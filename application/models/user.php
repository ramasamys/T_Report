<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User extends CI_Model {

	


 function checkLogin($username,$password) {
   $sql = "SELECT id,first_name,username,role FROM users WHERE username=? AND password=?";
   $query = $this->db->query($sql, array($username,md5($password)));  
   return $query->result_array();
 } 
 function getUserInformation($id){
   $sql = "SELECT * FROM users WHERE id=?";
   $query = $this->db->query($sql, array($id));
   return $query->result_array(); 
 }
  function getAllAgents($q) {
    $sql = "SELECT distinct(agent) from queue_log where agent like '%$q%'";
    $query = $this->db->query($sql);
    return $query->result();
  } 
   function getAllQueue($q) {
    $sql = "SELECT distinct(queuename) from queue_log where queuename like '%$q%'";
    $query = $this->db->query($sql);
    return $query->result();
  } 
  function agentQueue(){
    $sessionValues = $this->session->userdata('logged_in'); 
          $sessionId =  $sessionValues['sessionId'];	  
  	  
  $agent=$_POST['q'];
  $que=$_POST['team'];
  $sql="update logindetail set queue='$que' where sessionId='$sessionId'";
   $query=$this->db->query($sql);
  $team = explode(',',$que);
$unid = rand(0000,9999);
for($i=0;$i<sizeof($team);$i++)
{

$queue=$team[$i];
$sql22="insert into queue_member_table(unid,membername,queue_name,interface,paused) values('$unid','$agent','$queue','$agent',0)";
$query=$this->db->query($sql22);
}

$agentarray=array();
$agentarray=array("$agent","$que");
return $agentarray;  
 
  }
  function insertlogindetail($user,$timestamp)
  {
   
  $sql= "insert into logindetail(agent,login,sessionId) values('$user',now(),'$timestamp')";
  $query=$this->db->query($sql);	  
  	  
  }
  function loggedout()
  {
  	    $sessionValues = $this->session->userdata('logged_in'); 
          $sessionId =  $sessionValues['sessionId'];
          $agent=$sessionValues['username'];

  $sql="update logindetail set logout=now(),status='loggedout' where sessionId='$sessionId'";
  $query=$this->db->query($sql);
  $sql_queuelogout="delete from queue_member_table where membername='$agent'";
    $query=$this->db->query($sql_queuelogout);
  	  
  }
function agentpausefun(){
    $sessionValues = $this->session->userdata('logged_in');
          $sessionId =  $sessionValues['sessionId'];
          $agent=$sessionValues['first_name'];
          $flag=$_POST['flag'];
         // echo $agent;
         if($flag=="f3")
         {
$sql="update queue_member_table set paused='1' where membername='$agent'"; 
  $query=$this->db->query($sql);
}
else if($flag=="f4")
{
 $sql="update queue_member_table set paused='0' where membername='$agent'"; 
  $query=$this->db->query($sql);
	
}
}

function pausestatus()
{
	$sessionValues = $this->session->userdata('logged_in'); 
          $sessionId =  $sessionValues['sessionId'];
          $agent=$sessionValues['first_name'];
          
	//$pcheck="select paused from queue_member_table where membername='$agent'";
	$pcheck="SELECT count(*) AS CNT FROM `queue_member_table` WHERE membername='$agent' AND paused='1'";
	
	
	$query=$this->db->query($pcheck);
        return $query->result_array();
	//$this->db->query($pcheck);
	//return $query->row_array();
	
}

function agentpopup()
{
	$sessionValues = $this->session->userdata('logged_in'); 
          $sessionId =  $sessionValues['sessionId'];
          $agent=$sessionValues['first_name'];
 
$check="select * from pop where flag='0' and name='$agent' order by id desc limit 1";
$query=$this->db->query($check);
$result=$query->result_array();
$num=$query->num_rows();

if($num >0)
{
$name=$result[0]['name'];
$idd=$result[0]['id'];
$phon=$result[0]['phone'];

$updatepop="update pop set flag='1' where id='$idd'";
$updatequery=$this->db->query($updatepop);

$checkuserdb="select name,phone from pop_user where phone='$phon'";
$checkquery=$this->db->query($checkuserdb);
$checkresult=$checkquery->result_array();

$checknum=$checkquery->num_rows();
if($checknum > 0)
{
$nameuser=$checkresult[0]['name'];
$phonuser=$checkresult[0]['phone'];
$response = array();
	$response['phone']=$phonuser;
	$response['name'] = $nameuser;
	$response['check']="done";
	echo json_encode($response);
}
else
{
	$response = array();
	$response['phone']=$phon;
        $response['check']="not";
	echo json_encode($response);
		
}
	
}
else
{
	$response = array();
	$response['phone']="";
	$response['name'] = "";
        $response['check'] ="false";
	echo json_encode($response);
	
}

}
  
function queues(){

$queuesql = "select name from queue_table";
$queuequery=$this->db->query($queuesql);
return $queuequery->result_array();

}
  
  
}
?>

