<?php 
$what = 'malorca';
$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."/media/recent?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
			$readable = json_decode($json, true);
			echo "<pre>";
			$x = 0;
			foreach ($readable as $read) {	
				$x = $x +1;
				if ($x = 3) {$test = $read;}
			}
			

var_dump($readable);

var_dump($test[0]);


function instagram_dest_pictures_to_db($destid) {
$dest = $destid;
try {
	$dest_info_db = $db->prepare("SELECT * FROM dest WHERE DESTID = ?");
	$dest_info_db->bindParam(1,$dest);
	$dest_info_db->execute();
	$dest_info = $dest_into_db->fetch();
	
	$what = $dest_into["Destinationfullname"];
	$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."/media/recent?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
	$readable = json_decode($json, true);
	$x = 0;
	foreach ($readable as $read) {	
	$x = $x +1;
	if ($x = 3) {$picture = $read;}
	}
	foreach ($picture as $pic) {
		$username = $pic["caption"]["from"]["username"];
		$url = $pic["images"]["standard_resolution"]["url"];
		$dest_instagram_db = $db->prepare("INSERT INTO instagram_pictures  (DESTID, user, link) VALUES (?, ?, ?)");
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
	
	
	
	$what = $tag;
	$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."/media/recent?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
	$readable = json_decode($json, true);
	$x = 0;
	foreach ($readable as $read) {	
	$x = $x +1;
	if ($x = 3) {$picture = $read;}
	}
	ob_start();
	$number_of_pics = $number;
	$y = 0;
	while ($y <= $number_of_pics) {?>
		<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><?php echo $picture[$y]["caption"]["from"]["username"];?></p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/instagramsmall.jpeg';?>">
								</div>
							</div>
							<img src="<?php echo $picture[$y]["images"]["standard_resolution"]["url"];?>">
					</div>
				</div>
		
		<?php $y = $y + 1;
	}
	
	return ob_get_clean();	
}


		
			