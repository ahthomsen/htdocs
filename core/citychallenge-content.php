<?php  

try {
	
	$city_dest = $db->query("SELECT * FROM dest WHERE Citychallenge = 1");
	$city_dest -> execute();
	$city_dest_results = $city_dest->fetchAll();
}
catch (Exception $e) {
	echo "Could not connect to database";
}


?>


<div class="content-row">
	
	<form id="citychallenge" action="<?php echo BASE_URL ."citychallenge/citychallenge.php";?>" method="post">
		<h1 class="challenge-header">Where have you been?</h1>
		<div class="challenge-containter">

			<ul>
				<?php foreach($city_dest_results as $city) {?>
		
				
				<li class="challenge-city-rows">
				<label>		
					<div>
						
						<div class="challenge-city-name" style=" background: url(<?php echo BASE_URL . "destinations/img/" . $city['DestImg1'];?>) no-repeat center center fixed; 
						  -webkit-background-size: cover;
						  -moz-background-size: cover;
						  -o-background-size: cover;
	 						background-size: cover;">
							
								<h2><?php echo $city['Destinationfullname'];?></h2>
							
								<div class="challenge-city-scores">
									<h3><img src="<?php echo BASE_URL . "img/partying.png" ?>" alt="Party potential"><p><?php echo $city['Partying'];?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/shopping2.png" ?>" alt="Shopping"><p><?php echo $city['Shopping'];?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/museum.png" ?>" alt="Cultural sights"><p><?php echo $city['Museums'];?></p></h3>
									<h3><img src="<?php echo BASE_URL . "img/food.png" ?>" alt="High qualiry food"><p><?php echo $city['Food'];?></p></h3>
									<input class="challenge-check" name="<?php echo $city['DESTID'];?>" id="<?php echo $city['DESTID'];?>" type="checkbox">
									<div class="challenge-white-space" style="claer: both; height: 2px;"></div>
							
								</div>
								<div class="challenge-white-space" style="claer: both; height: 10px;"></div>
						
						</div>
					</div>
					</label>
				</li>
				
			<?php } ?>
				
			</ul>
		</div>
		<div class="city-submit">
				<input class="city-submit-button" type="submit" value="Go!">			
		</div>
		</div>
	</form>
</div>