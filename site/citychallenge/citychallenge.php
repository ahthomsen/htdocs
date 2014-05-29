<?php 
session_start();

include_once("../scripts/config.php");
include_once(ROOT_PATH . "scripts/database.php");
require(ROOT_PATH . "scripts/functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if(isset($_POST['5'])) {$d1 = 1 ;} else {$d1 = 0;}
	if(isset($_POST['14'])) {$d2 = 1 ;} else {$d2 = 0;}
	if(isset($_POST['20'])) {$d3 = 1 ;} else {$d3 = 0;}
	if(isset($_POST['21'])) {$d4 = 1 ;} else {$d4 = 0;}
	if(isset($_POST['39'])) {$d5 = 1 ;} else {$d5 = 0;}
	if(isset($_POST['42'])) {$d6 = 1 ;} else {$d6 = 0;}
	if(isset($_POST['52'])) {$d7 = 1 ;} else {$d7 = 0;}
	if(isset($_POST['54'])) {$d8 = 1 ;} else {$d8 = 0;}
	if(isset($_POST['59'])) {$d9 = 1 ;} else {$d9 = 0;}
	if(isset($_POST['64'])) {$d10 = 1 ;} else {$d10 = 0;}
	if(isset($_POST['71'])) {$d11 = 1 ;} else {$d11 = 0;}
	if(isset($_POST['77'])) {$d12 = 1 ;} else {$d12 = 0;}
	if(isset($_POST['80'])) {$d13 = 1 ;} else {$d13 = 0;}
	if(isset($_POST['83'])) {$d14 = 1 ;} else {$d14 = 0;}
	if(isset($_POST['100'])) {$d15 = 1 ;} else {$d15 = 0;}
	if(isset($_POST['104'])) {$d16 = 1 ;} else {$d16 = 0;}
	if(isset($_POST['106'])) {$d17 = 1 ;} else {$d17 = 0;}
	if(isset($_POST['109'])) {$d18 = 1 ;} else {$d18 = 0;}
	if(isset($_POST['112'])) {$d19 = 1 ;} else {$d19 = 0;}
	if(isset($_POST['122'])) {$d20 = 1 ;} else {$d20 = 0;}
	if(isset($_POST['124'])) {$d21 = 1 ;} else {$d21 = 0;}
	if(isset($_POST['78'])) {$d22 = 1 ;} else {$d22 = 0;}
	if(isset($_POST['79'])) {$d23 = 1 ;} else {$d23 = 0;}
	if(isset($_POST['120'])) {$d24 = 1 ;} else {$d24 = 0;}
	if(isset($_POST['121'])) {$d25 = 1 ;} else {$d25 = 0;}
	
	$total = $d1 + $d2 + $d3 + $d4 + $d5 + $d6 + $d7 + $d8 + $d9 + $d10 + $d11 + $d12 + $d13 + $d14 + $d15 + $d16 + $d17 + $d18 + $d19 + $d20 + $d21 + $d22 + $d23 + $d24 + $d25;
	
	header('Location: cityresult.php?result='.$total);
}








$title = "The Kokomo Major City challenge";
$headinclude = "<link rel='stylesheet' href='/css/citychallenge.css'>";

include( ROOT_PATH . "include/head.php");
include( ROOT_PATH . "include/header.php") ;
include( ROOT_PATH . "core/citychallenge-content.php") ;
include( ROOT_PATH . "include/footer.php") ;?>	
