
<div class="content-row">
	<form action="edit.php" method="post" enctype="multipart/form-data" >
		<div class="edit-user-div">
			
			<h1> Edit your user information:</h1>
		
			<label for="firstname" class="register-text">First name</label>
			<input type="text" class="register-fields" name="firstname" id="firstname"   value="<?php echo $user['FIRSTNAME'];?>">
			<!------------------------------------------------->
			
			<label for="lastname" class="register-text">Last name</label>
			<input type="text" class="register-fields" name="lastname" id="lastname" value="<?php echo $user['LASTNAME'];?>">
			
			<!-- -------- TO DO : DROP DOWN MENU WITH COUNTRIES-->
			<label for="country" class="register-text">Country</label>
			<input type="text"  class="register-fields" name="country" id="country" value="<?php echo $user['COUNTRY'];?>">
			<!------------------------------------------------->
			
			<p class=""></p>
			<!-- -------- TO DO : DROP DOWN MENU WITH YEARS -->
			<label for="dob" class="register-text">Year of birth</label>
			<input type="text" class="register-fields" name="dob" id="dob" value="<?php echo $user['DAYOFBIRTH'];?>">
			<!------------------------------------------------->
			
			<label for="dob" class="register-text">New profile picture</label>
			<input type="file" class="register-fields" name="picture" id="dob" value="Select new profile picture">
			
			
			<!-- -------- TO DO : SELECT CORRECT BUTTON IF USER'S GENDER IS KNOWN -->
			
			
			
			<label for="favorite" class="register-text">Favorite destination</label>
			<input type="text" class="register-fields" name="favorite" id="favorite"  value="<?php echo $user['FAV_DEST'];?>">
			
			<!------------------------------------------------->
			
			<p class="register-text">Gender</p>
			<div class="register-fields">
				<label for="male" class="">Male</label>
				<input type="radio" name="gender" value="Male" id="male" class="">
				<label for="female" class="">Female</label>
				<input type="radio" name="gender" value="Female" id="female" class="">
			</div>
			
			<div style="clear:both">
				<p><?php echo $error_msg ;?></p>
				
				</div>
		
		</div>
		
		<input type="submit" class="edit-user-button" value="Save!">
	
	</form>
</div>