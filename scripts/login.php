<?php 
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	require(ROOT_PATH . "/scripts/functions.php");
	require(ROOT_PATH . '/scripts/database.php');	
		
	$email = $_POST["login"];
	$password = $_POST["password"];
	$login_ok = FALSE;
	
	try 
	{
		$results = $db->prepare('SELECT `PASSWORD`, SALT, USERID, MAIL FROM user WHERE MAIL = ?');
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
			$error = "mismatch";	
			header('Location: ' . ROOT_PATH . 'users/login.php?' . $error);
			exit; 
		}
	}
	else
	{
		$error = "unknown";
		header('Location: ' . ROOT_PATH . 'users/login.php?' . $error);
		exit;
	}
	
	if($login_ok == TRUE)
	{
		echo "Your password is correct";
		/* TO DO: initiate log-in */
	}
}
else {

}
?>
