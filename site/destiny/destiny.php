<?php 
require('../scripts/config.php');

require(ROOT_PATH . "scripts/functions.php");
require(ROOT_PATH . "scripts/database.php");

$specific_meta = "Need help choosing holiday destination? Then you need to try our tool 'Destination Inspiration'. By clicking the statements that best describes your dream holiday, we will give you destination suggestions to consider.";


//generate random destID

try {
	$dest_db = $db->query("SELECT * FROM dest ORDER BY RAND() LIMIT 1");
	$dest_db1 = $dest_db->fetchall(PDO::FETCH_ASSOC);
	
	$random_dest = $dest_db1[0];
	
$r = 0;
	
$r = $random_dest['DESTID'];

header("Location:".BASE_URL."destinations/destinations.php?dest=".$r."&random=1");

}
catch (Exception $e) {
	echo "Could not connect to database";
	echo $e;
	
}

