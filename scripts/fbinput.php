<?php
session_start();
require("../scripts/config.php");
include_once(ROOT_PATH . "/scripts/database.php");
require(ROOT_PATH . "scripts/functions.php");


$error = 0;

// Loads information from Facebook page

if (isset($_GET['userid'])) { $id = $_GET['userid'] ;} else { $error = 1;}
if (isset($_GET['usermail'])) { $mail = $_GET['usermail'] ;} else { $error = 1;}
if (isset($_GET['userfirst'])) { $first = $_GET['userfirst'] ;} else { $error = 1;}
if (isset($_GET['userlast'])) { $last = $_GET['userlast'] ;} else { $error = 1;}
if (isset($_GET['usergender'])) { $gender = $_GET['usergender'] ;} else { $error = 1;}

// 
if ($error == 0 ) {
	// Check if the users email is already in use
	try {
		$user_db = $db-> prepare("SELECT * FROM user WHERE MAIL = ?");
		$user_db -> bindParam(1, $mail);
		$user_db -> execute();
		$user = $user_db->fetch();
		
		
		//check if the user already has an account on Kokomo with their FB email
		if (!empty($user)) {
			//check if the user already has a FB profile connected to his user and update everything accordingly!
			if(empty($user['FACEBOOKID'])) {
			try {
			$user_update_db = $db->prepare("UPDATE user SET FACEBOOKID = ?, FIRSTNAME = ?, LASTNAME = ?, GENDER = ? WHERE MAIL = ?");
			$user_update_db->bindParam(1,$id);
			$user_update_db->bindParam(2,$first);
			$user_update_db->bindParam(3,$last);
			$user_update_db->bindParam(4,$gender);
			$user_update_db->bindParam(5,$mail);
			$user_update_db->execute();
			}
			catch (Exception $e) {
				echo "could not update Facebook ID";
				die($e);
			}
			}
			// Change the session status to logged in using the user login id
			log_on($user['USERID']);
			header('Location:'.BASE_URL.'userprofile/userprofile.php?user='.$user['USERID']);
			exit;
			}
		
			// If the user does not already exists, the user is made in the system;
			else {
				
					 try {
					 $country = get_country_name();   		 				 	
					 $create_user_db= $db->prepare("INSERT INTO user (MAIL, FIRSTNAME, LASTNAME, GENDER, FACEBOOKID, COUNTRY, DAYOFBIRTH, FAV_DEST) VALUES(?, ?, ?, ?, ?, ?, 'N/A', 'N/A')");
					 $create_user_db->bindParam(1, $mail);
					 $create_user_db->bindParam(2, $first);
					 $create_user_db->bindParam(3, $last);
					 $create_user_db->bindParam(4, $gender);
					 $create_user_db->bindParam(5, $id);
					 $create_user_db->bindParam(6, $country);
					 $create_user_db->execute();
					 
					 
					 $user_new_db = $db->prepare('SELECT * FROM user WHERE FACEBOOKID=? AND MAIL = ?');
					 $user_new_db->bindParam(1, $id);
					 $user_new_db->bindParam(2, $mail);
					 $user_new_db->execute();
					 $user_new = $user_new_db->fetch();	
					 $_SESSION['userid'] = $user_new["USERID"];	
					 
					 // An an email was sent to him!
					 		
					$name = $user_new['FIRSTNAME'] . " " .  $user_new['LASTNAME'];
					$to=$user_new['MAIL'];
		            $subject="Welcome to Kokomo";
		            $from = 'mail@kokomoholiday.com';
		            $body='<h1>Hi '.$name.' and welcome to Kokomo!</h1><p>We are so excited that you decided to become a part of our site and hope you will find it useful. <br><br>We hope our features will broaden your horizon and inspire you to travel the world.<br><br> <b>Your account details:</b><br>Username: '.$user_new['MAIL'].'<br>Name: '.$name.'<br><a href="http://www.kokomoholiday.com/userprofile/userprofile.php?user='.$user_new["USERID"].'">Click here</a> to visit your profile<br><br>If you have any kind of question, do not hesitate to contact us. Simply reply this mail.<br><br>Best regards,<br><br>Kokomo <b>' ;
		            $headers = "From: " . strip_tags($from) . "\r\n";
		            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		            $headers .= "MIME-Version: 1.0\r\n";
		            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					mail($to,$subject,$body,$headers);  
					
					header('Location:'.BASE_URL.'userprofile/userprofile.php?user='.$user_new['USERID']);
					
					exit;										 
				  }
			catch (Exception $e){
					echo "Could not update database";
					die($e);
				}	
				
			}

	}
	catch (Exception $e) {
		echo "Could not connect to database";
		die($e);
	}
	
}
else {
		echo "An error..";
	
}
?>