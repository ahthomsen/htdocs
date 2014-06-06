
<script>
function submitAnswer() {
console.log(countryArray);
var jsonString = JSON.stringify(countryArray);
$.ajax({        
       type: "POST",
       url: "worldresult.php",
       data: {data : jsonString}, 
       cache: false,
       success: function(){
            alert("OK");
        }
    }); 
	}
</script>


<div class="content-row">
	
	<div class="content-container map-container">
	    <div id="vmap" style="width:100%; height: 300px; position: relative;"></div>
	     <div id="country-count"></div>
	    <div id="world-submit">
		
			<a href="#" onclick="submitAnswer()"> Go! </a>
	
		</div>
		
		<div class="world-zoom">
			Zoom in here
		</div>
	 
    </div>
    
     
    
     <div class="content-container world-country-list">
	    	<h3>Countries selected</h3>
	   <ul id="country-list"></ul>
	</div>
	
</div>


