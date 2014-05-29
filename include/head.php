
<!DOCTYPE html>
<html lang="en-US" xml:lang="en-US" xmlns ="http://www.w3.org/1999/xhtml" itemscope itemtype="http://schema.org/Article">
<head>
	<title><?php echo $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">

 	
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/normalize.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css?version=2">
	<link rel="shortcut icon" href="<?php echo BASE_URL; ?>img/kokomo_browser.ico">
	<link href='http://fonts.googleapis.com/css?family=Crafty+Girls' rel='stylesheet' type='text/css'>
	<meta name='description' content='<?php if (!empty($specific_meta)) {echo $specific_meta;} else { echo "Don’t know where to go holiday? Then you need Kokomo. Kokomo is a colorful site that helps you choose among the many travel destinations out there."; } ?>' >
	<?php echo $headinclude ?>
		
	<!-- Update your html tag to include the itemscope and itemtype attributes. -->
	<!-- Place this data between the <head> tags of your website FRONTPAGE-->
	
	<!-- Google Authorship and Publisher Markup -->
	<link rel="author" href="https://plus.google.com/100131789040267284690/posts"/>
	<link rel="publisher" href="https://plus.google.com/100131789040267284690"/>
	
	
	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="<?php echo $title;?>"> 
	<meta itemprop="description" content="<?php if (!empty($specific_meta)) {echo $specific_meta;} else { echo "Don’t know where to go holiday? Then you need Kokomo. Kokomo is a colorful site that helps you choose among the many travel destinations out there."; } ?>" >
	<meta itemprop="image" content="http://kokomoholiday.com/img/kokomo_just_the_k.png">
	
	<!-- Twitter Card data -->
	<meta name="twitter:card" content="<?php if (!empty($specific_meta)) {echo $specific_meta;} else { echo "Don’t know where to go holiday? Then you need Kokomo. Kokomo is a colorful site that helps you choose among the many travel destinations out there."; } ?>" >
	<meta name="twitter:site" content="@KokomoHoliday">
	<meta name="twitter:title" content="Kokomo Holiday">
	<meta name="twitter:description" content=" Dont know where to go on holiday? Then you need Kokomo. Kokomo is a colorful site that helps you choose vacation destination. ">
	<meta name="twitter:creator" content="@KokomoHoliday">
	<!-- Twitter summary card with large image must be at least 280x150px -->
	<meta name="twitter:image:src" content=" http://kokomoholiday.com/img/kokomo_just_the_k.png ">
	
	<!-- Open Graph data -->
	<meta property="og:title" content="<?php echo $title;?>" />
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="http://www.kokomoholiday.com/" />
	<meta property="og:image" content=" http://kokomoholiday.com/img/kokomo_just_the_k.png " />
	<meta property="og:description" content="<?php if (!empty($specific_meta)) {echo $specific_meta;} else { echo "Don’t know where to go holiday? Then you need Kokomo. Kokomo is a colorful site that helps you choose among the many travel destinations out there. "; } ?>" >
	<meta property="og:site_name" content="Kokomo" /> 
	<meta property="fb:admins" content="243373992532018" />
	
	
</head>