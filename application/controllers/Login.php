<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('mdl_user');
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
            redirect('dashboard');
        }
        else
        {
            $this->load->view('login');
        }
	}
	public function check_login()
    {
        $Return = array('result'=>'', 'error'=>'','branches'=>'');
        if($this->input->post('username')==='') {
            $Return['error'] = "Enter your user name";
        } else if($this->input->post('password')==='') {
            $Return['error'] = "Enter your password";
        }

        if($Return['error']!=''){
            $this->output($Return);
        }

        $username = $this->input->post('username',TRUE);
        $password = sha1($this->input->post('password',TRUE));
        $username_check = $this->mdl_user->get_where_custom('username',$username);
        $password_check = $this->mdl_user->get_where_custom('password',sha1($password));

        if ((!empty($username_check) && (!empty($password_check)))) 
        {
            $session_data = array(
                'user_logged' => TRUE,
                'username' => $username,
                'user_id' => $username_check->result()[0]->user_id
            );
            $this->session->set_userdata($session_data);
            $Return['result'] = "Welcome ".$username;
        }
        else
        {
            $Return['error'] = "Either your Username or Password is InCorrect! Plz Type Correct One!";
        }
        $this->output($Return);
        exit;
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        //unset($_SESSION);
        redirect('');
    }
}
