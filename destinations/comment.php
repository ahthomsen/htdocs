<?php
session_start();
require("../scripts/config.php");
require(ROOT_PATH . "scripts/functions.php");
$title = "Comment on a destination";
$headinclude = '<link rel="stylesheet" href="' . BASE_URL . 'css/user.css">';


$destination = "";
$date = get_date();
$message = "";
$destid="";
$errormessage = "";


if(isset($_SESSION['userid'])==FALSE)
{
	$message = 'You are not signed in. Your comment will be anonymous. <a href="' . BASE_URL . 'users/login.php">Login here</a>';
	$userid = 0;
}	
else {
	$userid = $_SESSION['userid'];
}
	

require(ROOT_PATH . "scripts/database.php");
/* Checks the posts and updates the database if 
 * valid entries.
 * If routed from destination page -> display destination
 * in field.
 * */
$proceed = TRUE;
 
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$destid = $_POST["destination"];
	$proceed = TRUE;
	$header = trim($_POST["header"]);
	$paragraph = trim($_POST["paragraph"]);
	if(empty($header)==TRUE)
	{
		$proceed = FALSE;
		$error = "header";
		$errormessage="Please enter a heading for your comment";
	}
	if(empty($paragraph)==TRUE)
	{
		$proceed = FALSE;
		$error = "paragraph";
		$errormessage = "Please enter your comment before posting";
	}
	foreach($_POST as $element)
	{
		if(stripos($element, 'ContentType:') != FALSE)
		{
			die("There incurred a problem with your submission");
		}
	}

	if($proceed == TRUE)
	{
		//checks to see if there is a destination with the form submitted destid
		try {
			$results = $db->prepare("SELECT 1 FROM dest WHERE DESTID=?");
			$results->bindParam(1, $destid);
			$results->execute();
			$result = $results->fetch();	
			}
			catch (Exception $e) 
			{
				die("There was an error retrieving data from the database: " . $e);
			}
		//continues if that's not the case
		if($result!=FALSE)
		{
			try  //initiate the update
			{										
			$update = $db->prepare("INSERT INTO dest_comment (HEADER, PARAGRAPH, USERID, DEST_ID, DATE) VALUES (?,?,?,?,?)");
			$update-> bindParam(1, $header);
			$update-> bindParam(2, $paragraph);
			$update-> bindParam(3, $userid);
			$update-> bindParam(4, $destid);
			$update-> bindParam(5, $date);
			$update->execute();
			
			//returns the user to the destinations page 
			header("Location: ../destinations/destinations.php?dest=" . $destid);
			exit;
			}
			catch (Exception $e)
			{
				die("There was an error updating the database: " . $e);
			}
		}
	}
}

//notifies user that they are not signed in and assignes userid to 0 (anonymous)

if(isset($_GET["dest"])==FALSE AND $proceed != FALSE)
{

	header("Location: ../index.php");
	exit;
}
elseif($proceed == FALSE)
{

}
else
{
	$destid = $_GET["dest"]; 
	$dest_name = $db->prepare("SELECT Destinationfullname FROM dest WHERE DESTID = ?");
	$dest_name-> bindParam(1, $destid);
	$dest_name->execute();
	$dest_name_output = $dest_name->fetch();
	
}


include( ROOT_PATH . "include/head.php");
include( ROOT_PATH . "include/header.php");
include( ROOT_PATH . "core/destinations-comment-content.php");
include( ROOT_PATH . "/include/footer.php") ;?>	

