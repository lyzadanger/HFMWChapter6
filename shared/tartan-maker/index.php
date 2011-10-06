<!DOCTYPE html> 
<html> 
  <head> 
  <title>The Tartanator</title> 
  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css" />
  <link rel="stylesheet" href="styles.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js"></script>
</head> 
<body> 

<div data-role="page">

  <div data-role="header">
    <h1>Tartan Builder</h1>
    <a href="dialogs/howto.html" data-rel="dialog" data-icon="info" class="ui-btn-right" data-role="button" data-theme="b">How To</a>
  </div><!-- /header -->

  <div data-role="content">  
    <form method="post" action="generate.php" id="tartanator_form">
      <ul data-role="listview" data-theme="c">
      <li data-role="list-divider">Tell us about your tartan</li>
      <li data-role="fieldcontain">
        <label for="tartan_name">Tartan Name</label>
        <input type="text" name="name" id="tartan_name" placeholder="Tartan Name" />
      </li>
      <li data-role="fieldcontain">
        <label for="tartan_info">Tartan Info</label>
        <textarea cols="40" rows="8" name="tartan_info" id="tartan_info" placeholder="Optional tartan description or info"></textarea>
      </li>
      <li data-role="list-divider">Build your colors</li>
      
      <?php for ($i = 0; $i < 6; $i++): // 6 fields if non-JS ?>
        <li class="color-input" data-role="fieldcontain">
          <label class="select" for="color-<?php print $i ?>">Color</label>
          <select name="colors[]" for="color-<?php print $i ?>" >
            <option value="" class="placeholder">Select a Color</option>
            <option value="#000000">Black</option>
            <option value="#ffffff">White</option>
            <option value="#cccccc">Light Grey</option>
            <option value="#666666">Dark Grey</option>
            <option value="#cc0000">Red</option>
            <option value="#660000">Dark Red</option>
            <option value="#FFB6C1">Light Rose</option>
            <option value="#ff3344">Rose</option>
            <option value="#FF8C00">Orange</option>
            <option value="#FFD700">Gold</option>            
            <option value="#ffec00">Yellow</option>
            <option value="#9ACD32">Yellow Green</option>
            <option value="#5b6333">Olive</option>
            <option value="#00cc00">Light Green</option>
            <option value="#8FBC8F">Light Grey Green</option>
            <option value="#008000">Green</option>
            <option value="#126846">Blue Green</option>
            <option value="#B0E0E6">Light Blue</option>
            <option value="#274086">Blue</option>
            <option value="#3c516c">Dark Slate Blue</option>
            <option value="#001144">Dark Blue</option>
            <option value="#29292b">Very Dark Blue</option>
            <option value="#4B0082">Indigo</option>
            <option value="#8A2BE2">Blue Violet</option>
            <option value="#65295f">Purple</option>
            <option value="#cc9966">Light Tan</option>
            <option value="#996600">Tan</option>
            <option value="#663300">Brown</option>
          </select>
        </li>

        <li class="size-input" data-role="fieldcontain">
          <label for="size-<?php print $i ?>">Stitch Count</label>
          <input id="size-<?php print $i ?>" type="range" min="2" step="2" max="72" autocomplete="false" name="sizes[]" value="2" placeholder="Size" />
        </li>
      <?php endfor; ?>

      <li data-role="fieldcontain" id="add-color-container">
        <input type="button" data-role="button" name="addcolor" id="addcolor" value="Add This Color" data-icon="plus" />
      </li>
    </ul>

      <ul data-role="listview" data-inset="true" id="colorlist">
      </ul>

      <div data-role="fieldcontain">
        <input type="hidden" name="redirect_to_image" value="true">
        <input type="submit" name="buildtartan" id="buildtartan" value="Make it!" data-role="button" />
      </div>

    </form>
    
    <div id="tartanholder">
    
    </div>

  </div><!-- /content -->

</div><!-- /page -->

<script type="text/javascript" language="JavaScript" src="colors.js"></script>
</body>
</html>