<?php	    
function get_instagram_media_count($what) {
			$what = "test";
			$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
			$readable = json_decode($json, true);
			return number_format($readable["data"]["media_count"]);
}
	 
	 
echo get_instagram_media_count("mallorca");