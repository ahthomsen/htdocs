
	
<?php

$results = $destinations;
?>
	<div class="dest-rec-bar">
		<h2>Top 10 destinations based on your preferences</h2>
	</div>
	<div class="all-post-cards-container"></div>
		<div id="columns">

<?php
foreach($results as $result) {?>
<div class="pin">
					<div class="dest-show-main-picture">
							<div class="dest-show-main-content">
								<p><a style="text-decoration: none;" href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $result['DESTID'];?>" ><?php echo $result['Destinationfullname']?></a></p>
								<div class="item-picture">
									<img src="<?php echo BASE_URL . 'img/kokomo_just_the_k.png';?>">
								</div>
							</div>
							<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $result['DestImg2']; ?>" alt="<?php echo $result['Destinationsfullname'];?>">
							<p style="margin-left: 10px"><?php echo $result['DestText'];?></p>
								<div class="dest-guide-right-scores">
								  <div class="dest-guide-scores output-beaches" style="padding-top: 5px">
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
					</div>
				</div>
		
<?php } 


?>

  </div>
</div>
