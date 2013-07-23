<?php include "header.php";?>

		<?php 
			$controller_name = "login/profile_updatation";
			$attributes = array('class' => 'profile-updatation',
					'id' => 'profile-updatation', 'name' => 'profile_updatation');
			echo form_open($controller_name, $attributes);
		?>
<table>
  <tr>
    <td>UserName</td>
    <td>
      <? 
	    if($this->session->userdata('logged_in')){
		$sessionValues = $this->session->userdata('logged_in');
		echo $sessionValues['username'];
	    }
      ?>      
    </td>
  <tr>
  <tr>
    <td>First Name</td>
    <td>
    <? $firstname = isset($user_details[0]['first_name']) ? $user_details[0]['first_name']  : ''?>
      <input type="text" name="tv_firstname" class="textbox-style" value="<? echo set_value('tv_firstname',$firstname) ; ?>" />
    </td>
  <tr>
  <tr>
    <td>Last Name</td>
    <td>
      <? $lastname = isset($user_details[0]['last_name']) ? $user_details[0]['last_name']  : ''?>
      <input type="text" name="tv_lastname" class="textbox-style" value="<? echo set_value('tv_lastname',$lastname); ?>" />
    </td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="tv_password" class="textbox-style" value="<? echo set_value('tv_password'); ?>" /></td>
  </tr>
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="tv_confirm_password" class="textbox-style" value="<? echo set_value('tv_confirm_password'); ?>" /></td>
  </tr>  
  <tr>
    <td colspan="2" style="text-align:center;"><input type="submit" value="Update" class="button-color"/></td>
  <tr>
</table>
</form>
<?php if(validation_errors()){ ?>
    <div class="error-msg">You must fill in all of the fields.</br>
    <?php echo validation_errors(); ?>
<? } ?>
</div>
<?php include "footer.php";?>
