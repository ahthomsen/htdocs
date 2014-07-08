<?php 

if (isset($_GET['random'])==TRUE && $_GET['random']!=0)  
{
	$random_button_hide = ""; 
	$random = "&random=1";
} 
else 
{
	$random_button_hide = "random_button_hide"; 
	$random="&random=0";
}
?>
	<div class="dest-rec-bar">
		<h2><?php echo $dest['Destinationfullname'];?></h2>
	</div>
	<div class="all-post-cards-container"></div>
		<div id="columns">
			<!-- new pin -->
			<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><a style="color: black; text-decoration: none;" href="<?php echo $dest['Cclink2'];?>">Photo</a> by <?php echo $dest['Ccname2'] ;?>, <a style="color: lightgrey; text-decoration: none;" href="http://creativecommons.org/licenses/by/2.0/"> CC BY 2.0</a> </p>
								<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/flicker_icon.png';?>">
								</div>
							</div>
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg2']; ?>" alt="<?php echo $destination;?>">
							<div style="clear: both"></div>						
					</div>
				</div>
				<!-- new pin -->
				<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><a style="color: black; text-decoration: none;" href="<?php echo $dest['Cclink1'];?>">Photo</a> by <?php echo $dest['Ccname1'] ;?>, <a style="color: lightgrey; text-decoration: none;" href="http://creativecommons.org/licenses/by/2.0/"> CC BY 2.0</a> </p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/flicker_icon.png';?>">
								</div>
							</div>
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $dest['DestImg1']; ?>" alt="<?php echo $destination;?>">
							<div style="clear: both"></div>						
					</div>
				</div>	
				<!-- new pin -->
				
				<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p>Destination attributes</p>
							<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/kokomo_just_the_k.png';?>">
								</div>
							</div>
							<?php  echo destination_stats($dest);?>		
					</div>
				</div>
				<!-- next pin -->
				<?php echo twitter_instagram_content($dest['DESTID'],20);?>
				<?php echo kokomo_postcards($dest['DESTID'],20);?>
</div>

	<div class="dest-show-main-picture">
		<div class="dest-show-main-content dest-show-main-content-fb">
				<p>Share your experience with the world..</p>
					<div class="item-picture">
							<img src="<?php echo BASE_URL . 'img/facebook.png';?>">
						</div>
					</div>
		<div class="fb-comments" style="padding-top: 45px;" data-numposts="5" data-width="100%" data-href="http://kokomoholiday.com<?php echo BASE_URL.'destinations/destinations.php?dest='.$dest['DESTID'];?>" data-numposts="5" data-colorscheme="light"></div>
	</div>

<div class="dest-menu">
	<ul>
		<li>
			<a href="<?php echo $dest['BookinglinkBrowser'];?>">Book now</a>
		</li>
		<li>
			<a href="<?php echo BASE_URL . 'destiny/destiny.php';?>">Next!</a>
		</li>
		<li>
			<a href="<?php echo BASE_URL . 'stories/upload.php';?>">Upload content!</a>
		</li>
	</ul>
</div>
<script src="<?php echo BASE_URL .'scripts/kokomo.js';?>"></script>
