<!DOCTYPE html> 
<html> 
	<head> 
	<title><?php print $tartan->name ?>: The Tartanator</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js"></script>
	<link rel="stylesheet" href="tartans.css" />
</head> 
<body> 

<div data-role="page" id="<?php print $tartan->get_nicename(); ?>">

	<div data-role="header">
    <a href="../tartans.html" rel="prev" data-icon="back" />Back</a>
		<h1><?php print $tartan->name; ?></h1>
	</div><!-- /header -->

	<div data-role="content">
    
	</div><!-- /content -->

	<div data-role="footer" data-position="fixed">
		<h4>Bring forrit the tartan!</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>