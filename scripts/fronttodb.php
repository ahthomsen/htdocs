<?php 
session_start();
require_once("../scripts/config.php");
require_once("../scripts/database.php");
if (isset($_SESSION['userid'])) {
$user = $_SESSION['userid'];	
}
else {
$user = session_id();
}

// script for already been

if (isset($_POST["destid"]) and isset($_POST["rec"])) {
	$destid = $_POST["destid"];
	$answer = $_POST["rec"];
	if ($answer == "yes") {$rec = 1;};
	if ($answer == "no") {$rec = 0;};
	
	// code that add information to user visited database along wtih recommendation
	try {
		
		$been_there_db = $db->prepare("SELECT * from been_there WHERE USERID = ? AND DESTID = ?");
		$been_there_db->bindParam(1,$user);
		$been_there_db->bindParam(2,$destid);
		$been_there_db->execute();
		$been_there_check = $been_there_db->fetch();
		
		if (empty($been_there_check)) {
			$been_there_db = $db-> prepare("INSERT INTO been_there (USERID, DESTID, rec) VALUES (?, ?, ?)");
			$been_there_db->bindParam(1, $user);
			$been_there_db->bindParam(2, $destid);
			$been_there_db->bindParam(3, $rec);	
			$been_there_db->execute();	
		}
		elseif (!empty($been_there_check)) {
			$been_there_db = $db-> prepare("UPDATE been_there SET rec = ? WHERE USERID = ? AND DESTID = ? ");
			$been_there_db->bindParam(1, $rec);
			$been_there_db->bindParam(2, $user);
			$been_there_db->bindParam(3, $destid);
			$been_there_db->execute();	
		}
		
	}
	catch (Exception $e) {
		echo "could not connect to database";
		die($e);
	}


}


// script for save for later

if (isset($_POST["destid"]) AND isset($_POST["save"])) {
	
	$destid = $_POST["destid"];
	
	// code that add information to user visited database along wtih recommendation
	try {
		
		$saved_db = $db->prepare("SELECT * from save_for_later WHERE USERID = ? AND DESTID = ?");
		$saved_db->bindParam(1,$user);
		$saved_db->bindParam(2,$destid);
		$saved_db->execute();
		$saved_check = $saved_db->fetch();
		
		if (empty($saved_check)) {
			$saved_db = $db-> prepare("INSERT INTO save_for_later (USERID, DESTID) VALUES (?, ?)");
			$saved_db->bindParam(1, $user);
			$saved_db->bindParam(2, $destid);
			$saved_db->execute();	
		}
	}
	catch (Exception $e) {
		echo "Could not connect to db";
		die ($e);
	}
	
}

if (isset($_POST['existing'])) {
	$existing = $_POST['existing'];
	// load all destinations
	try {
	$dest_db = $db->prepare("SELECT * FROM
	dest
	ORDER by rand()");
	$dest_db->execute();
	$dests_full = $dest_db->fetchAll();
	}
	catch (Exception $e) 
	{
		echo "Could not coneect to database";
		die($e);
	}
	
	$dests = array();
	$count = 0;
	$dest_exsting_count = count($existing);
	foreach ($dests_full as $dest_input) {
		$check = $dest_input["DESTID"];
		if  (in_array($check, $existing, true)) {
		}
		else {
			$dests[$count] = $dest_input;
			$total_views = $dest_existing_count + $count;
			$count = $count + 1;
			$dest_existing[$total_views] = $dest_input['DESTID'];
		}
		
		if ($count == 15) {
			break;
		}
	}	
	
}
	//echo json_encode(array('contentNum'=>$answer));
    //die();

?>