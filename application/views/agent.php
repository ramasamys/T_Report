<?php include "header.php";?>

<div id="div-1a">
<table>
<tr><td colspan="3">
<select name="searchable[]" id='searchable' multiple='multiple' >
   <? if(!empty($queue)){ 
     foreach($queue as $name) : ?>
	   

					<option value='<?php echo $name['name'];?>'><?php echo $name['name'];?> </option>

				
   <?php endforeach; ?>
   <? } else { ?>
    <tr>
      <td colspan="5">...</td>
    </tr>
  <? } ?>
	</select>



</td></tr>
<tr><td>
<input type="hidden" value="<? echo $sessionValues['first_name']; ?>" id="agentname" />
<center><input type="button" class="button-color" id="enterqueue" value="Enter into Queue"/></center>
</td></tr>
</table>
</div>
<?php include "footer.php";?>