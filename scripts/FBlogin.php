	<script>
 
  function kokomoFBlogin() {
  	FB.login(function(response) {
	  if (response.status === 'connected') {
      FB.api('/me', function(response) {
	   var userinfo = response;
	   var userid = userinfo.id;
	   var useremail = userinfo.email;
	   var userfirst = userinfo.first_name;
	   var userlast = userinfo.last_name;
	   var usergender = userinfo.gender;
	  window.location = "../scripts/fbinput.php?userid=" + userid + "&usermail=" + useremail + "&userfirst=" + userfirst + "&userlast=" + userlast + "&usergender=" + usergender ;  
	 });
	  } else if (response.status === 'not_authorized') {
	      	 	location.reload();
	  } else {
	      	 	location.reload();
	  }
	});
  }
  
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1504019866484099',
    cookie     : true,  // enable cookies to allow the server to access 
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

</script>