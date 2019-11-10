<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mdl_quiz');
	}
	public function output($Return=array()){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        exit(json_encode($Return));
    }
	public function index()
	{
        $session = TRUE;//$this->session->userdata('user_logged');
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
		$session = TRUE;//$this->session->userdata('user_logged');
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
        $session = TRUE;//$this->session->userdata('user_logged');
        if ($session) 
        {
            $Return = array('result'=>'', 'error'=>'','branches'=>'');
            if($this->input->get('quiz_id')==='') {
                $Return['error'] = "Select Quiz";
            } 

            if($Return['error']!=''){
                $this->output($Return);
            }
            //get quiz data
            $quiz_id = $this->input->get('quiz_id',TRUE);
            $quiz_data = array();
            $quiz_master = $this->mdl_quiz->get_where($quiz_id);
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
	public function check_register()
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
        $flag = 0;
        $role = "";
        //$check = Model\Model_register::find_by_email($email);
        $username_check = Model\Model_register::find_by_username($username);
        $password_check = Model\Model_register::find_by_password($password);

        // $check = $this->db->query("SELECT * FROM user_master WHERE username = '$username' AND password = '$password'");
        //$data = $check->row();
        if ((!empty($username_check) && (!empty($password_check)))) 
        {
            $flag = 1;

            $result = new Model\Model_register;
            $data = $result->_useForeach($username_check);
            $branch_data = array();
            // $alloc_check = Model\Model_branch_user_alloc::distinct()->select('branch_id')->find_by_user_id($data->user_id);
            $now = date_create('now')->format('H:i:s');
            $alloc_check = Model\Model_branch_user_alloc::distinct()->select('branch_id')->where('user_id = "'.$data->user_id.'" AND isActive != 0 AND start_time <= "'.$now.'" AND end_time > "'.$now.'"')->all();
            $branch_id = array();
            if (!empty($alloc_check)) {
                $ct = 0;
                foreach ($alloc_check as $alloc_value) 
                {
                    
                    // else if($ct > 1)
                    // {

                    // }
                    $ct++;
                }
                if ($ct == 1 && $ct > 0 && $ct < 2) 
                {
                    $branch_id = $alloc_check[0]->branch_id;       
                }
                else if($ct > 1)
                {
                    foreach ($alloc_check as $branch_value) 
                    {
                        $branch_id[] = array(
                            "branch_name" => $branch_value->branch_master()->branch_name,
                            "branch_id" => $branch_value->branch_master()->branch_id
                        );
                    }
                    $branches = json_encode($branch_id);
                    // $this->load->view("select_branch",$branches);
                    $Return['branches'] = $branches;

                }
            }
            else
            {
                $b_data = Model\Model_branch::find_by_company_id($data->company_id);
                if (!empty($b_data)) 
                {
                    $branch_id = $b_data[0]->branch_id;    
                }
            }
            $now = date_create('now')->format('H:i:s');
            $result2 = Model\Model_branch_user_alloc::distinct()->select('branch_id')->where('user_id = "'.$data->user_id.'" AND isActive != 0 AND start_time <= "'.$now.'" AND end_time > "'.$now.'"')->all();
            if (!empty($result2)) 
            {

                foreach ($result2 as $key => $branch) {
                    if ($branch->branch_id != 0) 
                    {
                        $branch_data[] = array("branch_id" => $branch->branch_id,"branch_name" => $branch->branch_master()->branch_name);
                    }
                    
                }
            }
            else
            {
                $check_active = Model\Model_branch_user_alloc::distinct()->select('branch_id')->where('user_id = "'.$data->user_id.'" AND isActive = 0')->all();
                if (!empty($check_active)) 
                {
                    $branch_data = array();
                }
                else
                {
                    foreach ($b_data as $branch_d) {
                        $branch_data[] = array("branch_id" => $branch_d->branch_id,"branch_name" => $branch_d->branch_name);
                    }
                }
                
            }
            $company_master = Model\Model_company::find($data->company_id);
            $start_period_date_format = '';
            $end_period_date_format = '';
            if (!empty($company_master)) 
            {
                //set start-end period
                $start_period_date = date_create($company_master->start_period);
                $start_period_date_format = date_format($start_period_date,"Y-m-d");
                $end_period_date = date_create($company_master->end_period);
                $end_period_date_format = date_format($end_period_date,"Y-m-d");
            }
            $arraydata = array(
                'user_logged' => TRUE,
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'user_id' => $data->user_id,
                'company_id' => $data->company_id,
                'branch_data' => json_encode($branch_data),
                'branch_id' => $branch_id,
                'start_period' => $start_period_date_format,
                'end_period' => $end_period_date_format
                

            );

            if (is_array($branch_id)) 
            {
                $b_len = count($branch_id);
            }
            else
            {
                $b_len = 1;
            }
            // $b_alloc = Model\Model_branch_user_alloc::find_by_user_id($data->user_id);
            $now = date_create('now')->format('H:i:s');
            $b_alloc = Model\Model_branch_user_alloc::where('user_id = "'.$data->user_id.'" AND isActive != 0 AND start_time <= "'.$now.'" AND end_time > "'.$now.'"')->all();
            $b_alloc_check = Model\Model_branch_user_alloc::find_by_user_id($data->user_id);
            $permissions = "";
            $start_time = "";
            $end_time = "";
            if ($b_len==1) 
            {
                if (!empty($b_alloc)) 
                {
                    foreach ($b_alloc as $b_value) 
                    {
                       $role_permission_mapper_master = Model\Model_role_permission_mapper::find_by_role_id($b_value->user_role_master()->role_id);
                        foreach ($role_permission_mapper_master as $value) {
                            $permissions = $value->permission_master()->permission_name .",". $permissions;
                        }
                        $start_time .= $b_value->start_time;
                        $end_time .= $b_value->end_time;
                    }
                }
                else if(empty($b_alloc_check))
                {
                    $permissions = 'ROLE_ADMIN,';
                }
                else
                {
                    $Return['error'] = "Sorry You Can't Login!";
                }
                $permissions = substr($permissions, 0, -1);
                $arraydata['permission_name'] = $permissions;

            }
            if(empty($branch_data) && empty($b_alloc_check))
            {
                $arraydata['permission_name'] = 'ROLE_ADMIN,';
            }
            
            if ($start_time != NULL && $end_time != NULL) 
            {
                $now = date_create('now')->format('H:i:s');
                if ($now >= $start_time && $now < $end_time) 
                {
                    $this->session->set_userdata($arraydata);
                    $Return['result'] = "Welcome ".$data->username." !"; 
                }
                else
                {
                    $Return['error'] = "Sorry You Can't Login!";
                }

            }
            else if(empty($branch_data) && !empty($b_alloc_check))
            {
                $Return['error'] = "Sorry You Can't Login!";
            }
            else
            {
                $this->session->set_userdata($arraydata);
                $Return['result'] = "Welcome ".$data->username." !";
            }

            
            // print_r($arraydata);die();
            


        }
        else
        {
            $Return['error'] = "Either your Username or Password is InCorrect! Plz Type Correct One!";
        }
        if ($flag == 0) {
            $Return['error'] = "Either your Username or Password is InCorrect! Plz Type Correct One!";
        }
        $this->output($Return);
        exit;
    }
}
