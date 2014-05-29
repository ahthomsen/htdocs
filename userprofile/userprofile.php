<?php 
session_start();

	
include_once("../scripts/config.php");
include_once(ROOT_PATH . "scripts/database.php");
require(ROOT_PATH . "scripts/functions.php");
$title = "Your personal user profile";
$headinclude = "<link rel='stylesheet' href='/css/user.css'>" . "<link rel='stylesheet' href='/css/stories.css'>";

		//HIDES EDIT BUTTON PER DEFAULT
		$hidden = ' style="display:none;"';
		//CHECK TO SEE IF PAGE REQUEST IS FOR ANOTHER USER
		//AND SET USERID TO REQUESTED USER PROFILE
		if(isset($_GET["user"]))
		{
			$userid = $_GET["user"];
		}
		//CHECKS IF USER ISN'T LOGGED IN
		//AND ALSO NOT USING A VALID LINK
		// AND REDIRECTS TO INDEX 
		else if(isset($_SESSION["userid"])==FALSE)
		{
			header("Location: ../index.php");
			exit;
		}
		//SETS THE USERID TO OWN AND DISPLAYS THE EDIT BUTTON
		else
		{
			$userid = $_SESSION['userid'];
			$hidden = "";
		}
		
		try
		{
			$results = $db->prepare("SELECT COUNTRY, GENDER
			, FIRSTNAME, LASTNAME, MIDDLENAME, DAYOFBIRTH, PROFILEPIC
			, FAV_DEST FROM user WHERE USERID = ? LIMIT 1");
			$results->bindParam(1, $userid);
			$results->execute();
			$result = $results->fetch();
		}
		catch (Exception $e)
		{
			die("An error occurred while trying to retrieve data from the database");
		}
				
		if($result == FALSE) //USER PROFILE DOES NOT EXIST IN DB
		{
			header("Location: ../index.php");
			exit;
		}
		
		
		$name = $result["FIRSTNAME"] . " " . $result["LASTNAME"];
		
		if($result["LASTNAME"] == "N/A")
		{ $name = $result["FIRSTNAME"];}
		
		$country = $result["COUNTRY"];
		$dob = $result["DAYOFBIRTH"];
		$gender = $result["GENDER"];
		$favorite = $result["FAV_DEST"];
		$picture = $result["PROFILEPIC"];
		
		if($result['PROFILEPIC']==FALSE OR $result['PROFILEPIC']=="N/A")
		{$picture = "mig.png";}
		
		try{
			$postcards = $db->prepare("SELECT COUNT(*) AS count FROM postcards WHERE USERID=?");
			$postcards->bindParam(1, $userid);
			$postcards->execute();
			$postcards_shared = $postcards->fetch();
			
			$postcards_db = $db->prepare("SELECT NAMEONCARD, YEAR, HEADLINE, SEASON
							, POSTPICTURE, OWN_RANKING, PICNUMBER
							, TYPE_STORY, TYPE_TRIP
							, Destinationfullname, dest.DESTID AS dest_id
							FROM postcards JOIN dest ON postcards.DESTID = dest.DESTID
							WHERE postcards.USERID = ? LIMIT 10;");
			$postcards_db->bindParam(1, $userid);
			$postcards_db->execute();
			$postcards = $postcards_db->fetchAll();
	
							
			$been = $db->prepare("SELECT COUNT(*) AS count FROM been_there WHERE USERID=?");
			$been->bindParam(1, $userid);
			$been->execute();
			$destinations_visited = $been->fetch();
			
			// Get the full array of destinations
			
			$been_dest = $db->prepare("SELECT Destinationfullname, DestImg1, dest.DESTID as dest_id FROM been_there JOIN dest ON been_there.DESTID = dest.DESTID WHERE been_there.USERID = ?");
			$been_dest->bindParam(1, $userid);
			$been_dest->execute();
			$destinations_visited_dest = $been_dest->fetchall();
			
			
			$total_db = $db->query("SELECT COUNT(*) AS count FROM dest");
			$total_fetch = $total_db->fetch();
			$percentage = $destinations_visited['count'] / $total_fetch['count'] * 100;
			
			$comments = $db->prepare("SELECT COUNT(*) AS count FROM dest_comment WHERE USERID=?");
			$comments->bindParam(1, $userid);
			$comments->execute();
			$destinations_commented = $comments->fetch();
			
			$saves_db = $db->prepare("SELECT * FROM save_for_later JOIN dest ON save_for_later.DESTID = dest.DESTID WHERE USERID=? ORDER BY dest.Destinationfullname");
			$saves_db->bindParam(1, $userid);
			$saves_db->execute();
			$saves = $saves_db->fetchAll();
			
	
			
		}
		catch (Exception $e)
		{
			die("An error occured while trying to retrieve data from the database");
		}
		

		
		
		include( ROOT_PATH . "include/head.php");
		include( ROOT_PATH . "include/header.php") ;
		include( ROOT_PATH . "core/userprofile-content.php") ;
		include( ROOT_PATH . "include/footer.php") ;?>	
