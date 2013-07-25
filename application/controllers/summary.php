<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('user','user',TRUE);

	}
	public function agentSummary()
	{
		$this->load->model('agent_summary');
		$data['agent_summary'] = $this->agent_summary->agentSummary();
		$this->load->view('agent_summary',$data);
		
	}
	
	public function queueSummary()
	{
	
		$this->load->model('agent_summary');
		$data['queue_summary'] = $this->agent_summary->queueSummary();
		$this->load->view('queue_summary',$data);
	
	}
	
	public function agent_summary_search()
	
	{
		$this->load->model('agent_summary');
		$from_date = $this->input->post('from_date');	
		$to_date = $this->input->post('to_date');
		$agent = $this->input->post('agent_name');
		
		$result = $this->agent_summary->agent_summary_search($from_date, $to_date, $agent);
		$this->load->view('agent_summary',$result);
	  
	
	}
	
	
	function getAgentList() {
	    $queryString = $this->input->get('q');
	    $agent_list = $this->user->getAllAgents($queryString);
	    $items = array();
	    foreach ($agent_list as $values) {
		array_push($items, $values->username);
	    }
	    if (count($items) == 0)
		return;
	    for ($i = 0; $i < count($items); $i++) {
		echo "$items[$i] \n";
	    }

	}
	
	
	
} 
?>

