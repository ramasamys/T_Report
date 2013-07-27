<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('user','user',TRUE);
	      $this->load->model('agent_summary','agent',TRUE);
	}
	public function agent()
	{
	$search['from'] = $this->input->post('from_date');
	$search['to'] = $this->input->post('to_date');
	$search['aname'] = $this->input->post('agent_name');	
		$data['agent_summary'] = $this->agent->agentSummary($search);
		$this->load->view('agent_summary',$data);
	}
	
	public function queue()
	{


		$data['queue_summary'] = $this->agent->queueSummary();
		$this->load->view('queue_summary',$data);
	
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

