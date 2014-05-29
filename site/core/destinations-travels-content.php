<?php

//first draft for been there-destinations list:
//simply generates a list of links from database
//RUTHLESS PRAGMATISM!

//EXTRA FEATURES TO BE ADDED: display already known travel location differenty ie. different color

$destinations_db = $db->prepare("SELECT DESTID, Destinationfullname FROM dest ORDER BY DESTID ASC");
$destinations_db->execute();
$destinations = $destinations_db->fetchAll();

?>
<h1>Where have you been?</h1>
<ul>
<?php
foreach ($destinations as $destination)
{ ?>
	<li>
		<a href="<?php echo BASE_URL . "destinations/beenthere.php?dest=" . $destination['DESTID'];?>">
			<?php echo $destination["Destinationfullname"];?>
		</a>
	</li>
<?php
}
?>


</ul>