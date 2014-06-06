<?php
session_start();
$title = "Kokomo: World Traveler Challange";
//$headinclude = "<link rel='stylesheet' href='/css/style.css?version=1'>";
		include_once("../scripts/config.php");
		include_once("../scripts/functions.php");
		
		include( ROOT_PATH . "include/head.php");?>

    <link href="jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../scripts/jquery.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <script src="jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="jqvmap/data/jquery.vmap.sampledata.js"></script>

    <script type="text/javascript">
    jQuery(document).ready(function() {
    countryCount = 0;
    document.getElementById('country-count').innerHTML = countryCount;
    countryArray = [];
    countryList = "";
    function addcountry(region) {
    	var land = region;
    	if ($.inArray(land, countryArray) == -1) {
    		countryArray.push(land);
    		countryCount = 1 + countryCount;
	      	countryList = '<li>' + region + '</li>' + countryList;
	        document.getElementById('country-count').innerHTML = countryCount;
	        document.getElementById('country-list').innerHTML = countryList;
    	}
    	else {
    		var besked = "Country already added to your list";
    		alert(besked);
    	}	
    }
   
    
    jQuery('#vmap').vectorMap(
	{
    map: 'world_en',
    backgroundColor: '#FFFFFF',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    color: '#333333',
    enableZoom: true,
    hoverColor: '#c9dfaf',
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: null,
    showTooltip: true,
    values: sample_data,
    onRegionClick: function(element, code, region)
    {	
		addcountry(region);
    }
});
    });
    

    </script>
 <?php 
		include( ROOT_PATH . "include/header.php") ;
		include( ROOT_PATH . "core/worldchallenge-content.php") ;
		include( ROOT_PATH . "include/footer.php") ;?>	

