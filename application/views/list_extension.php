<?php include "header.php"; ?>

<div class="search-container">
    <?php
    $controller_name = "pbx_admin/searchExtension";
    $attributes = array('class' => '',
        'id' => '', 'name' => '');
    echo form_open($controller_name, $attributes);
    ?>    
    <table class="global-table-style" style="line-height: 50px;">
        <tr>
            <th colspan="4" style="text-align:left;">
                <span>Search</span>
            </th>
        </tr>
        <tr>
            <td style="width:20%;">Extension  :</td>
            <td style="width:20%;">
                <input type="text" name="search"  class="textbox-style numbers-only" id="agent-name-autocomplete" url="<?php echo base_url() . 'index.php/pbx_admin/getExtension'; ?>" />
            </td>     
            <td style="width:30%;"><input type="submit" name="submit_data" value="Search" class="button-color" /></td>
            <td style="width:30%;"><input type="button" name="export_data" value="Export" class="button-color" /></td>

        </tr>  
    </table> 
</form>     
</div>
<div class="new-extension-creation">
    <input type="button" name="add-new-extension" class="create-extension button-color" value="Create Extension"/>
</div>
<div class="agent-summary-list">
    <table class="global-table-style">
        <tr>

            <th>Extensions</th>
			<th>Display Name</th>
            <th>Secret</th>
            <th>Call group</th>
            <th>Call pickup group</th>
            <th>Actions</th>


        </tr>
        <? if (!empty($result)) { 
            foreach ($result as $value) :
                ?>
                <tr style="text-align: center">
                    <td><?php echo $value->name; ?></td>
					<td><? echo $display_name = @($value->display_name) ? $value->display_name : '-'; ?></td>
                    <td><? echo $secret = @($value->secret) ? $value->secret : '-'; ?></td>
                    <td><? echo $callgroup = @($value->callgroup) ? $value->callgroup : '-'; ?></td>
                    <td><? echo $callpickgroup = @($value->pickupgroup) ? $value->pickupgroup : '-'; ?></td>
                    <td><a href="#" class="edit-extension" context="<? echo $value->context; ?>" display_name="<? echo $value->display_name; ?>" secret="<? echo $value->secret; ?>" callerid="<? echo $value->callerid; ?>" extensionsip="<? echo $value->id; ?>"  extname="<? echo $value->name; ?>" ext_hostname="<? echo $value->host;?>">Edit</a> 
                    &nbsp;|&nbsp;<a href="#" class="delete-extension" deleteid="<?php echo $value->name; ?>" >Delete</a></td>

                </tr>
            <?php endforeach; ?>
<? } else { ?>
            <tr>
                <td colspan="6">No Records.</td>
            </tr>
<? } ?>
    </table>
    <div class="pagination-style"><p><?php echo $links; ?></p></div>
</div>
<div class="display-type create-new-extension">
  <form id="pbx-new-extensions" method="post">
    <table width="100%" style="line-height: 30px;">
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
            <td>Secret <sup>*</sup></td> <td><input type="text" name="secret" class="textbox-style1 secret-fld" value=""></td>
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
            <td>Context</td> <td><input type="text" name="context" class="textbox-style1 extension-context" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td class="error_cell"> <label id="context-error"></label></td>
        </tr> 

        <tr>
            <td> Host</td> <td><input type="text" name="extension_host" class="textbox-style1 extension-host" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td class="error_cell"> <label id="extension-host-error"></label></td>
        </tr> 


        <tr>
            <td>Mailbox</td> <td><input  type="checkbox" name="mail" id="mailbox" class="mailbox" value=""/>Enable</td>
        </tr>
        <tr style="display:none;" class="show-fields">
            <td>Email id</td> <td><input type="text" name="mailid" id="mailid" class="textbox-style1 email-id" value="" ></td>
        </tr>	
        <tr>
            <td></td>
            <td class="error_cell"> <label id="mailid-error"></label></td>
        </tr>  
        <tr style="display:none;" class="show-fields" >
            <td>Password</td> <td><input type="text" name="password_ext" id="password" class="textbox-style1 password-ext"  value=""></td>
        </tr>
        <tr>
            <td></td>
            <td class="error_cell"> <label id="mail-password-error"></label></td>
        </tr>  
        <tr>
            <td></td>
            <td><input type="submit" name="insert" value="Save" class="button-color">&nbsp;<input type="reset" name="reset" value="Reset" class="button-color"></td>
        </tr>
    </table>
</form>
</div>
<div class="display-type edit-extension-div" >
<form id="pbx-edit-extensions" method="post">
    <table>

        <tr><td >Extension <sup>*</sup></td><td > <input type = "text"  name = "ed_extension" id = "ed_extension" value = " " class="textbox-style1 edit-sip-ext" readonly="readonly"> </td></tr>
        <tr><td>Display name <sup>*</sup></td><td><input type = "text"  name = "ed_displayname" id = "ed_displayname" value = " " class="textbox-style1 edit-sip-name" > </td></tr> 
   <tr>
            <td></td>
            <td class="error_cell"> <label id="edit-display-name-error"></label></td>
        </tr>  		
		<tr><td>Secret <sup>*</sup></td><td><input type = "text"  name = "ed_secret" id = "ed_secret" value = " " class="textbox-style1 edit-sip-secret"> </td></tr>
		<tr>
            <td></td>
            <td class="error_cell"> <label id="edit-secret-extension-error"></label></td>
        </tr> 
		
		<tr><td>Context</td><td><input type = "text"  name = "ed_context" id = "ed_context" value = " " class="textbox-style1 edit-sip-context" > </td></tr>
		<tr><td>Host</td><td><input type = "text"  name = "ed_host" id = "ed_host" value = " " class="textbox-style1 edit-sip-host" > </td></tr>
        <tr><td>CallerId</td><td><input type = "text"  name = "ed_callerid" id = "ed_callerid" value = " " class="textbox-style1 edit-sip-callerid" > </td></tr>
        <tr>
            <td></td>
            <td><input type="submit" name="" value="Update" class="button-color"/></td>
        </tr>
    </table>
	</form>
</div>
<?php include "footer.php"; ?>
