<?php

include_once("../scripts/config.php");
require(ROOT_PATH . "scripts/functions.php");
require(ROOT_PATH . "scripts/database.php");


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$email = strtolower($_POST["email"]);
	$password1 = $_POST["password1"];
	$password2 = $_POST["password2"];
	$is_valid = TRUE;
	/* Selects 1 entry in database with same mail
	 * should return null if new user mail */
	try {
	$returns = $db->prepare('SELECT 1 FROM user WHERE mail=?');
	$returns->bindParam(1, $email);
	$returns->execute();
	}
	catch (Exception $e){
		die($e);
	}
	$existing_email = $returns->fetch();
	 /*  Check to see if parameters are met:
	 *   Valid email adress
	 * 	 Passwords match
	 *   Unique email
	 *   Returns $error array with keys pass and email 
	  *  and values "passmismatch", "emailinvalid" and
	  * "emailoccupied"
	  * The order of the checks should be 
	  * from least important to most important
	 */
	if(strlen($password1)<6)
	{
		$error = "length";
		$is_valid=FALSE;
	}
	if($password1 != $password2)
	{
		$error = "mismatch";
		$is_valid=FALSE;		
	}
	if(filter_var($email, FILTER_VALIDATE_EMAIL)==FALSE)
	{
		$error = "invalid";
		$is_valid=FALSE;		
	}
	if($existing_email != FALSE)
	{
		$error = "occupied";
		$is_valid=FALSE;
	}
	foreach ($_POST as $element)
	{
		if(stripos($element, 'Content-Type:')!=FALSE)
		{
			die("There was an error with your input");
		}
	} 
	if(empty($_POST["question"])==FALSE)
	{
		die("Robot detected! Or error in browser...");
	}
	
	if($is_valid!=FALSE)	
	{
			$salt = create_salt();
			$password = get_hashed_password($password1, $salt);
			 try {   		 	
				 	 $update = $db->prepare('INSERT INTO user (MAIL, `PASSWORD`, SALT) VALUES(?, ?, ?);');
					 $update->bindParam(1, $email);
					 $update->bindParam(2, $password);			
					 $update->bindParam(3, $salt);
					 $update->execute(); 
					 
					 log_on();
					 
					 header("Location" . ROOT_PATH . "/index.html");
				  }
			catch (Exception $e){
					$error = "Could not update database";
					die($e);
				}	
	}	
	else {
			/* What happens if an error is returned */
			header('Location: register-users.php?error="' . $error . '"');
		}
}