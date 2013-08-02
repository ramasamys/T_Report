 
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
                    <th colspan="4">
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
    <input type="button" name="add-new-extension" class="create-extension button-color" value="Create Extension"/>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	
      <th>Followme</th>
      <th>Alter</th>
     

    </tr>
   <? if(!empty($result)){ 
     foreach($result as $value) : ?>
    <tr>
		
		<td><?php echo $value->f_name; ?></td>
		<td><a href="#">Edit</a>|<a href="#">Delete</a></td>
      
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="2">No Records.</td>
    </tr>
  <? } ?>
  </table>
  <p><?php echo $links; ?></p>
</div>
<?php include "footer.php";?>
