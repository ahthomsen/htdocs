<body>
	
<!-- Google Analytics tacking ID -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50864215-1', 'kokomoholiday.com');
  ga('send', 'pageview');

</script>

<!-- The Facebook SDK Javascript loeader -->
	
	<div id="fb-root"></div>
 
	<!-- Facebook Javascrip plugin -->
	
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/da_DK/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


	
	
	<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TRTWM9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TRTWM9');</script>
<!-- End Google Tag Manager -->


	<div class="main-wrapper">
		<header class="main-header">
		<div class="header-container top">
			<h1 class="main-logo top"><a href="<?php echo BASE_URL;?>">kokomo</a></h1>
			<ul class="main-nav group top">
				<li class="nav-search-li">
					<form action="<?php echo BASE_URL;?>search/search.php" method="get" class="header-search">
						<input class="header-search-bar" type="text" name="searchtext" id="searchtext" value="Search.." onfocus="javascript:this.value=''" onblur="javascript:if(this.value.length === 0){this.value='Search..'}">
						<input class="header-search-submit" value=" " type="submit">
					</form>				
				</li>
				<li class="nav-menu-li"><a href="#">Menu</a>
					<ul class="nav-dropdown">
						
						<?php if (isset($_SESSION['userid'])) {?>
						<li><a href="<?php echo BASE_URL;?>users/logout.php">Log out</a></li>
						<li><a href="<?php echo BASE_URL;?>userprofile/userprofile.php?user=<?php echo $_SESSION['userid'];?>">My user profile</a></li>
						<?php	}
						
						else { ?>
							
							<li><a href="<?php echo BASE_URL;?>users/login.php">Login</a></li>
							<li><a href="<?php echo BASE_URL;?>users/register.php">Register user</a></li>
						<?php } ?> 
						
						<li><a href="<?php echo BASE_URL;?>destinationguide/destinationguide.php">Destination-Helper</a></li>
						<li><a href="<?php echo BASE_URL;?>stories/stories.php">Postcards</a></li>
						<li><a href="<?php echo BASE_URL;?>search/search.php">Search</a></li>
						<li><a href="<?php echo BASE_URL;?>destiny/destiny.php">Suggestions</a></li>
						<li><a href="<?php echo BASE_URL;?>stories/upload.php">Upload postcards</a></li>
						
						<li><a href="<?php echo BASE_URL;?>partners/partners.php">Partners</a></li>
						
						<!-- <a href="<?php echo BASE_URL;?>tc/login.php"><li>Term & Conditions</li></a> -->
						<li><a href="<?php echo BASE_URL;?>about/about.php">About</a></li>
						<!--<a href="<?php echo BASE_URL;?>career/career.php"><li>Career</li></a>-->
						<li><a href="<?php echo BASE_URL;?>destinations/destinationlist.php">Destination List</a></li>
						<li><a href="<?php echo BASE_URL;?>contact/contact.php">Contact</a></li>
					</ul>

				</li>
				<?php if (isset($_SESSION['userid']) && $_SESSION['userid'] > 0) {?>
					
				<li class="nav-login-li logged-in-me"><a href="<?php echo BASE_URL;?>userprofile/userprofile.php?user=<?php echo $_SESSION['userid'];?>">Me!</a></li>
				
				<?php	}
				else  { ?>
					
					<li class="nav-login-li"><a href="<?php echo BASE_URL;?>users/login.php">Login</a></li>
					
				<?php } ?>
				
				
			</ul>
		</div>
	</header>