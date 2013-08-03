<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Useragent extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('agent', 'agent', TRUE);
		$this->load->library('form_validation');
        $this->load->model('global_pagination', 'global_pagination', TRUE);
        $this->load->model('global_pagination', 'global_pagination', TRUE);
    }

	
function settings()
   {
   $page_url = base_url() . "index.php/useragent/settings";
            $total_users = $this->agent->getuser_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
			$result_per_page = 10;
			
            $data['agent_details'] = $this->agent->getuser($result_per_page, $result_page);
			$data['links'] = $this->pagination->create_links();
            $this->load->view('agentdetails', $data );
   }
   function createnewuser() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('agentdetails');
        } else {
            redirect('login/logout');
        }
    }

    function insert() {

        $this->form_validation->set_rules('Username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
        $this->form_validation->set_rules('first_name', 'Firstname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required|xss_clean');

		


        if (isset($_POST['mail'])) {

            $this->form_validation->set_rules('mailid', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|numeric|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('agentdetails');
        } else {
            $this->load->model('agent');
            $myarray = array();
            $myarray['id'] = $this->pbxadmin->extensionInsert();
            $this->load->view('success', $myarray);
        }
    }

    function edit_extension() {

        $this->form_validation->set_rules('ext', 'Extension', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('name', 'Displayname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('secret', 'Secret', 'trim|required|alphanumeric|xss_clean');

        if (isset($_POST['mail'])) {

            $this->form_validation->set_rules('mailid', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|numeric|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('extension_view');
        } else {

            $this->pbxadmin->extensionUpdate();
            redirect('pbx_admin/extension_list');
        }
    }

    function deleteExtension() {
        if ($this->session->userdata('logged_in')) {

            $id = stripslashes($this->input->get('delete_id'));           
            $this->pbxadmin->extensionDelete($id);
            redirect('pbx_admin/extension_list');
        } else {
            redirect('login/logout');
        }
    
   }
   }
   ?>