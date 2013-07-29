<?php include "header.php";?>

agent main page
<div id="queuepanel">
<spanstyle="
clear: both;
position: relative;
top: 8px;
left:15px;
font-size: 20px;
color:white;
">
Logged In Queue:</span>
<table align="right"><tr>

<?
/*
$uname1="SIP/".$uname;

$pcheck="select paused from queue_member_table where membername='$uname1'";
//echo $pcheck;
$pas=mysql_query($pcheck,$conn);
$rowww = mysql_fetch_array($pas);
$pause=$rowww['paused'];
//echo $pause."ssssssssssssS";

if($pause=="1")
{
//style.background='gray';
?>


<td>
<input type="submit" name="Pause" id="pause" value="Pause" onclick="Pause()" style="background:gray" class='styled-button-8'/></td>
<td>
<input type="submit" name="Unpause" id="Unpause" value="Unpause" onclick="UnPause()" class='styled-button-8'/></td><td>
<input type="submit" name="QueueLogout" id="stop" value="QueueLogout"onclick="Stop()" class='styled-button-8'/></td>
<td>
<!--<input type="submit" name="AgentStatus" id="status" value="AgentStatus"onclick="openpopup('popup1')" class='styled-button-8'/></td>-->

<!--<td><a href="#" class="topopup">Click Here Trigger</a></td>-->

<?
}
else
{*/
?>
<td>
<input type="button" name="Pause" id="pause" value="Pause"  class="button-color"/></td>
<td>
<input type="button" name="Unpause" id="unpause" value="Unpause" class="button-color"/></td>
<!--<td>
<input type="submit" name="QueueLogout" id="stop" value="QueueLogout"onclick="Stop()" class='styled-button-8'/></td>
<td>
<input type="submit" name="AgentStatus" id="status" value="AgentStatus"onclick="openpopup('popup1')" class='styled-button-8'/></td>-->
<?

//}

?>
 <? $sessionValues = $this->session->userdata('logged_in'); ?>
<input type="hidden" id="agent" value="<?php  echo $sessionValues['first_name'];  ?>" />
</tr></table>
</div>




<?php include "footer.php";?>