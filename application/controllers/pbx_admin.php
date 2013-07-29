<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('pbxadmin', 'pbxadmin', TRUE);
		$this->load->model('global_pagination', 'global_pagination', TRUE);
        $this->load->library('form_validation');
    }

    function viewExtension() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/pbx_admin/list_extension";
            $total_users = $this->pbxadmin->extension_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->pbxadmin->extensionSelect($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            //print_r($data);
            $this->load->view('list_extension', $data);
        } else {
            redirect('login/logout');
        }
    }
	
	function getExtension() {
        $queryString = $this->input->get('q');
		$follow_list = $this->pbxadmin->getAllExtension($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->name);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

    function createExtension() {
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

    function delete_extension() {
        if ($this->session->userdata('logged_in')) {
            $this->pbxadmin->extensionDelete();
            redirect('pbx_admin/extension_list');
        } else {
            redirect('login/logout');
        }
    }

    function followme_list() {
        if ($this->session->userdata('logged_in')) 
			{
         
				$page_url = base_url() . "index.php/pbx_admin/followme_list";
				$total_users = $this->pbxadmin->followme_count();
				$result_page = $this->global_pagination->index($page_url, $total_users);
				$result_per_page = 10;
				$data['result'] = $this->pbxadmin->followmeList($result_per_page, $result_page);
				$data['links'] = $this->pagination->create_links();
            	$this->load->view('list_followme', $data);
			            
			
			} 
			else 
			{
				redirect('login/logout');
			}
    }
	 

	function getFollow() {
        $queryString = $this->input->get('q');
		$follow_list = $this->pbxadmin->getAllFollowme($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->f_name);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
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
            $this->pbxadmin->followmeUpdate();
            redirect('pbx_admin/followme_list');
        } else {
            redirect('login/logout');
        }
    }

    function followme_delete() {
        if ($this->session->userdata('logged_in')) {
            $this->pbxadmin->followmeDelete();
            redirect('pbx_admin/followme_list');
        } else {
            redirect('login/logout');
        }
    }

    function queue_list() {
        if ($this->session->userdata('logged_in')) {
		
		
		    $page_url = base_url() . "index.php/pbx_admin/queue_list";
            $total_users = $this->pbxadmin->queue_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->pbxadmin->queueSelect($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('list_queue', $data);
		
		
        } else {
            redirect('login/logout');
        }
    }
	
	function getQueue() {
        $queryString = $this->input->get('q');
		$follow_list = $this->pbxadmin->getAllQueue($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->name);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

    function queue_insert() {
        if ($this->session->userdata('logged_in')) {
            $this->form_validation->set_rules('qname', 'Queue_name', 'trim|required|alphanumeric|xss_clean');

            $this->form_validation->set_rules('qwait', 'Queue_call_waiting', 'trim|required|alphanumeric|xss_clean');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('add_queue');
            } else {
                $this->pbxadmin->queueInsert();
                redirect('pbx_admin/queue_list');
            }
        } else {
            redirect('login/logout');
        }
    }

    function queue_update() {
        if ($this->session->userdata('logged_in')) {
            $this->pbxadmin->queueUpdate();
            redirect('pbx_admin/queue_list');
        } else {
            redirect('login/logout');
        }
    }

    function queue_delete() {
        if ($this->session->userdata('logged_in')) {
            $this->pbxadmin->queueDelete();
            redirect('pbx_admin/queue_list');
        } else {
            redirect('login/logout');
        }
    }

    function inbound_insert() {
        $this->load->view('add_inbound');
    }

    function inbound_list() {
	
	
		    $page_url = base_url() . "index.php/pbx_admin/inbound_list";
            $total_users = $this->pbxadmin->inbound_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->pbxadmin->inboundList($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('list_inbound', $data);
			
			
	
    }
	
	function getInbound() {
        $queryString = $this->input->get('q');
		$follow_list = $this->pbxadmin->getAllInbound($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->did_num);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }
}
?>