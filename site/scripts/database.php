<?php 
try 
{
	$db = new PDO('mysql:host='. DB_LOCALHOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$db->exec("SET NAMES 'utf8'");
} 
catch (Exception $e) 
{
	
	echo "Could not connect to database!";
	
	die($e);
}
?>