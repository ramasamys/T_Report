<?php include "header.php";?>
<label class="heading">Agent Summary</label>
<hr>
<div class="search-container">
 
<?php
	$controller_name = "report_content/search_did";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
     <tr>
            <th style="text-align:left;">
                <span>Search</span>
            </th>
        </tr>
	<tr>
      <td>From &nbsp;<input type="text" name="from_date" class="textbox-style datepicker" /> &nbsp;&nbsp;
      To &nbsp;<input type="text" name="to_date"  class="textbox-style datepicker" /> &nbsp;&nbsp;
	  Agent &nbsp;<input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/report_content/auto_get_agent' ; ?>" 
        </td>
      </tr><tr>
      <td style="text-align: center;" ><input type="submit" name="submit_data" value="Search" class="button-color" />
      <input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>
  </table>
  
</form>  

</div>
<div class="new-extension-creation">
    
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
      <th>Call Time (YYYY-MM-DD HH:MM:SS)</th>
      <th>Caller ID</th>
      <th>Last Dst</th>
      <th>State</th>
      <th>Talk Time</th>
	  
	  
    </tr>
   <? if(!empty($did_report)){ 
     foreach($did_report as $value) : ?>
    <tr>
	
	<td><?php echo $value['calldate'];?></td>
	<td><?php echo $value['clid'];?></td>
	<td><?php echo $value['dst'];?></td>
	<td><?php echo $value['disposition'];?></td>
	<td><?php echo $value['b'];?></td>
      
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="5">No Records.</td>
    </tr>
  <? } ?>
  </table>
  <div class="pagination-style"><p><?php echo $links; ?></p></div>
</div>
<?php include "footer.php";?>
