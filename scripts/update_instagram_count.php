<?php 
require_once("config.php");
require_once("database.php");
$updated = 0;
$missing = 0;
try {
$dest_db = $db-> query("SELECT * FROM dest");
$dests = $dest_db->fetchall();

}
catch (Exception $e) {
	echo "Could not connect to db";
	die($e);
}

function get_instagram_media_count($what) {
			$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
			$readable = json_decode($json, true);
			$output = round($readable["data"]["media_count"],-3);
			$output = number_format($outout) . "+";
			return $output;
}

foreach ($dests as $dest) {

	if (empty($dest['instagram_count'] )) {
	$name = $dest['Destinationfullname'];
	$instagram = get_instagram_media_count($name);
		if ($instagram > 0) {
			try {
				$dest_db_update = $db->prepare("UPDATE dest instagram_count = ? WHERE DESTID = ?");
				$dest_db_update->bindParam(1, $instagram);
				$dest_db_update->bindParam(2, $dest['DESTID']);
				$dest_db_update->execute();
				$updated = $updated + 1;
			}
			catch (Exception $e) {
				echo "cound not connect";
				die($e);
			}
		}
		else {
			$missing = $missing + 1;
		}
	}
	else {
	}
}

echo $updated;
echo $missing; 
