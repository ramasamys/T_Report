<?php include "header.php";?>
<label class="heading">Queue list</label>
<hr>
<div class="search-container">
  <table class="global-table-style">
  <tr>
                    <th colspan="2" style="text-align:left;">
                        <span>Search</span><a href="#" class="show-div">Show</a><a href="#" class="hide-div" id="hidediv">Hide</a>
                    </th>
  </tr>
  </table> 
<div  class="slide-up-key" style="display: none;">
<?php
	$controller_name = "pbx_admin/queue_search";
	$attributes = array('class' => '',
					'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
    <tr style="text-align: center;">
      <td>
      Queue  : &nbsp; <input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/pbx_admin/getQueue' ; ?>" />
      </td>
      </tr><tr>
      <td style="text-align: center;" ><input type="submit" name="submit_data" value="Search" class="button-color" />
      <input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>
  </table>
</form>  
</div>
</div>
<div class="new-queue-creation">
    <input type="button" name="add-new-queue" class="create-queue button-color" value="Create Queue"/>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	
      <th>Queue</th>
      <th>Delete</th>
     

    </tr>
   <? if(!empty($result)){ 
     foreach($result as $value) : ?>
    <tr>
		<td><?php echo $value->name; ?></td>
		<td><a href="#">Edit</a>|<a href="#">Delete</a></td>
      
	  </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="2">No Records.</td>
    </tr>
  <? } ?>
  </table>
  <p><?php echo $links; ?></p>
</div>










<div class="display-type create-new-queue">
     <?php
			$controller_name = "pbx_admin/queue_insert";
			$attributes = array('class' => 'pbx-new-queue',
					'id' => 'pbx-new-queue', 'name' => 'new_queue');
			echo form_open($controller_name, $attributes);    
     ?>
  <table>
    <tr>
       		
		<td>Queue Name:<sup>*</sup></td> <td><input type="text" name="queue_name" class="textbox-style1 queue-name" value=""></td>
		
		
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="queue-name-error"></label></td>
    </tr>   



	<tr>
	<td>Announce-Frequency:</td> <td><select name="announce_frequency" id="announce_frequency" >
				<option value= "0 seconds">0 seconds</option>
				<option value= "10 seconds">10 seconds</option>
				<option value= "30 seconds">30 seconds</option>
				<option value= "3 mins">3 mins</option>
				<option value= "10 mins">10 mins</option>
				<option value= "15 mins">15 mins</option>
				<option value= "20 mins">20 mins</option>
				<option value= "40 mins">40 mins</option>	
				<option value= "45 mins">45 mins</option>
				<option value= "50 mins">50 mins</option>
				<option value= "60 mins">60 mins</option></select></td>
    </tr>
    
	<tr><td>Announce-Holdtime:</td><td>
	<select name="announce_holdtime" id="announce_holdtime" >
				<option value= "no">No</option>
				<option value= "yes">Yes</option>
				<option value= "once">Once</option>
	</select></td></tr>
	<tr><td>Announce-Position:</td><td>
	<select name="announce_position" id="announce_position" >
				<option value= "no">No</option>
				<option value= "yes">Yes</option>
	</select></td></tr>
	<tr><td>Autofill :</td><td>
	<input type="checkbox" name="auto_fill" id="auto_fill" value="yes"/>Enable
	</td></tr>
	<tr><td>Event Member Status:</td><td>
	<select name="event_member_status" id="event_member_status" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	<tr><td>Event when called:</td><td>
	<select name="event_when_called" id="event_when_called" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	<tr><td>Joinempty:</td><td>
	<select name="join_empty" id="join_empty" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
			<option value= "strict">Strict</option>
			<option value= "ultrastrict">UltraStrict</option>
			<option value= "loose">Loose</option>
	</select></td></tr>
	<tr><td>Leave when empty:</td><td>
	<select name="leave_when_empty" id="leave_when_empty">
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
			<option value= "strict">Strict</option>
			<option value= "ultrastrict">UltraStrict</option>
			<option value= "loose">Loose</option>
	</select></td></tr>
	<tr><td>Maximum wait time :</td><td>
	<select name="max_wait_time" id="max_wait_time"> 
			<option value= "0">0 seconds</option>
			<option value= "10 seconds">10 seconds</option>
			<option value= "30 seconds">30 seconds</option>
			<option value= "1 min">1 min</option>
			<option value= "3 mins">3 mins</option>
			<option value= "10 mins">10 mins</option>
			<option value= "15 mins">15 mins</option>
			<option value= "20 mins">20 mins</option>
			<option value= "40 mins">40 mins</option>										
			<option value= "45 mins">45 mins</option>
			<option value= "50 mins">50 mins</option>
			<option value= "60 mins">60 mins</option>
	</select></td></tr>
	<tr><td>Member delay:</td><td>
	<select name="member_delay" id="member_delay" >
			<option value= "0">0 seconds</option>
			<option value= "10">10 seconds</option>
			<option value= "30">30 seconds</option>
			<option value= "1">1 min</option>
			<option value= "3">3 mins</option>
			<option value= "10">10 mins</option>
			<option value= "15">15 mins</option>
			<option value= "20">20 mins</option>
			<option value= "40">40 mins</option>									
			<option value= "45">45 mins</option>
			<option value= "50">50 mins</option>
			<option value= "60">60 mins</option>
	</select></td></tr>
	
	<tr><td>Penalty members limit: </td><td>	
	<select name="penalty_member_limit" id="penalty_member_limit">
			<option value= "0">Honor Penalties</option>
			<option value= "1">1</option>
			<option value= "2">2</option>
			<option value= "3">3</option>
			<option value= "4">4</option>
			<option value= "5">5</option>
			<option value= "6">6</option>
			<option value= "7">7</option>
			<option value= "8">8</option>
			<option value= "9">9</option>
			<option value= "10">10</option>
	</select></td></tr>
	
	<tr><td>Queue-calls waiting:<sup>*</sup> </td><td>
	<input type="text" name="queue_call_wait" class="textbox-style1 queue-call-wait" id="queue_call_wait" value="">
	</td></tr>
	
	<tr>
        <td></td>
              <td class="error_cell"> <label id="queue-call-wait-error"></label></td>
    </tr> 
	
	<tr><td>Report hold time :</td><td>
	<select name="report_hold_time" id="report_hold_time" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	
	<tr><td>Retry :</td><td>
	<select name="retry" id="retry" >
			<option value= "10">10 seconds</option>
			<option value= "30">30 seconds</option>
			<option value= "1">1 min</option>
			<option value= "3">3 mins</option>
			<option value= "10">10 mins</option>
			<option value= "15">15 mins</option>
			<option value= "20">20 mins</option>
			<option value= "40">40 mins</option>										
			<option value= "45">45 mins</option>
			<option value= "50">50 mins</option>
			<option value= "60">60 mins</option></select></td></tr>

	<tr><td>Ring in use :</td><td>
	<select name="ring_in_use" id="ring_in_use" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	
	<tr><td>Service level :</td><td>
	<select name="service_level" id="service_level">
			<option value= "10">10 seconds</option>
			<option value= "30">30 seconds</option>
			<option value= "60">60 seconds</option>
			<option value= "100">100 seconds</option>
			<option value= "150">150 seconds</option>
			<option value= "200">200 seconds</option>
			<option value= "250">250 seconds</option>
			<option value= "300">300 seconds</option>								
			<option value= "350">350 seconds</option>
			<option value= "400">400 seconds</option>
			<option value= "450">450 seconds</option>
	</select></td></tr>
		
	<tr><td>Ring Strategy :</td><td>
	<select name="ring_statergy" id="ring_statergy">
			<option value= "ringall">Ring all</option>
			<option value= "random">Random</option>
			<option value= "leastrecent">Least Recent</option>
			<option value= "fewestcalls">Fewest Calls</option>
			<option value= "rrmemory">rrMemory</option>
			<option value= "rrordered">rrordered</option>
			<option value= "linear">linear</option>
			<option value= "wrandom">WRandom</option>
	</select></td></tr>
	
	<tr><td>Timeout :</td><td>
	<select name="time_out" id="time_out">
			<option value= "15">15 seconds</option>
			<option value= "30">30 seconds</option>
			<option value= "60">60 seconds</option>
			<option value= "100">100 seconds</option>
			<option value= "150">150 seconds</option>
			<option value= "200">200 seconds</option>
			<option value= "250">250 seconds</option>
			<option value= "300">300 seconds</option>								
			<option value= "350">350 seconds</option>
			<option value= "400">400 seconds</option>
			<option value= "450">450 seconds</option>
	</select></td></tr>
	
	<tr><td>Timeout restart:</td><td>
	<select name="timeout_restart" id="timeout_restart" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	
	<tr><td>Queue Weight :</td><td>
	<select name="queue_weight" id="queue_weight">
			<option value= "0">0</option>
			<option value= "1">1</option>
			<option value= "2">2</option>
			<option value= "3">3</option>
			<option value= "4">4</option>
			<option value= "5">5</option>
			<option value= "6">6</option>
			<option value= "7">7</option>
			<option value= "8">8</option>
			<option value= "9">9</option>
			<option value= "10">10</option>
	</select></td></tr>
	
	<tr><td>Wrapuptime :</td><td>
	<select name="wrapup_time" id="wrapup_time">
			<option value= "10">0 seconds</option>
			<option value= "10">10 seconds</option>
			<option value= "15">30 seconds</option>
			<option value= "25">1 min</option>
			<option value= "30">3 mins</option>
			<option value= "100">10 mins</option>
			<option value= "150">15 mins</option>
			<option value= "200">20 mins</option>
			<option value= "400">40 mins</option>		
			<option value= "450">45 mins</option>
			<option value= "500">50 mins</option>
			<option value= "600">60 mins</option>
	</select></td></tr>

	   <tr>
        <td></td>
        <td><input type="submit" name="insert" value="Save" class="button-color">&nbsp;<input type="reset" name="reset" value="Reset" class="button-color"></td>
    </tr>
	
     </table>
</form>
</div>
<div class="display-type edit-extension-div" >
    <table>

  <tr><td >Extension</td><td > <input type = "text"  name = "ext" id = "ext" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Host</td><td><input type = "text"  name = "host" id = "host" value = " " class="textbox-style1" > </td></tr>
 <tr><td>Name</td><td><input type = "text"  name = "name" id = "name" value = " " class="textbox-style1" > </td></tr>
 <tr><td>Nat</td><td><input type = "text"  name = "nat" id = "nat" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Type</td><td><input type = "text"  name = "type" id = "type" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Context</td><td><input type = "text"  name = "context" id = "context" value = " " class="textbox-style1" > </td></tr>
  <tr><td> From-user</td><td><input type = "text"  name = "fromuser" id = "fromuser" value = " " class="textbox-style1" > </td></tr>
  <tr><td> Mailbox</td><td><input type = "text"  name = "mailbox" id = "mailbox" value = " " class="textbox-style1"> </td></tr>
  <tr><td>Secret</td><td><input type = "text"  name = "sippasswd" id = "sippasswd" value = " " class="textbox-style1"> </td></tr>
  <tr><td>CallerId</td><td><input type = "text"  name = "callerid" id = "callerid" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Cancallforward</td><td><input type = "text"  name = "cancallforward" id = "cancallforward" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Canreinvite </td><td><input type = "text"  name = "canreinvite" id = "canreinvite" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Mask </td><td><input type = "text"  name = "mask" id = "mask" value = " "class="textbox-style1" > </td></tr>
  <tr><td>Musiconhold </td><td><input type = "text"  name = "musiconhold" id = "musiconhold" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Port </td><td><input type = "text"  name = "port" id = "port" value = " "class="textbox-style1" > </td></tr>
  <tr><td>Regseconds</td><td><input type = "text"  name = "regseconds" id = "regseconds" value = " " class="textbox-style1" > </td></tr>
  <tr><td>Lastms</td><td><input type = "text"  name = "lastms" id = "lastms" value = " " class="textbox-style1" > </td></tr>	  
  <tr>
      <td></td>
      <td><input type="submit" name="" value="Update" class="button-color"/></td>
  </tr>
    </table>
</div>







<?php include "footer.php";?>
