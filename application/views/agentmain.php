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


if($pas[0]['CNT'] >0)
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


<div id="bg" class="popup_bg"></div> 

<?php include "footer.php";?>