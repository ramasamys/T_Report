<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Report extends CI_Model {


function didReport() {

$sql = "select calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc";

   $query = $this->db->query($sql);
   return $query->result_array();
}

function outboundReport(){

$sql = "select calldate,clid,src,dst,disposition,sec_to_time(billsec) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc";

   $query = $this->db->query($sql);
   return $query->result_array();

}

function queueReport(){

$sql = "SELECT callid,queuename,TIMEDIFF((SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='CONNECT') ,(SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='ENTERQUEUE')) as Wait_Time,(select data2 from queue_log where event='ENTERQUEUE' and callid=q1.callid) as Callerid,agent,TIMEDIFF((SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and (event='COMPLETECALLER' or event='COMPLETEAGENT')) ,(SELECT DATE_FORMAT( TIME,  '%H:%i:%s' ) from queue_log where callid=q1.callid and event='CONNECT')) as Talk_Time,DATE_FORMAT( TIME,  '%d-%m-%Y %H:%i:%s' ) as time from queue_log as q1 where event='CONNECT' and callid=q1.callid order by time desc";

   $query = $this->db->query($sql);
   return $query->result_array();

}


function dialerReport(){ 

$sql = "select * from predictve";

   $query = $this->db->query($sql);
   return $query->result_array();

} 
function recordReport(){ 

$sql = "select calldate,clid,src,dst,disposition,sec_to_time(duration) as b from cdr where uniqueid!='' and lastdata like '%SIP/%' order by calldate desc";

   $query = $this->db->query($sql);
   return $query->result_array();

} 

function ivrReport(){ 

$sql = "";

   $query = $this->db->query($sql);
   return $query->result_array();

} 

}







