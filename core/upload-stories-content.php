<?php 
if(isset($_SESSION['userid']))
{
	try {
		$username = $db->prepare("SELECT FIRSTNAME FROM user WHERE USERID=?");
		$username->bindParam(1, $_SESSION['userid']);
		$username->execute();
		$fetch = $username->fetch();
		$name = $fetch['FIRSTNAME'];
	}	
	catch (Exception $e)
	{
		die("An error occurred while trying to retrieve data from the database");
	}

}

if(isset($_GET['dest']))
{
	try
	{
		$destname = $db->prepare("SELECT Destinationfullname FROM dest WHERE DESTID=?");
		$destname->bindParam(1, $_GET['dest']);
		$destname->execute();
		$fetch = $destname->fetch();
		$dest = $fetch['Destinationfullname'];
	}

	catch(Exception $e)
	{
		die("An error occurred while trying to retrieve data from the database" . $e);
	}
}
?>

<div class="content-row">
	<form method="post" action="upload.php" enctype="multipart/form-data">	
		<div class="user-content-bow story-upload-container">
		<h1 class="stories-upload-header">Upload your own postcard</h1>
			 <ul>
			 	<li>
					<label for="nameoncard" class="register-text">
						Sender of postcard:			
					 </label>
					 <input class="register-fields" type="text" value="<?php echo $name;?>" id="nameoncard" name="nameoncard">
				</li>
				<!-- next item -->
			 	<li>
					<label for="destination" class="register-text">
						Destination:			
					 </label>
					 <input class="register-fields" type="text" value="<?php echo $dest;?>" id="destination" name="destination">
				</li>
				<!-- next item -->
				<li>
				<label for="year" class="register-text">
						Year:			
					 </label>
					 
					 <select class="register-fields" id="year" name="year" >
					 	<option value="1900">Before 2000</option>
					 	<option value="2000">2000</option>
					 	<option value="2001">2001</option>
					 	<option value="2002">2002</option>
					 	<option value="2003">2003</option>
					 	<option value="2004">2004</option>
					 	<option value="2005">2005</option>
					 	<option value="2006">2006</option>
					 	<option value="2007">2007</option>
					 	<option value="2008">2008</option>
					 	<option value="2009">2009</option>
					 	<option value="2010">2010</option>
					 	<option value="2011">2011</option>
					 	<option value="2012">2012</option>
					 	<option value="2013">2013</option>
					 	<option value="2014">2014</option>
					 	<option value="2015">2015</option>
					 </select>
				</li>
				<!-- next item -->
				<li>
				<label for="season" class="register-text">Season:			
				</label>
					 <select class="register-fields" id="season" name="season">
					 	<option value="Winter">Winter</option>
					 	<option value="Spring">Spring</option>
					 	<option value="Summer">Summer</option>
					 	<option value="Autumn">Autumn</option>
					 </select>
				</li>
				<!-- next item -->
				<li>
				<label for="headline" class="register-text">
						Headline on postcard:			
					 </label>
					 <input class="register-fields" type="text" value="<?php echo $headline;?>" id="headline" name="headline">
				</li>
				<!-- next item -->
				<li>
					<label for="story_tag" class="register-text">
						Postcard tags e.g Beaches, Sun:			
					 </label>
					 <input class="register-fields" type="text" value="" id="story_tag" name="story_tag">
				</li>
				<!-- next item -->
				<li>
					<label for="picture" class="register-text">
						Picture on postcard:			
					 </label>
					 <input class="register-fields" type="file" value="destination" id="picture" name="picture">
				</li>
				<!-- next item -->
				<li>
					<label for="typeoftrip" class="register-text">	
						Type of trip:	
					 </label>
					  <select class="register-fields" id="year" name="typeoftrip" >
					 	<option value="Active holiday">Active holiday</option>
					 	<option value="Charter">Charter</option>
					 	<option value="Citybreak">Citybreak</option>
					 	<option value="Skiing">Skiiing</option>
					 	<option value="Exploration">Exploration</option>
					 	<option value="Shopping trip">Shopping trip</option>
					 	<option value="Beach and booze">Beach and booze</option>
					 	<option value="Winetrip">Winetrip</option>
					 	<option value="Weekned getaway">Weekend getaway</option>
					 	<option value="Entertainment">Entertainment time</option>
					 	<option value="Nature adventure">Nature adventure</option>
					 	<option value="Big city">Big city</option>
					 	<option value="Pure business">Pure business</option>
					 	<option value="Other">Other</option>
					 </select>
				</li>
				<!-- next item -->
				<li>
					<label for="typeofstory" class="register-text">
						Crew:			
					 </label>
					  <select class="register-fields" id="year" name="typeofstory" >
					 	<option value="Family">Family</option>
					 	<option value="Friends">Friends</option>
					 	<option value="Couple">Couple</option>
					 	<option value="Single">Single</option>
					 	<option value="One man wolf pack">One man wolf pack</option>
					 	<option value="Group">Group</option>
					 	<option value="Othere">Other</option>
					 </select>
				</li>
				<!-- next item -->
				<li>
				<label for="own_ranking" class="register-text">
						Own ranking of trip:			
					 </label>
					<select class="register-fields" id="own_ranking" name="own_ranking">
					 	<option value="1">1 - Horrible!</option>
					 	<option value="2">2</option>
					 	<option value="3">3</option>
					 	<option value="4">4</option>
					 	<option value="5">5 - Okay!</option>
					 	<option value="6">6</option>
					 	<option value="7">7</option>
					 	<option value="8">8</option>
					 	<option value="9">9</option>
					 	<option value="10">10 - Great!</option>						 						 						 						 						 	
					 </select>
				</li>
				<!-- next item -->
		
			</ul>
			<div style="clear:both"></div>
			<div class="upload-error-box" style="clear: both; <?php if($error_msg == "") {echo "display: none;";}?>">	
				<p><?php echo $error_msg;?></p>
			</div>
		</div>
		<input type="hidden" name="action" value="upload"> 
		<input class="register-button" type="submit" value="Go!">
	</form>

	
</div>