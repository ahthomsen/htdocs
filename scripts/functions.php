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

	if($total >= 150)$title="Indiana Jones";
	if($total >= 125)$title="Explorer";
	if($total >= 100)$title="Globerotter";
	if($total >= 75)$title="Backpacker";
	if($total >= 50)$title="Tourist";
	if($total >= 25)$title="Weekend Traveller";
	if($total < 25)$title="Travel Rookie";
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
?>