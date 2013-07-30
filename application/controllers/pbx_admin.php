<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('pbxadmin', 'admin', TRUE);
        $this->load->library('form_validation');
          $this->load->model('global_pagination', 'global_pagination', TRUE);
    }

    function list_extension() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/pbx_admin/list_extension";
            $total_users = $this->admin->extension_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->admin->extensionSelect($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            //print_r($data);
            $this->load->view('list_extension', $data);
        } else {
            redirect('login/logout');
        }
    }

    function add_extension() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('extension_view');
        } else {
            redirect('login/logout');
        }
    }

    function insert_extension() {

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
            $this->load->model('pbxadmin');
            $myarray = array();
            $myarray['id'] = $this->admin->extensionInsert();
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

            $this->admin->extensionUpdate();
            redirect('pbx_admin/extension_list');
        }
    }

    function delete_extension() {
        if ($this->session->userdata('logged_in')) {
            $this->admin->extensionDelete();
            redirect('pbx_admin/extension_list');
        } else {
            redirect('login/logout');
        }
    }

    function followme_list() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->admin->followmeList();
            $this->load->view('followme_list', $data);
        } else {
            redirect('login/logout');
        }
    }

    function followme_insert() {
        if ($this->session->userdata('logged_in')) {
            /* 		
              $this->pbxadmin->followmeInsert();
              redirect('pbx_admin/followme_list'); */
            $this->load->view('add_followme');
        } else {
            redirect('login/logout');
        }
    }

    function followme_update() {
        if ($this->session->userdata('logged_in')) {
            $this->admin->followmeUpdate();
            redirect('pbx_admin/followme_list');
        } else {
            redirect('login/logout');
        }
    }

    function followme_delete() {
        if ($this->session->userdata('logged_in')) {
            $this->admin->followmeDelete();
            redirect('pbx_admin/followme_list');
        } else {
            redirect('login/logout');
        }
    }

    function queue_list() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->admin->queueSelect();
            $this->load->view('queue_list', $data);
        } else {
            redirect('login/logout');
        }
    }

    function queue_insert() {
        if ($this->session->userdata('logged_in')) {
            $this->form_validation->set_rules('qname', 'Queue_name', 'trim|required|alphanumeric|xss_clean');

            $this->form_validation->set_rules('qwait', 'Queue_call_waiting', 'trim|required|alphanumeric|xss_clean');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('add_queue');
            } else {
                $this->admin->queueInsert();
                redirect('pbx_admin/queue_list');
            }
        } else {
            redirect('login/logout');
        }
    }

    function queue_update() {
        if ($this->session->userdata('logged_in')) {
            $this->admin->queueUpdate();
            redirect('pbx_admin/queue_list');
        } else {
            redirect('login/logout');
        }
    }

    function queue_delete() {
        if ($this->session->userdata('logged_in')) {
            $this->admin->queueDelete();
            redirect('pbx_admin/queue_list');
        } else {
            redirect('login/logout');
        }
    }

    function inbound_insert() {
        $this->load->view('add_inbound');
    }

    function inbound_list() {
        $data['result'] = $this->admin->inboundList();
        $this->load->view('list_inbound', $data);
    }

    function depended_value(){
    	$values = $this->admin->dependedValues();
    	//print_r($values);
    	return json_encode($values[0]);
    	    
    }
	
}
?>