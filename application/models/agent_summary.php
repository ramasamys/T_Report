<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Agent_summary extends CI_Model {


function agentSummary() {

$sql = "SELECT callid,date( time ) AS date1, queuename, agent,(select count(event) from queue_log where event='RINGNOANSWER' and data1!='0' and  agent=t1.agent) as no, sec_to_time(sum( data2 )) AS totaltime, count(*) as tot,(select sec_to_time(sum(timediff(end,start))) from qpause where membername= t1.agent) as pause,(select name from sipname where exten=(select substring(t1.agent,5))) as name FROM queue_log t1 WHERE (t1.event = 'COMPLETECALLER' or t1.event = 'COMPLETEAGENT') GROUP BY agent";

   $query = $this->db->query($sql);
   return $query->result_array();
}


}
?>