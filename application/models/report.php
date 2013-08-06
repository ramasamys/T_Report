<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Report extends CI_Model {


function didReport($limit, $start) {

$this->db->limit($limit, $start);

$sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc LIMIT " .$start . ", ".$limit;


   $query = $this->db->query($sql);
    return $query->result_array();
}
function didReportSearch($search, $limit, $start)
{
	
	//$did_sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc LIMIT " .$start . ", ".$limit;
	
	
	
$start_date		=	$search[0]." 00:00:00";
$end_date		=	$search[1]." 23:59:59";
$agent			=	$search[2];
$agent_search	=	"";
if($agent!=0 || $agent!="")
{
$agent_search	=	"and dst='$agent'";
}
$this->db->limit($limit, $start);
$did_sql	=	"SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) AS b FROM cdr WHERE uniqueid!='' AND lastdata LIKE '%SIP/%' AND calldate BETWEEN '$start_date' AND '$end_date' '$agent_search' ORDER BY calldate DESC LIMIT " .$start . ", ".$limit;
	

	$query = $this->db->query($did_sql);
    return $query->result_array();
}

function did_count($count)
{

if($count=="")
{
$sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc";
}
else
{

$start_date		=	$count[0]." 00:00:00";
$end_date		=	$count[1]." 23:59:59";
$agent			=	$count[2];
$agent_search	=	"";
if($agent!=0 || $agent!="")
{
$agent_search	=	"and dst='$agent'";
}

$sql="SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) AS b FROM cdr WHERE uniqueid!='' AND lastdata LIKE '%SIP/%' AND calldate BETWEEN '$start_date' AND '$end_date' '$agent_search' ORDER BY calldate DESC";

}

   $result = $this->db->query($sql);
   return $result->num_rows();
     
}

function outboundReport($limit, $start){

$sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(billsec) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc LIMIT " .$start . ", ".$limit;

   $query = $this->db->query($sql);
   return $query->result_array();

}
function outbound_count()
{
$sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(billsec) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc";

   $query = $this->db->query($sql);
   return $query->num_rows();

}

function queueReport($limit, $start){
$this->db->limit($limit, $start);

$sql = "SELECT callid,queuename,TIMEDIFF((SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='CONNECT') ,(SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='ENTERQUEUE')) as Wait_Time,(SELECT data2 from queue_log where event='ENTERQUEUE' and callid=q1.callid) as Callerid,agent,TIMEDIFF((SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and (event='COMPLETECALLER' or event='COMPLETEAGENT')) ,(SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='CONNECT')) as Talk_Time,DATE_FORMAT( TIME,  '%d-%m-%Y %H:%i:%s' ) as time from queue_log as q1 where event='CONNECT' and callid=q1.callid order by time desc LIMIT " .$start . ", ".$limit;

   $query = $this->db->query($sql);
   return $query->result_array();

}

function queue_count()
{

$sql = "SELECT callid,queuename,TIMEDIFF((SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='CONNECT') ,(SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='ENTERQUEUE')) as Wait_Time,(SELECT data2 from queue_log where event='ENTERQUEUE' and callid=q1.callid) as Callerid,agent,TIMEDIFF((SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and (event='COMPLETECALLER' or event='COMPLETEAGENT')) ,(SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='CONNECT')) as Talk_Time,DATE_FORMAT( TIME,  '%d-%m-%Y %H:%i:%s' ) as time from queue_log as q1 where event='CONNECT' and callid=q1.callid order by time desc";

   $query = $this->db->query($sql);
   return $query->num_rows();

}


function dialerReport($limit, $start){ 

$sql = "SELECT * from predictive LIMIT " .$start . ", ".$limit;

   $query = $this->db->query($sql);
   return $query->result_array();
} 

function dialer_count()
{
$sql = "SELECT * from predictive";

   $query = $this->db->query($sql);
   return $query->num_rows();

}

function recordReport($limit, $start){ 

$sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc LIMIT " .$start . ", ".$limit;

   $query = $this->db->query($sql);
   return $query->result_array();

} 

function record_count(){ 

$sql = "SELECT calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc";

   $query = $this->db->query($sql);
   return $query->num_rows();

} 


function ivrReport(){ 

$sql = "";

   $query = $this->db->query($sql);
   return $query->result_array();

}

function getAgents($q) {
    $sql = "SELECT distinct(dst) from cdr where dst like '%$q%'";
    $query = $this->db->query($sql);
    return $query->result();
  }  
  
  function getPhone($q) {
    $sql = "SELECT distinct(clid) from cdr where clid like '%$q%'";
    $query = $this->db->query($sql);
    return $query->result();
  } 
  
  
  function getPredictiveAgents($q) {
    $sql = "SELECT distinct(agent) from predictive where agent like '%$q%'";
    $query = $this->db->query($sql);
    return $query->result();
  }  
  
  function getPredictivePhone($q) {
    $sql = "SELECT distinct(dest) from predictive where dest like '%$q%'";
    $query = $this->db->query($sql);
    return $query->result();
  } 

}







