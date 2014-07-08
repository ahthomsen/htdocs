<?php /* $results_dest = $_SESSION["results_dest_session"]; 
$results_stories = $_SESSION["results_story_session"]; */
?>

	<div class="dest-rec-bar">
		<h2>Destinations that fit your search criteria</h2>
	</div>
	<div class="all-post-cards-container"></div>
		<div id="columns">
			
		<?php foreach($destination as $result) { ?>
		<div class="pin">
			<div class="dest-show-main-picture">
				<div class="dest-show-main-content">
					<p><a style="text-decoration: none;" href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $result['DESTID'];?>" ><?php echo $result['Destinationfullname']?></a></p>
					<div class="item-picture">
						<img src="<?php echo BASE_URL . 'img/kokomo_just_the_k.png';?>">
					</div>
					</div>
					<a href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $result['DESTID'];?>">
					<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $result['DestImg2']; ?>" alt="<?php echo $result['Destinationsfullname'];?>">
					</a>
 				</div>
			</div>
		<?php } ?>
		
	</div>
</div>
