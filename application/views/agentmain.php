<?php include "header.php";?>

<?php
if(!empty($error)){
foreach($error as $key => $value){
//echo $value;
if(strpos($value,'Duplicate entry') !== false )
 {   echo '<font color="red"> Already logged in </font>';  }
	}
}
?>

<table style="line-height: 40px;width:100%;">
<tr><td style="text-align: left;"><b>Logged in Queues : </b><? if(!empty($loggedin)){ 
     foreach($loggedin as $names) : ?>
<?php echo $names['queue_name'].", ";?>
   <?php endforeach; ?>
   <? } else { ?><b><font color='red' id='blink' class='blink'>No Queues...!</font></b><?}?></td>
      <td style="text-align: right;" > <input type="button" name="queue_select" value="SELECT QUEUE" class="queue_select button-color" />
      <input type="button" name="remove_queue"  value="REMOVE QUEUE" class="remove_queue button-color" /></td>
    </tr>
  </table>
<div id="queuepanel">
<spanstyle="
clear: both;
position: relative;
top: 8px;
left:15px;
font-size: 20px;
color:white;
">
<table align="right"><tr>
<?

if($pause[0]['CNT'] >0)
{

?>
<td>
<input type="button" name="Pause" id="pause" value="Pause" style="background:gray" class="button-color"/></td>
<td>
<input type="button" name="Unpause" id="unpause" value="Unpause" class="button-color"/></td>

<?

}
else
{
	?>
<td>
<input type="button" name="Pause" id="pause" value="Pause" class="button-color"/></td>
<td>
<input type="button" name="Unpause" id="unpause" value="Unpause" class="button-color"/></td>	
	<?
}

?>
<? $sessionValues = $this->session->userdata('logged_in'); ?>
<input type="hidden" id="agent" value="<?php  echo $sessionValues['first_name'];  ?>" />
</tr></table>
</div>
<form>
<input type="button" name="AgentStatus" id="status" value="AgentStatus"onclick="openpopup('popup1')" class='button-color'/>
</form>

<div id="popup1" class="popup" style="border-style:outset;"> 

</div>
<div class="display-type add_queue_popup">
    <?php
   $controller_name = "login/queue_login";
    echo form_open($controller_name);
   ?>
  
	
       <? if(!empty($queue)){ ?>
	 <table align="right"><tr>   <td align="right"><label><b>Select All</b></label></td><td align="right"><input type="checkbox" name="checkall" id="checkall" /></td></tr></table>
	 <table width="100%" align="center">
    <tr><th>QueueName</th><th>Select</th></tr>
    <br>
    <br>
    <br>
	  
     <?php foreach($queue as $name) :?>
<tr><td align="center">
<label><?php echo $name['name'];?></label></td><?
$logged[] = array();
if(!empty($loggedin)){ 
foreach($loggedin as $names) :
$logged[] = $names['queue_name'];
endforeach;
}
if(in_array($name['name'], $logged)){

}else{
?>
<td align="center"><input type="checkbox" class="check" name="queue[]" value="<?php echo $name['name'];?>"/>
   </td></tr>
   <?php }
   endforeach; ?>

   <? } else { ?>
    <tr>
      <td colspan="5">...</td>
    </tr>
  <? } ?>
    
   <tr><td colspan="2"> <center><input type="submit" class="button-color" id="enterqueueselected" value="Enter into Queue"/></center></td></tr>
    </table>
</form>
</div>

<div class="display-type remove_queue_popup">
    <?php
   $controller_name = "login/queue_logout";
    echo form_open($controller_name);
   ?>
   <? if(!empty($loggedin)){ ?>
		    <table align="right"><tr>   <td align="right"><label><b>Select All</b></label></td><td align="right"><input type="checkbox" name="allcheck" id="allcheck" /></td></tr></table>
		   
	<table width="100%" align="center">
    <tr><th>QueueName</th><th>Select</th></tr>
    <br>
    <br>
    <br>
		   
<?php foreach($loggedin as $names) : ?>
	   
<tr><td align="center">
<label><?php echo $names['queue_name'];?></label></td><td align="center"><input type="checkbox" class="checkall" name="queues[]" value="<?php echo $names['queue_name'];?>" />
   </td></tr>				
   <?php endforeach; ?>

   <? } else { ?>
    <tr>
      <td colspan="5">  <?php echo "No queues"; ?></td>
    </tr>
  <? } ?>
    
   <tr><td colspan="2"> <center><input type="submit" class="button-color" id="enterqueueselected" value=" Remove "/></center></td></tr>
    </table>
</form>
</div>


<div id="bg" class="popup_bg"></div> 

<?php include "footer.php";?>