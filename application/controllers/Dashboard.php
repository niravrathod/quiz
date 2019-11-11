<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('mdl_quiz');
        $this->load->model('mdl_questions');
		$this->load->model('mdl_options');
	}
	public function output($Return=array()){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        exit(json_encode($Return));
    }
	public function index()
	{
        $session = $this->session->userdata('user_logged');
        if ($session) 
        {
            $this->load->view('dashboard');
        }
        else
        {
            redirect('');
        }
	}
	public function get_quiz_data()
	{
		$session = $this->session->userdata('user_logged');
        if ($session) 
        {
        	//get quiz data
        	$quiz_data = array();
        	$quiz_master = $this->mdl_quiz->get('quiz_id');
        	foreach ($quiz_master->result() as $quiz_value) 
        	{
        		$quiz_data[] = array(
        			'quiz_id' => $quiz_value->quiz_id,
        			'quiz_name' => $quiz_value->quiz_name
        		);
        	}
        	echo json_encode($quiz_data);
        	exit;
        }
        else
        {
        	redirect('');
        }
	}
    public function start_quiz()
    {
        $session = $this->session->userdata('user_logged');
        if ($session) 
        {
            $Return = array('result'=>'', 'error'=>'','branches'=>'');
            if($this->input->get('quiz_id')==='') {
                $Return['error'] = "Select Quiz";
            } 

            if($Return['error']!=''){
                $this->output($Return);
            }
            //get question data from quiz id and its options
            $quiz_id = $this->input->get('quiz_id',TRUE);
            $data = array();
            $question_master = $this->mdl_questions->get_where_custom('quiz_id',$quiz_id);
            foreach ($question_master->result() as $question_value) 
            {
                $option_data = array();
                $options_master = $this->mdl_options->get_where_custom('question_id',$question_value->question_id);
                foreach ($options_master->result() as $key => $option_value) 
                {
                    if ($question_value->option_id ==  $option_value->option_id) 
                    {
                        $option_data[] = array(
                            'option_id' => $option_value->option_id,
                            'option_name' => $option_value->option_name,
                            'index' => $key
                        );
                    }
                    else
                    {
                        $option_data[] = array(
                            'option_id' => $option_value->option_id,
                            'option_name' => $option_value->option_name
                        );
                    }
                    
                }
                $data[] = array(
                    'question_id' => $question_value->question_id,
                    'question' => $question_value->question,
                    'suggestion' => $question_value->suggestion,
                    'options' => $option_data,
                );
            }
            echo json_encode($data);
            exit;
        }
        else
        {
            redirect('');
        }
    }
}
