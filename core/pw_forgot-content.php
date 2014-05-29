

<div class="content-row">
	
	<form method="post" action="pw_forgot.php">
		<div style="height: 100%;" class="login-text-box">	
			<h1 style="margin:5px;">Resetting your password: </h1>
			<div>
					
				<label class="register-text" for="email">
					Email address
				</label>
				<input class="register-fields" type="text" id="email" name="email">
				
				<label style="display:none;" class="register-text" for="humans">
					Email address
				</label>
				<input style="display:none;" class="register-fields" type="text" id="humans" name="humans">
				
				<p> <?php echo $msg_error; ?></p>
							
			</div>
		</div>
		<div>
			<input class="register-button" type="submit" value="Go!">
		</div>
	</form>
</div>