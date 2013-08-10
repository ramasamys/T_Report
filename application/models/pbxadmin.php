<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Pbxadmin extends CI_Model {

    function searchterm_handler($searchterm) {
        if ($searchterm != "") {
            $this->session->set_userdata('search', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('search')) {
            $searchterm = $this->session->userdata('search');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

    function extension_count($searchterm) {
        if ($searchterm != "" && $searchterm != NULL) {
            $sql = "SELECT COUNT(*) As cnt FROM sipusers WHERE name LIKE '%" . $searchterm . "%'";
            $result = $this->db->query($sql);
            $row = $result->row();
            return $row->cnt;
        } else {
            return $this->db->count_all("sipusers");
        }
    }

    function extensionSelect($limit, $start) {
        $this->db->limit($limit, $start);
        $sql = "SELECT sipusers.id, sipusers.context, sipusers.callerid, sipusers.mailbox, sipusers.host, sipusers.name, sipname.name AS display_name, sipusers.secret, sipusers.callgroup, sipusers.pickupgroup FROM sipname INNER JOIN sipusers ON sipname.exten = sipusers.name ORDER BY sipusers.id DESC LIMIT " . $start . " ," . $limit;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function extensionSearch($searchterm, $limit) {
        $sql = "SELECT * FROM sipusers WHERE name LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",10 ";
        $sql_result = $this->db->query($sql);
        if ($sql_result->num_rows() > 0) {
            foreach ($sql_result->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function getAllExtension($exten) {
        $sql = "SELECT distinct(name) from sipusers where name like '%$exten%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getExtension() {
        $extension_list = "SELECT distinct(name) from sipusers where name!=''";
        $extension_query = $this->db->query($extension_list);
        return $extension_query->result_array();
    }

    function checkExtension($id) {
        $sql = "SELECT * from sipname WHERE exten=?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    function extensionInsert($sipnamedata, $sipusersdata, $voicedata) {
        $this->db->insert('sipname', $sipnamedata);
        $nameid = $this->db->insert_id();

        $this->db->insert('sipusers', $sipusersdata);
        $userid = $this->db->insert_id();

        $this->db->insert('voiceboxes', $voicedata);
        $voiceid = $this->db->insert_id();

        $result = array();
        $result = array("$userid", "$nameid", "$voiceid");
        return $result;
    }

    function extension_insert_fail($sipuser_id, $sipname_id, $voiceboxes_id) {
        if ($sipuser_id == "" || $sipuser_id == 0) {
            $sipuser_query = "DELETE FROM sipusers WHERE id='$sipuser_id'";
            $sipuser_result = $this->db->query($sipuser_query);
        }
        if ($sipname_id == "" || $sipname_id == 0) {

            $sipname_query = "DELETE FROM sipname WHERE id='$sipname_id'";
            $sipname_result = $this->db->query($sipname_query);
        }
        if ($voiceboxes_id == "" || $voiceboxes_id == 0) {
            $voiceboxes_query = "DELETE FROM voiceboxes WHERE uniqueid='$voiceboxes_id'";
            $voiceboxes_result = $this->db->query($voiceboxes_query);
        }
    }

    function extensionUpdate($sipextension, $upd_sipname, $upd_sipusers, $upd_sipvoice) {

        $this->db->where('exten', $sipextension);
        $this->db->update('sipname', $upd_sipname);

        $this->db->where('name', $sipextension);
        $this->db->update('sipusers', $upd_sipusers);

        $this->db->where('customer_id', $sipextension);
        $this->db->update('voiceboxes', $upd_sipvoice);
    }

    function extensionDelete($id) {
        $sipusers_sql = "DELETE FROM sipusers WHERE name=?";
        $sipname_sql = "DELETE FROM sipname WHERE exten=?";
        $voiceboxes_sql = "DELETE FROM voiceboxes WHERE customer_id=?";

        $sipusers_result = $this->db->query($sipusers_sql, array($id));
        $sipname_result = $this->db->query($sipname_sql, array($id));
        $voiceboxes_result = $this->db->query($voiceboxes_sql, array($id));
    }

    public function followme_count($searchterm) {
        if ($searchterm != "" && $searchterm != NULL) {
            $sql = "SELECT COUNT(*) As cnt FROM followme WHERE f_name LIKE '%" . $searchterm . "%'";
            $result = $this->db->query($sql);
            $row = $result->row();
            return $row->cnt;
        } else {
            return $this->db->count_all("followme");
        }
    }

    function followmeList($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by("f_id", "DESC");
        $query = $this->db->get("followme");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function followmeSearch($searchterm, $limit) {
        $sql = "SELECT * FROM followme WHERE f_name LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",10 ";
        $sql_result = $this->db->query($sql);
        if ($sql_result->num_rows() > 0) {
            foreach ($sql_result->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function getAllFollowme($follow) {
        $sql = "SELECT distinct(f_name) from followme where f_name like '%$follow%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function followmeInsert($followme_for_insertion) {
        $this->db->insert('followme', $followme_for_insertion);
        return $this->db->insert_id();
    }

    function checkFollowme($followname) {
        $sql = "SELECT * from followme WHERE fname=?";
        $query = $this->db->query($sql, array($followname));
        return $query->result_array();
    }

    function followmeUpdate($followme_name, $upd_followme_insert) {
        $this->db->where('f_name', $followme_name);
        $this->db->update('followme', $upd_followme_insert);
    }

    function followmeDelete($followme_delete) {
        $sql = "DELETE FROM followme WHERE f_id = ?";
        $this->db->query($sql, array($followme_delete));
    }

    public function queue_count($searchterm) {
        if ($searchterm != "" && $searchterm != NULL) {
            $sql = "SELECT COUNT(*) As cnt FROM queue_table WHERE name LIKE '%" . $searchterm . "%'";
            $result = $this->db->query($sql);
            $row = $result->row();
            return $row->cnt;
        } else {
            return $this->db->count_all("queue_table");
        }
    }

    function queueSelect($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("queue_table");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function queueSearch($searchterm, $limit) {
        $sql = "SELECT * FROM queue_table WHERE name LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",10 ";
        $sql_result = $this->db->query($sql);
        if ($sql_result->num_rows() > 0) {
            foreach ($sql_result->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function getAllQueue($queue) {
        $sql = "SELECT distinct(name) from queue_table where name like '%$queue%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function queueInsert($queue) {
        $this->db->insert('queue_table', $queue);
        return $this->db->insert_id();
    }

    function checkQueue($name) {
        $sql = "SELECT * from queue_table WHERE name=?";
        $query = $this->db->query($sql, array($name));
        return $query->result_array();
    }

    function queueUpdate($name, $insertion) {
        $this->db->where('name', $name);
        $this->db->update('queue_table', $insertion);
    }

    function queueDelete($id) {
        $sql = "DELETE FROM queue_table WHERE name=?";
        $this->db->query($queue_sql, array($id));
    }

    public function inbound_count($searchterm) {
        if ($searchterm != "" && $searchterm != NULL) {
            $sql = "SELECT COUNT(*) As cnt FROM inbound_rout WHERE did_num LIKE '%" . $searchterm . "%'";
            $result = $this->db->query($sql);
            $row = $result->row();
            return $row->cnt;
        } else {
            return $this->db->count_all("inbound_rout");
        }
    }

    function inboundList($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("inbound_rout");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function inboundSearch($searchterm, $limit) {
        $sql = "SELECT * FROM inbound_rout WHERE did_num LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",10 ";
        $sql_result = $this->db->query($sql);
        if ($sql_result->num_rows() > 0) {
            foreach ($sql_result->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function getAllInbound($inbound) {
        $sql = "SELECT distinct(did_num) from inbound_rout where did_num like '%$inbound%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function inboundInsert($id) {
        $this->db->insert('inbound_rout', $id);
        return $this->db->insert_id();
    }

    function checkInbound($id) {
        $sql = "SELECT * from inbound_rout WHERE did_num=?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();

    }

    function inboundUpdate() {
        $sql = "update inbound set";
        $this->db->query($sql);
    }

    function inboundDelete($id) {
        $sql = "DELETE FROM inbound_rout WHERE did_num = ?";
        $this->db->query($sql, array($id));
    }

    function dependent_values($values) {

        if ($values == "Extension") {
            $sql = "select distinct(username) as list from sipusers where username!=''";
            $query = $this->db->query($sql);
            return $query->result_array($query);
        } else if ($values == "Queue") {
            $sql = "select distinct(name) as list from queue_table where name!=''";
            $query = $this->db->query($sql);
            return $query->result_array($query);
        } else if ($values == "Terminate Call") {
            return array('list' => "Hangup");
        } else if ($values == "Follow Me") {
            $sql = "select distinct(f_name) as list from followme where f_name!=''";
            $query = $this->db->query($sql);
            return $query->result_array($query);
        }
    }

}

