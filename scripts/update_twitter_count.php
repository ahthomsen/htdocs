<?php 
require_once("config.php");
require_once("database.php");
require_once("TwitterAPIExchange.php");

$settings = array(
    'oauth_access_token' => "357755029-nLhgvQbnwixtAkzz6IKeobTVRU331SXAtaq7jzfC",
    'oauth_access_token_secret' => "FMwnkEXoqha5Te7cTalCAkv4xfYpwdlRho111UbBgJEFm",
    'consumer_key' => "TlE3HtcBByF1MhzmX59qM6IoU",
    'consumer_secret' => "ZIXbCoVYtFTS0V2dJsv8Z11Oaf4QxawWwHJZA0excBtntDRG9p"
);

$n= 0;
$count = 0;
$startpoint = 0;
$count_old = $count;
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$requestMethod = 'GET';
$hashtag = 'mallorca';
$getfield = '?q=%23'.$hashtag.'&result_type=recent&include_entities=true&lang=en&count=10';

// Perform the request
$twitter = new TwitterAPIExchange($settings);
$json_output = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

// Let's calculate how many results we got
$json = json_decode($json_output, true);
echo "<pre>";
var_dump($json);
echo "</pre>";
/*
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

/*function get_twitter_media_count($what) {
			$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
			$readable = json_decode($json, true);
			$output = round($readable["data"]["media_count"],-3);
			$output = number_format($outout) . "+";
			return $output;
}
 * 


foreach ($dests as $dest) {

	if (empty($dest['twittercount'] )) {
	$name = $dest['Destinationfullname'];
	//$instagram = get_instagram_media_count($name);
		if ($instagram > 0) {
			try {
				$dest_db_update = $db->prepare("UPDATE dest twitter = ? WHERE DESTID = ?");
				//$dest_db_update->bindParam(1, $instagram);
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
 * 
 * */

