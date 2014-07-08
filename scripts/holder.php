    $Beaches = 0;
	$Cityfeel = 0;
	$Partying = 0;
	$Budget = 0;
	$Shopping = 0;
	$Museums = 0;
	$Active = 0;
	$Language = 0;
	$Food = 0;
	$Nature = 0;

	foreach ($destrec as $dest) {
		$Beaches = $Beaches + $dest['Beaches'];
		$Cityfeel = $Cityfeel + $dest['Cityfeel'];
		$Partying = $Partying + $dest['Partying'];
		$Budget = $Budget + $dest['Budget'];
		$Shopping = $Shopping + $dest['Shopping'];
		$Museums = $Museums + $dest['Museums'];
		$Active = $Active + $dest['Active'];
		$Language = $Language + $dest['Language'];
		$Food = $Food + $dest['Food'];
		$Nature = $Nature + $dest['Nature'];
	};
	
	$Beaches = $Beaches / $totals;
	$Cityfeel = $Cityfeel / $totals;
	$Partying = $Partying / $tatals;
	$Budget = $Budget / $totals;
	$Shopping = $Shopping / $totals;
	$Museums = $Museums / $totals;
	$Active = $Active / $totals;
	$Language = $Language / $totals;
	$Food = $Food / $totals;
	$Nature = $Nature / $totals;
	