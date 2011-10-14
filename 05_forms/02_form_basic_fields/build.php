<!DOCTYPE html> 
<html> 
  <head> 
  <title>The Tartanator</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.css" />
  <link ref="stylesheet" href="tartans/tartans.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.js"></script>
</head> 
<body> 

<div data-role="page">
  <div data-role="header" data-position="fixed">
    <h1>Tartan Builder</h1>
  </div><!-- /header -->

  <div data-role="content">  
  
    <form id="tartanator_form">
      <ul data-role="listview" id="tartanator_form_list">
      <li data-role="list-divider">Tell us about your tartan</li>
      <li data-role="fieldcontain">
        <label for="tartan_name">Tartan Name</label>
        <input type="text" name="name" id="tartan_name" placeholder="Tartan Name" />
      </li>
      <li data-role="fieldcontain">
        <label for="tartan_info">Tartan Info</label>
        <textarea cols="40" rows="8" name="tartan_info" id="tartan_info" placeholder="Optional tartan description or info"></textarea>
      </li>
    </ul>
    <div data-role="fieldcontain">
      <input type="submit" name="buildtartan" id="buildtartan" value="Make it!" data-role="button" />
    </div>
    </form>
    
  </div><!-- /content -->

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar"> 
			<ul> 
				<li><a href="index.html" data-icon="info">About</a></li> 
				<li><a href="findevent.html" data-icon="star">Events</a></li> 
				<li><a href="tartans.html" data-icon="grid" class="ui-btn-active">Tartans</a></li> 
			</ul> 
		</div><!-- /navbar --> 
	</div><!-- /footer -->
	
</div><!-- /page -->

</body>
</html>