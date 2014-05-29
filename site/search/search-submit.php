<?php 
session_start();

$search_term = "";
$search_term = trim($_POST["searchtext"]);

//Test for empty search results!

if ($search_term == "" OR $search_term == "Search.." OR $search_term == "Search for destinations and stories") {
	$_SESSION['missing_input'] = 1;
	header("Location: search.php");
}


include("../scripts/functions.php");

session_start();

$destinations = destination_db_combined();

$stories_db = stories_db_combined();

$results_dest = array();

$results_stories = array();


foreach($destinations as $somethingdifferent) {
	if (stripos($somethingdifferent["Destinationfullname"],$search_term) !== false) {
		$results_dest[]=$somethingdifferent;
	}

};

$_SESSION["results_dest_session"] = $results_dest;

foreach($stories_db as $story) {
	if (stripos($story["Destination"],$search_term) !== false OR stripos($somethingdifferent["Titleofstory"],$search_term) !== false) {
		$results_stories[]=$story;
	}

};

$_SESSION["results_story_session"] = $results_stories;

if (count($results_stories) == 0 && count($results_dest) == 0) {

$_SESSION['results_none'] = 1;
header("Location: /search/search.php");
	
}

else {
header("Location: /search/results.php");
}
?>