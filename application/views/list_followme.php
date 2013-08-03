 
<?php include "header.php";?>
<div class="search-container">
<?php
	$controller_name = "pbx_admin/followme_search";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>    
  <table class="global-table-style" style="line-height: 50px;" >
  <tr>
                    <th colspan="4" style="text-align:left;">
                        <span>Search</span>
                    </th>
  </tr>
    <tr>
        <td style="width:20%;"> Followme :</td>
      <td style="width:20%;">
        <input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/pbx_admin/getFollow' ; ?>" />
      </td>      
      <td style="width:30%;"><input type="submit" name="submit_data" value="Search" class="button-color" /></td>
      <td style="width:30%;">
      <input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>  
  </table> 
</form>     
</div>
<div class="new-followme-creation">
    <input type="button" name="add-new-followme" class="create-followme button-color" value="Create Followme"/>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	
      <th>Followme</th>
      <th>Actions</th>
     

    </tr>
   <? if(!empty($result)){ 
     foreach($result as $value) : ?>
    <tr>
		
		<td><?php echo $value->f_name; ?></td>
		<td><a href="#">Edit</a>&nbsp;|&nbsp;<a href="#">Delete</a></td>
      
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


<div class="display-type create-new-followme">
     <?php
			$controller_name = "pbx_admin/followme_insert";
			$attributes = array('class' => 'pbx-new-followme',
					'id' => 'pbx-new-followme', 'name' => 'new_followme');
			echo form_open($controller_name, $attributes);    
     ?>

  <table>
    <tr>
        <td>Followme name <sup>*</sup></td> <td><input type="text" name="followme_name" class="textbox-style1 followme-name" value=""></td><td></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="followme-name-error"></label></td>
    </tr>    
    <tr>
	<td>Ring Time</td> <td><select type="text" name="ring_time" id="ring_time">
	<?php
						for ($i=0; $i <= 60; $i++) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					?>
	</select>
	</td><td></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="ring-time-error"></label></td>
    </tr>        
         
	 <tr>
	<td>FollowMe List</td> <td><textarea name="followme_list" id="followme_list" class="followme-list" value="" cols="40" rows="4" ></textarea></td><td></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="followme-list-error"></label></td>
    </tr>  
	
	<tr>
	<td>Quick Pick Extenstion</td> <td>
	<select name="quickpick_extension" id="quickpick_extension">
	
	
	 <? if(!empty($extension_list)){ 
     foreach($extension_list as $extensions) : ?>
 		
		<?php echo '<option value="'.$extensions['name'].'">'.$extensions['name'].'</option>' ?>
		
   <?php endforeach; ?>
   <? } else { ?>
   <option value="">No extensions</option>
   <? }?>
	
	
	
	
	
	</select></td><td></td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="quickpick-extension-error"></label></td>
    </tr>
	
    <tr>
	<td>Set destination</td> <td><select name="set_destination" id="set_destination"> 
		<option value="">Select</option>
		<option value="Queue">Queue</option> 
	    </select></td>
	  
	 <td>
	 
		<select name="dependent_destination" id="dependent_destination">
			<option value="">Select</option>
			<option value="erte">dfgdf</option>
			<option value="dfgdf">dfgfdg</option>
			<option value="fdgdfg">ertret</option>
			<!--<option selected="selected">-</option>-->
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
<?php include "footer.php";?>
