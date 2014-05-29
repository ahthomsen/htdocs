<?php
session_start();
$title = "Search for destinations, stories or users";
$headinclude = "<link rel='stylesheet' href='../css/search.css'>";

if (isset($_SESSION['results_story_session']) OR isset($_SESSION["results_dest_session"])) {
	
		
		$_SESSION['results_none'] = 0;
		$_SESSION['missing_input'] = 0;
		
		include_once("../scripts/config.php");
		
		include( ROOT_PATH . "include/head.php");
		include( ROOT_PATH . "include/header.php") ;
		include( ROOT_PATH . "core/search-results-content.php") ;
		include( ROOT_PATH . "include/footer.php") ;

}

else {
	
	$_SESSION['missing_input'] = 1;
	
	header("Location: search.php");
	
}
