


<p><?php echo $message;?></p>  <!------- A message to users who aren't signed in -->

<!---- ERROR MESSAGES (defined in destinations/comments.php)
$error = "heading"  if heading is empty
$error = "paragraph" if paragraph is empty
--> 

<div class="content-row">
	<form method="post" action="comment.php">
		<div class="comment-container-div">
			<h1>Post a comment on <?php echo $dest_name_output['Destinationfullname'];?></h1>
			<div>
				<!--- HIDDEN INPUT CONTAINING DESTINATION ID ---->
				<input type="text" name="destination" style="display:none;" value="<?php echo $destid?>">
				
				<label class="comment-header-text" for="header">Headline</label>
				<input type="text" class="comment-header-field" name="header" class="" id="header">
				
				<label class="comment-content-text" for="paragraph" class="">Comment</label>	
				<textarea name="paragraph" class="comment-content-field"></textarea>
				<p><?php echo $errormessage ?></p>
			</div>
		</div>
		<div>
			<input class="register-button" type="submit" value="Go!">
		</div>
	</form>
</div>

