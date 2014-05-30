<?php 
session_start();
include_once("../scripts/config.php");
$title = "Login with your user or register a new profile";
$headinclude = '<link rel="stylesheet" href="../css/user.css?version=1">';
$email = "";
$msg_error = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	require(ROOT_PATH . "/scripts/functions.php");
	require(ROOT_PATH . '/scripts/database.php');	
		
	$email = trim($_POST["login"]);
	$password = trim($_POST["password"]);
	$login_ok = FALSE;
	
	try 
	{
		$results = $db->prepare('SELECT `PASSWORD`, SALT, USERID, MAIL FROM user WHERE MAIL = ? LIMIT 1');
		$results->bindParam(1, $email);
		$results->execute();
	}
	catch (Exception $e)
	{
		die($e);
	}
	
	
	$result = $results->fetch();
	if($result !=FALSE)
	{	
		$password_registered = $result["PASSWORD"];
		$salt = $result["SALT"];
		
		$password_entered = get_hashed_password($_POST["password"], $salt);

		if($password_entered == $password_registered)
		{
			$login_ok = TRUE;
		}
		else {
			$msg_error = "The username and password does not match";
		}
	}
	else
	{
		$msg_error = "The username is not known";
		
	}
	
	if($login_ok == TRUE)
	{
		log_on($result['USERID']);

		header('Location: /userprofile/userprofile.php?user='.$result['USERID']);
		exit;
	}
}
	
include( ROOT_PATH . "/include/head.php");
// Note this is being included prior to the header info!
include( ROOT_PATH . "/scripts/FBlogin.php");

include( ROOT_PATH . "/include/header.php");
include(ROOT_PATH . "/core/login-content.php") ;
include( ROOT_PATH . "/include/footer.php") ;?>	 