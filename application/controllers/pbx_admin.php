<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
		  $this->load->library("pagination");
	      $this->load->model('pbxadmin','pbxadmin',TRUE);
		   $this->load->model('global_pagination','global_pagination',TRUE);
		  $this->load->library('form_validation');
	}
	
	function list_extension()
	{
		$page_url 			=	base_url() . "index.php/pbx_admin/list_extension";
		$total_users 		=	$this->pbxadmin->extension_count();
		$result_page		=	$this->global_pagination->index($page_url,$total_users);
		$result_per_page	=	10;		
		$data['result'] = $this->pbxadmin->extensionSelect($result_per_page,$result_page);
		$data['links']	=$this->pagination->create_links();
		//print_r($data);
		$this->load->view('list_extension',$data);
			
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
			$this->load->view('list_followme',$data);
			
					
	}
	function followme_insert()
	{
			/*		
			$this->pbxadmin->followmeInsert();
			redirect('pbx_admin/followme_list');*/
			$this->load->view('add_followme');
					
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
			$this->load->view('list_queue',$data);
			
	
	}
	
	function queue_insert()
	{
	
			$this->form_validation->set_rules('qname', 'Queue_name', 'trim|required|alphanumeric|xss_clean');
			
			$this->form_validation->set_rules('qwait', 'Queue_call_waiting', 'trim|required|alphanumeric|xss_clean');
				
				if ($this->form_validation->run() == FALSE)
					{
				
						$this->load->view('add_queue');
			
					}
				
				else
					{
						$this->pbxadmin->queueInsert();
						redirect('pbx_admin/queue_list');
					}
	
	
	
		       /* $this->pbxadmin->queueInsert();
			redirect('pbx_admin/queue_list');
			$this->load->view('add_queue');*/
	
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
		
	function inbound_list()
	{
		$data['result'] = $this->pbxadmin->inboundList();
		$this->load->view('list_inbound',$data);
	}
	
			
	function inbound_insert()
	{
		$this->load->view('add_inbound');
	}
	
	}	
	
?>