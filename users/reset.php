<?php 
session_start();

include_once("../scripts/config.php");
include_once("../scripts/database.php");
include_once("../scripts/functions.php");
$title = "Reset your password";
$headinclude = '<link rel="stylesheet" href="../css/user.css">';

$name_error = "";
$mail_error = "";

//checks if the link is valid and returns user to reset page if not
if(isset($_GET['action']) && $_GET['action']=="reset")
{          
        try
        {
        $encrypt = $_GET['encrypt'];
		$results = $db->prepare("SELECT USERID FROM user WHERE md5(119*14+USERID)=?");
		$results ->bindParam(1, $encrypt);
		$results ->execute();
		$Result = $results->fetch();
		}
		catch (Exception $e)
		{
			die("An error occurred while accessing the user database: " . $e);
		}
        if($Result == FALSE)
        {
            header("Location: " . BASE_URL . "users/login.php");
			exit;
        }
}

if(isset($_POST['action']))
{
	foreach($_POST as $element)
	{
		if(stripos($element, 'ContentType:') != FALSE)
		{
			die("An error occured with your submission");
		}
	} 
    $encrypt      = $_POST['action'];
    $password     = $_POST['password'];
	$users_db = $db->prepare("SELECT USERID FROM user where md5(119*14+USERID)=?");
	$users_db->bindParam(1, $encrypt);
 	$users_db->execute();
	$Results = $users_db->fetch();
 
    if($Results!=FALSE && $_POST['password1'] == $_POST['password2'])
    {
        try 
        {
	        //creates a new password for the user
	        $salt = create_salt();
			$newpassword = $_POST['password1'];
			$hashedpassword = get_hashed_password($newpassword, $salt);
			$userid = $Results['USERID'];
			
			$update = $db->prepare("UPDATE user SET `PASSWORD`=?, SALT=? WHERE USERID=?");
			$update->bindParam(1, $hashedpassword);
			$update->bindParam(2, $salt);
			$update->bindParam(3, $userid);
			$update->execute();	
        }
		catch (Exception $e)
		{
			die("An error occurred while attempting to update your password");
		}
		log_on($userid);
		header("Location: " . BASE_URL . "userprofile/userprofile.php");
		exit;
    }
	elseif($_POST['password1'] != $_POST['password2'])
	{
		$message = "Your new passwords do not match. Please try again";
	}
    else
    {
		$message = "The link you have used appears to be invalid. <a href='" . BASE_URL . "users/pw_forgot.php'>Please try again</a>";
    }
}

	
include( ROOT_PATH . "/include/head.php");
include( ROOT_PATH . "/include/header.php");
 
include(ROOT_PATH . "/core/reset-content.php");
include( ROOT_PATH . "/include/footer.php") ;?>	 
