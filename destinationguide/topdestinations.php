<?php 
session_start();

if(isset($_GET['dest1'])) {$dest1 = $_GET['dest1'];}
if(isset($_GET['dest2'])) {$dest2 = $_GET['dest2'];}
if(isset($_GET['dest3'])) {$dest3 = $_GET['dest3'];}
if(isset($_GET['dest4'])) {$dest4 = $_GET['dest4'];}
if(isset($_GET['dest5'])) {$dest5 = $_GET['dest5'];}
if(isset($_GET['dest6'])) {$dest6 = $_GET['dest6'];}
if(isset($_GET['dest7'])) {$dest7 = $_GET['dest7'];}
if(isset($_GET['dest8'])) {$dest8 = $_GET['dest8'];}
if(isset($_GET['dest9'])) {$dest9 = $_GET['dest9'];}
if(isset($_GET['dest10'])) {$dest10 = $_GET['dest10'];}

if (isset($_GET['dest1']) AND isset($_GET['dest2']) AND isset($_GET['dest3']) AND isset($_GET['dest4']) AND isset($_GET['dest5']) AND isset($_GET['dest6']) AND isset($_GET['dest7']) AND isset($_GET['dest8']) AND isset($_GET['dest9']) AND isset($_GET['dest10'])  ) {
	
	require("../scripts/config.php");
    require("../scripts/database.php");
	require("../scripts/functions.php");

try {				
			$dest_db = $db->prepare("SELECT * FROM dest WHERE DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ?");
			$dest_db->bindParam(1, $dest1);
			$dest_db->bindParam(2, $dest2);
			$dest_db->bindParam(3, $dest3);
			$dest_db->bindParam(4, $dest4);
			$dest_db->bindParam(5, $dest5);
			$dest_db->bindParam(6, $dest6);
			$dest_db->bindParam(7, $dest7);
			$dest_db->bindParam(8, $dest8);
			$dest_db->bindParam(9, $dest9);
			$dest_db->bindParam(10, $dest10);
			$dest_db->execute();
			$destinations = $dest_db->fetchAll();

					
			
		}
		 catch (Exception $e)
		 {
		 	die("An error occured while retrieving data from the database: " . $e);
		 }		

$title = "Destination Guide: Suggested destinations?";
//$headinclude = "<link rel='stylesheet' href='/css/topdestinations.css'>";
		
				
				include( ROOT_PATH . "include/head.php");
				include( ROOT_PATH . "include/header.php") ;
				include( ROOT_PATH . "core/topdestinations-content.php") ;
				include( ROOT_PATH . "include/footer.php") ;
				
}
else
	
	{
		header("Location: destinationguide.php");
		
	}
