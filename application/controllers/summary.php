<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends CI_Controller {

	 function __construct() {
	      parent::__construct();
	      $this->load->helper(array('url','form'));
	      $this->load->model('user','user',TRUE);

	}
	public function agentSummary()
	{
		$this->load->view('agent_summary');
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
	
	public function queueSummary()
	{
		$this->load->view('queue_summary');
	}
	
} 
?>

