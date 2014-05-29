<?php 


session_start();

$_SESSION['results_none'] = 0; 
$_SESSION['missing_input'] = 0; 

header("Location: search.php");
