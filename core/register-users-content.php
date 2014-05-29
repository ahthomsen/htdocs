<div class="content-row">
		<div class="register-div" >
			<form method="post" action="../users/register.php">
				<div></div><!-------------------------------------------------------->
					<label for="name" class="register-name register-text">
						First name
					</label>
					<input type="text" id="name" class="register-email  register-fields <?php echo $name_error;?>" name="name" value="<?php echo $name;?>">
					<label for="email" class="register-mail register-text">
						Email
					</label>
					<input type="text" id="email" class="register-email  register-fields <?php echo $mail_error;?>" name="email" value="<?php echo $email;?>">
					<!-------------------------------------------------------->
					<label for="password1" class="register-  register-text">
						Password
					</label>
					<input type="password" id="password1" class="register-password1  register-fields <?php echo $password_error;?>" name="password1">
					<!-------------------------------------------------------->
					<label for="password2" class="register-  register-text">
						Repeat password
					</label>
					<input type="password" id="password2" class="register-password2  register-fields <?php echo $password_error;?>" name="password2">
					<!-------------------------------------------------------->
					<label for="question" class="register-  register-text not-for-humans">
						Repeat password
					</label>
					<input type="password" id="question" class="not-for-humans" name="question">
					<!-------------------------------------------------------->
					<div>
						<p> <?php echo $msg_error ;?></p>
					</div>
				</div>
				<div> 
					<input type="submit" class="register-button clearfix  register-elements" value="Go!">
				</div>
			</form>
		</div>
</div>