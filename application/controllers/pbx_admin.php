<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('pbxadmin','admin',TRUE);
		  $this->load->library('form_validation');
	}
	
	function list_extension()
	{
	$this->load->view('extension_list');
	}
	
	function add_extension()
	{
		$this->load->view('extension_view');
	}
	
	function insert_extension()
	{
		
		$this->form_validation->set_rules('ext', 'Extension', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('name', 'Displayname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('secret', 'Secret', 'trim|required|alphanumeric|xss_clean');
		
			if (isset($_POST['mail']))
				{
		
					$this->form_validation->set_rules('mailid', 'Email', 'trim|required|valid_email|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|numeric|xss_clean');
			
				}
		
			if ($this->form_validation->run() == FALSE)
				{
				
					$this->load->view('extension_view');
			
				}
			else
				{
					$this->load->model('pbxadmin');
					$myarray = array();
					$myarray['id'] = $this->pbxadmin->extensionInsert();
					$this->load->view('success',$myarray);
					//print_r($myarray);exit;
					
					
				}
		
	}
	function edit_extension()
	{
		
		$this->form_validation->set_rules('ext', 'Extension', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('name', 'Displayname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('secret', 'Secret', 'trim|required|alphanumeric|xss_clean');
		
			if (isset($_POST['mail']))
				{
		
					$this->form_validation->set_rules('mailid', 'Email', 'trim|required|valid_email|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|numeric|xss_clean');
			
				}
		
			if ($this->form_validation->run() == FALSE)
				{
				
					$this->load->view('extension_view');
			
				}
			else
				{
					
					$this->pbxadmin->extensionUpdate();
					redirect('pbx_admin/extension_list');
					
				}
		
	}
	function delete_extension()
	{		
				
					$this->pbxadmin->extensionDelete();
					redirect('pbx_admin/extension_list');
		
	}
	
	
	function followme_list()
	{
					
			$data['result'] = $this->pbxadmin->followmeList();
			$this->load->view('followme_list',$data);
					
	}
	function followme_insert()
	{
					
			$this->pbxadmin->followmeInsert();
			redirect('pbx_admin/followme_list');
					
	}
	
	function followme_update()
	{

			$this->pbxadmin->followmeUpdate();
			redirect('pbx_admin/followme_list');
					
	}
	function followme_delete()
	{

			$this->pbxadmin->followmeDelete();
			redirect('pbx_admin/followme_list');
					
	}
	
	function queue_list()
	{
		        $data['result'] = $this->pbxadmin->queueSelect();
			$this->load->view('queue_list',$data);
	
	}
	
	function queue_insert()
	{
		        $this->pbxadmin->queueInsert();
			redirect('pbx_admin/queue_list');
	
	}
	
	function queue_update()
	{
		        $this->pbxadmin->queueUpdate();
			redirect('pbx_admin/queue_list');
	
	}
	
	function queue_delete()
	{
		        $this->pbxadmin->queueDelete();
			redirect('pbx_admin/queue_list');
	
	}
		
	function inbound()
	{
	
	}
	
	}	
	
?>