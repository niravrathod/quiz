<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
            $this->load->view('register');
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
        $username_check = $this->mdl_user->get_where_custom('username',$username);
        if (!empty($username_check->result()) || $username == 'admin') 
        {
            $Return['error'] = "Username Already Exists";
            $this->output($Return);
        }

        $data = array(
            'username' => $username,
            'password' => $password
        );

        $add_user = $this->mdl_user->_insert($data);
        if (!empty($add_user)) 
        {
            $Return['result'] = "Registration Successfully Done!";
        }
        else
        {
            $Return['error'] = "Something Went Wrong!";
        }
        $this->output($Return);
        exit;
    }
}
