 
<?php include "header.php";?>
<label class="heading">Inbound list</label>
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
	$controller_name = "pbx_admin/inbound_search";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
    <tr style="text-align: center;">
      <td>
      Inbound  : &nbsp; <input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/pbx_admin/getInbound' ; ?>" />
      </td>
      </tr><tr>
      <td style="text-align: center;" ><input type="submit" name="submit_data" value="Search" class="button-color" />
      <input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>
  </table>
</form>  
</div>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
	
      <th>Inbound</th>
      <th>Alter</th>
     

    </tr>
   <? if(!empty($result)){ 
     foreach($result as $value) : ?>
    <tr>
		<td><?php echo $value->did_num; ?></td>
		<td><a href="#">Edit</a>|<a href="#">Delete</a></td>
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="2">No Records.</td>
    </tr>
  <? } ?>
  </table>
  <p><?php echo $links; ?>
</div>
<?php include "footer.php";?>
