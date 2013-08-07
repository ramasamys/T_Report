<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Realtime extends CI_Model {

function inAgentStatus(){

$inAgentsql = "select agentId,agentName,agentStatus,queue from agent_status where (agentStatus = 'READY' or agentStatus = 'CONNECT' or agentStatus = 'PAUSED' or agentStatus = 'RINGING')";


   $inAgent = $this->db->query($inAgentsql);
   return $inAgent->result_array();

}

function outAgentStatus(){

$outAgentsql = "select * from agent_status1";

  $outAgent = $this->db->query($outAgentsql);
  return $outAgent->result_array();

}

function waitCalls(){

$waitSql = "SELECT callerId,timestamp,queue FROM call_status WHERE status = 'inQue'";

  $waitQuery = $this->db->query($waitSql);
  return $waitQuery->result_array();
  
}

function liveCalls(){

$liveSql = "select c.callid,c.timestamp,c.callerid,c.queue,a.agentId,timediff(now(),c.timestamp) as t from call_status as c,agent_status as a where c.status = 'CONNECT' and a.callid=c.callid";

  $liveQuery = $this->db->query($liveSql);
  return $liveQuery->result_array();

}

function outCalls(){

$outCallSql = "SELECT * FROM `manual` WHERE event = 'CONNECT'";

  $outQuery = $this->db->query($outCallSql);
  return $outQuery->result_array();

}


}