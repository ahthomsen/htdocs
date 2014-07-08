<?php
session_start();
require_once("../scripts/config.php");
require_once(ROOT_PATH . "scripts/database.php");
require_once(ROOT_PATH . "scripts/functions.php");
if (isset($_SESSION['userid'])) {
$user = $_SESSION['userid'];	
}
else {
$user = session_id();
}
try {
	
	
	// Calculate the avg score of all recommended destination  and reports them in avgscore varaible
	
	$dest_been_db = $db->prepare("SELECT * FROM dest INNER JOIN been_there ON dest.DESTID=been_there.DESTID WHERE been_there.USERID = ? AND been_there.rec = 1");
	$dest_been_db->bindparam(1, $user);
	$dest_been_db->execute();
	$dest_been = $dest_been_db->fetchall();
	$totals = count($dest_been);
	$destrec = array();
	foreach ($dest_been as  $been) {
		$destrec[] = array_slice($been,11,10);
	}

	$avgscore = array();

	foreach ($destrec as $dest) {
		$x = 0;
		while($dest_score = current($dest)) {
			$avgscore[$x] = $avgscore[$x] + $dest_score;
			next($dest);
			$x = $x + 1;
		}
	}
	for($x=0;$x<=9;$x++) {
		$avgscore[$x] = round($avgscore[$x] / $totals, 2);
	}
	
	// Get all the existing destinations visited or selected fro check out by the user
	
	$dest_existing_db =$db->prepare("SELECT DESTID FROM been_there WHERE USERID = ?");
	$dest_existing_db->bindParam(1,$user);
	$dest_existing_db->execute();
	$dest_existing_been = $dest_existing_db->fetchAll();
	
	$dest_existing_db = $db->prepare("SELECT DESTID FROM save_for_later WHERE USERID = ?");
	$dest_existing_db->bindParam(1,$user);
	$dest_existing_db->execute();
	$dest_existing_saved = $dest_existing_db->fetchAll();
	
	$dest_exsting_combined = array_merge($dest_existing_been , $dest_existing_saved);
	
	//turn the multiarray combined array into a single array
	$dest_existing = array('0');
	
	// creates a single dimensional array that contain all the destIDs of existing destinations
	foreach ($dest_exsting_combined as $key => $value) {

		$dest_existing[$key] = 	$value['DESTID'];
	}
	
	// get all destinations in the SQL database
	$dest_all_db =$db->prepare("SELECT DESTID, Beaches, Cityfeel, Partying, Budget, Shopping, Museums, Active, Language, Food, Nature FROM dest");
	$dest_all_db->execute();
	$dest_all = $dest_all_db->fetchall();

	$dest_explore = array();
	echo "<pre>";
	//var_dump($dest_all);
	foreach ($dest_all as $dest_al) {
			$check = $dest_al['DESTID'];
			$x = 0;
			if (in_array($check, $dest_existing, true)) {
			}
			else {
				while ($dest_value = current($dest_al)) {
				if(key($dest_al) == 'DESTID') 
					{ next($dest_al);}
				else {
					$sse = pow($dest_value - $avgscore[$x], 2) + $sse;
					$x = $x + 1;
					next($dest_al);	
					}
				}
				$dest_al['sse'] = $sse;
				$sse = 0;
				$dest_explore[] = $dest_al;
				
			}
	}
	
	array_sort_by_column($dest_explore, 'sse');
	$total_dest_left = count($dest_explore);
	var_dump($dest_explore);

}
catch (Exception $e) {
	echo "Could not connect to database";
	die($e);
}
