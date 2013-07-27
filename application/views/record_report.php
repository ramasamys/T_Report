<?php include "header.php";?>
<label class="heading">Agent Summary</label>
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
	$controller_name = "summary/";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
    <tr style="text-align: center;">
      <td colspan="3">From &nbsp;<input type="text" name="from_data" class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      To &nbsp;<input type="text" name="from_data"  class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      Agent &nbsp;<input type="text" name="agent_name"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/summary/getAgentList' ; ?>" />
      </td>
      </tr><tr>
      <td colspan="3" style="text-align: center;" ><input type="submit" name="submit_data" value="Search" class="button-color" />
      <input type="button" name="export_data" value="Export" class="button-color" /></td>
    </tr>
  </table>
</form>  
</div>
</div>
<div class="agent-summary-list">
  <table class="global-table-style">
    <tr>
      <th>Call Time</th>
      <th>Source</th>
      <th>Destination</th>
      <th>Status</th>
      <th>Duration</th>
      <th>Download</th>
	  <th>Play audio</th>
		  
    </tr>
   <? if(!empty($record_report)){ 
     foreach($record_report as $value) : ?>
    <tr>

	<td><?php echo $value['calldate'];?></td>
	<td><?php echo $value['clid'];?></td>
	<td><?php echo $value['dst'];?></td>
	<td><?php echo $value['disposition'];?></td>
	<td><?php echo $value['b'];?></td>
	<td><a href="#"><img src="<?php echo base_url();?>css/images/10.png"/></a></td>
	<td><a href="#"><img src="<?php echo base_url();?>css/images/audio.png"/></a></td>
	
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="7">No Records.</td>
    </tr>
  <? } ?>
  </table>
</div>
<?php include "footer.php";?>
