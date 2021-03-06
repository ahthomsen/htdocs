<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
	
<script>
  // This is called with the results from from FB.getLoginStatus().

function kokomoFBlogout() {
	FB.logout();
	document.getElementById('status').innerHTML = '<a href="fblogin.php"" href="#">Confirm Logout</a>';
     };
   
  
  function kokomoFBlogin() {
  	FB.login(function(response) {
	  if (response.status === 'connected') {
	     		location.reload();
	  } else if (response.status === 'not_authorized') {
	      	 	location.reload();
	  } else {
	      	 	location.reload();
	  }
	});
  }
  
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      document.getElementById('status').innerHTML = '<a onclick="kokomoFBlogout()" href="#">Logout</a>';
      FB.api('/me', function(response) {
	   var userinfo = response;
	   var userid = userinfo.id;
	   var useremail = userinfo.email;
	   var userfirst = userinfo.firstname;
	   var userlast = userinfo.lastname;
	   window.location = "fbinput.php?userid=" + userid + "&mail=" + useremail + "&userfirst=" + userfirst ;
	 });
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = '<a onclick="kokomoFBlogin()" href="#">Login</a>';
    } else {
      // The person is not logged into Facebook, so we're not sure if the are logged into Kokomo;
	 document.getElementById('status').innerHTML = '<a onclick="kokomoFBlogin()" href="#">Login</a>';
		 }
	};


  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1504019866484099',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
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

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.

</script>


<div>
	<a> Login via Facebook </a>
</div>



<div id="status">
</div>

</body>
</html>