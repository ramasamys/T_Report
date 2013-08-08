<?php include "header.php";?>
<div class="search-container">
  
<?php
	$controller_name = "summary/";
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
      <td>From &nbsp;<input type="text" name="from_data" class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      To &nbsp;<input type="text" name="from_data"  class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      Agent &nbsp;<input type="text" name="agent_name"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/report_content/predictive_agent' ; ?>" />
	  Phone &nbsp;<input type="text" name="phone"  class="textbox-style" id="new-agent-name-autocomplete" new_url="<?php echo base_url().'index.php/report_content/predictive_phone' ; ?>" />
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
      <th>Destination(YYYY-MM-DD HH:MM:SS)</th>
      <th>Agent</th>
      <th>Time</th>
      <th>Status</th>
      <th>Reason</th>
    </tr>
   <? if(!empty($predictive_report)){ 
     foreach($predictive_report as $value) : ?>
    <tr>
     
	<td><?php echo $value['dest'];?></td>
	<td><?php echo $value['agent'];?></td>
	<td><?php echo $value['time'];?></td>
	<td><?php echo $value['status'];?></td>
	<td><?php echo $value['reason'];?></td>
	
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td style="text-align: left;"> &nbsp; No Records.</td>
      <td colspan="4"></td>
    </tr>
  <? } ?>
  </table>
<div class="pagination-style"><p><?php echo $links; ?></p></div>
</div>
<?php include "footer.php";?>
