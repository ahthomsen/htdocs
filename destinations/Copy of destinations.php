<?php 
session_start();

require("../scripts/config.php");
$headinclude = '<link rel="stylesheet" href="../css/destinations.css"><link rel="stylesheet" href="../css/stories.css">';


if (isset($_GET['dest']) == TRUE) 
{
	$direct_dest = $_GET['dest'];
	include_once(ROOT_PATH . "scripts/functions.php");
	require(ROOT_PATH . "scripts/database.php");
	$destinations_db = $db->prepare("SELECT * FROM dest WHERE DESTID=?");
	$destinations_db->bindParam(1, $direct_dest);
	$destinations_db->execute();
	$results_dest = $destinations_db->fetch();
	
	if (is_null($results_dest['DESTID'])==FALSE) 
	{
		$destination = $results_dest["Destinationfullname"];
		try 
		{				
			$destid = $_GET['dest'];
			$stories_db = $db->prepare("SELECT *
			FROM postcards LEFT JOIN dest ON dest.DESTID = postcards.DESTID WHERE postcards.DESTID = ?");
			$stories_db->bindParam(1, $destid);
			$stories_db->execute();
			$stories_input = $stories_db->fetchAll();
			$postcards = count($stories_input);
			
			//Code block that retrieves any available comments on this destination
			$comments = $db->prepare('SELECT HEADER, PARAGRAPH, FIRSTNAME, DATE, user.USERID, COUNT(COMMENT_ID) AS count  FROM dest_comment 
			LEFT OUTER JOIN `user` ON dest_comment.USERID = user.USERID 
			WHERE DEST_ID = ? ORDER BY `DATE` ASC;');
			$comments->bindParam(1, $direct_dest);
			$comments->execute();
			$comment = $comments->fetchAll();
			$comment_count = $comment[0]['count'];
			
			$saves_db = $db->prepare('SELECT COUNT(*) AS count FROM save_for_later WHERE DESTID=?');
			$saves_db->bindParam(1, $destid);
			$saves_db->execute();
			$saves = $saves_db->fetch();
			$savedforlater = $saves['count'];
			
			$visits_db = $db->prepare("SELECT COUNT(*) AS count from been_there WHERE DESTID=?");
			$visits_db->bindParam(1, $destid);
			$visits_db->execute();
			$visits = $visits_db->fetch();
			
			if (isset($_SESSION['userid'])) {
				$ibeenthere_db = $db->prepare("SELECT * FROM been_there WHERE USERID = ? AND DESTID = ?");
				$ibeenthere_db->bindParam(1, $_SESSION['userid']);
				$ibeenthere_db->bindParam(2, $destid);
				$ibeenthere_db->execute();
				$ibeenthere = $ibeenthere_db->fetch();
				
				}		
			
			
		}
		 catch (Exception $e)
		 {
		 	die("An error occured while retrieving data from the database: " . $e);
		 }		
		
	}
	else 
	{		
		header("Location: http:/index.php"); 
		exit;
	}
}
else 
{		
	header("Location: http:/index.php"); 
	exit;
}

$title = "What about " . $destination . "?";
$specific_meta = $results_dest['DestText'];

	include_once("../scripts/config.php");
	
	include( ROOT_PATH . "include/head.php");
	include( ROOT_PATH . "include/header.php") ;
	include( ROOT_PATH . "core/destinationspage-content.php") ;
	include( ROOT_PATH . "include/footer.php") ;?>	
