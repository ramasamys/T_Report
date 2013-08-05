<?php include "header.php";?>
<label class="heading">Agent Details</label>
<hr>
<div class="search-container">
  <table class="global-table-style">
  <tr>
                   
  </tr>
  </table> 
<div  class="slide-up-key" style="display: none;">
<?php
	$controller_name = "useragent";
	$attributes = array('class' => '',
        'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
    <tr style="text-align: center;">
      <td
      colspan="3">From &nbsp;<input type="text" name="from_date" class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      To &nbsp;<input type="text" name="to_date"  class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      </td>
      </tr>
	 
	  
	  <tr>
      <td colspan="3" style="text-align: center;" ><input type="submit" name="submit_data" value="Search" class="button-color" />
      <input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>
  </table>
</form>  
</div>
</div>
<div class="new-user-creation">
    <input type="button" name="add-new-user"  class="create-user button-color" value="Create "/>
	
</div>

<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
      <th>Username</th>
      <th>Role</th>
	  <th>CreatedBy</th>
	  <th>CreatedDate</th>
	  <th></th>
      
    </tr>
   <? if(!empty($agent_details)){ 
     foreach($agent_details as $value) : ?>
    <tr>
     
	<td><?php echo $value['username'];?></td>
	<td><?php echo $value['role'];?></td>
	<td><?php echo $value['created_by'];?></td>
	<td><?php echo $value['created_date'];?></td>
	    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="5">No Records.</td>
    </tr>
  <? } ?>
  </table>
  
</div>

<div class="display-type create-new-user">
     <?php
			$controller_name = "useragent/insert";
			$attributes = array('class' => 'new-user',
					'id' => 'new-user', 'name' => 'new_extensions');
			echo form_open($controller_name, $attributes);    
     ?>
  <table>
    <tr>
        <td>Username <sup>*</sup></td> <td><input type="text" name="username" class="textbox-style1 username" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="username-error"></label></td>
    </tr>    
    <tr>
	<td>Role <sup>*</sup></td> <td><input type="text" name="role" class="textbox-style1 role" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="role-error"></label></td>
    </tr>        
    <tr>
	<td>Firstname <sup>*</sup></td> <td><input type="text" name="firstname" class="textbox-style1 firstname" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="firstname-error"></label></td>
    </tr>        
    <tr>
	<td>Lastname	</td> <td><input type="text" name="lastname" class="textbox-style1 lastname" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="lastname-error"></label></td>
    </tr>        
          
    
    <tr style="display:none;" class="show-fields">
	<td>Email id</td> <td><input type="text" name="mailid" id="mailid" class="textbox-style1 email-id" value="" ></td>
    </tr>	
	<tr style="display:none;" class="show-fields" >
	<td>Password</td> <td><input type="text" name="password_ext" id="password" class="textbox-style1 password-ext"  value=""></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="insert" value="Save" class="button-color">&nbsp;<input type="reset" name="reset" value="Reset" class="button-color"></td>
    </tr>
  </table>
</form>
</div>



<?php include "footer.php";?>
