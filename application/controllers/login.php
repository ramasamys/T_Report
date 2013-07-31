<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('user', 'user', TRUE);
    }

    public function index() {
        $this->load->view('login_form');
    }

    function verifyLogin() {

        $this->form_validation->set_rules('tv_username', 'Username', 'trim|required|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('tv_password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_form');
        } else {
            $this->checkSession();
        }
    }

    function checkSession() {
        $sessionValues = $this->session->userdata('logged_in');
        if (!empty($sessionValues) && $sessionValues['role'] == 'Administrator') {
            $this->load->view('admin_settings');
        }
        if (!empty($sessionValues) && $sessionValues['role'] == 'Agent') {
            $this->load->view('agent');
        }
        if (empty($sessionValues)) {
            $this->logout();
        }
    }

    function check_database($password) {

        $username = $this->input->post('username');
        $result = $this->user->checkLogin($username, $password);

        if (!empty($result)) {
        $timestamp = sha1(uniqid(5));
            $this->user->insertlogindetail($result[0]['username'], $timestamp);
            $user_details = array();
            foreach ($result as $row) :
                $user_details = array(
                    'id' => $row['id'],
                    'first_name' => $row['first_name'],
                    'username' => $row['username'],
                    'role' => $row['role'],
                    'sessionId' => $timestamp
                );
                $this->session->set_userdata('logged_in', $user_details);
            endforeach;
            return TRUE;
        }
        else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    public function profile() {
        if ($this->session->userdata('logged_in')) {
            $sessionValues = $this->session->userdata('logged_in');
            $data['user_details'] = $this->user->getUserInformation($sessionValues['id']);
            $this->load->view('profile', $data);
        } else {
            redirect('login/logout');
        }
    }

    function profile_updatation() {

        $this->form_validation->set_rules('tv_firstname', 'First Name', 'trim|required|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('tv_lastname', 'Last Name', 'trim|required|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('tv_password', 'Password', 'trim|required|min_length[5]|max_length[15]|matches[passconf]');
        $this->form_validation->set_rules('tv_confirm_password', 'Confirm Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('profile');
        } else {
            $this->load->view('admin_settings');
        }
    }

    function queue_login() {
        if ($this->session->userdata('logged_in')) {
            $number = $this->user->agentQueue();
        } else {
            redirect('login/logout');
        }
    }

    function agentmaincontrol() {
        if ($this->session->userdata('logged_in')) {
         $data['pas']=$this->user->pausestatus();
        // print_r($data);
         
            $this->load->view('agentmain',$data);
        } else {
            redirect('login/logout');
        }
    }
    function agentpause(){
       if ($this->session->userdata('logged_in')) {
       	       
            $this->user->agentpausefun();
            
        } else {
        	
            redirect('login/logout');
            
        }	    
    	    
	    
    }
    public function logout() {
        $this->user->loggedout();
        $this->session->sess_destroy();
        redirect();
    }

}
?>

