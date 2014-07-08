<?php 

function destination_db_ipage() {
try {
	$db = new PDO("mysql:host=letshaveagoodtimecom.ipagemysql.com;dbname=destinationguide;port=3306","goodtime","Goodtimes2014");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

try {
	$dest = $db->query("SELECT * FROM GUIDE");
} catch (Exception $e) {
	echo "Data could not be loaded from database";
	exit; 
}

$destinations = $dest->fetchAll(PDO::FETCH_ASSOC); 

return $destinations;

}

function destination_db_localhost() {
try {
	$db = new PDO("mysql:host=localhost;dbname=destinations;port=8889","root","root");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

try {
	$dest = $db->query("SELECT * FROM `TABLE 1`");
} catch (Exception $e) {
	echo "Data could not be loaded from database";
	exit; 
}

$destinations = $dest->fetchAll(PDO::FETCH_ASSOC); 

return $destinations;

}


function stories_db_ipage() {

try {
	$db = new PDO("mysql:host=letshaveagoodtimecom.ipagemysql.com;dbname=destinationguide;port=3306","goodtime","Goodtimes2014");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

try {
	$stories = $db->query("SELECT * FROM `STORIES`");
} catch (Exception $e) {
	echo "Data could not be loaded from database 2";
	exit; 
}

$stories = $stories->fetchAll(PDO::FETCH_ASSOC); 

return $stories;
	
}


function stories_db_localhost() {

try {
	$db = new PDO("mysql:host=localhost;dbname=destinations;port=8889","root","root");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

try {
	$stories = $db->query("SELECT * FROM `TABLE 2`");
} catch (Exception $e) {
	echo "Data could not be loaded from database 2";
	exit; 
}

$stories = $stories->fetchAll(PDO::FETCH_ASSOC); 

return $stories;
	
}

// Test of new setup;

function destination_db_combined() {
try {
	$db = new PDO("mysql:host=letshaveagoodtimecom.ipagemysql.com;dbname=destinationguide;port=3306","goodtime","Goodtimes2014");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
			
								
						try {
							$db = new PDO("mysql:host=localhost;dbname=destinations;port=8889","root","root");
							$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
							$db->exec("SET NAMES 'utf8'");
						} catch (Exception $e) {
							echo "Could not connect to the database.";
							exit;
						}
						
						try {
							$dest = $db->query("SELECT * FROM `TABLE 1`");
						} catch (Exception $e) {
							echo "Data could not be loaded from database";
							exit; 
						}
						
						$destinations = $dest->fetchAll(PDO::FETCH_ASSOC); 
						
						return $destinations;
						exit;					
}

try {
	$dest = $db->query("SELECT * FROM GUIDE");
} catch (Exception $e) {
	echo "Data could not be loaded from database";
	exit; 
}

$destinations = $dest->fetchAll(PDO::FETCH_ASSOC); 

return $destinations;

}

// combined stories function

function stories_db_combined() {

try {
	$db = new PDO("mysql:host=letshaveagoodtimecom.ipagemysql.com;dbname=destinationguide;port=3306","goodtime","Goodtimes2014");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
	
	
					try {
					$db = new PDO("mysql:host=localhost;dbname=destinations;port=8889","root","root");
					$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$db->exec("SET NAMES 'utf8'");
				} catch (Exception $e) {
					echo "Could not connect to the database.";
					exit;
				}
					try {
					$stories = $db->query("SELECT * FROM `TABLE 2`");
				} catch (Exception $e) {
					echo "Data could not be loaded from database 2";
					exit; 
				}
				
				$stories = $stories->fetchAll(PDO::FETCH_ASSOC); 

				return $stories;
				exit;
}

try {
		$stories = $db->query("SELECT * FROM `STORIES`");
	} catch (Exception $e) {
		echo "Data could not be loaded from database 2";
		exit; 
	}

$stories = $stories->fetchAll(PDO::FETCH_ASSOC); 

return $stories;

}



//function that provide one random story of all the stories;



function random_story_from_db() {
	
	$story_db = stories_db_combined();
	
	$numberofstories = count($story_db);
	
	$random_number = rand(0,$numberofstories);
	
	$random_story = array();
	
	$random_story = $story_db[$random_number];
	
	return $random_story;


}

function random_dest_from_db() {
	
	$dest_db = destination_db_combined();
	
	$numberofdest = count($dest_db);
	
	$random_number = rand(0,$numberofdest);
	
	$random_dest = array();
	
	$random_dest = $dest_db[$random_number];
	
	return $random_dest;

}

//Function that creates random number used for hash in password generation
function create_salt()
{
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
	return $salt;
}

//Function that gets hashed password 
//based on string and salt (random nummber assigned during registration)

function get_hashed_password($password, $salt)
{
	$password = hash("sha256", $password, $password . $salt);
	for ($round = 0; $round < 65432; $round++)
	{
		$password = hash("sha256", $password . $salt);
	}
	return $password;
}

function log_on($userid)
{
	$_SESSION['userid'] = $userid;
	return;
}

function log_off()
{
	unset($_SESSION['userid']);
	return;
}

function get_date()
{
	$date = date("d") . "/" . date("m") . "-" . date("Y");
	return $date;
}

function get_travel_status($postcards, $places, $comments)
{
	//RUTHLESS version:
	$total = $postcards + $places + $comments;

	if($total >= 30)$title="Indiana Jones";
	elseif($total >= 25)$title="Explorer";
	elseif($total >= 20)$title="Globerotter";
	elseif($total >= 15)$title="Backpacker";
	elseif($total >= 10)$title="Tourist";
	elseif($total >= 5)$title="Weekend Traveller";
	elseif($total <= 5)$title="Travel Rookie";
	return $title;
}

function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) 
{
    $sort_col = array();
    foreach ($arr as $key=> $row) 
    {
        $sort_col[$key] = $row[$col];
	}
    array_multisort($sort_col, $dir, $arr);
}


function compress_image($source_url, $destination_url, $quality) {
	
	$info = getimagesize($source_url); 
	if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url); 
	elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url); 
	elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url); 
	imagejpeg($image, $destination_url, $quality); 
	
return $destination_url; 

}

function destination_stats($result) { ob_start();?>
	<div class="dest-guide-right-scores">
	
				  <div class="dest-guide-scores output-beaches">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/beaches.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Beaches']*10) . '%'?>;"> </div>
				 	</div>
				  </div>
				  
				  <div class="dest-guide-scores output-cityfeel">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/cityfeel.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Cityfeel']*10) . '%'?>;"> </div>
				 	</div>
				 	
				  </div>
				  
				  <div class="dest-guide-scores output-partying">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/partying.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Partying']*10) . '%'?>;"> </div>
				 	</div>
				 	
				  </div>
				  
				  <div class="dest-guide-scores output-budget">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/shopping2.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Shopping']*10) . '%'?>;"> </div>
				 	</div>
				 	
				 	<div class="dest-guide-scores output-museum">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/museum.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Museums']*10) . '%'?>;"> </div>
				 	</div>
				 	
				  </div>
				  
				   <div class="dest-guide-scores output-active">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/active.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Active']*10) . '%'?>;"> </div>
				 	</div>
				 	
				  </div>
				  
				  <div class="dest-guide-scores output-food">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/food.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Food']*10) . '%'?>;"> </div>
				 	</div>
				 	
				  </div>
				  
				  <div class="dest-guide-scores output-nature">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/nature.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Nature']*10) . '%'?>;"> </div>
				 	</div>
				 </div>
				 	
				 	<div class="dest-guide-scores output-entertainment">
				  	<div class="dest-guide-scores-img"><img src="<?php echo BASE_URL;?>img/entertainment.png"></div>
				 	<div class="dest-guide-div-score-bg">
				 		<div class="dest-guide-div-score-pct" style="width:<?php echo ($result['Entertainment']*10) . '%'?>;"> </div>
				 	</div>
				 	
				  </div>
				  
				 </div>

		</div>

<?php  return ob_get_clean();} 

      function get_content($URL){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_URL, $URL);
          $data = curl_exec($ch);
          curl_close($ch);
          return $data;
      }
	  
	  function get_country_name() {
	
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			   $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}
			$json = file_get_contents("http://freegeoip.net/json/" . $ip);
			$readable = json_decode($json, true);
			return $readable['country_name'];
	  }
	  
	  
	  
	  function get_country_code() {
	
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			   $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}
			$json = file_get_contents("http://freegeoip.net/json/" . $ip);
			$readable = json_decode($json, true);
			return $readable['country_code'];
	  }

function get_instagram_media_count($what) {
			$json = file_get_contents("https://api.instagram.com/v1/tags/".$what."?access_token=1379550292.f59def8.86a2bf75ea804105ac50267d8f43fe6d");
			$readable = json_decode($json, true);
			return number_format($readable["data"]["media_count"]);
}

function instagram_dest_pins($destid,$number) {
	
	$destnr = $destid;
	$max_number = $number;
	try {
		$db = new PDO('mysql:host='. DB_LOCALHOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->exec("SET NAMES 'utf8'");
		$instagram_db = $db->prepare("SELECT * FROM instagram_pictures WHERE DESTID = ?");
		$instagram_db->bindparam(1, $destnr);
		$instagram_db->execute();
		$instagram = $instagram_db->fetchall();
		
	}
	catch (Exception $e) {
		echo "Could not connect to database";
		die($e);
	}
	
	$display_number = min($max_number, count($instagram), 20);
	$y = 0;
	ob_start();
	while ($y < $display_number) { ?>
		<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p>Photo by <?php if (!empty($instagram[$y]['user'])) {echo $instagram[$y]['user'];} else {echo "unknown artist";} ;?></p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/instagramsmall.jpeg';?>">
								</div>
							</div>
							<img src="<?php echo $instagram[$y]['link'];?>">
					</div>
				</div>
		<?php $y = $y + 1;
	}
	
	return ob_get_clean();	
}

function twitter_dest_pins($destid,$number) {
	
	$destnr = $destid;
	$max_number = $number;
	try {
		$db = new PDO('mysql:host='. DB_LOCALHOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->exec("SET NAMES 'utf8'");
		$twitter_db = $db->prepare("SELECT * FROM twitter_tweets WHERE DESTID = ?");
		$twitter_db->bindparam(1, $destnr);
		$twitter_db->execute();
		$twitter = $twitter_db->fetchall();
		
		
		
	}
	catch (Exception $e) {
		echo "Could not connect to database";
		die($e);
	}
	
	$display_number = min($max_number, count($twitter),10);
	$y = 0;
	ob_start();
	while ($y < $display_number) { ?>
		<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><?php if (!empty($twitter[$y]['user'])) {echo $twitter[$y]['user'];} else {echo "unknown artist";} echo ", ".substr($twitter[$y]['time_of_post'],4,7)."&#39;".substr($twitter[$y]['time_of_post'],-2); ;?></p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/twittersmall.jpeg';?>">
								</div>
							</div>
							<div class="twitter-content">
								<img src="<?php echo $twitter[$y]['profile_link'];?>">
								<div>
									<h2>&quot; <?php echo $twitter[$y]['text_of_post'];?> &quot;</h3>
									<h3>- <?php echo $twitter[$y]['screen_name'];?></h2>
								</div>
							</div>
					</div>
				</div>
		<?php $y = $y + 1;
	}
	
	return ob_get_clean();	
}	  

function twitter_instagram_content($destid, $totalsets) {
	$destnr = $destid;
	$max_number = $totalsets;
	try {
		$db = new PDO('mysql:host='. DB_LOCALHOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->exec("SET NAMES 'utf8'");
		$twitter_db = $db->prepare("SELECT * FROM twitter_tweets WHERE DESTID = ?");
		$twitter_db->bindparam(1, $destnr);
		$twitter_db->execute();
		$twitter = $twitter_db->fetchall();
		
		$db = new PDO('mysql:host='. DB_LOCALHOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->exec("SET NAMES 'utf8'");
		$instagram_db = $db->prepare("SELECT * FROM instagram_pictures WHERE DESTID = ?");
		$instagram_db->bindparam(1, $destnr);
		$instagram_db->execute();
		$instagram = $instagram_db->fetchall();
		ob_start();
		$display_number = min($max_number, count($twitter), count($instagram),10);
		$y = 0;
		while ($y < $display_number) { ?>
		<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><?php if (!empty($twitter[$y]['user'])) {echo $twitter[$y]['user'];} else {echo "unknown artist";} echo ", ".substr($twitter[$y]['time_of_post'],4,7)."&#39;".substr($twitter[$y]['time_of_post'],-2); ;?></p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/twittersmall.jpeg';?>">
								</div>
							</div>
							<div class="twitter-content">
								<img src="<?php echo $twitter[$y]['profile_link'];?>">
								<div>
									<h2>&quot; <?php echo $twitter[$y]['text_of_post'];?> &quot;</h3>
									<h3>- <?php echo $twitter[$y]['screen_name'];?></h2>
								</div>
							</div>
					</div>
				</div>
		<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p>Photo by <?php if (!empty($instagram[$y]['user'])) {echo $instagram[$y]['user'];} else {echo "unknown artist";} ;?></p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/instagramsmall.jpeg';?>">
								</div>
							</div>
							<img src="<?php echo $instagram[$y]['link'];?>">
					</div>
		</div>
				
				
		<?php $y = $y + 1;
	}
		
	}
	catch (Exception $e) {
		echo "Could not connect to database";
		die($e);
	}
	
	return ob_get_clean();	
	
}


function kokomo_postcards($destid,$number) {
	
	$destnr = $destid;
	$max_number = $number;
	try {
		$db = new PDO('mysql:host='. DB_LOCALHOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->exec("SET NAMES 'utf8'");
		$postcards_db = $db->prepare("SELECT * FROM postcards WHERE DESTID = ?");
		$postcards_db ->bindparam(1,$destid);
		$postcards_db->execute();
		$postcards = $postcards_db->fetchall();
		
		
	}
	catch (Exception $e) {
		echo "Could not connect to database";
		die($e);
	}
	
	$display_number = min($max_number, count($postcards),10);
	$y = 0;
	ob_start();
	while ($y < $display_number) { ?>
		<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><?php if (!empty($postcards[$y]['NAMEONCARD'])) {echo $postcards[$y]['NAMEONCARD'].", ".$postcards[$y]['HEADLINE'];} else {echo "unknown artist";};?></p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/kokomo_just_the_k.png';?>">
								</div>
							</div>
							
							<img src="<?php echo BASE_URL . 'stories/pics/upload/'.$postcards[$y]['PICNUMBER'];?>">
					</div>
				</div>
		<?php $y = $y + 1;
	}
	
	return ob_get_clean();	
}	
