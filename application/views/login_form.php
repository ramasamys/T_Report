<?php include "header.php";?>
   
	<div class="loginform" >
		<div class="loginTitle"></div>


<?php //echo validation_errors(); ?>
        <?php if(validation_errors()){ ?>
                  <div id="login_error">
                    <?php echo '<strong>ERROR</strong>:'.validation_errors(); ?>
                </div>
      <?  } ?>                

		<?php
			$controller_name = "login/verifyLogin";
			$attributes = array('class' => 'report-login',
					'id' => 'report-login', 'name' => 'report_login');
			echo form_open($controller_name, $attributes);

		?>
		
			    <p>
			    <label for="user_login">Username <br>
					<input type="text" name="tv_username" value="<?php  echo set_value('tv_username');?>" placeholder="username" onfocus="javascript: if(this.value == this.defaultValue){ this.value = ''; }"/>
				</label>
			    </p>
				<p>
					<label for="user_pass">Password <br>
					<input type="password" name="tv_password" value="<?php echo set_value('tv_password');?>" placeholder="password"  onclick="if(this.value == this.defaultValue) this.value = ''"/>
				</p>
<p class="forgetmenot">
<label for="rememberme">
<input id="rememberme" type="checkbox" name="rememberme">
Remember Me
</label>
</p>				
				<p class="submit">

				<input type="submit" value="Login" class="button-color" />
				
				</p>
			
		</form>
	</div>

	
<?php include "footer.php";?>
