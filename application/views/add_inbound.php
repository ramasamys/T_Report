<?php include "header.php";?>
<label class="heading">Add Inbound</label>
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
    <th colspan="3">Add Inbound route</th>
    </tr>
   
    <tr><td>DID Name  :</td><td><input type = "text"  name = "did_name" > </td></tr>
    
	<tr><td>DID Number  :</td><td><input type = "text"  name = "did_number" > </td></tr>
	
	<tr><td>Set Destination :</td><td>
	<select name="destination" id="destination">
			<option value="">Select</option>
			<option value="Extension">Extension</option>
			<option value="Queue">Queue</option> 
			<option value="Terminate Call">Terminate Call</option> 
			<option value="Follow Me">Follow Me</option>
	</select></td><td>
	<div id="id"></div>
	<select name="sid" id="sid">
			<option value="">Select</option>
			<option selected="selected">-</option>
	</select></td></tr>
	
  </table>
<div align="center">  
  <input type="submit" name="insert" value="Insert">
 </div>
</form>
  </div>
<?php include "footer.php";?>
