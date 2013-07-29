<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_content extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library("pagination");
        $this->load->model('report', 'report', TRUE);
        $this->load->model('global_pagination', 'global_pagination', TRUE);
    }

    public function ivr() {
        
    }

    public function did() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/report_content/did";
            $total_users = $this->report->did_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $data['did_report'] = $this->report->didReport(3, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('did_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function queue() {
        if ($this->session->userdata('logged_in')) {

            $data['queue_report'] = $this->report->queueReport();
            $this->load->view('queue_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function outbound() {
        if ($this->session->userdata('logged_in')) {

            $data['outbound_report'] = $this->report->outboundReport();
            $this->load->view('outbound_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function predictive() {
        if ($this->session->userdata('logged_in')) {

            $data['predictive_report'] = $this->report->dialerReport();
            $this->load->view('predictive_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function record() {
        if ($this->session->userdata('logged_in')) {

            $data['record_report'] = $this->report->recordReport();
            $this->load->view('record_report', $data);
        } else {
            redirect('login/logout');
        }
    }

}

?>

