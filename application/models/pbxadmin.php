<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pbxadmin extends CI_Model {

function extensionSelect() {

$tsql = "select * from sipusers";
   $query = $this->db->query($sql);
   return $query->result_array();

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

function extensionDelete() {

$deletesql = "delete from sipusers where id='$id'";

   $deletequery = $this->db->query($deletesql);
//   return $deletequery->result_array();

    }    

function queueSelect() {

$selectsql = "select * from queue_table";

   $selectquery = $this->db->query($selectsql);
   return $addquery->result_array();

    }
    
    
    
function queueInsert() {

$addsql = "insert into queue_table(`name`,`timeout`, `queue_callswaiting`, `queue_reporthold`, `announce_frequency`,`announce_holdtime`, `retry`, `wrapuptime`, `maxlen`, `servicelevel`, `strategy`, `joinempty`, `leavewhenempty`, `eventmemberstatus`, `eventwhencalled`, `memberdelay`, `weight`, `timeoutrestart`, `periodic_announce_frequency`, `ringinuse`)value('$name','$timeout','$queue_callswaiting','$queue_reporthold','$announce_frequency','$announce_holdtime','$retry','$wrapuptime','$maxlen','$servicelevel','$strategy','$joinempty','$leavewhenempty','$eventmemberstatus','$eventwhencalled','$memberdelay','$weight','$timeoutrestart','$periodic_announce_frequency','$ringinuse')";

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

function inboundList() {

$list = "select * from inbound_route";

   $listinbound = $this->db->query($list);
//   return $listinbound->result_array();

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
    
function followmeList() {

$select = "select * from followme";

   $selectfollow = $this->db->query($select);
   return $selectfollow->result_array();

    }
    
}