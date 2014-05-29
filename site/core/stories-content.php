<?php

//$stories_db = stories_db_localhost();
require(ROOT_PATH . "scripts/database.php");

//if a specified destination is selected only show postcards from that destination (limit 10)
if(isset($_GET['dest']))
{
	try {
	$destid = $_GET['dest'];
	$stories_db = $db->prepare("SELECT *
	FROM postcards JOIN dest ON postcards.DESTID = dest.DESTID WHERE dest.DESTID=?
	ORDER by rand() LIMIT 5");
	$stories_db->bindParam(1, $destid);
	$stories_db->execute();
	$stories = $stories_db->fetchAll();
	}
	catch (Exception $e) 
	{
		echo "Could not coneect to database";
		die($e);
	}
}
//else load all the postcards (limit 10)
else 
{
	try {
	$stories_db = $db->query("SELECT *
	FROM postcards JOIN dest ON postcards.DESTID = dest.DESTID
	ORDER BY rand() LIMIT 5");
	$stories = $stories_db->fetchAll();	
	}
	catch (Exception $e) 
	{
		echo "Could not coneect to database";
		die($e);
	}
}

?>




<div class="content-row">
	
	<div class="stories-top-header clearfix">
				<div class="" >
				<h1>Postcards uploaded by users</h1>
				</div>
	</div>
	<div class="all-post-cards-container"></div>
	<ul class="all-post-cards-container-ul">
	
		<?php foreach($stories as $story) { ?>
				<li>
				<a href="<?php echo BASE_URL . "stories/selected.php?cardid=" . $story['CARDID']; ?>" style="text-decoration: none; color: black;">
					<div class="stories-container">
					<img src="<?php echo BASE_URL . "stories/pics/upload/" . $story['PICNUMBER'];?>">
						<h1> <?php echo $story['NAMEONCARD'];?> , <?php echo $story["Destinationfullname"] . ", " . $story['SEASON'] . " " . $story["YEAR"]; ?></h1>
						<h2> <?php echo $story['HEADLINE'];?></h2>
						<h3> <?php echo $story['TYPE_STORY'];?> <br> <?php echo $story['TYPE_TRIP'];?></h3>
						<p><?php echo $story['OWN_RANKING'];?></p>
						<!-- <div class="postcard-like-action">
 							<a href="<?php echo BASE_URL . "stories/like.php?card=" . $story['CARDID'] . "&user=" . $result['USERID']; ?>"><img class="stories-like-button" src="<?php echo BASE_URL . 'img/like.png';?>"></a>
 						</div>
 						-->
					</div>
				</a>
					
				</li>
				
			<?php } ?>

	</ul>	
		
		<div style="clear:both;"></div>
	</div>
	
	 <div class="random_button_show">
 	<a href="<?php echo BASE_URL;?>stories/stories.php">More!</a>

 </div>
	
</div>