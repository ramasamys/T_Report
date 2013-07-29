<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Summary extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('user', 'user', TRUE);
        $this->load->model('agent_summary', 'agent', TRUE);
    }

    public function agent() {
        if ($this->session->userdata('logged_in')) {
            $search['from'] = $this->input->post('from_date');
            $search['to'] = $this->input->post('to_date');
            $search['aname'] = $this->input->post('agent_name');
            $data['agent_summary'] = $this->agent->agentSummary($search);
            $this->load->view('agent_summary', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function queue() {
        if ($this->session->userdata('logged_in')) {
            $search['from'] = $this->input->post('from_date');
            $search['to'] = $this->input->post('to_date');
            $search['aname'] = $this->input->post('agent_name');            
            $data['queue_summary'] = $this->agent->queueSummary($search);
            $this->load->view('queue_summary', $data);
        } else {
            redirect('login/logout');
        }
    }

    function getAgentList() {
        $queryString = $this->input->get('q');
        $agent_list = $this->user->getAllAgents($queryString);
        $items = array();
        foreach ($agent_list as $values) {
            array_push($items, $values->agent);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }
	
    function getQueueList() {
        $queryString = $this->input->get('q');
        $queue_list = $this->user->getAllQueue($queryString);
        $items = array();
        foreach ($queue_list as $values) {
            array_push($items, $values->queuename);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

}
?>

