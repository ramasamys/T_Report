<script language="javascript">
function foo(isChecked){
    document.getElementById('mailid').disabled = isChecked ? "" : "disabled";
    document.getElementById('password').disabled = isChecked ? "" : "disabled";
}
</script>



<?php include "header.php";?>
<label class="heading">Agent Summary</label>
<hr>
<div class="search-container">

<div  class="slide-up-key" style="display: none;">
<?php
	$controller_name = "summary/";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
 
</form>  
</div>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
      <th colspan="2">Adding extension</th>
    </tr>
   
    <tr>
	<td>*SIP Extension:</td> <td><input type="text" name="ext"></td>
    </tr>
    <tr>
	<td>*Display Name:</td> <td><input type="text" name="name"></td>
    </tr>
    <tr>
	<td>*Secret:</td> <td><input type="text" name="secret"></td>
    </tr>
    <tr>
	<td>Call Group:	</td> <td><input type="text" name="call_group"></td>
    </tr>
    <tr>
	<td>Call pickup Group:</td> <td><input type="text" name="pickup_group"></td>
    </tr>
    <tr>
	<td>Mailbox:</td> <td><input  type="checkbox" name="mail" id="mail" onchange="foo(this.checked);"/>Enable</td>
    </tr>
    <tr>
	<td>Email id:</td> <td><input type="text" name="mailid" disabled="disabled" ></td>
    </tr>	
	<tr>
	<td>Password</td> <td><input type="text" name="password" disabled="disabled"></td>
    </tr>
	<tr>
	<td>Call waiting:</td> <td><input type="text" name="waiting"></td>
    </tr>
  </table>
<div align="center">  
  <input type="submit" name="insert" value="Insert">
  <input type="reset" name="reset" value="Reset">
</div>
  </div>
<?php include "footer.php";?>
