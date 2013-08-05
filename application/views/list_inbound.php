 
<?php include "header.php"; ?>
<div class="search-container">
    <?php
    $controller_name = "pbx_admin/inbound_search";
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
            <td style="width:20%;">Inbound  :</td>
            <td style="width:20%;">
                <input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url() . 'index.php/pbx_admin/getInbound'; ?>" />
            </td>

            <td style="width:30%;"><input type="submit" name="submit_data" value="Search" class="button-color" /></td>
            <td style="width:30%;"><input type="button" name="export_data" value="Export" class="button-color" /></td>
			<!--<td style="width:30%;"><button name="export_data"> <img src="<?php echo base_url() . 'css/images/find-icon.png'; ?>"></button></td>-->
        </tr>  
    </table> 
</form>      
</div>
<div class="new-extension-creation">
    <input type="button" name="add-new-inbound" class="create-inbound button-color" value="Create Inbound"/>
</div>

<div class="agent-summary-list">
    <table class="global-table-style">
        <tr>

            <th>DID number</th>
			<th>DID name</th>
            <th>Actions</th>


        </tr>
        <? if (!empty($result)) {
            foreach ($result as $value) :
                ?>
                <tr>
                    <td><?php echo $value->did_num; ?></td>
					<td><?php echo $value->did_name; ?></td>
                    <td><a href="#" did_name="<?php echo $value->did_name;?>" did_number="<?php echo $value->did_num;?>" class="edit-inbound">Edit</a>&nbsp;|&nbsp;<a href="#" class="delete-inbound" deleteid="<?php echo $value->did_num; ?>">Delete</a></td>
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


<div class="display-type create-new-inbound">
    <?php
    $controller_name = "pbx_admin/insert_inbound";
    $attributes = array('class' => 'pbx-new-inbound',
        'id' => 'pbx-new-inbound', 'name' => 'new_inbound');
    echo form_open($controller_name, $attributes);
    $destination = array('Select' => 'Select','Extension'=> 'Extension','Queue'=>'Queue','Terminate Call'=>'Terminate Call','Follow Me'=>'Follow Me');
    ?>
    <table width="100%">
        <tr>
            <td>DID name <sup>*</sup></td> <td><input type="text" name="did_name" class="textbox-style1 did-name" value=""></td><td></td>
        </tr>
        <tr>
            <td></td>
            <td class="error_cell"> <label id="did-name-error"></label></td>
        </tr>    
        <tr>
            <td>DID number <sup>*</sup></td> <td><input type="text" name="did_number" class="textbox-style1 did-number" value=""></td><td></td>
        </tr>
        <tr>
            <td></td>
            <td class="error_cell"> <label id="did-number-error"></label></td>
        </tr>        

        <tr>
            <td>Set destination</td> 
            <td>
                <select name="set_destination" id="set_destination"> 
                    <? foreach($destination as $des) { ?>
                    <option value="<? echo $des; ?>"><? echo $des; ?></option>
                    <? } ?>
                   </select>
            </td>

            <td>
                <select name="dependent_destination" id="dependent_destination">
                <option selected="selected">-</option>
				</select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="error_cell"> <label id="set-destination-error"></label></td>
        </tr>        

        <tr>
            <td></td>
            <td><input type="submit" name="insert" value="Save" class="button-color">&nbsp;<input type="reset" name="reset" value="Reset" class="button-color"></td>
        </tr>
    </table>
</form>
</div>
<div class="display-type edit-inbound-div" >
    <table>

        <tr><td >DID name</td><td > <input type = "text"  name = "did_name" id = "did_name" value = "" class="textbox-style1" > </td></tr>
        <tr><td>DID number</td><td><input type = "text"  name = "did_number" id = "did_number" value = "" class="textbox-style1" > </td></tr>
       <tr><td>Set destination</td>
	   <td>
                <select name="set_destination" id="set_destination"> 
                    <? foreach($destination as $des) { ?>
                    <option value="<? echo $des; ?>"><? echo $des; ?></option>
                    <? } ?>
                   </select>
            </td>
			</tr>	  
        <tr>
            <td></td>
            <td><input type="submit" name="" value="Update" class="button-color"/></td>
        </tr>
    </table>
</div>
<?php include "footer.php"; ?>
