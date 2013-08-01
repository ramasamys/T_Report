<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Agent_summary extends CI_Model {


function agentSummary($filter) {

$sql2="";
$sql3="";
   if($filter!=NULL){
   if($filter['from'] !=""){
   $from = $filter['from'];
   $to = $filter['to'];
              $sql2= "AND date(time) between '$from' and '$to'" ;
              }
               if($filter['aname'] !=""){
               $agent = $filter['aname'];
             $sql3= " AND agent = '$agent'" ;
              }
           } 

$sql = "SELECT callid,DATE_FORMAT(time,'%d-%m-%Y') as date1, queuename, agent,(select count(event) from queue_log where event='RINGNOANSWER' and data1!='0' and agent=t1.agent $sql3) as no, sec_to_time(sum( data2 )) AS totaltime, count(*) as tot,(select sec_to_time(sum(timediff(end,start))) from qpause where membername= t1.agent $sql2) as pause,(select name from sipname where exten=(select substring(t1.agent,5))) as name FROM queue_log as t1 WHERE t1.event = 'COMPLETECALLER' or t1.event = 'COMPLETEAGENT' $sql3 $sql2 GROUP BY agent";

   $query = $this->db->query($sql);
   return $query->result_array();
}

function queueSummary($filter) {
$sql2="";
$sql3="";
   if($filter!=NULL){
   if($filter['from'] !=""){
   $from = $filter['from'];
   $to = $filter['to'];
              $sql2= "AND date(time) between '$from' and '$to''" ;
              }
               if($filter['aname'] !=""){
               $agent = $filter['aname'];
            //  $sql3= " AND agent = '$agent'" ;
              }
           } 
           
$sql = "select distinct(queuename),(select distinct(queuename) from queue_log where (event='abandon' or event='CONNECT') and queuename=q.queuename  $sql2 $sql3) as que,(select count(distinct(callid)) from queue_log where event='abandon' and queuename=q.queuename )as Abandon,round(((select count(distinct(callid)) from queue_log where event='abandon' and queuename=q.queuename  $sql2 $sql3) * 100)/(select count(distinct(callid)) from queue_log where (event='abandon' or event='CONNECT') and queuename=q.queuename  $sql2 $sql3),0) as aban_avg,(select count(distinct(callid)) from queue_log where event='CONNECT' and queuename=q.queuename  $sql2 $sql3) as Answered,round(((select count(distinct(callid)) from queue_log where event='CONNECT' and queuename=q.queuename  $sql2 $sql3) * 100)/(select count(distinct(callid)) from queue_log where (event='abandon' or event='CONNECT') and queuename=q.queuename  $sql2 $sql3),0) as answer_avg,(select count(distinct(callid)) from queue_log where (event='abandon' or event='CONNECT') and queuename=q.queuename  $sql2 $sql3) as total from queue_log as q where queuename!='NONE' $sql2 $sql3 group by queuename";

   $query = $this->db->query($sql);
   return $query->result_array();
}

}
?>