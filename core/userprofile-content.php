<div class="content-row">
	
		

	
	<div class="user-content-bow user-box">
		
			<div class="user-pic-div">
				<h1><?php echo $name ?></h1>
					<!-- Checks for an existing profile picture and returns a standard picture if no picture exists -->
				
				
				<?php if (file_exists(ROOT_PATH . "userprofile/img/" . $picture)) { ?>
					
					
					<img src="img/<?php echo $picture ;?>" alt="User profile picture">
				<?php } else {?>
				
				    <img src="img/missing_profile_pic.png" alt="User profile picture">
				
				<?php } ?>
				<h2 class="travel-status"><?php echo get_travel_status($postcards_shared["count"], $destinations_visited["count"], $destinations_commented["count"]);?></h2>
			</div>
	
			<div class="user-stats-div">
				<ul>
					<li>
						<h2>Postcards shared</h2>
						<p><?php echo $postcards_shared["count"];?></p>
					</li>
					<!-- ------------------------- -->
					<li>
						<h2>Destinations visited</h2>
						<p><?php echo $destinations_visited["count"]; ?></p>
					</li>
					<!-- ------------------------- -->
					<li>
						<h2>Destinations commented</h2>
						<p><?php echo $destinations_commented["count"] ?></p>
					</li>
					<li>
						<h2>% of total destinations</h2>
						<p><?php echo round($percentage, 1); ?></p>
					</li>
					<!-- ------------------------- -->
				</ul>
			</div>
		
			<div class="user-basic-info-div clearfix">
				<ul>
					<li>
						<div class="user-basis-info-text">
							<p class="leftalign">Country:</p>
							<p class="rightalign"><?php echo htmlentities($country); ?></p>
						</div>
					</li>
					<!-- ------------------------- -->
					<li>
						<div class="user-basis-info-text">
							<p class="leftalign">Birth year:</p>
							<p class="rightalign"><?php echo $dob; ?></p>
						</div>
					</li>
					<!-- ------------------------- -->
					<li>
						<div class="user-basis-info-text">
							<p class="leftalign">Gender:</p>
							<p class="rightalign"><?php echo $gender; ?></p>
						</div>
					</li>
					<!-- ------------------------- -->
					<li>
						<div class="user-basis-info-text">
							<p class="leftalign">Favorite destination:</p>
							<p class="rightalign"><?php echo htmlentities($favorite); ?></p>
						</div>
					</li>
					<!-- ------------------------- -->
				</ul>
				
				
			<?php	if(isset($_SESSION['userid']) AND isset($_GET['user']) AND $_SESSION['userid']==$_GET['user']) {?>
		
			<a class="user-edit-info" href="<?php echo BASE_URL;?>userprofile/edit.php"> Update my info!</a> 
			
	  <?php } ?>	
				
				
				
			</div>
			
			<div style="clear: both;">
				
			</div>
			
		</div>
		
		<!-- Here the user information box end and the list saved destinations starts -->
		<?php 
		//displays the saved for later destinations, but only if the user is looking at his own profile
		if(isset($_SESSION['userid']) AND isset($_GET['user']) AND $_SESSION['userid']==$_GET['user']) {?>
		
		<div class="user-checkout-div">
			<h1>Places <?php echo htmlentities($result['FIRSTNAME']);?> want to see</h1>
			<div class="user-check-out-list">
			<?php
			foreach ($saves as $save)
			{ ?>
				
				<a style="text-decoration: none; color: black;" href="<?php echo BASE_URL . "destinations/destinations.php?dest=" . $save['DESTID'];?>">
					<div class="save-for-later-div">
						<img src="<?php echo BASE_URL . "destinations/img/" . $save['DestImg1'] ;?>">
						<h3>	<?php echo $save['Destinationfullname']; ?> </h3>
					</div>
					<div style="clear:both;"></div>			
	  <?php } ?>	
	  </div>		
			<div style="clear:both;"></div>
		</div>
		<?php } 

		?>
		
		
		<div class="user-checkout-div">
			<h1>Places <?php echo htmlentities($result['FIRSTNAME']);?> has been</h1>
			<div class="user-check-out-list">
			<?php

			foreach($destinations_visited_dest as $visit)

			{ ?>
				
				<a style="text-decoration: none; color: black;" href="<?php echo BASE_URL . "destinations/destinations.php?dest=" . $visit['DESTID'];?>">
					<div class="save-for-later-div">
						<img src="<?php echo BASE_URL . "destinations/img/" . $visit['DestImg1'] ;?>">
						<h3>	<?php echo $visit['Destinationfullname']; ?> </h3>
					</div>
					<div style="clear:both;"></div>
				</a>			
	 		 <?php } ?>	

			</div>		
			<div style="clear:both;"></div>
		</div>
		
		
		<div class="user-postcards-wrapper"> 
		
			<div class="user-postcards-header">
				<h1>Postcards</h1>
			</div>
									
		<?php if($postcards != FALSE)
		{ //displays all postcards made by user?>			
	<div class="all-post-cards-container">
	<ul>
	
		<?php foreach($postcards as $story) { ?>
				<li style="width: 100%;">
				<a href="<?php echo BASE_URL . "destinations/destinations.php?dest=" . $story['dest_id']; ?>" style="text-decoration: none; color: black;">
					<div class="stories-container-profile">
					<img src="<?php echo BASE_URL . "stories/pics/upload/" . $story['PICNUMBER'] ;?>">
						<h1> <?php echo $story['NAMEONCARD'];?> , <?php echo $story["Destinationfullname"] . ", " . $story['SEASON'] . " " . $story["YEAR"]; ?></h1>
						<h2> <?php echo $story['HEADLINE'];?></h2>
						<h3> <?php echo $story['TYPE_STORY'];?> <br> <?php echo $story['TYPE_TRIP'];?></h3>
						<p><?php echo $story['OWN_RANKING'];?></p>
						<!--<div class="postcard-like-action">
 							<a href="<?php echo BASE_URL . "stories/like.php?card=" . $story['CARDID'] . "&user=" . $result['USERID']; ?>"><img class="stories-like-button" src="<?php echo BASE_URL . 'img/like.png';?>"></a>
 						</div>
 						-->
					</div>
				</a>
					
				</li>
				
			<?php } ?>
	</ul>			
	</div>
	<div style="clear:both" class="all-post-cards-container">
		<a class="user-add-postcard" href="/stories/upload.php?" >Add postcard</a>  
	</div>
	
	  <?php 
		} 
		else
		{ ?>   
		 	<div style="clear:both" class="all-post-cards-container">   
			<div class="all-post-cards-container">
			<a class="user-add-postcard" href="/stories/upload.php?" >Add postcard</a>  
			</div>
		<?php
		} 
		?>
				
		</div>
		
</div>
		
		
</div>


 
	