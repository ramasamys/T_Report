<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_content extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'download'));
        $this->load->library("pagination");
        $this->load->model('report', 'report', TRUE);
        $this->load->model('global_pagination', 'global_pagination', TRUE);
    }

    public function ivr() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('ivr_report');
        } else {
            redirect('login/logout');
        }
    }

    public function did() {
        if ($this->session->userdata('logged_in')) {
            $count = "";
            $page_url = base_url() . "index.php/report_content/did";
            $total_users = $this->report->did_count($count);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['did_report'] = $this->report->didReport($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('did_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function queue() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/report_content/queue";
            $total_users = $this->report->queue_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['queue_report'] = $this->report->queueReport($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('queue_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function outbound() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/report_content/outbound";
            $total_users = $this->report->outbound_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['outbound_report'] = $this->report->outboundReport($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('outbound_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function predictive() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/report_content/predictive";
            $total_users = $this->report->dialer_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['predictive_report'] = $this->report->dialerReport($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('predictive_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    public function record() {
        if ($this->session->userdata('logged_in')) {
            $page_url = base_url() . "index.php/report_content/record";
            $total_users = $this->report->record_count();
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['record_report'] = $this->report->recordReport($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('record_report', $data);
        } else {
            redirect('login/logout');
        }
    }

    function auto_get_agent() {
        if ($this->session->userdata('logged_in')) {
            $queryString = $this->input->get('q');
            $agent_list = $this->report->getAgents($queryString);
            $items = array();
            foreach ($agent_list as $values) {
                array_push($items, $values->dst);
            }
            if (count($items) == 0)
                return;
            for ($i = 0; $i < count($items); $i++) {
                echo "$items[$i] \n";
            }
        } else {
            redirect('login/logout');
        }
    }

    function auto_get_phone() {
        if ($this->session->userdata('logged_in')) {
            $queryString = $this->input->get('q');
            $agent_list = $this->report->getPhone($queryString);
            $items = array();
            foreach ($agent_list as $values) {
                array_push($items, $values->clid);
            }
            if (count($items) == 0)
                return;
            for ($i = 0; $i < count($items); $i++) {
                echo "$items[$i] \n";
            }
        } else {
            redirect('login/logout');
        }
    }

    function predictive_agent() {
        if ($this->session->userdata('logged_in')) {
            $queryString = $this->input->get('q');
            $agent_list = $this->report->getPredictiveAgents($queryString);
            $items = array();
            foreach ($agent_list as $values) {
                array_push($items, $values->agent);
            }
            if (count($items) == 0)
                return;
            for ($i = 0; $i < count($items); $i++) {
                echo "$items[$i] \n";
            }
        } else {
            redirect('login/logout');
        }
    }

    function predictive_phone() {
        if ($this->session->userdata('logged_in')) {
            $queryString = $this->input->get('q');
            $agent_list = $this->report->getPredictivePhone($queryString);
            $items = array();
            foreach ($agent_list as $values) {
                array_push($items, $values->dest);
            }
            if (count($items) == 0)
                return;
            for ($i = 0; $i < count($items); $i++) {
                echo "$items[$i] \n";
            }
        } else {
            redirect('login/logout');
        }
    }

    function audio_donwload($audio) {
        if ($this->session->userdata('logged_in')) {
            $path = base_url() . "audio/";
            $audio_name = $audio . ".mp3";
            $full_path = $path . $audio . ".mp3";
            $data = file_get_contents("$full_path");
            force_download("$audio_name", $data);
        } else {
            redirect('login/logout');
        }
    }

}
?>

