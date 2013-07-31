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
	$controller_name = "summary/agentSearch";
	$attributes = array('class' => 'agent-summary-search',
			'id' => 'agent-summary-search', 'name' => 'agent_summary_search');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 40px;">
    <tr style="text-align: center;">
      <td colspan="3">From &nbsp;<input type="text" name="from_date" class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      To &nbsp;<input type="text" name="to_date"  class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      Agent &nbsp;<input type="text" name="search"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/summary/getAgentList' ; ?>" />
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
	  <th>Date</th>
      <th>Agent</th>
      <th>Answered</th>
      <th>Not Answered</th>
      <th>Talk Time</th>
      <th>Pause Time</th>
    </tr>
   <? if(!empty($agent_summary)){ 
     foreach($agent_summary as $value) : ?>
    <tr>
	
	<td><?php echo $value['date1'];?></td>
	<td><?php echo $value['agent'];?></td>
	<td><?php echo $value['tot'];?></td>
	<td><?php echo $value['no'];?></td>
	<td><?php echo $value['totaltime'];?></td>
	<td><?php echo $value['pause'];?></td>
	
    </tr>
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="6">No Records.</td>
    </tr>
  <? } ?>
  </table>
</div>
<?php include "footer.php";?>
