<?php 
session_start();
$title = "Edit your user profile";
$headinclude = "<link rel='stylesheet' href='/css/user.css'>";
$error_msg = "";
	
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
require_once("../scripts/database.php");

if(isset($_SESSION["userid"])==FALSE)
{  //CHECKS IF SESSION HAS EXPIRED AND RETURNS TO LOGIN IF IT HAS
		header("Location: " . BASE_URL . "users/login.php");
		exit;
}
$userid = $_SESSION['userid'];



if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	
	
	//SETS INPUT VARIALBES TO INPUT AND IF EMPTY TO N/A
	$firstname = trim($_POST["firstname"]); if(empty($firstname))$firstname="N/A";
	$lastname = trim($_POST["lastname"]); if(empty($lastname))$lastname="N/A";
	$country = $_POST["country"]; if(empty($country))$country="N/A";
	$dob = $_POST["dob"]; if(empty($dob))$dob="N/A";
	$favorite = trim($_POST["favorite"]); if(empty($favorite))$favorite="N/A";
	$gender = $_POST["gender"]; if(empty($gender))$gender="N/A";
	
	// check if a file has been selected for upload
	
	if (!empty($_FILES)) {
		
		$profilepic = $_FILES['picture']['name'];		
	}

	
	//CHECKS IF THE ENTERED INFORMATION CONTAINS HARMFUL CONTENT
	foreach($_POST as $element)
	{
		if(stripos($element, 'ContentType:') != FALSE)
		{
			die("An error occured with your submission");
		}
	}
	
	//Upload the selected picture!
	if (!empty($_FILES)) {
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["picture"]["name"]);
			$extension = end($temp);

			
			if ((($_FILES["picture"]["type"] == "image/gif")
			|| ($_FILES["picture"]["type"] == "image/jpeg")
			|| ($_FILES["picture"]["type"] == "image/jpg")
			|| ($_FILES["picture"]["type"] == "image/pjpeg")
			|| ($_FILES["picture"]["type"] == "image/x-png")
			|| ($_FILES["picture"]["type"] == "image/png"))
			&& ($_FILES["picture"]["size"] < 2000000)
			&& in_array($extension, $allowedExts)) {
			  if ($_FILES["picture"]["error"] > 0) {
			    $error_msg = "Return Code: " . $_FILES["picture"]["error"] . "<br>";
				
				 
				 exit;
			  } else {
			  	
				$salt = create_salt();
				$timeofinput = time();
				$timeofinput = $timeofinput . $userid;
				$picturename_raw = get_hashed_password($timeofinput, $salt);
				$picturename = $picturename_raw . "." . $extension;

				
				if(file_exists(ROOT_PATH . "userprofile/img/" . $picturename)) {
	   				chmod( realpath(ROOT_PATH . "userprofile/img/" . $picturename,0755)); //Change the file permissions if allowed
	   			    unlink( realpath(ROOT_PATH . "userprofile/img/" . $picturename)); //remove the file
						}

			      move_uploaded_file($_FILES["picture"]["tmp_name"], ROOT_PATH . "userprofile/img/" . $picturename);
				  /* Reducing the size of the uploded picture and add a new small detail picture */
				$picturedist = ROOT_PATH . "userprofile/img/" . "small" . $picturename_raw . ".jpg";
				$d = compress_image(ROOT_PATH . "userprofile/img/" . $picturename, $picturedist, 80);
				$picturename = "small" . $picturename_raw . ".jpg";
	
				}
	
			}
		}
	
	
	// end of picture upload;
	
	try{
		$update = $db->prepare("UPDATE user SET FIRSTNAME=?, LASTNAME=?, COUNTRY=?
		, DAYOFBIRTH=?, FAV_DEST=?, GENDER=?, PROFILEPIC=? WHERE USERID=?");
		$update->bindParam(1, $firstname);
		$update->bindParam(2, $lastname);
		$update->bindParam(3, $country);
		$update->bindParam(4, $dob);
		$update->bindParam(5, $favorite);
		$update->bindParam(6, $gender);
		$update->bindValue(7, $picturename);
		$update->bindParam(8, $userid);
		$update->execute();
		header("Location: " . BASE_URL . "userprofile/userprofile.php?user=" . $userid);
	}
	catch (Exception $e){
		die("An error occured while trying to update the database: " . $e);
	}
}
else //REQUEST_METHOD IS MOST LIKELY GET AND EXISTING VALUES OF USER INFO ARE RETRIEVED
//SO THEY CAN BE INSERTED INTO FORM
{
	$user_db = $db->prepare("SELECT FIRSTNAME, LASTNAME, COUNTRY, GENDER, DAYOFBIRTH, FAV_DEST FROM user WHERE USERID=?;");
	$user_db->bindParam(1, $userid);
	$user_db->execute();
	$user = $user_db->fetch();
}

include( ROOT_PATH . "include/head.php");
		include( ROOT_PATH . "include/header.php") ;
		include( ROOT_PATH . "core/userprofile-edit-content.php") ;
		include( ROOT_PATH . "include/footer.php") ;?>

?>


		