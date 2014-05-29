<?php
require(ROOT_PATH . "scripts/functions.php");
require(ROOT_PATH . "scripts/database.php");
$destinations_db = $db->query("SELECT * from dest");
$destinations = $destinations_db->fetchAll();


//destination_db_combined() ;?>


<div class="content-row" style="margin-bottom: 40px">
	
	<?php foreach($destinations as $destination) { ?>
	<div class="dest-show-topline" style="margin-bottom: 5px;">
		<a style="text-decoration: none; color: black; font-size: 0.8em;" href="<?php echo BASE_URL;?>destinations/destinations.php?dest=<?php echo $destination['DESTID'];?>"><h1><?php echo $destination["Destinationfullname"]; ?></h1></a>
	</div>
	<?php } ?>

 </div>
	
