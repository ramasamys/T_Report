<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('user','user',TRUE);

	}
	
	function extension()
	{
		$this->load->view('extension_view.php');
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