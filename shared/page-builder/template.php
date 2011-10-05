<!DOCTYPE html> 
<html> 
	<head> 
	<title><?php print $tartan->name ?>: The Tartanator</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.js"></script>
	<link rel="stylesheet" href="tartans.css" />
</head> 
<body> 

<div data-role="page" id="<?php print $tartan->get_nicename(); ?>">

	<div data-role="header" data-position="fixed">
    <a href="../tartans.html" rel="prev" data-direction="reverse" data-icon="back" />Back</a>
		<h1><?php print $tartan->name; ?></h1>
	</div><!-- /header -->

	<div data-role="content">
    
	</div><!-- /content -->
	<div data-role="footer" data-position="fixed" data-theme="c">
		Bring forrit the tartan!
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>