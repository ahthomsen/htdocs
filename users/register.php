<?php 
session_start();
include_once("../scripts/config.php");
$title = "Register yourself as an active user";
$headinclude = '<link rel="stylesheet" href="../css/user.css">';
$mail_error = "";
$password_error = "";
$name_error ="";
$msg_error = "";
$name = "";
if(isset($_POST['name']))$name = $_POST['name'];
$email = "";
if(isset($_POST['email'])) $email = $_POST['email'];

include_once(ROOT_PATH . "/scripts/database.php");
require(ROOT_PATH . "scripts/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$email = trim(strtolower($_POST["email"]));
	$name = trim($_POST['name']);
	$password1 = trim($_POST["password1"]);
	$password2 = trim($_POST["password2"]);
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
		$password_error = " error-box"; 
		$msg_error ="The password must be minimum 6 characters";
		$is_valid=FALSE;
	}
	if($password1 != $password2)
	{
		$password_error = " error-box"; 
		$msg_error ="The passwords do not match";
		$is_valid=FALSE;		
	}
	if(empty($name))
	{
		$name_error = " error-box"; 
		$msg_error="Please specify a name";
		$is_valid=FALSE;
	}
	if(filter_var($email, FILTER_VALIDATE_EMAIL)==FALSE)
	{
		$mail_error = " error-box"; 
		$msg_error ="Please enter a vaild email address";
		$is_valid=FALSE;		
	}
	if($existing_email != FALSE)
	{
		$mail_error = " error-box"; 
		$msg_error ="The specified email is already in use";
		$is_valid=FALSE;
	}
	if(!empty($_POST["question"]))
	{
		die("A field that should have been left empty has been filled out. Perhaps an error with your browser has occured.");
	}
	foreach($_POST as $element)
	{
		if(stripos($element, 'ContentType:') != FALSE)
		{
			die("An error occured with your submission");
		}
	}
	if($is_valid!=FALSE)	
	{
			$salt = create_salt();
			$password = get_hashed_password($password1, $salt);
			 try {   		 				 	
					 $update = $db->prepare('INSERT INTO user (MAIL, `PASSWORD`, SALT, FIRSTNAME, LASTNAME, MIDDLENAME, COUNTRY, DAYOFBIRTH, GENDER, FAV_DEST, PROFILEPIC) VALUES(?, ?, ?, ?, "N/A", "N/A", "N/A", "N/A", "N/A", "N/A", "N/A");');
					 $update->bindParam(1, $email);
					 $update->bindParam(2, $password);			
					 $update->bindParam(3, $salt);
					 $update->bindParam(4, $name);
					 $update->execute(); 
					 
					 $results = $db->prepare('SELECT USERID FROM user WHERE MAIL=?');
					 $results->bindParam(1, $email);
					 $results->execute();
					 
					 $result = $results->fetch();	
					 $_SESSION['userid'] = $result["USERID"];			
					
					$to=$email;
		            $subject="Welcome to Kokomo";
		            $from = 'mail@kokomoholiday.com';
		            $body='<h1>Hi '.$name.' and welcome to Kokomo!</h1><p>We are so excited that you decided to become a part of our site and hope you will find it useful. <br><br>We hope our features will broaden your horizon and inspire you to travel the world.<br><br> <b>Your account details:</b><br>Username: '.$email.'<br>Name: '.$name.'<br><a href="http://www.kokomoholiday.com/userprofile/userprofile.php?user='.$result["USERID"].'">Click here</a> to visit your profile<br><br>If you have any kind of question, do not hesitate to contact us. Simply reply this mail.<br><br>Best regards,<br><br>Kokomo <b>' ;
		            $headers = "From: " . strip_tags($from) . "\r\n";
		            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		            $headers .= "MIME-Version: 1.0\r\n";
		            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					mail($to,$subject,$body,$headers);  
					
					header('Location: /userprofile/userprofile.php?user='.$result['USERID']);
					
					
					
					
					exit;										 
				  }
			catch (Exception $e){
					$error = "Could not update database";
					die($e);
				}	
	}	
}

	
		include( ROOT_PATH . "/include/head.php");
		include( ROOT_PATH . "/include/header.php");
 
		include(ROOT_PATH . "/core/register-users-content.php") ;
		
		include( ROOT_PATH . "/include/footer.php") ;?>
