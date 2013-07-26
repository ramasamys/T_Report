<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('user','user',TRUE);
		  $this->load->library('form_validation');

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
					
					
				$this->load->view('extension_list');
				}
		
	}
	
	
	function follow_me()
	{
	
	}
	
	function queue()
	{
	
	}
		
	function inbound()
	{
	
	}
	
	}	
	
?>