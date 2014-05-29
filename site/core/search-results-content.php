<?php /* $results_dest = $_SESSION["results_dest_session"]; 
$results_stories = $_SESSION["results_story_session"]; */
?>

<div class="content-row">
	<div class="search-results-left">
		<div><h1>Destinations</h1></div>
		
		
		<?php foreach($destination as $result_d) { ?>
		
		<a style="color: black;"  href="<?php echo BASE_URL ;?>destinations/destinations.php?dest=<?php echo $result_d['DESTID'];?>">	
			<div class="search-results-destinations clearfix">
				<img src="<?php echo BASE_URL;?>destinations/img/<?php echo $result_d['DestImg1'];?>">
				<p class="search-results-dest"><?php echo $result_d['Destinationfullname'];?></p>
				
				<p class="search-results-score"><?php echo substr($result_d['AvgScore'],0,3);?></p>
				<div class="postcard-like-action">
 							
 				</div>
			</div>
		</a>	
		
		<?php } ?>
		
	</div>
	<div class="search-results-right">
		<div><h1>Stories</h1></div>
		
		<?php foreach($story as $results_story) { ?>
		
		<a style="color: black;" href="<?php echo BASE_URL ;?>stories/stories.php?dest=<?php echo $results_story['DESTID'];?>">	
			<div class="search-results-stories clearfix">
				<img src="<?php echo BASE_URL;?>stories/pics/upload/<?php echo $results_story['PICNUMBER'];?>">
				<p class="search-results-dest"><?php echo $results_story['NAMEONCARD'] . ", " . $results_story['YEAR'];?></p>
				<p class="search-results-score"><?php echo $results_story['OWN_RANKING'];?></p>
			</div>
		</a>
		
		<?php } ?>

	</div>
</div>
