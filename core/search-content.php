
<div class="content-row">
	
		<div>
			<div class="search-top-div content-area3">
				<div >
				<h1>Where to?</h1>
				</div>
			</div>
		</div>
		
		<div class="search-main-search-div">
			<form action="<?php echo BASE_URL;?>search/search.php" method="get">
				<div class="search-field-div">
					
						<label>
							<input class="search-bar-main" type="text" name="searchtext" value="Search for destinations and stories" id="searchtext" onfocus="javascript:this.value=''" onblur="javascript:if(this.value.length === 0){this.value='Search for destinations and stories'}">
							<input class="search-submit-main" type="submit" value="Go!">
						</label>
						
			 	</div>
			 </form>
		</div>
		
			
			<div class="search-error-box <?php echo $search_error;?>">
				<h1 style="<?php echo $no_results;?>"> No destinations or stories match your search term</h1>
				<h1 style="<?php echo $no_input;?>"> Please provide a valid search term</h1>
			</div>
	
</div>