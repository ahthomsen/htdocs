<?php 
session_start();
$title = "The Kokomo Major City challenge";
$headinclude = "<link rel='stylesheet' href='/css/citychallenge.css'>";
include_once("../scripts/config.php");
include_once(ROOT_PATH . "scripts/database.php");
require(ROOT_PATH . "scripts/functions.php");


if (isset($_GET['result'])) {
	$d = $_GET['result'];
	if($d > -1 AND $d < 6) {$result_rank = "Travel Rookie"; $result_text = "..hurry up and experience much more!";}
	if($d > 5 AND $d < 11) {$result_rank = "Travel Curious";$result_text = "You might know your way around a few cities but what about Kuala Lumpur?";}
	if($d > 10 AND $d < 16) {$result_rank = "Frequent Flyer";$result_text = "If you keep this up you’ll have to add pages to your passport. Keep up the good work!";}
	if($d > 15 AND $d < 21) {$result_rank = "Citizen of the World";$result_text = "You should write a guide book. We would want to read it!";}
	if($d > 20 AND $d < 26) {$result_rank = "Ultimate Explorer"; $result_text = "Even Indiana Jones bows in your presence!";}
}

else {
	
	header("Location: citychallenge.php");
}


include( ROOT_PATH . "include/head.php");
include( ROOT_PATH . "include/header.php") ;
include( ROOT_PATH . "core/cityresult-content.php") ;
include( ROOT_PATH . "include/footer.php") ;?>	
