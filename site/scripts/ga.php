<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50151351-2', 'kokomoholiday.com');
  ga('send', 'pageview');
  <?php if (isset($_SESSION['userid'])) { ?> ga(‘set’, ‘&uid’, '<?php echo $_SESSION['userid'];?>'); <?php } ?>

</script>