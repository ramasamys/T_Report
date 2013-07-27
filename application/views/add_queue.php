<?php include "header.php";?>
<label class="heading">Agent Summary</label>
<hr>
<div class="search-container">

<div  class="slide-up-key" style="display: none;">
</div>
</div>
<div class="agent-summary-list">

<?php echo validation_errors(); ?>

<?php echo form_open('pbx_admin/queue_insert'); ?>


  <table class="global-table-style">
    <tr>
      <th colspan="2">Adding Queue</th>
    </tr>
   
    <tr>
	<td>Queue Name:</td> <td><input type="text" name="qname" value="<?php echo set_value('qname'); ?>"></td>
    </tr>
    <tr>
	<td>Announce-Frequency:</td> <td><select name="frequency" id="frequency" >
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
	<select name="hold" id="hold" >
				<option value= "no">No</option>
				<option value= "yes">Yes</option>
				<option value= "once">Once</option>
	</select></td></tr>
	<tr><td>Announce-Position:</td><td>
	<select name="position" id="position" >
				<option value= "no">No</option>
				<option value= "yes">Yes</option>
	</select></td></tr>
	<tr><td>Autofill :</td><td>
	<input type="checkbox" name="auto_fill" id="auto_fill" value="yes"/>Enable
	</td></tr>
	<tr><td>Event Member Status:</td><td>
	<select name="member_status" id="member_status" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	<tr><td>Event when called:</td><td>
	<select name="when_called" id="when_called" >
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
	<select name="leave_empty" id="leave_empty">
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
			<option value= "strict">Strict</option>
			<option value= "ultrastrict">UltraStrict</option>
			<option value= "loose">Loose</option>
	</select></td></tr>
	<tr><td>Maximum wait time :</td><td>
	<select name="max_wait" id="max_wait"> 
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
	<select name="penalty" id="penalty">
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
	<tr><td>Queue-calls waiting:</td><td>
	<input type="text" name="qwait" id="qwait">
	</td></tr>
	
	<tr><td>Report hold time :</td><td>
	<select name="hold_time" id="hold_time" >
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
	<select name="ring_use" id="ring_use" >
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
	<select name="restart" id="restart" >
			<option value= "no">No</option>
			<option value= "yes">Yes</option>
	</select></td></tr>
	
	<tr><td>Queue Weight :</td><td>
	<select name="weight" id="weight">
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
	<select name="wrap_time" id="wrap_time">
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

	<tr><td colspan="2" style="text-align:center;" >
	<input type="submit" name="submit" id="submit" value =" SUBMIT "/>
	</td></tr>

  </table>

</form>
  </div>
<?php include "footer.php";?>
