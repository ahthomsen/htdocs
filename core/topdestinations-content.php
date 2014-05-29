<div class="content-row">
	
	<?php

$results = $destinations;

foreach($results as $result) {?>

<div style="clear:both;" class="dest-guide-out-top clearfix">
		<a style="text-decoration: none;" href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $result['DESTID'];?>" ><h1><?php echo $result['Destinationfullname']?></h1></a>
	</div>
	
	<div class="dest-guide-left-pictures mobile-hidden">
			<a href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $result['DESTID'];?>" style="font-size: 1.1em; color: black; text-align: left; ">
				<div class="dist-guide-story-pic-holders" style="background: url('<?php echo BASE_URL;?>destinations/img/<?php echo $result['DestImg1'];?>') no-repeat;">
					
					<p class="dest-top-text" style="padding: 10px 10px; margin: 5px 0px;background-color:white; filter:alpha(opacity=60); opacity:.7;"><?php echo $result['DestText'];?></p>
					
					</div>
			</a>
			<a href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $result['DESTID'];?>">
			<div class="dist-guide-story-pic-holders" style="background: url('<?php echo BASE_URL;?>destinations/img/<?php echo $result['DestImg2'];?>') no-repeat;"></div></a>
	</div>
	
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
		
<?php } 


?>

  </div>
	
