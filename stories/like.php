<?php 
session_start();

require("../scripts/config.php");
require(ROOT_PATH . "scripts/database.php");

//checks if page was properly loaded

if(isset($_GET['card']))
{
	//executes code to update database
	try {
		$stories = $db->prepare("SELECT DESTID, LIKES FROM postcards WHERE CARDID=?");
		$stories->bindParam(1, $cardid);
		$stories->execute();
		$story = $stories->fetch();
		$likes = $story['LIKES'] + 1;
		$update = $db->prepare("UPDATE postcards SET LIKES=? WHERE CARDID=?");
		$update->bindParam(1, $likes);
		$update->bindParam(2, $cardid);
		$update->execute();	
	}
	catch(Exception $e)
	{
		die("An error occurred while trying to update database: " . $e);
	}
	
	//checks where user was directed from and directs them back 
	//NB. users from search are directed back to destination of postcard
	if(isset($_GET['random']) && $_GET['random']=="1")
	{
		header("Location: " . BASE_URL . "destinations/destinations.php?dest=" . $story['DESTID'] . "&random=1");
		exit;
	}
	if((isset($_GET['random']) && $_GET['random']=="0") OR (isset($_GET['search'])))
	{
		header("Location: " . BASE_URL . "destinations/destinations.php?dest=" . $story['DESTID']);
		exit;
	}	
	if(isset($_GET['user']))
	{
		header("Location: " . BASE_URL . "userprofile/userprofile.php?user=" . $_GET['user']);
		exit;
	}
	if(isset($_GET['stories']))
	{
		header("Location: " . BASE_URL . "stories/stories.php");
		exit;
	}
}
else
{
	header("Location: " . BASE_URL . "stories/stories.php");
}

?>