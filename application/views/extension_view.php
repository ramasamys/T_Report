<?php include "header.php";?>
<label class="heading">Agent Summary</label>
<hr>
<div class="search-container">

<div  class="slide-up-key" style="display: none;">
</div>
</div>
<div class="agent-summary-list">

<?php echo validation_errors(); ?>

<?php echo form_open('pbx_admin/insert_extension"'); ?>


  <table class="global-table-style">
    <tr>
      <th colspan="2">Adding extension</th>
    </tr>
   
    <tr>
        <td>SIP Extension <sup>*</sup></td> <td><input type="text" name="ext" class="textbox-style1" value="<?php echo set_value('ext'); ?>"></td>
    </tr>
    <tr>
	<td>Display Name <sup>*</sup></td> <td><input type="text" name="name" class="textbox-style1" value="<?php echo set_value('name'); ?>"></td>
    </tr>
    <tr>
	<td>Secret <sup>*</sup></td> <td><input type="text" name="secret" class="textbox-style1" value="<?php echo set_value('secret'); ?>"></td>
    </tr>
    <tr>
	<td>Call Group	</td> <td><input type="text" name="call_group" class="textbox-style1" value="<?php echo set_value('call_group'); ?>"></td>
    </tr>
    <tr>
	<td>Call pickup Group</td> <td><input type="text" name="pickup_group" class="textbox-style1" value="<?php echo set_value('pickup_group'); ?>"></td>
    </tr>
    <tr>
	<td>Mailbox</td> <td><input  type="checkbox" name="mail" class="mailbox" value="<?php echo set_value('mail'); ?>"/>Enable</td>
    </tr>
    <tr style="display:none;" class="show-fields">
	<td>Email id</td> <td><input type="text" name="mailid" id="mailid" class="textbox-style1" value="<?php echo set_value('mailid'); ?>" ></td>
    </tr>	
	<tr style="display:none;" class="show-fields" >
	<td>Password</td> <td><input type="text" name="password" id="password" class="textbox-style1"  value="<?php echo set_value('password'); ?>"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="insert" value="Save" class="button-color">&nbsp;<input type="reset" name="reset" value="Reset" class="button-color"></td>
    </tr>
  </table>
</form>
<table class="mandatory-fields">
        <tr>        
        <td colspan="2">Field marked with <sup>*</sup> are mandatory</td>
    </tr>
</table>
  </div>
<?php include "footer.php";?>
