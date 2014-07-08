<?php 
require_once("../scripts/config.php");
require_once(ROOT_PATH . "scripts/database.php");
require_once(ROOT_PATH . "scripts/functions.php");

//function instagram_dest_pictures_to_db($destid) 
set_time_limit(0); 
$z = 1;
for ($z = 1; $z <= 129; $z++) {
	$dest = $z;
	try {
	$dest_info_db = $db->prepare("SELECT * FROM dest WHERE DESTID = ?");
	$dest_info_db->bindParam(1,$dest);
	$dest_info_db->execute();
	$dest_info = $dest_info_db->fetch();
	$what = $dest_info["Destinationfullname"];
	$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."/media/recent?access_token=1379550292.1fb234f.c5007ae91b9846bf8133d16e4592b33f");
	$readable = json_decode($json, true);
	$x = 0;
	foreach ($readable as $read) {	
	$x = $x +1;
	if ($x = 3) {$picture = $read;}
	}
	foreach ($picture as $pic) {
		$user = $pic["caption"]["from"]["username"];
		$url = $pic["images"]["standard_resolution"]["url"];
		$dest_instagram_db = $db->prepare("INSERT INTO instagram_pictures (DESTID, user, link) VALUES (?, ?, ?)");
		$dest_instagram_db->bindparam(1, $dest);
		$dest_instagram_db->bindparam(2, $user);
		$dest_instagram_db->bindparam(3, $url);
		$dest_instagram_db->execute();
	}
}
catch (Exception $e) {
	echo "Could not connect to the database";
	die($e);
}
sleep(300);
}

		
			