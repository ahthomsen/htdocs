<?php
require(ROOT_PATH . "scripts/database.php");

if (isset($_SESSION['userid'])) {
$user = $_SESSION['userid'];	

}
else {
$user = session_id();
}

	
	try {
	// get an array of destinations already visited by the users:
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

	foreach ($dest_exsting_combined as $key => $value) {

		$dest_existing[$key] = 	$value['DESTID'];
	}
	//get all destinations in one array
	$dest_existing_count = count($dest_existing);
	$dest_db = $db->prepare("SELECT * FROM
	dest
	ORDER by rand() LIMIT 15");
	$dest_db->execute();
	$dests_full = $dest_db->fetchAll();
	}
	catch (Exception $e) 
	{
		echo "Could not coneect to database";
		die($e);
	}
	
	$dests = array();
	$count = 0;
	foreach ($dests_full as $dest_input) {
		$check = $dest_input["DESTID"];
		if  (in_array($check, $dest_existing, true)) {
		}
		else {
			$dests[$count] = $dest_input;
			$total_views = $dest_existing_count + $count;
			$count = $count + 1;
			$dest_existing[$total_views] = $dest_input['DESTID'];
		}
		
		if ($count == 100) {
			break;
		}
	}
	//load the exsting destinations known the the user into a JSON variable to be send to PHP later
	
	$existing = json_encode($dest_existing);
	
	// gets the current user to find existing visits and saved
	if (isset($_SESSION['userid'])) {
		$user = $_SESSION['userid'];
	}
	else {
		$user = session_id();
	}
	
	try {
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
	catch (Exception $e) 
	{
		echo "Could not coneect to database";
		die($e);
	}
	
	

?>

	<script>
	 visits = <?php if (!empty($visited_count)) {echo $visited_count;} else {echo '0';}?>;
	 saved = <?php if (!empty($saved_count)) {echo $saved_count;} else {echo '0';}?>;

	</script>
	<script src="<?php echo BASE_URL .'scripts/kokomo.js';?>"></script>
	
	<div id="backcover-start" onclick="this.style.display = 'none';" <?php if (isset($_GET['more'])) {echo "style='display: none;'";} ?>>
		<div class="front-cover">
			<p>Hey there! Go find your next holiday destination. Here’s how:</p>
			<ul>
				<li>
					<a>
						<h2>1: Move the cursor to any destination</h2>
					</a>
				</li>
				<li>
					<a>
						<h2>2: Select from the presented options</h2>
					</a>
				</li>
				<li>
					<a>
						<h2>3: Click the orange stats in the lower left corner to get recommendations</h2>
					</a>
				</li>
				<li>
					<a>
						<h2>4: Scroll down for more destinations, tests etc.</h2>
					</a>
				</li>
			</ul>
			<p>Click anywhere to close this window!</p>
		</div>
	</div>

	
	
	
	<div class="all-post-cards-container"></div>
	<div id="columns">

	
		<?php foreach($dests as $dest) { 
		
		$insta_count_db = $db->prepare("SELECT * FROM instagram_pictures WHERE DESTID = ?");
		$insta_count_db->bindparam(1,$dest['DESTID']);
		$insta_count_db->execute();
		$insta_count = $insta_count_db->fetch();
		$insta_count = count($insta_count);
		
		$twit_count_db = $db->prepare("SELECT *FROM twitter_tweets WHERE DESTID = ?");
		$twit_count_db->bindparam(1,$dest['DESTID']);
		$twit_count_db->execute();
		$twit_count = $twit_count_db->fetch();
		$twit_count = count($twit_count); 
		
	
		
			
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
								<div class="social-scores">
									<ul>
										<li>
											<img src="<?php echo BASE_URL . 'img/twittersmall.jpeg';?>">
											<p><?php echo $twit_count;?></p>
										</li>
										<li>
											<img src="<?php echo BASE_URL . 'img/instagramsmall.jpeg';?>">
											<p><?php echo $insta_count;?></p>
										</li>
									</ul>
								</div>
							</div>
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg1']; ?>" alt="<?php echo $destination;?>">
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg2']; ?>" alt="<?php echo $destination;?>">
							<div class="dest-score-show">
								<p><?php echo substr($dest['AvgScore'],0,3);?></p>
							</div>
							<div style="clear: both"></div>
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
									<li>
										<a href="<?php echo $dest['BookinglinkBrowser'];?>">Book now</a>
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
								<a href="javascript:void(0)"><img  onclick="already_rec('yes',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpup.png';?>"></a>
								<a href="javascript:void(0)"><img onclick="already_rec('no',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpdown.png';?>"></a>
							</div>
							

					</div>
				</div>	
			</a>	
		<?php } ?>
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
	$(window).scroll(function() {
    if(($(window).scrollTop() >= ($(document).height() - $(window).height())*0.9) && (alreadyshow == 0)) {
    	document.getElementById('backcover').style.display = 'block';
    	alreadyshow = 1;
    }
   
    if($(window).scrollTop() == ($(document).height() - $(window).height())) {
    	document.getElementById('backcover').style.display = 'block';
    }
    
});

</script>

<div class="scroll-guide"> 
<h2>Scroll down for more options</h2>	
</div>

<div id="backcover" onclick="this.style.display = 'none';">
	<div class="front-cover">
		<p>Find your next holiday destination..</p>
		<ul>
			<li>
				<a href="<?php echo BASE_URL.'index.php?more=1';?>">
					<h2>Browse more destinations</h2>
				</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL . 'destinationguide/destinationguide.php';?>">
					<h2>Try the destination guide</h2>
				</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL . 'userstats/userstats.php';?>">
					<h2>Get destination recommendations</h2>
				</a>
			</li>
		</ul>
	</div>
</div>




