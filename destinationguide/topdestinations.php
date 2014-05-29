<?php 
session_start();

if(isset($_GET['dest1'])) {$dest1 = $_GET['dest1'];}
if(isset($_GET['dest2'])) {$dest2 = $_GET['dest2'];}
if(isset($_GET['dest3'])) {$dest3 = $_GET['dest3'];}
if(isset($_GET['dest4'])) {$dest4 = $_GET['dest4'];}
if(isset($_GET['dest5'])) {$dest5 = $_GET['dest5'];}

if (isset($_GET['dest1']) AND isset($_GET['dest2']) AND isset($_GET['dest3']) AND isset($_GET['dest4']) AND isset($_GET['dest5']) ) {
	
	require("../scripts/config.php");
    require("../scripts/database.php");

try {				
			$dest_db = $db->prepare("SELECT * FROM dest WHERE DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ? OR DESTID = ?");
			$dest_db->bindParam(1, $dest1);
			$dest_db->bindParam(2, $dest2);
			$dest_db->bindParam(3, $dest3);
			$dest_db->bindParam(4, $dest4);
			$dest_db->bindParam(5, $dest5);
			$dest_db->execute();
			$destinations = $dest_db->fetchAll();

					
			
		}
		 catch (Exception $e)
		 {
		 	die("An error occured while retrieving data from the database: " . $e);
		 }		

$title = "Destination Guide: Suggested destinations?";
$headinclude = "<link rel='stylesheet' href='/css/topdestinations.css'>";
		
				
				include( ROOT_PATH . "include/head.php");
				include( ROOT_PATH . "include/header.php") ;
				include( ROOT_PATH . "core/topdestinations-content.php") ;
				include( ROOT_PATH . "include/footer.php") ;
				
}
else
	
	{
		header("Location: destinationguide.php");
		
	}
