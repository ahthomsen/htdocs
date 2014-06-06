<?php 
session_start();
require ("../scripts/config.php");
require ("../scripts/database.php");
require ("../scripts/functions.php");
if (isset($_GET['cardid'])) {
	$cardnumber = $_GET['cardid'];
	// Get the selected postcard from the database
	try {
	$selectcard_db = $db->prepare("SELECT *
	FROM postcards JOIN dest ON postcards.DESTID = dest.DESTID WHERE CARDID = ?");
	$selectcard_db -> bindParam(1,$cardnumber);
	$selectcard_db -> execute();
	$selectcard = $selectcard_db->fetch();
	}
	catch (Exception $e) {
	echo "Could not connect to database!";
	die($e);
	}
}
else {
	try {
	$selectcard_db = $db->prepare("SELECT *
	FROM postcards JOIN dest ON postcards.DESTID = dest.DESTID ORDER BY rand() LIMIT 1");
	$selectcard_db -> execute();
	$selectcard = $selectcard_db->fetch();
	$cardnumber = $selectcard['CARDID'];
	}
	catch (Exception $e) {
	echo "Could not connect to database!";
	die($e);
	}
		
}

// Get the relevant user information for the selected costcard, if a the card has been made from a logged in user!
if ($selectcard['USERID'] !== '999') {
	$includeuser = 1;
	try {
	// set to 1 to indicate that the postcard was uploaded by a logged in user
	$selectuser_db = $db->prepare ("SELECT * FROM user WHERE USERID = ?");
	$selectuser_db -> bindParam(1,$selectcard['USERID']);
	$selectuser_db -> execute();
	$selectuser = $selectuser_db->fetch();
	}
	catch (Exception $e) {
	echo "Could not connect to database!";
	die($e);
	}	
}
else {	
// Detertimes if the postcard was updated by a logged in user;
$includeuser = 0;
}
// include the markup and css
$cardtitle = $selectcard['NAMEONCARD'] .", " . $selectcard["Destinationfullname"] . ", " . $selectcard['SEASON'] . " " . $selectcard["YEAR"];
$title = "Postcard: " . $cardtitle;
$headinclude = "<link rel='stylesheet' href='/css/topdestinations.css'><link rel='stylesheet' href='/css/stories.css'><link rel='stylesheet' href='/css/search.css'><link rel='stylesheet' href='/css/destinations.css'>";
				
				include( ROOT_PATH . "include/head.php");
				include( ROOT_PATH . "include/header.php") ;
				include( ROOT_PATH . "core/postcard-select-content.php") ;
				include( ROOT_PATH . "include/footer.php") ;

