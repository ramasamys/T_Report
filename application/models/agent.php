<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Agent extends CI_Model {

function getuser($limit, $start)
{
$this->db->limit($limit, $start);

$sql="select username,role,created_date,created_by from users where role!='Administrator' order by created_date desc LIMIT " .$start . ", ".$limit;
$query=$this->db->query($sql);
 return $query->result_array();
}

function getuser_count()
{

$sql="select username,role,created_date,created_by from users where role!='Administrator' order by created_date desc ";
$result = $this->db->query($sql);
   return $result->num_rows();
}

}

?>