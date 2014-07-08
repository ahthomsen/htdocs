<?php 
session_start();
$title = "Kokomo Holiday - Travel status";
$headinclude = '<link rel="stylesheet" href="../css/userstats.css">';
	
		require_once("../scripts/config.php");
		require( ROOT_PATH . "scripts/functions.php");
		include( ROOT_PATH . "include/head.php");
		include( ROOT_PATH . "include/header.php");
		include( ROOT_PATH . "core/userstats-content.php");
		include( ROOT_PATH . "include/footer.php") ;

