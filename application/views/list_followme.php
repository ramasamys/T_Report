 
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
<div class="new-extension-creation">
    <input type="button" name="add-new-followme" class="create-followme button-color" value="Create Followme"/>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	
      <th>Followme id</th>
	  <th>Followme name</th>
	  <th>Ring time</th>
	  <th>Extension list</th>
      <th>Actions</th>
     

    </tr>
   <? if(!empty($result)){ 
     foreach($result as $value) : ?>
    <tr>
		
		<td><?php echo $value->f_id; ?></td>
		<td><?php echo $value->f_name; ?></td>
		<td><? echo $ringtime = isset($value->ringtime) ? $value->ringtime : '-'; ?></td>
		<td><? echo $extlist = isset($value->extlist) ? $value->extlist : '-'; ?></td>
		<td><a href="#" 
		followme_id="<?php echo $value->f_id; ?>" followme_name="<?php echo $value->f_name; ?>" ring_time="<?php echo $value->ringtime; ?>" extension_list="<?php echo $value->extlist; ?>" set_destination="<?php echo $value->setdst; ?>" dependent_value="<?php echo $value->dst; ?>" class="edit-followme">Edit</a>&nbsp;|&nbsp;<a href="#" class="delete-followme" deleteid="<?php echo $value->f_id; ?>">Delete</a></td>
      
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
        <td>Followme name <sup>*</sup></td> <td><input type="text" name="followme_name" class="textbox-style1 followme-name" value=""></td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="followme-name-error"></label></td>
    </tr>    
    <tr>
	<td>Ring Time</td> <td><select type="text" name="ring_time" id="ring_time" class="ring-time">
	
	<?php
						for ($i=0; $i <= 60; $i++) { ?>
							<option value="<? echo $i; ?>" ><? echo $i; ?></option>;
					<?	}
					?>
	</select>
	</td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="ring-time-error"></label></td>
    </tr>        
         
	 <tr>
	<td>FollowMe List</td> <td><textarea name="followme_list" id="followme_list" class="followme-list" value="" cols="40" rows="4" ></textarea></td>
    </tr>
    <tr>
               <td class="error_cell"> <label id="followme-list-error"></label></td>
    </tr>  
	
	<tr>
	<td>Quick Pick Extenstion</td> <td>
	<select name="quickpick_extension" id="quickpick_extension">
	
	
	 <? if(!empty($extension_list)){                                                       
	    foreach($extension_list as $extensions) : ?>
 		<option value="<? echo $extensions['name']; ?>"><? echo $extensions['name'];?></option>
	  <?php endforeach; ?>
   <? } else { ?>
   <option value="">No extensions</option>
   <? } ?>
	
	
	
	
	
	</select></td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="quickpick-extension-error"></label></td>
    </tr>
	
    <tr>
	<td>Set destination</td> <td><select name="set_destination" class="set_destination"> 
		<option value="">Select</option>
		<option value="Queue">Queue</option> 
	    </select>
	 
		<select name="dependent_destination" id="dependent_destination">
                         <option selected="selected">-</option>
		</select>
	  </td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="set-destination-error"></label></td>
    </tr>        
     
    <tr>
        
        <td><input type="submit" name="insert" value="Save" class="button-color">&nbsp;<input type="reset" name="reset" value="Reset" class="button-color"></td>
    </tr>
  </table>
</form>
</div>
<div class="display-type edit-followme-div" >
    <table>

   <tr>

        <td>Followme name <sup>*</sup></td> <td><input type="text" name="edit_followme_name" class="textbox-style1 edit-followme-name" value=""></td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="edit-followme-name-error"></label></td>
    </tr>    
    <tr>
	<td>Ring Time</td> <td><select type="text" name="edit_ring_time" id="edit_ring_time">
	
	<?php
						for ($i=0; $i <= 60; $i++) { ?>
							<option value="<? echo $i; ?>" ><? echo $i; ?></option>;
						<? }
					?>
	</select>
	</td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="edit-ring-time-error"></label></td>
    </tr>        
    
	<tr>
	<td>Quick Pick Extenstion</td> <td>
	<select name="edit_quickpick_extension" id="edit_quickpick_extension">
	
	
	 <? if(!empty($extension_list)){ 
     foreach($extension_list as $extensions) : ?> 		
		<?php echo '<option value="'.$extensions['name'].'">'.$extensions['name'].'</option>' ?>
		
   <?php endforeach; ?>
   <? } else { ?>
   <option value="">No extensions</option>
   <? }?>
	
	
	
	
	
	</select></td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="edit-quickpick-extension-error"></label></td>
    </tr>
	
	 <tr>
	<td>FollowMe List</td> <td><textarea name="edit_followme_list" id="edit_followme_list" class="edit-followme-list" value="" cols="40" rows="4" ></textarea></td><td></td>
    </tr>
    <tr>
        
              <td class="error_cell"> <label id="edit-followme-list-error"></label></td>
    </tr>  
	
	<tr>
	<td>Set destination</td> <td><select name="edit_set_destination" id="edit_set_destination"> 
		<option value="">Select</option>
		<option value="Queue">Queue</option> 
	    </select>
	 
		<select name="edit_dependent_destination" id="edit_dependent_destination">
			<? if(!empty($depended_value)){
                            foreach($depended_value as $values){ ?>
                    <option value="<? echo $values['list'] ?>"><? echo $values['list']; ?></option>
                          <?  }
                        }?>
		</select>
	  </td>
    </tr>
    <tr>
        <td></td>
              <td class="error_cell"> <label id="edit-set-destination-error"></label></td>
    </tr>        
     
    <tr>  <tr>
      <td></td>
      <td><input type="submit" name="" value="Update" class="button-color"/></td>
  </tr>
    </table>
</div>
<?php include "footer.php";?>
