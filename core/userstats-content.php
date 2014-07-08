<?php
session_start();
require_once(ROOT_PATH . "scripts/database.php");
require_once("../scripts/config.php");
require_once(ROOT_PATH . "scripts/database.php");
require_once(ROOT_PATH . "scripts/functions.php");
if (isset($_SESSION['userid'])) {
$user = $_SESSION['userid'];	
}
else {
$user = session_id();
}
try {
	
	
	// Calculate the avg score of all recommended destination  and reports them in avgscore varaible
	
	$dest_been_db = $db->prepare("SELECT * FROM dest INNER JOIN been_there ON dest.DESTID=been_there.DESTID WHERE been_there.USERID = ? AND been_there.rec = 1");
	$dest_been_db->bindparam(1, $user);
	$dest_been_db->execute();
	$dest_been = $dest_been_db->fetchall();
	$totals = count($dest_been);
	$destrec = array();
	foreach ($dest_been as  $been) {
		$destrec[] = array_slice($been,11,10);
	}

	$avgscore = array();

	foreach ($destrec as $dest) {
		$x = 0;
		while($dest_score = current($dest)) {
			$avgscore[$x] = $avgscore[$x] + $dest_score;
			next($dest);
			$x = $x + 1;
		}
	}
	for($x=0;$x<=9;$x++) {
		$avgscore[$x] = round($avgscore[$x] / $totals, 2);
	}
	
	// Get all the existing destinations visited or selected fro check out by the user
	
	$dest_existing_db =$db->prepare("SELECT DESTID FROM been_there WHERE USERID = ?");
	$dest_existing_db->bindParam(1,$user);
	$dest_existing_db->execute();
	$dest_existing_been = $dest_existing_db->fetchAll();
	
	$dest_existing_db = $db->prepare("SELECT DESTID FROM save_for_later WHERE USERID = ?");
	$dest_existing_db->bindParam(1,$user);
	$dest_existing_db->execute();
	$dest_existing_saved = $dest_existing_db->fetchAll();
	
	$dest_exsting_combined = array_merge($dest_existing_been , $dest_existing_saved);
	
	//turn the multiarray combined array into a single array
	$dest_existing = array('0');
	
	// creates a single dimensional array that contain all the destIDs of existing destinations
	foreach ($dest_exsting_combined as $key => $value) {

		$dest_existing[$key] = 	$value['DESTID'];
	}
	
	// get all destinations in the SQL database
	$dest_all_db =$db->prepare("SELECT DESTID, Beaches, Cityfeel, Partying, Budget, Shopping, Museums, Active, Language, Food, Nature FROM dest");
	$dest_all_db->execute();
	$dest_all = $dest_all_db->fetchall();

	$dest_explore = array();

	//var_dump($dest_all);
	foreach ($dest_all as $dest_al) {
			$check = $dest_al['DESTID'];
			$x = 0;
			if (in_array($check, $dest_existing, true)) {
			}
			else {
				while ($dest_value = current($dest_al)) {
				if(key($dest_al) == 'DESTID') 
					{ next($dest_al);}
				else {
					$sse = pow($dest_value - $avgscore[$x], 2) + $sse;
					$x = $x + 1;
					next($dest_al);	
					}
				}
				$dest_al['sse'] = $sse;
				$sse = 0;
				$dest_explore[] = $dest_al;
				
			}
	}
	
	array_sort_by_column($dest_explore, 'sse');
	$total_dest_left = count($dest_explore);
	$top3dest = array_slice($dest_explore, 2,3);
	$buttom3dest = array_slice($dest_explore, $total_dest_left - 3, 3);
	
	$top3_db = $db-> prepare("SELECT * FROM dest WHERE DESTID = ? OR DESTID = ? OR DESTID = ?");
	$top3_db->bindparam(1, $top3dest[0]['DESTID']);
	$top3_db->bindparam(2, $top3dest[1]['DESTID']);
	$top3_db->bindparam(3, $top3dest[2]['DESTID']);
	$top3_db->execute();
	$top3 = $top3_db->fetchAll();
	
	$buttom3_db = $db-> prepare("SELECT * FROM dest WHERE DESTID = ? OR DESTID = ? OR DESTID = ?");
	$buttom3_db->bindparam(1, $buttom3dest[0]['DESTID']);
	$buttom3_db->bindparam(2, $buttom3dest[1]['DESTID']);
	$buttom3_db->bindparam(3, $buttom3dest[2]['DESTID']);
	$buttom3_db->execute();
	$buttom3 = $buttom3_db->fetchAll();


// get the number of "saved for later" for a given user;
		$saved_db = $db->prepare("SELECT * FROM save_for_later WHERE USERID = ?");
		$saved_db-> bindParam(1,$user);
		$saved_db->execute();
		$saved_before = $saved_db->fetchAll();
		$saved_count = count($saved_before);
		// get the number of already visited destinations
		
		$visited_db = $db->prepare("SELECT * FROM been_there  WHERE USERID = ?");
		$visited_db->bindParam(1,$user);
		$visited_db->execute();
		$visited_before = $visited_db->fetchAll();
		
		$visited_count = count($visited_before);

}
catch (Exception $e) {
	echo "Could not connect to database";
	die($e);
}

?>

	<script>
	 visits = <?php if (!empty($visited_count)) {echo $visited_count;} else {echo '0';}?>;
	 saved = <?php if (!empty($saved_count)) {echo $saved_count;} else {echo '0';}?>;

	 function travel_status(c_visited) {
	 	var score = c_visited;
	 	var status = "";
	 	switch (true) {
	 		case (score < 5):
	 			status = 'Travel Rookie';
	 			return status;
	 			break;
	 		case (score < 10):
	 			status = 'Weekend Traveller';
	 			return status;
	 			break;
	 		case (score < 15):
	 			status = 'Tourist';
	 			return status;
	 			break;
	 		case (score < 20):
	 			status = 'Backpacker';
	 			return status;
	 			break;
	 		case (score < 25):
	 			status = 'Globetrotter';
	 			return status;
	 			break;
	 		case (score < 30):
	 			status = 'Explorer';
	 			return status;
	 			break;
	 		case (score < 30000000):
	 			status = 'Indiana Jonas';
	 			return status;
	 			break;
	 		}
	 		
	 	}



	 
	 
		function i_been_already(destid) {
			var dest_text = destid + 'text';
			var dest_already = destid + 'already';
			var dest_pin = destid + 'pin';
			document.getElementById(dest_text).style.display = 'none';
			document.getElementById(dest_pin).onmouseover=null; 
			document.getElementById(dest_pin).onmouseout=null;
			document.getElementById(dest_already).style.display = 'block';
			visits = visits + 1;
			document.getElementById('travel_status').innerHTML = '= ' + travel_status(visits);
			document.getElementById('session_visits').innerHTML = '= ' + visits;
		}
		function already_rec(answer,destid) {
		var feedback = answer;
		var dest_pin = destid + 'pin';
		document.getElementById(dest_pin).style.border = 'solid 10px green';
		// The function that push information to the php
		var rec = answer;
		var dest_to_save = destid;
		var jqxhr = $.post('<?php echo BASE_URL . "scripts/fronttodb.php";?>',{destid: destid, rec: rec})

        // success
        .done(function (response){
            var obj = $.parseJSON(response);
            if (obj.contentNum !== null) {
                $("#test").text(obj.contentNum);
            }
        })

        // always
        .always(function () {
            // re-enable inputs
         
  		  });
		
		
		}
		function check_out_later(destid) {
		var dest_pin = destid + 'pin';
		document.getElementById(dest_pin).style.display = 'none';
		saved = saved + 1;
		document.getElementById('session_saved').innerHTML = '= ' + saved;
		var dest = destid;
		var save = 1;
		var jqxhr = $.post('<?php echo BASE_URL . "scripts/fronttodb.php";?>',{destid: dest, save: save})
        // success
        .done(function (response){
        })
        // always
        .always(function () {
            // re-enable inputs  
  		  });
		}
	
		
	</script>
	
		<div id="backcover-start" onclick="this.style.display = 'none';" <?php if (isset($_GET['more'])) {echo "style='display: none;'";} ?>>
		<div class="front-cover">
			<p>Hi there, you current status is <?php echo get_travel_status($totals, 0, 0);?>, visit <?php  $togo = ceil($totals/5)*5 - $totals; if ($togo == 0) {$togo = 5;} $new_totals = $totals + 6; echo $togo;?> more destinations to become <?php echo get_travel_status($new_totals, 0, 0);?></p>
			<p>
				Based on the destinations you have recommended so far we want to help you extend your horizon by suggesting:
			</p>
			<ul>
				<li>
					<a>
						<h2>3 new destinations with similar characteristics</h2>
					</a>
				</li>
				<li>
					<a>
						<h2>3 new, but quite different destinations </h2>
					</a>
				</li>
			</ul>
			<p>Click anywhere to close this window!</p>
		</div>
	</div>
	
	<div class="dest-rec-bar">
		<h2>Try something new, but similar..</h2>
	</div>
	<div class="all-post-cards-container"></div>
	<div id="columns" style="margin-bottom: 20px">

	
		<?php foreach($top3 as $dest) { 
			
			$attribute = array_slice($dest, 11, 10);
		
			$rank1 = "Beaches";
			$rank2 = "Cityfeel";
			$rank3 = "Museums";
			$rank4 = "Nature";
			$score1 = 0;
			$score2 = 0;
			$score3 = 0;
			$score4 = 0;
				
			while ($att_score = current($attribute)) {
				if ($att_score >= $score1) {$rank4 = $rank3; $rank3 = $rank2; $rank2 = $rank1; $score4 = $score3; $score3 = $score2; $score2 = $score1; $rank1 = key($attribute); $score1 = $att_score; next($attribute);}
				elseif ($att_score >= $score2) {$rank4 = $rank3; $rank3 = $rank2; $score4 = $score3; $score3 = $score2; $rank2 = key($attribute); $score2 = $att_score; next($attribute);}
				elseif ($att_score >= $score3) {$rank4 = $rank3; $score4 = $score3; $rank3 = key($attribute); $score3 = $att_score; next($attribute);}
				elseif ($att_score >= $score4) {$rank4 = key($attribute); $score4 = $att_score; next($attribute); }
				else {next($attribute);}
			}

				
			?>		
			
			
			
			
			
			<a class="<?php echo $hideclass;?>" href="<?php echo BASE_URL . 'destinations/destinations.php?dest=' . $dest['DESTID'];?>" style="color: black; text-decoration: none;" >
				<div class="pin" id="<?php echo $dest['DESTID'].'pin';?>" onmouseover="document.getElementById('<?php echo $dest['DESTID'].'text';?>').style.display = 'block';"
						onmouseout="document.getElementById('<?php echo $dest["DESTID"].'text';?>').style.display = 'none';">
					<div class="dest-show-main-picture">
							
							<div class="dest-show-main-content">
								<p><?php echo $dest["Destinationfullname"] ?></p>
								<div class="social-scores" style="display: none;">
									<ul>
										<li>
											<img src="<?php echo BASE_URL . 'img/twittersmall.jpeg';?>">
											<p><?php echo $dest['twitter_count'];?></p>
										</li>
										<li>
											<img src="<?php echo BASE_URL . 'img/instagramsmall.jpeg';?>">
											<p><?php echo $dest['instagram_count'];?></p>
										</li>
									</ul>
								</div>
							</div>
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg1']; ?>" alt="<?php echo $destination;?>">
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg2']; ?>" alt="<?php echo $destination;?>">
							<div class="dest-score-show">
								<p><?php echo substr($dest['AvgScore'],0,3);?></p>
							</div>
							<div class="dest-text" id="<?php echo $dest['DESTID'].'text'?>">
							
								<p style="color: black; text-decoration: none;"><?php echo $dest['DestText'];?></p>
								<ul class="dest-actions">
									<li>
										<a href="javascript:void(0)" onclick="i_been_already(<?php echo $dest['DESTID'];?>)">I been already</a>
									</li>
									<li>
										<a href="javascript:void(0)" onclick="check_out_later(<?php echo $dest['DESTID'];?>)">Check out later</a>
									</li>
									<li>
										<a href="<?php echo BASE_URL.'destinations/destinations.php?dest='.$dest['DESTID'];?>">Check out now</a>
									</li>
								</ul>
								<div class="challenge-city-scores">
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank1).".png" ?>" alt="<?php echo $rank1;?>"><p><?php echo $score1;?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank2).".png" ?>" alt="<?php echo $rank2;?>"><p><?php echo $score2;?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank3).".png" ?>" alt="<?php echo $rank3;?>"><p><?php echo $score3;?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank4).".png" ?>" alt="<?php echo $rank4;?>"><p><?php echo $score4;?></p></h3>
									<div class="challenge-white-space" style="claer: both; height: 2px;"></div>
									<a href="<?php echo BASE_URL . 'destinationguide/destinationguide.php';?>">What does these icons mean?</a>
								</div>
							</div>
							
							<div id="<?php echo $dest['DESTID'].'already';?>" class="dest-already">
								<p>Will you recommend <?php echo $dest['Destinationfullname'];?>?</p>
								<a href="javascript:void(0)"><img onclick="already_rec('yes',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpup.png';?>"></a>
								<a href="javascript:void(0)"><img onclick="already_rec('no',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpdown.png';?>"></a>
							</div>
							

					</div>
				</div>	
			</a>	
		<?php } ?>
	</div>
	</div>
	<div class="dest-rec-bar">
	    	<h2>Try something different..</h2>
	</div>
	
	<div class="all-post-cards-container"></div>
	<div id="columns"  style="margin-bottom: 55px">

	
		<?php foreach($buttom3 as $dest) { 
			
			$attribute = array_slice($dest, 11, 10);
		
			$rank1 = "Beaches";
			$rank2 = "Cityfeel";
			$rank3 = "Museums";
			$rank4 = "Nature";
			$score1 = 0;
			$score2 = 0;
			$score3 = 0;
			$score4 = 0;
				
			while ($att_score = current($attribute)) {
				if ($att_score >= $score1) {$rank4 = $rank3; $rank3 = $rank2; $rank2 = $rank1; $score4 = $score3; $score3 = $score2; $score2 = $score1; $rank1 = key($attribute); $score1 = $att_score; next($attribute);}
				elseif ($att_score >= $score2) {$rank4 = $rank3; $rank3 = $rank2; $score4 = $score3; $score3 = $score2; $rank2 = key($attribute); $score2 = $att_score; next($attribute);}
				elseif ($att_score >= $score3) {$rank4 = $rank3; $score4 = $score3; $rank3 = key($attribute); $score3 = $att_score; next($attribute);}
				elseif ($att_score >= $score4) {$rank4 = key($attribute); $score4 = $att_score; next($attribute); }
				else {next($attribute);}
			}

				
			?>		
			
			
			
			
			
			<a class="<?php echo $hideclass;?>" href="<?php echo BASE_URL . 'destinations/destinations.php?dest=' . $dest['DESTID'];?>" style="color: black; text-decoration: none;" >
				<div class="pin" id="<?php echo $dest['DESTID'].'pin';?>" onmouseover="document.getElementById('<?php echo $dest['DESTID'].'text';?>').style.display = 'block';"
						onmouseout="document.getElementById('<?php echo $dest["DESTID"].'text';?>').style.display = 'none';">
					<div class="dest-show-main-picture">
							
							<div class="dest-show-main-content">
								<p><?php echo $dest["Destinationfullname"] ?></p>
								<div class="social-scores" style="display: none;">
									<ul>
										<li>
											<img src="<?php echo BASE_URL . 'img/twittersmall.jpeg';?>">
											<p><?php echo $dest['twitter_count'];?></p>
										</li>
										<li>
											<img src="<?php echo BASE_URL . 'img/instagramsmall.jpeg';?>">
											<p><?php echo $dest['instagram_count'];?></p>
										</li>
									</ul>
								</div>
							</div>
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg1']; ?>" alt="<?php echo $destination;?>">
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg2']; ?>" alt="<?php echo $destination;?>">
							<div class="dest-score-show">
								<p><?php echo substr($dest['AvgScore'],0,3);?></p>
							</div>
							<div class="dest-text" id="<?php echo $dest['DESTID'].'text'?>">
							
								<p style="color: black; text-decoration: none;"><?php echo $dest['DestText'];?></p>
								<ul class="dest-actions">
									<li>
										<a href="javascript:void(0)" onclick="i_been_already(<?php echo $dest['DESTID'];?>)">I been already</a>
									</li>
									<li>
										<a href="javascript:void(0)" onclick="check_out_later(<?php echo $dest['DESTID'];?>)">Check out later</a>
									</li>
									<li>
										<a href="<?php echo BASE_URL.'destinations/destinations.php?dest='.$dest['DESTID'];?>">Check out now</a>
									</li>
								</ul>
								<div class="challenge-city-scores">
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank1).".png" ?>" alt="<?php echo $rank1;?>"><p><?php echo $score1;?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank2).".png" ?>" alt="<?php echo $rank2;?>"><p><?php echo $score2;?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank3).".png" ?>" alt="<?php echo $rank3;?>"><p><?php echo $score3;?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/".strtolower($rank4).".png" ?>" alt="<?php echo $rank4;?>"><p><?php echo $score4;?></p></h3>
									<div class="challenge-white-space" style="claer: both; height: 2px;"></div>
									<a href="<?php echo BASE_URL . 'destinationguide/destinationguide.php';?>">What does these icons mean?</a>
								</div>
							</div>
							
							<div id="<?php echo $dest['DESTID'].'already';?>" class="dest-already">
								<p>Will you recommend <?php echo $dest['Destinationfullname'];?>?</p>
								<a href="javascript:void(0)"><img onclick="already_rec('yes',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpup.png';?>"></a>
								<a href="javascript:void(0)"><img onclick="already_rec('no',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpdown.png';?>"></a>
							</div>
							

					</div>
				</div>	
			</a>	
		<?php } ?>
	</div>
	</div>
	</div>

	</div>
		<div class="dest-session-stats">
			<a href="<?php echo BASE_URL . 'userstats/userstats.php';?>">
			<ul>
				<li>
					<img src="<?php echo BASE_URL.'img/globe_visit.png';?>">
						<p id="session_visits">= </p>
				</li>
				<li>
					<img src="<?php echo BASE_URL.'img/dest_dream.png';?>">
						<p id="session_saved"></p>
				</li>
				<li>
					<img src="<?php echo BASE_URL.'img/statuspic.png';?>">
					<p id="travel_status"></p>
				</li>
			</ul>
			</a>
		</div>	

	</div>
<script src="<?php echo BASE_URL .'scripts/jquery.js';?>"></script>
<script>
	document.getElementById('session_saved').innerHTML = '= ' + saved;
	document.getElementById('session_visits').innerHTML = '= ' + visits;
	document.getElementById('travel_status').innerHTML = '= ' + travel_status(visits);
	alreadyshow = 0;
    
</script>



