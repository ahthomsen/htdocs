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
<div class="content-row">
	
	<div class="dest-show-topline">
		<h1><?php echo $destination; ?></h1>
		<?php if (!empty($ibeenthere)) {?>
			
		<img src="<?php echo BASE_URL . 'img/ibeenthere.png';?>" class="dest-been-there-check" >
		
		<?php } else { ?>
		
		<a class="dest-been-there-text" href="<?php echo BASE_URL . "destinations/beenthere.php?dest=" . $_GET['dest'] . $random; ?>"> I been already</a>
		
		<?php } ?>
		
	</div>
	
	<div class="dest-show-main-content">

			<p><?php echo $results_dest["DestText"] ?></p>
		
	</div>
	
	<div class="dest-show-main-picture">
			<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $results_dest['DestImg1']; ?>" alt="<?php echo $destination;?>">
			<div style="position: relative"></div>
			<img src="<?php echo BASE_URL; ?>destinations/img/<?php echo $results_dest['DestImg2']; ?>" alt="<?php echo $destination;?>">
			
	</div>
	
	 <div class="dest-kokomo-stats-div">
   		  <ul>
   			<li>
   				<h2>User visits</h2>
   				<p><?php echo $visits['count']; ?></p>
   			</li>
   			<!--    --  new item   -->
   			<li>
   				<h2>Postcards shared</h2>
   				<p><?php echo $postcards; ?></p>
   			</li>
   			<!--    --  new item   -->   	
   			<li>
   				<h2>Comments posted</h2>
   				<p><?php echo $comment_count; ?></p>   				
   			</li>
   			<!--    --  new item   -->   	
   			<li>
    			<h2>Saved for checkout</h2>
   				<p><?php echo $savedforlater; ?></p>  				
   			</li>
   			<!--    --  new item   -->
   			<li>
    			<h2>Send to select friends: </h2>
   				<div class="fb-send"  style="float: right; margin: 5px 5px;" data-href='<?php echo "http://kokomoholiday.com/destinations/destinations.php?dest=" . $_GET['dest'] . "&random=1" ;?>' data-width="50px" data-colorscheme="light"></div>				
   			</li>
   			<!--    --  new item   -->   		
   			<li>
   				<h2>Shared with group of friends: </h2>
   				<div class="fb-share-button"  style="float: right; margin: 5px 5px;" data-href='<?php echo "http://kokomoholiday.com/destinations/destinations.php?dest=" . $_GET['dest'] . "&random=1" ;?>' data-type="button"></div>				
   			</li>
   			<!--    --  new item   -->   		   				
   		</ul>
   		
   		 <div style="clear: both;"></div>
   		 
   
   </div>
   
   	<div class="dest-show-partnership">
		<h1>Look for hotels at our partner:</h1>
		<ul>
			<li>
				<a href="<?php echo $results_dest['BookinglinkBrowser'];?>">
					<img style="margin-bottom: 15px" src="<?php echo BASE_URL; ?>img/bookingcom.jpeg" rel="no follow" alt="Booking.com Partnership Link" title="Click here to visit our partners hotels within this destinations">
				</a>
			</li>	
		</ul>
	</div>
	
	<?php if(($stories_input[0]['CARDID'])) {?>
		
 	<div style="margin-bottom: 120px;" class="stories-container-div">
		<ul class="all-post-cards-container-ul">>
		
			<?php 

			 foreach($stories_input as $story) { ?>
				<li style="width: 100%; margin-right: 2%;">
			
					<div class="stories-container">
			
					<img src="<?php echo BASE_URL . "stories/pics/upload/" . $story['PICNUMBER'];?>">
						<h1> <?php echo $story['NAMEONCARD'];?> , <?php echo $story["Destinationfullname"] . ", " . $story['SEASON'] . " " . $story["YEAR"]; ?></h1>
						<h2> <?php echo $story['HEADLINE'];?></h2>
						<h3> <?php echo $story['TYPE_STORY'];?> <br> <?php echo $story['TYPE_TRIP'];?></h3>
						<p><?php echo $story['OWN_RANKING'];?></p>
						<!-- <div class="postcard-like-action">
 							<a href="<?php BASE_URL . 'stories/like.php?card=' . $story['CARDID'] . '&user=' . $_GET['dest']; ?>"><img class="stories-like-button" src="<?php echo BASE_URL . 'img/like.png';?>"></a>
 						</div>
 						-->
					</div>
				</li>
				
			<?php } ?>
	
		</ul>	
		
	</div>
	
	<?php } ?>
	
	<?php if($comment[0]['count']!=0) { ?>
	
		 <div class="dest-comment-container">
			<ul class="dest-comment-container-ul">
			
		<?php //code block that generates a comment html output
		//for each comment in the $comment array
	
		foreach($comment as $element)
		{			
			if($element['USERID']==FALSE)$element['FIRSTNAME']='Anonymous';
			?>
				<li>
				<div class="dest-comments-div">
				<h2><?php echo htmlentities($element["HEADER"]);?></h2>
				<h3><?php echo htmlentities($element["PARAGRAPH"]);?></h3>
				<p><?php echo htmlentities($element["FIRSTNAME"]) . ', ' . $element["DATE"];?></p>				
				</div>				
				</li>	
			<?php		 
		}	 
		?>		
		
		
		
			</ul>	
		
		</div>
	
	<?php } ?>
	
	<div class="cc-links-div">
   		  <ul>
   			<li>
   				<p><a href="<?php echo $results_dest['Cclink1'];?>">Photo</a> by <?php echo $results_dest['Ccname1'] ;?>, <a href="http://creativecommons.org/licenses/by/2.0/"> CC BY 2.0</a></p>
   			</li>
   			<!--    --  new item   -->
   			<li>
   				<p><a href="<?php echo $results_dest['Cclink2'];?>">Photo</a> by <?php echo $results_dest['Ccname2'] ;?>, <a href="http://creativecommons.org/licenses/by/2.0/"> CC BY 2.0</a></p>
   			</li>
   			<!--    --  new item   -->   	   			   				
   		</ul>
   </div>
	
	<div style="clear:both; height: 150px;"></div>
		
</div>
	
 
 
 <!-- After the actual  content -->
 
 <?php 
 /*
 //checks if user is using random dest function and if so,
 //notifies save_for_later and been_there pages
 if(isset($_GET['random']) AND $_GET['random']==1)
 {
 	$random = "&random=1";
 } */
 ?>
 
 <div class="random_button_show">
 	<a href="<?php echo BASE_URL;?>destiny/destiny.php">Next!</a>

 </div>
 
 <div class="dest-border-actions comment" >
 	<a href="<?php echo BASE_URL . "destinations/comment.php?dest=" . $_GET['dest'];?>">Add comment</a>
 </div>
	
 <div class="dest-border-actions postcard" >
 	<a href="<?php echo BASE_URL . "stories/upload.php?dest=" . $_GET['dest'];?>">Add postcard</a>
 </div>
	
 <div class="dest-border-actions save" >
 	<a href="<?php echo BASE_URL . "destinations/saveforlater.php?dest=" . $_GET['dest'] . $random;?>">Save for later</a>
 </div>
 	
	
  <div class="dest-border-actions beenthere" >
 	<a href="<?php echo BASE_URL . "destinations/beenthere.php?dest=" . $_GET['dest'] . $random; ?>">I've been there!</a>
 </div>
 

 <!-- <div class="dest-border-actions rank" >
 	<a href="/#">Rank this place</a> -->
 </div>