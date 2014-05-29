<?php if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		
		require_once("../scripts/config.php");
		require(ROOT_PATH . "scripts/database.php");
		require(ROOT_PATH . "scripts/functions.php");
				
		if (isset($_POST["Long"])) {$Long=1;}else {$Long = 0;}
		if (isset($_POST["Beaches"])) {$Beaches=1;}else {$Beaches = 0;}
		if (isset($_POST["Cityfeel"])) {$Cityfeel=1;}else {$Cityfeel = 0;}
		if (isset($_POST["Partying"])) {$Partying=1;}else {$Partying = 0;}
		if (isset($_POST["Budget"])) {$Budget=1;}else {$Budget = 0;}
		if (isset($_POST["Shopping"])) {$Shopping=1;}else {$Shopping = 0;}
		if (isset($_POST["Museums"])) {$Museums=1;}else {$Museums = 0;}
		if (isset($_POST["Language"])) {$Language=1;}else {$Language = 0;}
		if (isset($_POST["Food"])) {$Food=1;}else {$Food = 0;}
		if (isset($_POST["Nature"])) {$Nature=1;}else {$Nature = 0;}
		if (isset($_POST["Entertainment"])) {$Entertainment=1;}else {$Entertainment = 0;}
		if (isset($_POST["Notourism"])) {$Notourism=1;}else {$Notourism = 0;}
		if (isset($_POST["Security"])) {$Security=1;}else {$Security = 0;}
		
		//echo  $Haultime . $Beaches . $Cityfeel . $Partying . $Budget . $Shopping . $Museums . $Language . $Food . $Nature . $Entertainment . $Notourism . $Security;
		
		try 
		{
		 $dest = $db->query("SELECT * FROM dest");

		} catch (Exception $e) 
		{
			echo "Data could not be loaded from database";
		}
		
		$destinations = $dest->fetchAll(); 
		$x = 0;

		
		foreach ($destinations as $destination) {
			$destinations[$x]['score'] = $destination['Beaches'] * $Beaches + $destination['Cityfeel'] * $Cityfeel + $destination['Budget'] * $Budget + $destination['Shopping'] * $Shopping + $destination['Museums'] * $Museums + $destination['Language'] * $Language + $destination['Food'] * $Food + $destination['Nature'] * $Nature + $destination['Entertainment'] * $Entertainment + $destination['Notourism'] * $Notourism + $destination['Security'] * $Security;
			if (
			($Long == 0)
			&&
			($destination['Haultime'] == "Long")
			) 
			{$destinations[$x]['score'] = 0;};
			$x = $x + 1; 
		}
		
		
		array_sort_by_column($destinations, 'score');
		
		$dest1 = $destinations[1]['DESTID'];
		$dest2 = $destinations[2]['DESTID'];
		$dest3 = $destinations[3]['DESTID'];
		$dest4 = $destinations[4]['DESTID'];
		$dest5 = $destinations[5]['DESTID'];

		
		header("Location: topdestinations.php?dest1=".$dest1."&dest2=".$dest2."&dest3=".$dest3."&dest4=".$dest4."&dest5=".$dest5);

}
else {
	header("Location: destinationguide.php");
	
}
