 
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
                <input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url() . 'index.php/pbx_admin/getExtension'; ?>" />
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

            <th>Display Name</th>
            <th>Extensions</th>
            <th>Mailbox</th>
            <th>Caller Id</th>
            <th>Actions</th>


        </tr>
        <? if (!empty($result)) {
            foreach ($result as $value) :
                ?>
                <tr style="text-align: center">
                    <td><? echo $name = isset($value->callerid) ? $value->callerid : '-'; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><? echo $mailbox = @($value->mailbox) ? $value->mailbox : '-'; ?></td>
                    <td><? echo $cid = isset($value->callerid) ? $value->callerid : '-'; ?></td>
                    <td><a href="#" class="edit-extension">Edit</a> &nbsp;|&nbsp;<a href="#" class="delete-extension" deleteid="<?php echo $value->id; ?>" >Delete</a></td>

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
    <table width="100%">
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
<?php include "footer.php"; ?>
