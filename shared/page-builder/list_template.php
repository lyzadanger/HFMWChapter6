<!DOCTYPE html> 
<html> 
	<head> 
	<title>The Tartanator</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js"></script>
  <link rel="stylesheet" href="tartans/tartans.css" />
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
	  <a href="index.html" rel="prev" data-icon="back" />Back</a>
		<h1>Favorite Tartans</h1>
	</div><!-- /header -->

	<div data-role="content">	
    <ul data-role="listview">
      <?php foreach($tartan_list as $name => $info): ?>
        <li><a href="<?php print $info['link']; ?>">
          <img src="<?php print $info['icon']; ?>" alt="<?php print $name; ?>" />
          <h3><?php print $name; ?></h3>
        </a></li>
      <?php endforeach; ?>
    </ul>
	</div><!-- /content -->

	<div data-role="footer">
		<h6>Bring forrit the tartan!</h6>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>