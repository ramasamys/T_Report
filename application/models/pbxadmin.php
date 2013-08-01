<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pbxadmin extends CI_Model {

function searchterm_handler($searchterm)
			{
		
				if($searchterm!="")
					{
						$this->session->set_userdata('search', $searchterm);
						return $searchterm;
					}
				elseif($this->session->userdata('search'))
					{
						$searchterm = $this->session->userdata('search');
						return $searchterm;
					}
				else
					{
						$searchterm ="";
						return $searchterm;
					}
			}
			
			
function extension_count($searchterm) 
			{
				if($searchterm!="" && $searchterm!=NULL)
				{
					$sql = "SELECT COUNT(*) As cnt FROM sipusers WHERE name LIKE '%" . $searchterm . "%'";
					$result = $this->db->query($sql);
					$row = $result->row(); 
					return $row->cnt;
				
				}
				else
				{
					return $this->db->count_all("sipusers");
				}
			}

   
function extensionSelect($limit, $start) {

   	$this->db->limit($limit, $start);
				$query = $this->db->get("sipusers");
					if ($query->num_rows() > 0) 
						{
							foreach ($query->result() as $row) 	
								{
									$data[] = $row;
								}
									return $data;
						}
							return false;

   }
   
function extensionSearch($searchterm,$limit)
	{
		$sql = "SELECT * FROM sipusers WHERE name LIKE '%" . $searchterm . "%' LIMIT " .$limit . ",10 ";
		$sql_result = $this->db->query($sql);
					if($sql_result->num_rows() > 0)
						{
							foreach($sql_result->result() as $row)
								{
									$data[] = $row;
								}
									return $data;
						}
					else
						{
							return 0;
						}
	
	}

function getAllExtension($exten) {
    $sql = "SELECT distinct(name) from sipusers where name like '%$exten%'";
	$query = $this->db->query($sql);
    return $query->result();
  }   
 
function extensionInsert() 
	{
	
		$call_group		=	"";
		$pickup_group	=	"";
		$mailid			=	NULL;
		$password		=	NULL;
		$ext			=	$_POST['ext'];
		$name			=	$_POST['name'];
		$secret			=	$_POST['secret'];
		$call_group		=	$_POST['call_group'];
		$pickup_group	=	$_POST['pickup_group'];
		if (isset($_POST['mail']))
				{
					$mailid			=	$_POST['mailid'];
					$password		=	$_POST['password'];
				}

		$insertsql = "insert into sipusers(name,host,context,fromuser,mailbox,username,sippasswd,callgroup,pickupgroup)values('$ext','dynamic','default','$ext','$mailid','$ext','$secret','$call_group','$pickup_group')";
		
		$insertnamesql = "insert into sipname(exten,name) values('$ext','$name')";
		
		$insertvoicesql = "INSERT INTO voiceboxes(customer_id, mailbox,password,email,context) values('$ext','$ext','$password','$mailid','default')";
		
		$insertquery = $this->db->query($insertsql);
		$userid =	0;
		$userid	=	mysql_insert_id();	
		
		$insertnamequery = $this->db->query($insertnamesql);
		$nameid	=	0;
		$nameid	=	mysql_insert_id();
		
		$insertvoicequery = $this->db->query($insertvoicesql);
		$voiceid =	0;
		$voiceid =	mysql_insert_id();
		
		$id = array();
		$id = array("$userid","$nameid","$voiceid");
		return $id;		
		
   }
   
function extensionUpdate() {

$nat = $_POST['nat'];
$type = $_POST['type'];
$context = $_POST['context'];
$fromuser = $_POST['fromuser'];
$mailbox = $_POST['mailbox'];
$sippasswd = $_POST['sippasswd'];
$callerid = $_POST['callerid'];
$cancallforward = $_POST['cancallforward'];
$canreinvite = $_POST['canreinvite'];
$mask = $_POST['mask'];
$musiconhold = $_POST['musiconhold'];
$port = $_POST['port'];
$regseconds = $_POST['regseconds'];
$lastms = $_POST['lastms'];
$username = $_POST['username'];

$nat = $_POST['name'];

$updatesql = "update sipusers set nat='$nat',type='$type',context='$context',fromuser='$fromuser', mailbox='$mailbox',sippasswd='$sippasswd',callerid='$callerid',cancallforward ='$cancallforward',canreinvite='$canreinvite', mask='$mask', musiconhold='$musiconhold', port='$port', regseconds='$regseconds',lastms='$lastms' where username='$username'";

$update_namesql = "update sipname set name='$name' where exten='$username'";

   $updatequery = $this->db->query($updatesql);
   $update_namequery = $this->db->query($update_namesql);
//   return $updatequery->result_array();

    }

function extensionDelete($id) {

    $sql = "delete from sipusers where id=?";

   $query = $this->db->query($sql, array($id));

    }

public function followme_count($searchterm) 
			{
					if($searchterm!="" && $searchterm!=NULL)
				{
					$sql = "SELECT COUNT(*) As cnt FROM followme WHERE f_name LIKE '%" . $searchterm . "%'";
					$result = $this->db->query($sql);
					$row = $result->row(); 
					return $row->cnt;
				
				}
				else
				{
					return $this->db->count_all("followme");
				}
			
			
			
				
			}

function followmeList($limit, $start) 
{

	
		$this->db->limit($limit, $start);
		$query = $this->db->get("followme");
			if ($query->num_rows() > 0) 
				{
					foreach ($query->result() as $row) 	
						{
							$data[] = $row;
						}
							return $data;
				}
							return false;

  }
  
  function followmeSearch($searchterm,$limit)
	{
		$sql = "SELECT * FROM followme WHERE f_name LIKE '%" . $searchterm . "%' LIMIT " .$limit . ",10 ";
		$sql_result = $this->db->query($sql);
					if($sql_result->num_rows() > 0)
						{
							foreach($sql_result->result() as $row)
								{
									$data[] = $row;
								}
									return $data;
						}
					else
						{
							return 0;
						}
	
	}
 
function getAllFollowme($follow) {
    $sql = "SELECT distinct(f_name) from followme where f_name like '%$follow%'";
	$query = $this->db->query($sql);
    return $query->result();
  } 
			
function followmeInsert() {

$insert = "insert into followme(id,followname,ringtime,extlist,setdst,dst)values('$id','$followname','$ringtime','$extlist','$setdst','$dst')";

   $insertfollow = $this->db->query($insert);
//   return $insertfollow->result_array();

    }
    
function followmeUpdate() {

$edit = "update followme set folloename='$followname',ringtime='$ringtime',extlist='$extlist',setdst='$setdst',dst='$dst' where id='$id'";

   $editfollow = $this->db->query($edit);
//   return $editfollow->result_array();

    }  
    
function followmeDelete() {

$remove = "delete from followme where id = '$id'";

   $removefollow = $this->db->query($remove);
//   return $removefollow->result_array();

    }
    

    

public function queue_count($searchterm) 
			{
				if($searchterm!="" && $searchterm!=NULL)
				{
					$sql = "SELECT COUNT(*) As cnt FROM queue_table WHERE name LIKE '%" . $searchterm . "%'";
					$result = $this->db->query($sql);
					$row = $result->row(); 
					return $row->cnt;
				
				}
				else
				{
					return $this->db->count_all("queue_table");
				}
			
			}
			
			
function queueSelect($limit, $start) {

	  	$this->db->limit($limit, $start);
				$query = $this->db->get("queue_table");
					if ($query->num_rows() > 0) 
						{
							foreach ($query->result() as $row) 	
								{
									$data[] = $row;
								}
									return $data;
						}
							return false;
    }
	
function queueSearch($searchterm,$limit)
	{
		$sql = "SELECT * FROM queue_table WHERE name LIKE '%" . $searchterm . "%' LIMIT " .$limit . ",10 ";
		$sql_result = $this->db->query($sql);
					if($sql_result->num_rows() > 0)
						{
							foreach($sql_result->result() as $row)
								{
									$data[] = $row;
								}
									return $data;
						}
					else
						{
							return 0;
						}
	
	}
	
function getAllQueue($queue) {
    $sql = "SELECT distinct(name) from queue_table where name like '%$queue%'";
    $query = $this->db->query($sql);
    return $query->result();
  } 
    
    
function queueInsert() {

$qname					=	$_POST['qname'];
$timeout				=	$_POST['time_out'];
$queue_callswaiting		=	$_POST['qwait'];
$queue_reporthold		=	$_POST['hold_time'];
$announce_frequency		=	$_POST['frequency'];
$announce_holdtime		=	$_POST['hold'];
$retry					=	$_POST['retry'];
$wrapuptime				=	$_POST['wrap_time'];
$maxlen					=	$_POST['max_wait'];
$servicelevel			=	$_POST['service_level'];
$strategy				=	$_POST['ring_statergy'];
$joinempty				=	$_POST['join_empty'];
$leavewhenempty			=	$_POST['leave_empty'];
$eventmemberstatus		=	$_POST['member_status'];
$eventwhencalled		=	$_POST['when_called'];
$memberdelay			=	$_POST['member_delay'];
$weight					=	$_POST['weight'];
$timeoutrestart			=	$_POST['restart'];
$ringinuse				=	$_POST['ring_use'];

$addsql = "insert into queue_table(`name`,`timeout`, `queue_callswaiting`, `queue_reporthold`, `announce_frequency`,`announce_holdtime`, `retry`, `wrapuptime`, `maxlen`, `servicelevel`, `strategy`, `joinempty`, `leavewhenempty`, `eventmemberstatus`, `eventwhencalled`, `memberdelay`, `weight`, `timeoutrestart`,  `ringinuse`)value('$qname','$timeout','$queue_callswaiting','$queue_reporthold','$announce_frequency','$announce_holdtime','$retry','$wrapuptime','$maxlen','$servicelevel','$strategy','$joinempty','$leavewhenempty','$eventmemberstatus','$eventwhencalled','$memberdelay','$weight','$timeoutrestart','$ringinuse')";

   $addquery = $this->db->query($addsql);
//   return $addquery->result_array();

    }
    
function queueUpdate() {

$editsql = "update queue_table set announce_frequency='$announce_frequency',announce_holdtime='$announce_holdtime',eventmemberstatus='$eventmemberstatus',eventwhencalled='$eventwhencalled', joinempty='$joinempty',leavewhenempty='$leavewhenempty',memberdelay='$memberdelay',queue_callswaiting ='$queue_callswaiting',reportholdtime='$reportholdtime', retry='$retry', ringinuse='$ringinuse', servicelevel='$servicelevel', strategy='$strategy',timeout='$timeout',timeoutrestart='$timeoutrestart',weight='$weight',wrapuptime='$wrapuptime',name='$name' where id='$id'";

   $editquery = $this->db->query($editsql);
//   return $editquery->result_array();

    }
    
function queueDelete() {

$removesql = "delete from queue_table where id='$id'";

   $removequery = $this->db->query($removesql);
//   return $removequery->result_array();

    }

	
public function inbound_count($searchterm) 
			{
				if($searchterm!="" && $searchterm!=NULL)
				{
					$sql = "SELECT COUNT(*) As cnt FROM inbound_rout WHERE did_num LIKE '%" . $searchterm . "%'";
					$result = $this->db->query($sql);
					$row = $result->row(); 
					return $row->cnt;
				}
				else
				{
					return $this->db->count_all("inbound_rout");
				}
				
			}
			
function inboundList($limit, $start) {
	
	  	$this->db->limit($limit, $start);
				$query = $this->db->get("inbound_rout");
					if ($query->num_rows() > 0) 
						{
							foreach ($query->result() as $row) 	
								{
									$data[] = $row;
								}
									return $data;
						}
							return false;

    }
	
function inboundSearch($searchterm,$limit)
	{
		$sql = "SELECT * FROM inbound_rout WHERE did_num LIKE '%" . $searchterm . "%' LIMIT " .$limit . ",10 ";
		$sql_result = $this->db->query($sql);
					if($sql_result->num_rows() > 0)
						{
							foreach($sql_result->result() as $row)
								{
									$data[] = $row;
								}
									return $data;
						}
					else
						{
							return 0;
						}
	
	}

function getAllInbound($inbound) {
    $sql = "SELECT distinct(did_num) from inbound_rout where did_num like '%$inbound%'";
	$query = $this->db->query($sql);
    return $query->result();
  }
    
function inboundInsert() {

$add = "insert into inbound_route(did_num,did_name,setdst,dst)values('$did_num','$did_name','$setdst','$dst')";

   $addinbound = $this->db->query($add);
//   return $addinbound->result_array();

    }

function inboundUpdate() {

$update = "update inbound set";

   $updateinbound = $this->db->query($update);
//   return $updateinbound->result_array();

    }

function inboundDelete() {

$delete = "delete from inbound_route where id = '$id'";

   $deleteinbound = $this->db->query($delete);
//   return $deleteinbound->result_array();

    }

function dependedValues(){
   	
     $value = $_POST['dst'];
     
     if($value == 'queue'){
     
$sqlSelect = "SELECT DISTINCT(name) FROM queue_table";	     
     }
     elseif($value == 'exten'){
$sqlSelect = "SELECT DISTINCT(name) FROM sipusers";     	     
     	     
     }
     else{
     	     
     }
     $dropdown = $this->db->query($sqlSelect);
     return $dropdown->result();
  }    
    
}
