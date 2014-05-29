<?php 
session_start();
$title = "Kokomo Holiday - Selected page does not exist!";
$headinclude = "";
	
		include_once("scripts/config.php");
		require( ROOT_PATH . "scripts/functions.php");
		include( ROOT_PATH . "include/head.php");
		include( ROOT_PATH . "include/header.php");
		include( ROOT_PATH . "core/error-content.php");
		include( ROOT_PATH . "include/footer.php") ;
