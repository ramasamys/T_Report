<?php include "header.php";?>

<label class="heading">Add followme</label>
<hr>
<div class="search-container">

<div  class="slide-up-key" style="display: none;">
</div>
</div>
<div class="agent-summary-list">

<?php echo validation_errors(); ?>

<?php echo form_open(''); ?>


  <table class="global-table-style">
    <tr>
    <th colspan="3">Add followme</th>
    </tr>
   
    <tr><td>FollowMe Name :</td>
	<td><input type = "text"  name = "followme" > </td></tr>
   
    <tr><td>Ring Time:</td><td>
	<select name="ring_time" id="ring_time">
			<option value=""></option>
	</select></td></tr>
	
	<tr><td>FollowMe List :</td><td>
	<textarea id="follow_list" name = "follow_list" cols="40" rows="2"></textarea> 
	</td></tr>
	
	<tr><td>Quick Pick Extenstion :</td><td>
	<select name="ext" id="ext">
			<option value=""></option>
	</select> </td></tr>
	
	<tr><td>Set Destination :</td><td>
    <select name="followmedst" id="followmedst">
			<option value="">Select</option>
			<option value="queue">Queue</option>
			<option value="exten">Extension</option>
	</select></td><td>
	<div id="id"></div>
	<select name="destination" id="destination">
			<option value="">Select</option>
	</select></td></tr>
	
  </table>
<div align="center">  
  <input type="submit" name="insert" value="Insert">
 </div>
</form>
  </div>
<?php include "footer.php";?>
