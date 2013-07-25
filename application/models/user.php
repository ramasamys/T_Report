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
}
?>

