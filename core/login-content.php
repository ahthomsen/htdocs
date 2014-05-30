<?php 
$msg_error = "";
if(isset($_GET['error'])) {
	
	if ($_GET['error'] = "unknown") {$msg_error = "The username is not known";}
	if ($_GET['error'] = "mismatch") {$msg_error = "The username and password does not match";}	
}

?>


<div class="content-row">
	
	<form method="post" action="login.php">
		<div class="login-text-box">	
			<h1>Login</h1>
			<div>
				<?php 
				if (isset($_SESSION['userid']) == TRUE) { ?>				
				<p> You are already logged in <a href="logout.php">click here to log out!</a></p>		
				<?php }				
				else { ?>
				<div>
					<a onclick="kokomoFBlogin()" href="#"><img style="width:100%;" src="<?php echo BASE_URL .'img/login_with_facebook.png';?>"></a>
				</div>	
					
				<label class="register-text" for="login">
					Email address
				</label>
				<input class="register-fields" type="text" id="login" name="login">
				<!------------------------------------------------------->
				
				<label class="register-text" for="password">
					Password
				</label>
				<input class="register-fields" type="password" id="login" name="password">
				
				<p> Not already a member? <a href="register.php">click here to register</a></p>
				
				<p> Forgot your password? <a href="pw_forgot.php">click here</a></p>
				
				<p> <?php echo $msg_error; ?></p>
				
				<?php } ?>				
			</div>
			<div style="height: 1px; clear: both;"></div>
		</div>
		<div>
			<input class="register-button" type="submit" value="Go!">
		</div>
	</form>
</div>