 
<?php include "header.php";?>
<label class="heading">Extension list</label>
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
	$controller_name = "pbx_admin/searchExtension";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
    
  <table class="global-table-style" style="line-height: 40px;">

    <tr style="text-align: center;">
      <td>
      Extension  : &nbsp; <input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/pbx_admin/getExtension' ; ?>" />
      </td>
      </tr><tr>
      <td style="text-align: center;" ><input type="submit" name="submit_data" value="Search" class="button-color" />
      <input type="button" name="export_data" value="Export" class="button-color" /></td>

    </tr>
  </table>
</form>  
</div>
</div>
<div class="new-extension-creation">
    <input type="button" name="add-new-extension" class="create-extension button-color" value="Create Extension"/>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	     
      <th>Display Name</th>
      <th>Extensions</th>
      <th>Mailbox</th>
      <th>Caller Id</th>
      <th>Actions</th>
     

    </tr>
   <? if(!empty($result)){      
     foreach($result as $value) : ?>
    <tr style="text-align: center">
        <td><? echo $name = isset($value->callerid) ? $value->callerid : '-'; ?></td>
		<td><?php echo $value->name; ?></td>
                <td><? echo $mailbox = @($value->mailbox) ? $value->mailbox : '-' ; ?></td>
                <td><? echo $cid = isset($value->callerid) ? $value->callerid : '-' ; ?></td>
                <td><a href="#" class="">Edit</a> &nbsp;|&nbsp;<a href="#" class="delete-extension" deleteid="<?php echo $value->id; ?>" >Delete</a></td>
      
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="2">No Records.</td>
    </tr>
  <? } ?>
  </table>
    <div class="pagination-style"><p><?php echo $links; ?></p></div>
</div>
<div class="display-type create-new-extension">
     <?php
			$controller_name = "pbx_admin/insert_extension";
			$attributes = array('class' => 'pbx-new-extensions',
					'id' => 'pbx-new-extensions', 'name' => 'new_extensions');
			echo form_open($controller_name, $attributes);    
     ?>
  <table>
    <tr>
        <td>SIP Extension <sup>*</sup></td> <td><input type="text" name="sip_extension" class="textbox-style1 sip-extension" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="sip-extension-error"></label></td>
    </tr>    
    <tr>
	<td>Display Name <sup>*</sup></td> <td><input type="text" name="display_name" class="textbox-style1 display-name" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="display-name-error"></label></td>
    </tr>        
    <tr>
	<td>Secret <sup>*</sup></td> <td><input type="text" name="secret" class="textbox-style1 sceret-fld" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="secret-extension-error"></label></td>
    </tr>        
    <tr>
	<td>Call Group	</td> <td><input type="text" name="call_group" class="textbox-style1 call-group" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="call-group-error"></label></td>
    </tr>        
    <tr>
	<td>Call pickup Group</td> <td><input type="text" name="pickup_group" class="textbox-style1 call-pickup" value=""></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="call-pickup-error"></label></td>
    </tr>        
    <tr>
	<td>Mailbox</td> <td><input  type="checkbox" name="mail" class="mailbox" value=""/>Enable</td>
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
