<?php include "header.php";
?>
<div class="search-container">
 
<?php
	/*$controller_name = "summary/";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);*/
?>
  <table class="global-table-style" style="line-height: 40px;">
     <tr>
            <th style="text-align:left;">
                <span>Queue Selection</span>
            </th>
        </tr>
	<tr>
      <td><div id="queuepanel">
<table align="right"><tr>

<td>
<input type="button" name="Pause" id="pause" value="Pause" class="button-color"/></td>
<td>
<input type="button" name="Unpause" id="unpause" value="Unpause" class="button-color"/></td>

 <? $sessionValues = $this->session->userdata('logged_in'); ?>
<input type="hidden" id="agent" value="<?php  echo $sessionValues['first_name'];  ?>" />
</tr></table>
</div>
      </td>
      </tr><tr>
      <td style="text-align: center;" > <input type="button" name="queue_select" value="SELECT QUEUE" class="queue_select button-color" />
      <input type="button" name="remove_queue"  value="REMOVE QUEUE" class="remove_queue button-color" /></td>
    </tr>
  </table>
</form>  
</div>
<?
/*
 if(!empty($loggedin)){ 
echo "<div align='right'>You have already logged in ";
     foreach($loggedin as $qname) : 
     
	echo $qname['queue_name'];
			
    endforeach; 

    echo "</div>";} else { }    
*/
?>
<!--
<div id="div-1a">
<table>
<tr><td colspan="3">
<select name="searchable[]" id='searchable' multiple='multiple' >
   <? if(!empty($queue)){ 
     foreach($queue as $name) : ?>
	   

					<option value='<?php echo $name['name'];?>'><?php echo $name['name'];?> </option>

				
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="5">...</td>
    </tr>
  <? } ?>
	</select>



</td></tr>
<tr><td>
<input type="hidden" value="<? echo $sessionValues['first_name']; ?>" id="agentname" />
<center><input type="button" class="button-color" id="enterqueue" value="Enter into Queue"/></center>
</td></tr>
</table>
</div>-->


<div class="display-type add_queue_popup">
    <?php
   $controller_name = "login/queue_login";
    echo form_open($controller_name, $attributes);
   ?>
    <table width="100%" align="center">
    <tr><th>QueueName</th><th>Select</th></tr>
    <br>
    <br>
    <br>
       <? if(!empty($queue)){ 
     foreach($queue as $name) : ?>
	   
<tr><td align="center">
<label><?php echo $name['name'];?></labe></td><td align="center"><input type="checkbox" name="queue[]" value="<?php echo $name['name'];?>" />
   </td></tr>				
   <?php endforeach; ?>

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
    echo form_open($controller_name, $attributes);
   ?>
    <table width="100%" align="center">
    <tr><th>QueueName</th><th>Select</th></tr>
    <br>
    <br>
    <br>
       <? if(!empty($loggedin)){ 
     foreach($loggedin as $names) : ?>
	   
<tr><td align="center">
<label><?php echo $names['queue_name'];?></labe></td><td align="center"><input type="checkbox" name="queues[]" value="<?php echo $names['queue_name'];?>" />
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










<?php include "footer.php";?>