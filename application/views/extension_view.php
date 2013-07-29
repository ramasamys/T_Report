<script language="javascript">
function foo(isChecked){
    document.getElementById('mailid').disabled = isChecked ? "" : "disabled";
    document.getElementById('password').disabled = isChecked ? "" : "disabled";
}
</script>



<?php include "header.php";?>
<label class="heading">Agent Summary</label>
<hr>

<div class="agent-summary-list">

<?php echo validation_errors(); ?>

<?php echo form_open('pbx_admin/insert_extension"'); ?>


  <table class="global-table-style">
    <tr>
      <th colspan="2">Adding extension</th>
    </tr>
   
    <tr>
	<td>*SIP Extension:</td> <td><input type="text" name="ext" value="<?php echo set_value('ext'); ?>"></td>
    </tr>
    <tr>
	<td>*Display Name:</td> <td><input type="text" name="name" value="<?php echo set_value('name'); ?>"></td>
    </tr>
    <tr>
	<td>*Secret:</td> <td><input type="text" name="secret" value="<?php echo set_value('secret'); ?>"></td>
    </tr>
    <tr>
	<td>Call Group:	</td> <td><input type="text" name="call_group" value="<?php echo set_value('call_group'); ?>"></td>
    </tr>
    <tr>
	<td>Call pickup Group:</td> <td><input type="text" name="pickup_group" value="<?php echo set_value('pickup_group'); ?>"></td>
    </tr>
    <tr>
	<td>Mailbox:</td> <td><input  type="checkbox" name="mail" id="mail" onchange="foo(this.checked);" value="<?php echo set_value('mail'); ?>"/>Enable</td>
    </tr>
    <tr>
	<td>Email id:</td> <td><input type="text" name="mailid" id="mailid" disabled="disabled" value="<?php echo set_value('mailid'); ?>" ></td>
    </tr>	
	<tr>
	<td>Password</td> <td><input type="text" name="password" id="password" disabled="disabled" value="<?php echo set_value('password'); ?>"></td>
    </tr>
	
  </table>
<div align="center">  
  <input type="submit" name="insert" value="Insert">
  <input type="reset" name="reset" value="Reset">
  </div>

</form>
  </div>
<?php include "footer.php";?>
