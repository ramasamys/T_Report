<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Realtime extends CI_Model {

    function inAgentStatus() {
        $sql = "select agentId,agentName,agentStatus,queue from agent_status where (agentStatus = 'READY' or agentStatus = 'CONNECT' or agentStatus = 'PAUSED' or agentStatus = 'RINGING')";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function outAgentStatus() {
        $sql = "select * from agent_status1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function waitCalls() {
        $sql = "SELECT callerId,timestamp,queue FROM call_status WHERE status = 'inQue'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function liveCalls() {
        $sql = "select c.callid,c.timestamp,c.callerid,c.queue,a.agentId,timediff(now(),c.timestamp) as t from call_status as c,agent_status as a where c.status = 'CONNECT' and a.callid=c.callid";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function outCalls() {
        $sql = "SELECT * FROM `manual` WHERE event = 'CONNECT'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}