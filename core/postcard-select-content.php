
<div class="content-row">
	
		<div>
			<div style="background: white;" class="search-top-div" >
				<div >
				<h1 style="color: black"><?php echo $cardtitle;?></h1>
				</div>
			</div>
		</div>
		
		<div class="content-contrainer-narrow-blank">
			 <a href="<?php echo BASE_URL . "destinations/destinations.php?dest=" . $selectcard['DESTID']; ?>" style="text-decoration: none; color: black;">
					<div class="stories-container">
					<img src="<?php echo BASE_URL . "stories/pics/upload/" . $selectcard['PICNUMBER'];?>">
						<h3> <?php echo $selectcard['TYPE_STORY'];?> <br> <?php echo $selectcard['TYPE_TRIP'];?></h3>
						<p><?php echo $selectcard['OWN_RANKING'];?></p>
						<!-- <div class="postcard-like-action">
 							<a href="<?php echo BASE_URL . "stories/like.php?card=" . $selectcard['CARDID'] . "&user=" . $result['USERID']; ?>"><img class="stories-like-button" src="<?php echo BASE_URL . 'img/like.png';?>"></a>
 						</div>
 						-->
					</div>
				</a>
		</div>
		<div style="clear:both"></div>
		
		<div class="content-container-narrow">
		<ul>
   			<li>
    			<h2>Send to select friends: </h2>
   				<div class="fb-send"  style="float: right; margin: 5px 5px;" data-href="<?php echo 'http://kokomoholiday.com'.BASE_URL.'stories/selected.php?cardid=' . $cardnumber ;?>" data-width="50px" data-colorscheme="light"></div>				
   			</li>
   			<!--    --  new item   -->   		
   			<li>
   				<h2>Shared with group of friends: </h2>
   				<div class="fb-share-button"  style="float: right; margin: 5px 5px;" data-href='<?php echo "http://kokomoholiday.com".BASE_URL."stories/selected.php?cardid=" . $cardnumber ;?>' data-type="button"></div>			
   			</li>
   			<!--    --  new item   -->   		   				
   		</ul>
   		<div style="clear:both"></div>
		</div>
		
		<div style="clear:both"></div>
		
		<?php if ($includeuser == 1) { ?>
		<div class="content-container-narrow">
			<h2 class="anchor-middle-orange"><a class="anchor-middle-orange" href="<?php echo BASE_URL . "userprofile/userprofile.php?user=" . $selectuser['USERID'];?>">Postcard posted by <?php echo $selectuser['FIRSTNAME'] . " " . $selectuser['LASTNAME'];?></a></h2>
		</div>
		<?php } ?>
		
		<div style="clear:both"></div>
		
		<div class="content-container-narrow">
			<div class="fb-comments" data-numposts="5" data-width="100%" data-href="http://kokomoholiday.com<?php echo BASE_URL.'stories/stories.php?cardid='.$cardnumber?>" data-numposts="5" data-colorscheme="light"></div>
		</div>
		
</div>

 <div class="random_button_show">
 <a href="<?php echo BASE_URL;?>stories/selected.php">More!</a>
 </div>