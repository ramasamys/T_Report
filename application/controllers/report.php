<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('user','user',TRUE);

	}
	public function did()
	{
		$this->load->view('did_report');
	}
	
	public function queue()
	{
		$this->load->view('queue_report');
	}
	public function outbound()
	{
		$this->load->view('outbound_report');
	}	
} 
?>

