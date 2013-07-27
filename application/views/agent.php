<?php include "header.php";?>

<div id="div-1a">
<table>
<tr><td colspan="3">
<select name="searchable[]" id='searchable' multiple='multiple' >
					<option value='1'>Option strawberry 1 - India</option>
					<option value='2'>Option apricot 2 - Italy</option>
					<option value='3'>Option cherry 3 - USA</option>
					<option value='4'>Option pineapple 4 - Holland</option>
					</select>
</td></tr>
<tr><td>
<input type="hidden" value="<? echo $sessionValues['first_name']; ?>" id="agentname" />
<center><input type="button" class="button-color" id="enterqueue" value="Enter into Queue"/></center>
</td></tr>
</table>
</div>
<?php include "footer.php";?>