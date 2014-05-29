<?php
session_start();

$headline = "";
$name = "";
$dest = "";
$error_msg = "";


if (isset($_SESSION['userid'])) {$userid = $_SESSION['userid'];} else {$userid = 999;}//else {$userid = 0;}

// Need to include user_id if logged in

		include_once("../scripts/config.php");
		include_once("../scripts/database.php");
		include_once("../scripts/functions.php");

if(isset($_GET['dest'])) {$dest = $_GET['dest']; $dest_title = "for " . $dest ;} else {$dest = "";$dest_title="";}
$title = "Upload your own postcard" . $dest_title;


if($_SERVER['REQUEST_METHOD']=="POST") 
{
	
/* control code */
	if(empty($_POST['nameoncard'])) {
		$error_msg = "Please specify who is on the card!";
	}
	elseif(empty($_POST['destination'])) {
		$error_msg = "Please insert a destination name!";
	}
	elseif(empty($_FILES)) {
	$error_msg = "Please select a picture for your postcard!";
	}
	elseif(empty($_POST['headline'])) 
	{
		$error_msg = $error_msg . "<br> Please give the postcard a headline";
	}
	else 
	{
		try 
		{
			$dest_match = $db->prepare("SELECT DESTID, Destinationfullname FROM dest WHERE Destinationfullname = ?");
			$dest_match->bindParam(1, $_POST['destination']);
			$dest_match -> execute();
			$dest_match1 = $dest_match->fetch();
			
			if ($dest_match1 != false) {
				
				$dest_use = $dest_match1['DESTID'];
	
			}
			
			else {
						try 
						{
							$dest_match = $db->prepare("SELECT DESTID, Destinationfullname FROM dest WHERE Destinationfullname LIKE ?");
							$dest_match-> bindValue(1, "%" . $_POST['destination'] . "%");
							$dest_match -> execute();
							$dest_match1 = $dest_match->fetchall();
								
							$dest_ids = array();
							foreach($dest_match1 as $dest_small) 
							{
								$dest_ids[] = $dest_small['DestID'];
							}
	
							
							if (count($dest_ids) >= 2) {
								$error_msg = "More than one destination in our database matches the specified destination name";
							}
							if (count($dest_ids) == 1) {
								
								$dest_use = $dest_ids[0];
							}
							else {
								$error_msg = "The given destination is not in our database yet - please provide feedback on what to add!";
							}
						}
						catch (Exception $e) {
							echo "Could not connect to database!";
							exit;
						}
				}
		}
		catch (Exception $e) {
			echo $e;
			echo "Could not connect to database!";
			exit;
	
		}
		
	}

	// if the destination error msg remain non false the following execution runs:	
	if ($error_msg == "") {
				
			// upload of picture:		
		
			$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
			$temp = explode(".", $_FILES["picture"]["name"]);
			$extension = end($temp);

			
			if ((($_FILES["picture"]["type"] == "image/gif")
			|| ($_FILES["picture"]["type"] == "image/jpeg")
			|| ($_FILES["picture"]["type"] == "image/jpg")
			|| ($_FILES["picture"]["type"] == "image/pjpeg")
			|| ($_FILES["picture"]["type"] == "image/x-png")
			|| ($_FILES["picture"]["type"] == "image/png"))
			&& ($_FILES["picture"]["size"] < 20000000000)
			&& in_array($extension, $allowedExts)) {
			  if ($_FILES["picture"]["error"] > 0) {
			    $error_msg = "Return Code: " . $_FILES["picture"]["error"] . "<br>";
			  } else {

					$salt = create_salt();
					$timeofinput = time();
					$timeofinput = $timeofinput . $userid . $_POST['year'] . $_POST['headline'];
					$picturename_raw = get_hashed_password($timeofinput, $salt);
					$picturename = $picturename_raw . "." . $extension;
					
			   		move_uploaded_file($_FILES["picture"]["tmp_name"], ROOT_PATH . "stories/pics/upload/" . $picturename);
					
					$d = compress_image(ROOT_PATH . "stories/pics/upload/" . $picturename, ROOT_PATH . "stories/pics/upload/" . "small" . $picturename_raw . ".jpg", 80);
			        $picturename = "small" . $picturename_raw . ".jpg";
			     	//the script for saving the story in the database only runs if the file is uploaded
			      
			      
						    try {
							$upload = $db-> prepare("INSERT INTO postcards (USERID, DESTID, YEAR, SEASON, HEADLINE, STORY_TAGS, PICNUMBER, TYPE_STORY, TYPE_TRIP, OWN_RANKING, NAMEONCARD, PICTYPE, CARDID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
							$upload ->bindParam(1, $userid);
							$upload ->bindParam(2, $dest_use);
							$upload ->bindParam(3, $_POST['year']);
							$upload ->bindParam(4, $_POST['season']);
							$upload ->bindParam(5, $_POST['headline']);
							$upload ->bindParam(6, $_POST['story_tag']);
							$upload ->bindParam(7, $picturename);
							$upload ->bindParam(8, $_POST['typeofstory']);
							$upload ->bindParam(9, $_POST['typeoftrip']);
							$upload ->bindParam(10, $_POST['own_ranking']);
							$upload ->bindParam(11, $_POST['nameoncard']);
							$upload ->bindParam(12, $extension);
							$upload ->bindParam(13, $cardid);
							$upload -> execute();
							
							$error_msg = "Postcard successfully uploaded to database <br> <a style='color: white; text-decoration: none;' href='../stories/stories.php'>Go to postcards</a> <br> <a style='color: white; text-decoration: none;' href='upload.php'> Update more postcards </a>";
							
							}
							catch (Exception $e) {
								echo "Could not load data into database";
								die($e);
							}
			     
			  }
			} else {
			  $error_msg = "Invalid file: please ensure you have selected a valid image file with a size below 2Mb";
			}
	}
	
//if user submitted the form, an error occurred, defines the submitted data as not be 'deleted'
$name = $_POST['nameoncard'];
$dest = $_POST['destination'];
$headline = $_POST['headline'];
}

$headinclude = "<link rel='stylesheet' href='/css/user.css'>";
		
		
		include( ROOT_PATH . "include/head.php");
		include( ROOT_PATH . "include/header.php") ;
		include( ROOT_PATH . "core/upload-stories-content.php") ;
		include( ROOT_PATH . "include/footer.php") ;?>	
