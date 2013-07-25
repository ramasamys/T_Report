<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_content extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	     // $this->load->model('user','user',TRUE);

	}
	
	public function ivr()
	{
		$this->load->model('report');
		
	}
	
	public function did()
	{
		$this->load->model('report');
		$data['did_report'] = $this->report->didReport();
		$this->load->view('did_report',$data);
	}
	
	public function queue()
	{
		$this->load->model('report');
		$data['queue_report'] = $this->report->queueReport();
		$this->load->view('queue_report',$data);
	}
	
	public function outbound()
	{
		$this->load->model('report');
		$data['outbound_report'] = $this->report->outboundReport();
		$this->load->view('outbound_report',$data);
	}	
	
	public function predictive()
	{
		$this->load->model('report');
		$data['predictive_report'] = $this->report->dialerReport();
		$this->load->view('predictive_report',$data);
	}
	
	public function record()
	{
		$this->load->model('report');
		$data['record_report'] = $this->report->recordReport();
		$this->load->view('record_report',$data);
	}
	
} 
?>

