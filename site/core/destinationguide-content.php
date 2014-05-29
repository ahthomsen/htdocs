
<div class="content-row">
	
		<div class="dist-guide-header">
			<div class="content-area1 front-box">
				<div class="box-text" >
				<a>Find your dream destination</a>
				<p>Tailor your next experience by checking-off all the most important characteristics of your next experience</p>
				</div>
			</div>
		</div>
		
		<form id="dest-guide-form" action="<?php echo BASE_URL;?>destinationguide/dest-guide-submit.php" method="post">
			<div class="dist-guide-form">
				
			<!-- <label> -->
					<div class="input-beaches dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/longhaul.png" title="Click this parameter if you don't mind 5+ hours in a plane. " >
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> I don't mind long plane flights</p>
				      </div>
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Long" name="Long">
				      
				      </div>
					</div>
		<!--		</label>	-->			

				
				<label>
					<div class="input-beaches dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/beaches.png" title="Click this parameter, if you are planning to spent time on the beach. " >
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> I need quality beaches</p>
				      </div>
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Beaches" name="Beaches">
				      
				      </div>
					</div>
				</label>
				
								<label>
					<div class="input-cityfeel dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/cityfeel.png" title="Use this option if you disagree that Cleveland is the same as New York City – only smaller. ">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> I miss the atmosphere of big cities</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Cityfeel" name="Cityfeel">
				      
				      </div>
					</div>
				</label>

				
				<label>
					<div class="input-partying dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/partying.png" title="Whether it be bars, clubs, pubs or other, click here if you are planning to do a lot of partying">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p>Going out partying is crucial</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Partying" name="Partying">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-budget dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/budget.png" title="Use this option is money is a little tight currently. No one has to know">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> I'm on a tight budget</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Budget" name="Budget">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-shopping dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/shopping2.png" title="Click here if you plan to bring home extra luggage filled with new stuff.">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> I am going to do a lot of shopping</p>
				      </div>
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Shopping" name="Shopping">
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-museums dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/museum.png" title="Time to act if you are fascinated by museums, older architecture, historic landmarks, or something else along that line.">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p>Culture and museums are key</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Museums" name="Museums">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-active dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/active.png" title="Watersports, cycling, hiking, fitness, swimming and more are all covered by this category. Get fit. ">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> Im looking for a active holiday</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Active" name="Active">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-language dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/language.png" Title="Minimize the odds of being lost in translation by clicking here">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> People must speak some English </p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Language" name="Language">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-food dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/food.png" title="Make sure to click, if discovering new parts of the world also mean discovering the best their kitchens has to offer.">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p>High quality cuisine is crucial</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Food" name="Food">
				      
				      </div>
					</div>
				</label>
				
								<label>
					<div class="input-nature dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/nature.png" title="Whether you prefer rock climbing or just walks in green surroundings highlight here. ">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p>Great nature is a must </p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Nature" name="Nature">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-entertainment dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/entertainment.png" title="If amusement parks, theatres, sport events or similar is one of your main reasons to hop on a plane you need to click here. ">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p>Entertainment is mandatory</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Entertainment" name="Entertainment">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-notourism dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/notourism.png" title="Tired of having other tourists cramping your style? You know what to do by now.">
				      </div>
				      <div class="input-div-text input-div">
				     	 	<p> I stay clear of very touristic places</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Notourism" name="Notourism">
				      
				      </div>
					</div>
				</label>
				
				<label>
					<div class="input-security dist-guide-input-box">
				      <div class="input-div-img input-div">
				    	  	<img src="<?php echo BASE_URL;?>img/security4.png" title="Want to eliminate even the slightest chance of criminal activities you have to enable this.">
				      </div>
				      <div class="input-div-text input-div" title=”>
				     	 	<p>I prefer destinations with no crime</p>
				      </div >
				      <div class="input-div-checkbox input-div">
				     	 	<input class="dist-guide-input-check" type="checkbox" value="1" id="Security" name="Security">
				      
				      </div>
					</div>
				</label>
				
				
				
			  </div>

			
			<div class="dist-guide-form-submit">
				
						<input class="dist-guide-submit-bottom" type="submit" value="Go!">
				
						
			</div>
			
		</form>
	
</div>