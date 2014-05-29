<?php 
session_start();
require("../scripts/config.php");
require(ROOT_PATH . "scripts/database.php");

$random = ""; 
//checks to see if _GET is set and returns to index if not
if(!isset($_GET['dest']))
{
	header("Location: " . BASE_URL . "index.php");
	exit;
}

if(isset($_GET['random'])==TRUE AND $_GET['random']==1)
{
	$random = 	"&random=1";
}

//checks to see if user is logged on
if(isset($_SESSION['userid']))
{
	$userid = $_SESSION['userid'];
	$destid = $_GET['dest'];
	
		//checks to see if user and dest already exists in table
		try 
		{
			$results = $db->prepare("SELECT 1 from been_there WHERE USERID=? AND DESTID=?");
			$results->bindParam(1, $userid);
			$results->bindParam(2, $destid);
			$results->execute();
			$result = $results->fetch();
		}
		catch (Exception $e)
		{
			die("An error occurred while retrieving data from the database");
		}	
		//redirects back to destination page if destination is already marked as visited
		if($result != FALSE)
		{
			header("Location: " . BASE_URL . "destinations/destinations.php?dest=" . $destid . $random);
			exit;
		}
	
		//updates the table save_for_later
		try {
			$update = $db->prepare('INSERT INTO been_there (DESTID, USERID) VALUES (?, ?);');
			$update->bindParam(1, $destid);
			$update->bindParam(2, $userid);
			$update->execute();
			header("Location: " . BASE_URL . "destinations/destinations.php?dest=" . $destid . $random);
			exit;
		}
		catch (Exception $e) {
			die("An error occured while attempting to update the database");
		}
} 
//returns user to login if not logged in
else {
	header("Location: " . BASE_URL . "users/login.php");	
	exit;
}




?>