<?php
session_start();

require("../scripts/config.php");
require(ROOT_PATH . "/scripts/database.php");


$title = "Where have you been?";
$headinclude = '<link rel="stylesheet" href="../css/travels.css">';

if(!isset($_SESSION['userid'])) //if user is not logged in, returns to login screen
{
	header("Location: " . BASE_URL . "users/login.php");
	exit;
}

include( ROOT_PATH . "/include/head.php");
include( ROOT_PATH . "/include/header.php");
 
include(ROOT_PATH . "/core/destinations-travels-content.php") ;
include( ROOT_PATH . "/include/footer.php") ;

?>	