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
		document.getElementById(dest_pin).style.display = 'none';
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
	
	<div class="all-post-cards-container"></div>
	<div id="columns">

	
		<?php foreach($dests as $dest) { ?>		
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
										<a onclick="i_been_already(<?php echo $dest['DESTID'];?>)">I been already</a>
									</li>
									<li>
										<a onclick="check_out_later(<?php echo $dest['DESTID'];?>)">Check out later</a>
									</li>
									<li>
										<a  href="<?php echo BASE_URL.'destinations/destinations.php?dest='.$dest['DESTID'];?>">Check out now</a>
									</li>
								</ul>
							</div>
							<div id="<?php echo $dest['DESTID'].'already';?>" class="dest-already">
								<p>Will you recommend <?php echo $dest['Destinationfullname'];?>?</p>
								<img onclick="already_rec('yes',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpup.png';?>">
								<img onclick="already_rec('no',<?php echo $dest['DESTID'];?>);" src="<?php echo BASE_URL . 'img/thumpdown.png';?>">
							</div>

					</div>
				</div>	
			</a>	
		<?php } ?>
	</div>
		<div class="dest-session-stats">
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
				<a href="<?php echo BASE_URL;?>">
					<h2>Browse more destinations</h2>
				</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL . 'destinationguide/destinationguide.php';?>">
					<h2>Try the destination guide</h2>
				</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL . 'citychallenge/citychallenge.php';?>">
					<h2>Take the city challenge</h2>
				</a>
			</li>
		</ul>
	</div>
</div>



