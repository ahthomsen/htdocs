
<?php 
require_once("../scripts/config.php");
require_once(ROOT_PATH . "scripts/database.php");
require_once(ROOT_PATH . "scripts/functions.php");
set_time_limit(0); 
$z = 127;
for ($z = 127; $z <= 129; $z++) {
	$dest = $z;
	try {
		
	$dest_info_db = $db->prepare("SELECT * FROM dest WHERE DESTID = ?");
	$dest_info_db->bindParam(1,$dest);
	$dest_info_db->execute();
	$dest_info = $dest_info_db->fetch();
	$what = $dest_info["Destinationfullname"];
	

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
$hashtag = $what;
$getfield = '?q=%23'.$hashtag.'&result_type=recent&include_entities=true&lang=en&count=10&esult_type=popular';

// Perform the request
$twitter = new TwitterAPIExchange($settings);
$json_output = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

// Let's calculate how many results we got
$json = json_decode($json_output, true);



foreach ($json["statuses"] as $tweet) {
	$user = $tweet['user']['name'];
	$screen_name = $tweet['user']['screen_name'];
	$time_of_post = $tweet['created_at'];
	$profile_link = $tweet['user']['profile_image_url'];
	$text_of_post = $tweet['text'];
	$destid = $z;
	
	$twitter_upload_db = $db->prepare("INSERT INTO twitter_tweets (DESTID, user, screen_name, time_of_post, profile_link, text_of_post) VALUES (?, ?, ?, ?, ?, ?)");
	$twitter_upload_db -> bindparam(1, $destid);
	$twitter_upload_db -> bindparam(2, $user);
	$twitter_upload_db -> bindparam(3, $screen_name);
	$twitter_upload_db -> bindparam(4, $time_of_post);
	$twitter_upload_db -> bindparam(5, $profile_link);
	$twitter_upload_db -> bindparam(6, $text_of_post);
	$twitter_upload_db -> execute();
	
	}


	}
	
	catch (Exception $e) {
		echo "can't connect to database";
		die($e);
	}
//sleep(300);
} //end of destination loop


