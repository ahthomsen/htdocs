<div class="content-row">
		<div class="register-div" >
			<form method="post" action="reset.php">
				<div></div><!-------------------------------------------------------->
					<label for="password1" class="register-name register-text">
						New password
					</label>
					<input type="password" id="password1" class="register-email  register-fields <?php echo $name_error;?>" name="password1" value="<?php echo $name;?>">
					<label for="password2" class="register-mail register-text">
						Confirm password
					</label>
					<input type="password" id="password2" class="register-email  register-fields <?php echo $mail_error;?>" name="password2" value="<?php echo $email;?>">
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