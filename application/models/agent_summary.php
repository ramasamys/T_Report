<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Summary extends CI_Model {


function agentSummary($fdate,$tdate) {
$sql2 = "";
$sql3= "";
if(((!empty($fdate)) || ($fdate !=NULL)) && (!empty($tdate)) || ($tdate !=NULL))){
$sql2 = "and date(time) between '$fdate' and '$tdate'";
$sql3 = "and start like '%$fdate%'";
}

$sql = "SELECT callid,date( time ) AS date1, queuename, agent,(select count(event) from queue_log where event='RINGNOANSWER' and data1!='0' and  agent=t1.agent $sql2) as no, sec_to_time(sum( data2 )) AS totaltime, count(*) as tot,(select sec_to_time(sum(timediff(end,start))) from qpause where membername= t1.agent $sql3) as pause,(select name from sipname where exten=(select substring(t1.agent,5))) as name FROM queue_log t1 WHERE (t1.event = 'COMPLETECALLER' or t1.event = 'COMPLETEAGENT' $sql2) $sql2 GROUP BY agent";

   $query = $this->db->query($sql);
   return $query->result_array();
}
}
?>