<?php 
session_start();
include_once("../scripts/config.php");
include_once("../scripts/database.php");
$title = "Reset your password";
$headinclude = '<link rel="stylesheet" href="../css/user.css">';
$mail_error = "";
$password_error = "";
$name_error ="";
$email = "";
$msg_error = "";
$name = "";

if($_SERVER["REQUEST_METHOD"] == "POST" AND empty($_POST['question']))
{
	$email      = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $msg_error =  "The specified email addres is invalid. Please specify a valid email addres!";
    }
    else
    {
        $result = $db->prepare("SELECT USERID FROM user WHERE Lower(MAIL) = Lower(?)");
		$result->bindParam(1, $email);
		$result->execute();
        $Results = $result->fetch();
 
        if($Results!=FALSE)
        {
            $encrypt = md5(119*14+$Results['USERID']);
            $msg_error = "A link to reset your password has been sent to your email.";
            $to=$email;
            $subject="Reset Password for Kokomoholiday";
            $from = 'mail@kokomoholiday.com';
            $body='Hello. This is an email to help create a new password for kokomoholiday.com. <br> Click here to reset your password http://kokomoholiday.com/users/reset.php?encrypt='.$encrypt.'&action=reset   <br/> <br/>--<br>Kokomo<br>Share more, see more. If you did not request this email, please disregard the content';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);           
        }
        else
        {
            $msg_error = "The specified email could not be found in our user database. Please try again.";
        }
    }
	
	
	
}

		include( ROOT_PATH . "/include/head.php");
		include( ROOT_PATH . "/include/header.php");
 
		include( ROOT_PATH . "/core/pw_forgot-content.php") ;
		
		include( ROOT_PATH . "/include/footer.php") ;
	