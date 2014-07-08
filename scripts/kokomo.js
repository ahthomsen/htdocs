	 function travel_status(c_visited) {
	 	var score = c_visited;
	 	var status = "";
	 	switch (true) {
	 		case (score < 5):
	 			status = 'Travel Rookie';
	 			return status;
	 			break;
	 		case (score < 10):
	 			status = 'Weekend Traveller';
	 			return status;
	 			break;
	 		case (score < 15):
	 			status = 'Tourist';
	 			return status;
	 			break;
	 		case (score < 20):
	 			status = 'Backpacker';
	 			return status;
	 			break;
	 		case (score < 25):
	 			status = 'Globetrotter';
	 			return status;
	 			break;
	 		case (score < 30):
	 			status = 'Explorer';
	 			return status;
	 			break;
	 		case (score < 30000000):
	 			status = 'Indiana Jonas';
	 			return status;
	 			break;
	 		}
	 		
	 	}



	 
	 
		function i_been_already(destid) {
			var dest_text = destid + 'text';
			var dest_already = destid + 'already';
			var dest_pin = destid + 'pin';
			document.getElementById(dest_text).style.display = 'none';
			document.getElementById(dest_pin).onmouseover=null; 
			document.getElementById(dest_pin).onmouseout=null;
			document.getElementById(dest_already).style.display = 'block';
			visits = visits + 1;
			document.getElementById('travel_status').innerHTML = '= ' + travel_status(visits);
			document.getElementById('session_visits').innerHTML = '= ' + visits;
		}
		function already_rec(answer,destid) {
		var feedback = answer;
		var dest_pin = destid + 'pin';
		document.getElementById(dest_pin).style.display = 'none';
		// The function that push information to the php
		var rec = answer;
		var dest_to_save = destid;
		var jqxhr = $.post('<?php echo BASE_URL . "scripts/fronttodb.php";?>',{destid: destid, rec: rec})

        // success
        .done(function (response){
            var obj = $.parseJSON(response);
            if (obj.contentNum !== null) {
                $("#test").text(obj.contentNum);
            }
        })

        // always
        .always(function () {
            // re-enable inputs
         
  		  });
		
		
		}
		function check_out_later(destid) {
		var dest_pin = destid + 'pin';
		document.getElementById(dest_pin).style.display = 'none';
		saved = saved + 1;
		document.getElementById('session_saved').innerHTML = '= ' + saved;
		var dest = destid;
		var save = 1;
		var jqxhr = $.post('<?php echo BASE_URL . "scripts/fronttodb.php";?>',{destid: dest, save: save})
        // success
        .done(function (response){
        })
        // always
        .always(function () {
            // re-enable inputs  
  		  });
		}