 
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
	$controller_name = "";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
    <tr>
      <td style="text-align: center;" >Extension  : &nbsp; 
          <input type="text" name="ext"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/pbx_admin/getExtensionList' ; ?>" />
      </td><td>
          <input type="submit" name="submit_data" value="Search" class="button-color" /></td>
      <td><input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>
  </table>
</form>  
</div>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	
      <th>Extensions</th>
      <th>Actions</th>
     

    </tr>
   <? if(!empty($result)){        
     foreach($result as $value) : ?>
    <tr style="text-align: center">
		
		<td><?php echo $value->name; ?></td>
                <td><a href="#" class="">Edit</a> &nbsp;|&nbsp;<a href="#" class="delete-extension" deleteid="<?php echo $value->id; ?>" >Delete</a></td>
      
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
