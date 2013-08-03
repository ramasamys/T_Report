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
 
 
 function getExtension() {
    $extension_list = "SELECT distinct(name) from sipusers";
	$extension_query = $this->db->query($extension_list);
    return $extension_query->result_array();
	//print_r($result);
	//exit;
  }  
 
function extensionInsert($extension_for_sipusers,$extension_for_sipname,$extension_for_voiceboxes) 
	{
		
		$sipusers_insert	=	$this->db->insert('sipusers', $extension_for_sipusers);
		$userid				=	0;
		$userid				=	$this->db->insert_id();
		
		$sipname_insert		=	$this->db->insert('sipname', $extension_for_sipname);
		$nameid				=	0;
		$nameid				=	$this->db->insert_id();
		
		$voiceboxes_insert	=	$this->db->insert('voiceboxes', $extension_for_voiceboxes);
		$voiceid			=	0;
		$voiceid			=	$this->db->insert_id();
		
		
		$id = array();
		$id = array("$userid","$nameid","$voiceid");
		return $id;		
		
   }
   
   function extension_insert_fail($sipuser_id,$sipname_id,$voiceboxes_id)
	{
		if($sipuser_id =="" || $sipuser_id == 0)
		{
			$sipuser_query	= 	"DELETE FROM sipusers WHERE id='$sipuser_id'";
			$sipuser_result	= 	$this->db->query($sipuser_query);
		
		}
		if($sipname_id == "" || $sipname_id == 0){
		
			$sipname_query	= 	"DELETE FROM sipname WHERE id='$sipname_id'";
			$sipname_result	= 	$this->db->query($sipname_query);
		
		}
		if($voiceboxes_id == "" || $voiceboxes_id == 0)
		{
			$voiceboxes_query	= 	"DELETE FROM voiceboxes WHERE uniqueid='$voiceboxes_id'";
			$voiceboxes_result	= 	$this->db->query($voiceboxes_query);
		
		}
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
			
function followmeInsert($followme_for_insertion) {

		$followme_insert		=	$this->db->insert('followme', $followme_for_insertion);
		
		return $this->db->insert_id();
/*$insert = "insert into followme(id,followname,ringtime,extlist,setdst,dst)values('$id','$followname','$ringtime','$extlist','$setdst','$dst')";

   $insertfollow = $this->db->query($insert);
//   return $insertfollow->result_array();
*/
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
    
    
function queueInsert($data_for_queue) {


   $queue_insert = $this->db->insert('queue_table', $data_for_queue);
   return $this->db->insert_id();

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
    
function inboundInsert($inbound_for_insertion) {

		$inbound_insert		=	$this->db->insert('inbound_rout', $inbound_for_insertion);
		
		return $this->db->insert_id();
		
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

function dependent_values($values){ 	

	if($values == "Extension"){
			$sql = "select distinct(username) as list from sipusers";
			$query = $this->db->query($sql);
                        return $query->result_array($query);
		}
	else if($values == "Queue") {
		     $sql = "select distinct(name) as list from queue_table";
                     $query = $this->db->query($sql);
                     return $query->result_array($query);
		}
	else if($values == "Terminate Call"){
                        return array('list'=> "Hangup");
		}	
	else if($values == "Follow Me")	{
			$sql = "select distinct(f_name) as list from followme";
			$query = $this->db->query($sql);
                        return $query->result_array($query);
		}
}

}    
    

