<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pbx_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('pbxadmin', 'pbxadmin', TRUE);
        $this->load->library('form_validation');
        $this->load->model('global_pagination', 'global_pagination', TRUE);
    }

    function viewExtension() {
        if ($this->session->userdata('logged_in')) {

            $search_ext = "";
            $page_url = base_url() . "index.php/pbx_admin/viewExtension";
            $total_users = $this->pbxadmin->extension_count($search_ext);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;

            $data['result'] = $this->pbxadmin->extensionSelect($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('list_extension', $data);
        } else {
            redirect('login/logout');
        }
    }

    function searchExtension() {
        if ($this->session->userdata('logged_in')) {
            $searchterm = $this->pbxadmin->searchterm_handler(stripslashes($this->input->get_post('search')));
            $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            $page_url = base_url() . "index.php/pbx_admin/searchExtension";
            $total_users = $this->pbxadmin->extension_count($searchterm);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $search_data['result'] = $this->pbxadmin->extensionSearch($searchterm, $limit);
            $search_data['links'] = $this->pagination->create_links();
            $data['searchterm'] = $searchterm;
            $this->load->view('list_extension', $search_data);
        } else {
            redirect('login/logout');
        }
    }

    function getExtension() {
        $queryString = $this->input->get('q');
        $follow_list = $this->pbxadmin->getAllExtension($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->name);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

    function createExtension() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('extension_view');
        } else {
            redirect('login/logout');
        }
    }

    function insert_extension() {

        if ($this->session->userdata('logged_in')) {
            $sipextension = stripslashes($this->input->post('sipextension'));
            $context = stripslashes($this->input->post('extension_context'));
            $mailid = stripslashes($this->input->post('email_id'));
            $password_ext = stripslashes($this->input->post('password_ext'));

            $sipname['exten'] = $sipextension;
            $sipname['name'] = stripslashes($this->input->post('display_name'));

            $sipusers['name'] = $sipextension;
            $sipusers['host'] = stripslashes($this->input->post('extension_host'));
            $sipusers['context'] = $context;
            $sipusers['fromuser'] = $sipextension;
            $sipusers['mailbox'] = $mailid;
            $sipusers['username'] = $sipextension;
            $sipusers['sippasswd'] = $password_ext;
            $sipusers['callgroup'] = stripslashes($this->input->post('call_group'));
            $sipusers['pickupgroup'] = stripslashes($this->input->post('call_pickup_group'));
            $sipusers['secret'] = stripslashes($this->input->post('secret_fld'));

            $sipvoice['customer_id'] = $sipextension;
            $sipvoice['mailbox'] = $sipextension;
            $sipvoice['password'] = $password_ext;
            $sipvoice['email'] = $mailid;
            $sipvoice['context'] = $context;


            $upd_sipname['name'] = stripslashes($this->input->post('display_name'));

            $upd_sipusers['host'] = stripslashes($this->input->post('extension_host'));
            $upd_sipusers['context'] = $context;
            $upd_sipusers['secret'] = stripslashes($this->input->post('secret_fld'));
            $upd_sipusers['callerid'] = stripslashes($this->input->post('edit_callerid'));


            $upd_sipvoice['context'] = $context;


            $checkExtensionExist = $this->pbxadmin->checkExtension($sipextension);

            if (empty($checkExtensionExist)) {

                $insertid_array = $this->pbxadmin->extensionInsert($sipname, $sipusers, $sipvoice);

                $sipuser_id = $insertid_array[0];
                $sipname_id = $insertid_array[1];
                $voiceboxes_id = $insertid_array[2];

                if (empty($sipuser_id) || empty($sipname_id) || empty($voiceboxes_id)) {
                    $this->pbxadmin->extension_insert_fail($sipuser_id, $sipname_id, $voiceboxes_id);
                } else {
                    echo json_encode(array('status' => 'success'));
                }
            } else {
                $update_array = $this->pbxadmin->extensionUpdate($sipextension, $upd_sipname, $upd_sipusers, $upd_sipvoice);
                echo json_encode(array('status' => 'updated'));
            }
        } else {
            redirect('login/logout');
        }
    }

    function edit_extension() {

        $this->form_validation->set_rules('ext', 'Extension', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('name', 'Displayname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('secret', 'Secret', 'trim|required|alphanumeric|xss_clean');

        $chekMail = stripslashes($this->input->post('mail'));
        if (isset($chekMail)) {
            $this->form_validation->set_rules('mailid', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|numeric|xss_clean');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('extension_view');
        } else {
            $this->pbxadmin->extensionUpdate();
            redirect('pbx_admin/extension_list');
        }
    }

    function deleteExtension() {
        if ($this->session->userdata('logged_in')) {
            $id = stripslashes($this->input->post('delete_id'));
            $this->pbxadmin->extensionDelete($id);
            redirect('pbx_admin/extension_list');
        } else {
            redirect('login/logout');
        }
    }

    function followme() {
        if ($this->session->userdata('logged_in')) {
            $search = "";
            $page_url = base_url() . "index.php/pbx_admin/followme";
            $total_users = $this->pbxadmin->followme_count($search);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->pbxadmin->followmeList($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $data['extension_list'] = $this->pbxadmin->getExtension();
            $data['depended_value'] = $this->pbxadmin->dependent_values('Queue');
            $this->load->view('list_followme', $data);
        } else {
            redirect('login/logout');
        }
    }

    function followme_search() {
        if ($this->session->userdata('logged_in')) {
            $searchterm = $this->pbxadmin->searchterm_handler($this->input->get_post('search'));
            $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            $page_url = base_url() . "index.php/pbx_admin/followme_search";
            $total_users = $this->pbxadmin->followme_count($searchterm);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $search_data['result'] = $this->pbxadmin->followmeSearch($searchterm, $limit);
            $search_data['links'] = $this->pagination->create_links();
            $data['searchterm'] = $searchterm;
            $this->load->view('list_followme', $search_data);
        } else {
            redirect('login/logout');
        }
    }

    function getFollow() {
        $queryString = $this->input->get('q');
        $follow_list = $this->pbxadmin->getAllFollowme($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->f_name);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

    function followme_insert() {
        if ($this->session->userdata('logged_in')) {

            $followme_name = stripslashes($this->input->post('followme_name'));
            $followme_insert_value['f_name'] = $followme_name;
            $followme_insert_value['ringtime'] = stripslashes($this->input->post('ring_time'));
            $followme_insert_value['extlist'] = stripslashes($this->input->post('followme_list'));
            $followme_insert_value['setdst'] = stripslashes($this->input->post('set_destination'));
            $followme_insert_value['dst'] = stripslashes($this->input->post('dependent_destination'));


            $upd_followme_insert['ringtime'] = stripslashes($this->input->post('ring_time'));
            $upd_followme_insert['extlist'] = stripslashes($this->input->post('followme_list'));
            $upd_followme_insert['setdst'] = stripslashes($this->input->post('set_destination'));
            $upd_followme_insert['dst'] = stripslashes($this->input->post('dependent_destination'));


            $check_followme = $this->pbxadmin->checkFollowme($followme_name);

            if (empty($check_followme)) {
                $followme_array = $this->pbxadmin->followmeInsert($followme_insert_value);

                echo json_encode(array('status' => 'success'));
            } else {
                $followme_update = $this->pbxadmin->followmeUpdate($followme_name, $upd_followme_insert);
                echo json_encode(array('status' => 'updated'));
            }
        } else {
            redirect('login/logout');
        }
    }

    function followme_delete() {
        if ($this->session->userdata('logged_in')) {
            $followme_delete_id = stripslashes($this->input->post('followme_delete_id'));
            $this->pbxadmin->followmeDelete($followme_delete_id);
            redirect('pbx_admin/followme');
        } else {
            redirect('login/logout');
        }
    }

    function queue() {
        if ($this->session->userdata('logged_in')) {
            $search = "";
            $page_url = base_url() . "index.php/pbx_admin/queue";
            $total_users = $this->pbxadmin->queue_count($search);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->pbxadmin->queueSelect($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('list_queue', $data);
        } else {
            redirect('login/logout');
        }
    }

    function queue_search() {
        if ($this->session->userdata('logged_in')) {
            $searchterm = $this->pbxadmin->searchterm_handler(stripslashes($this->input->get_post('search')));
            $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            $page_url = base_url() . "index.php/pbx_admin/queue_search";
            $total_users = $this->pbxadmin->queue_count($searchterm);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $search_data['result'] = $this->pbxadmin->queueSearch($searchterm, $limit);
            $search_data['links'] = $this->pagination->create_links();
            $data['searchterm'] = $searchterm;
            $this->load->view('list_queue', $search_data);
        } else {
            redirect('login/logout');
        }
    }

    function getQueue() {
        $queryString = $this->input->get('q');
        $follow_list = $this->pbxadmin->getAllQueue($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->name);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

    function queue_insert() {
        if ($this->session->userdata('logged_in')) {
            $queue_name = stripslashes($this->input->post('queue_name'));
            $queue_insertion['name'] = $queue_name;
            $queue_insertion['timeout'] = stripslashes($this->input->post('time_out'));
            $queue_insertion['queue_callswaiting'] = stripslashes($this->input->post('queue_call_wait'));
            $queue_insertion['announce_frequency'] = stripslashes($this->input->post('announce_frequency'));
            $queue_insertion['announce_holdtime'] = stripslashes($this->input->post('announce_holdtime'));
            $queue_insertion['retry'] = stripslashes($this->input->post('retry'));
            $queue_insertion['wrapuptime'] = stripslashes($this->input->post('wrapup_time'));
            $queue_insertion['maxlen'] = stripslashes($this->input->post('max_wait_time'));
            $queue_insertion['servicelevel'] = stripslashes($this->input->post('service_level'));
            $queue_insertion['strategy'] = stripslashes($this->input->post('ring_statergy'));
            $queue_insertion['joinempty'] = stripslashes($this->input->post('join_empty'));
            $queue_insertion['leavewhenempty'] = stripslashes($this->input->post('leave_when_empty'));
            $queue_insertion['eventmemberstatus'] = stripslashes($this->input->post('event_member_status'));
            $queue_insertion['eventwhencalled'] = stripslashes($this->input->post('event_when_called'));
            $queue_insertion['reportholdtime'] = stripslashes($this->input->post('report_hold_time'));
            $queue_insertion['memberdelay'] = stripslashes($this->input->post('member_delay'));
            $queue_insertion['weight'] = stripslashes($this->input->post('queue_weight'));
            $queue_insertion['timeoutrestart'] = stripslashes($this->input->post('timeout_restart'));
            $queue_insertion['ringinuse'] = stripslashes($this->input->post('ring_in_use'));
            $upd_queue_insertion['timeout'] = stripslashes($this->input->post('time_out'));
            $upd_queue_insertion['queue_callswaiting'] = stripslashes($this->input->post('queue_call_wait'));
            $upd_queue_insertion['retry'] = stripslashes($this->input->post('retry'));
            $upd_queue_insertion['strategy'] = stripslashes($this->input->post('ring_statergy'));

            $checkQueueExist = $this->pbxadmin->checkQueue($queue_name);

            if (empty($checkQueueExist)) {
                $this->pbxadmin->queueInsert($queue_insertion);
                echo json_encode(array('status' => 'success'));
            } else {
                $update_array = $this->pbxadmin->queueUpdate($queue_name, $upd_queue_insertion);
                echo json_encode(array('status' => 'updated'));
            }
        } else {
            redirect('login/logout');
        }
    }

    function queue_delete() {
        if ($this->session->userdata('logged_in')) {
            $queue_delete_id = stripslashes($this->input->post('queue_delete_id'));
            $this->pbxadmin->queueDelete($queue_delete_id);
            redirect('pbx_admin/queue');
        } else {
            redirect('login/logout');
        }
    }

    function inbound() {
        if ($this->session->userdata('logged_in')) {
            $search = "";
            $page_url = base_url() . "index.php/pbx_admin/inbound";
            $total_users = $this->pbxadmin->inbound_count($search);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $result_per_page = 10;
            $data['result'] = $this->pbxadmin->inboundList($result_per_page, $result_page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('list_inbound', $data);
        } else {
            redirect('login/logout');
        }
    }

    function insert_inbound() {
        if ($this->session->userdata('logged_in')) {
            $did_number = stripslashes($this->input->post('did_number'));
            $inbound_insertion['did_num'] = $did_number;
            $inbound_insertion['did_name'] = stripslashes($this->input->post('did_name'));
            $inbound_insertion['setdst'] = stripslashes($this->input->post('set_destination'));
            $inbound_insertion['dst'] = stripslashes($this->input->post('dependent_destination'));

            $upd_inbound_insertion['did_name'] = stripslashes($this->input->post('did_name'));
            $upd_inbound_insertion['setdst'] = stripslashes($this->input->post('set_destination'));
            $upd_inbound_insertion['dst'] = stripslashes($this->input->post('dependent_destination'));

            $checkInboundExist = $this->pbxadmin->checkInbound($did_number);

            if (empty($checkInboundExist)) {
                $this->pbxadmin->inboundInsert($inbound_insertion);
                echo json_encode(array('status' => 'success'));
            } else {
                $update_array = $this->pbxadmin->inboundUpdate($did_number, $upd_inbound_insertion);
                echo json_encode(array('status' => 'updated'));
            }
        } else {
            redirect('login/logout');
        }
    }

    function inbound_dependent() {
        if ($this->session->userdata('logged_in')) {
            $dependent = stripslashes($this->input->post('destination'));
            $dvalues = $this->pbxadmin->dependent_values($dependent);
            echo json_encode($dvalues);
        } else {
            redirect('login/logout');
        }
    }

    function inbound_search() {
        if ($this->session->userdata('logged_in')) {
            $searchterm = $this->pbxadmin->searchterm_handler(stripslashes($this->input->get_post('search')));
            $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            $page_url = base_url() . "index.php/pbx_admin/inbound_search";
            $total_users = $this->pbxadmin->inbound_count($searchterm);
            $result_page = $this->global_pagination->index($page_url, $total_users);
            $search_data['result'] = $this->pbxadmin->inboundSearch($searchterm, $limit);
            $search_data['links'] = $this->pagination->create_links();
            $data['searchterm'] = $searchterm;
            $this->load->view('list_inbound', $search_data);
        } else {
            redirect('login/logout');
        }
    }

    function getInbound() {
        $queryString = $this->input->get('q');
        $follow_list = $this->pbxadmin->getAllInbound($queryString);
        $items = array();
        foreach ($follow_list as $values) {
            array_push($items, $values->did_num);
        }
        if (count($items) == 0)
            return;
        for ($i = 0; $i < count($items); $i++) {
            echo "$items[$i] \n";
        }
    }

    function inbound_delete() {
        if ($this->session->userdata('logged_in')) {
            $inbound_delete_id = stripslashes($this->input->post('inbound_delete_id'));
            $this->pbxadmin->inboundDelete($inbound_delete_id);
            redirect('pbx_admin/inbound');
        } else {
            redirect('login/logout');
        }
    }

    function realtime() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('realtime_report');
        } else {
            redirect('login/logout');
        }
    }

}

?>