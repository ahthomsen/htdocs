<?php
session_start();


require_once("../scripts/config.php");
require(ROOT_PATH . "scripts/database.php");

$title = "Search for destinations, stories or users";
$headinclude = "<link rel='stylesheet' href='/css/search.css'>";
$no_results = "display:none;";
$no_input = "display:none;";
$search_error = "display:none;";
$specific_meta = "Search for destinations for your next holiday or vacation. Read more on the suggestions before making a decision. When you are readyUse our booking partner booking.com to find the hotels."; 


	if(isset($_GET['searchtext']))
	{
		$proceed = true;
		$search_term = $_GET['searchtext'];
		//empty search query? return error
		if ($search_term == "" OR $search_term == "Search.." OR $search_term == "Search for destinations and stories") 
		{
			$no_input = "";
			$proceed = false;
		}	
		if($proceed == true)
		{
			try 
			{	//retrieve data 
				//first returns destinations
				$destinations = $db->prepare("SELECT * FROM dest WHERE Destinationfullname LIKE ? OR DestText LIKE ?");
	
		 		$destinations->bindValue(1, "%" . $search_term . "%");
				$destinations->bindValue(2, "%" . $search_term . "%");
				$destinations->execute();
				$destination = $destinations->fetchAll();
				
				
				//secondly returns postcards
				//$stories = $db->prepare("SELECT Destinationfullname, HEADLINE, NAMEONCARD, CARDID, YEAR, postcards.DESTID AS DESTID, STORY_TAGS, OWN_RANKING, PICNUMBER, PICTYPE FROM postcards JOIN dest ON dest.DESTID = postcards.DESTID WHERE HEADLINE LIKE ? OR STORY_TAGS LIKE ?");
		 		//$stories->bindValue(1, "%" . $search_term . "%");
				//$stories->bindValue(2, "%" . $search_term . "%");
				//$stories->execute();
				//$story = $stories->fetchAll();
				
				
			}
			catch (Exception $e)
			{
				die("An error occurred while retrieving data from the database: " . $e);
			}
		}
	
	}


include( ROOT_PATH . "include/head.php");
include( ROOT_PATH . "include/header.php") ;

//if search resulted in results, include the results file 
if((!empty($destination) OR !empty($story)))
{
	include(ROOT_PATH . "core/search-results-content.php");	
}
elseif (isset($_GET['searchtext']) AND empty($destination) AND empty($story)) 
{ 
	$no_results = "";
	include( ROOT_PATH . "core/search-content.php");
}
else
{
	include(ROOT_PATH . "core/search-content.php");
}
		
include( ROOT_PATH . "include/footer.php") ;
/*
if ($_SESSION['results_none'] == 1) {$no_results = "";} else {$no_results = "error-box-hide";}
if ($_SESSION['missing_input'] == 1) {$no_input = "";} else {$no_input = "error-box-hide";}
if ($_SESSION['missing_input'] == 1 OR $_SESSION['results_none'] == 1) {$search_error = "";} else {$search_error = "error-box-hide";}
if ($_SESSION['missing_input'] == 1 OR $_SESSION['results_none'] == 1) {$search_error_in = "";} else {$search_error_in  = "style='display:none;'";}
*/		

?>	
		
		
		

