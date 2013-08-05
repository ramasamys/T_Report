<?php include "header.php";?>
<label class="heading">Queue Summary</label>
<hr>
<div class="search-container">
 
<?php
	$controller_name = "summary/";
	$attributes = array('class' => '',
			'id' => '', 'name' => '');
	echo form_open($controller_name, $attributes);
?>
  <table class="global-table-style" style="line-height: 50px;">
    <tr>
            <th style="text-align:left;">
                <span>Search</span>
            </th>
        </tr>
      <td>From &nbsp;<input type="text" name="from_date" class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      To &nbsp;<input type="text" name="to_date"  class="textbox-style datepicker" /> &nbsp;&nbsp;&nbsp;
      Queue &nbsp;<input type="text" name="queue"  class="textbox-style" id="agent-name-autocomplete" url="<?php echo base_url().'index.php/summary/getQueueList' ; ?>" />
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
      <th>Date(DD-MM-YYYY)</th>
      <th>Queue</th>
      <th>Total calls</th>
      <th>Answered calls</th>
      <th>Avg.Answered</th>
      <th>Abandon calls</th>
	  <th>Avg.Abandon</th>
    </tr>
   <? if(!empty($queue_summary)){ 
     foreach($queue_summary as $value) : ?>
    <tr>
     
	<td><?php echo $value['queuename'];?></td>
	<td><?php echo $value['que'];?></td>
	<td><?php echo $value['Abandon'];?></td>
	<td><?php echo $value['aban_avg'];?></td>
	<td><?php echo $value['Answered'];?></td>
	<td><?php echo $value['answer_avg'];?></td>
	<td><?php echo $value['total'];?></td>

	
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
