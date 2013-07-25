<?php include "header.php";?>
   
	<div class="loginform" >
		<div class="loginTitle"></div>

<?php echo validation_errors(); ?>
		<?php
			$controller_name = "login/verifyLogin";
			$attributes = array('class' => 'report-login',
					'id' => 'report-login', 'name' => 'report_login');
			echo form_open($controller_name, $attributes);
		?>
			    <p>
			    <label for="user_login">Username <br>
					<input type="text" name="tv_username" value="<?php echo set_value('tv_username'); ?>" placeholder="username" />
				</label>
			    </p>
				<p>
					<label for="user_pass">Password <br>
					<input type="password" name="tv_password" value="<?php echo set_value('tv_password'); ?>" placeholder="password"  />
				</p>
				<p>
					<label for="user_role">Role 
					<select name="tv_user_role">
					  <option value="administrator">Administrator</option>
					  <option value="agent">Agent</option>
					</select>
				</p>				
<p class="forgetmenot">
<label for="rememberme">
<input id="rememberme" type="checkbox" value="forever" name="rememberme">
Remember Me
</label>
</p>				
				<p class="submit">

				<input type="submit" value="Login" class="button-color" />
				
				</p>
			
		</form>

	</div>

	
<?php include "footer.php";?>
