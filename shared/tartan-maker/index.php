<!DOCTYPE html> 
<html> 
  <head> 
  <title>The Tartanator</title> 
  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 

  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css" />
  <style type="text/css" media="screen">
    #colorlist li {
      background-image: -webkit-linear-gradient(90deg,rgba(0,0,0,.3),  transparent);
      cursor: pointer;
      padding-bottom: 0.7em;
      padding-top: 0.7em;
      padding-left: 30px;
      text-shadow: none;
    }
    #colorlist li a {
      position: absolute;
    }
    #colorlist li .ui-li {
      border-top: 0;
    }
    #add-color-container {
      display: none;
    }
    .placeholder {
      color: #999;
    }
    .ui-field-contain {
      border: none;
      padding: 0.5em;
    }
    select {
      /* prevent iOS zoom problem */
      font-size: 1em;
    }
  </style>

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js"></script>
</head> 
<body> 

<div data-role="page">

  <div data-role="header">
    <h1>Create your own tartan</h1>
  </div><!-- /header -->

  <div data-role="content">  
    <form method="post" action="generate.php" id="tartanator_form">

      <div data-role="fieldcontain">
        <label for="tartan_name">Tartan Name</label>
        <input type="text" name="name" id="tartan_name" placeholder="Tartan Name" />
      </div>

      <?php for ($i = 0; $i < 6; $i++): ?>
        <div class="size-input" data-role="fieldcontain">
          <label for="size-<?php $i ?>">Size</label>
          <input id="size-<?php $i ?>" type="range" min="2" max="72" autocomplete="false" name="sizes[]" value="" placeholder="Size" />
        </div>

        <div class="color-input" data-role="fieldcontain">
          <label class="select" for="color-<?php $i ?>">Color</label>
          <select name="colors[]" for="color-<?php $i ?>">
            <option value="" class="placeholder">Select a Color</option>
            <option value="#000000">Black</option>
            <option value="#ff3344">Rose</option>
            <option value="#00cc00">Lt. Green</option>
            <option value="#B0E0E6">Lt. Blue</option>
            <option value="#cc9966">Lt. Tan</option>
            <option value="#ffec00">Yellow</option>
            <option value="#ffffff">White</option>
            <option value="#cc0000">Red</option>
            <option value="#008000">Green</option>
            <option value="#274086">Blue</option>
            <option value="#996600">Tan</option>
            <option value="#65295f">Purple</option>
            <option value="#cccccc">Grey</option>
            <option value="#660000">Dk. Red</option>
            <option value="#126846">Bluegreen</option>
            <option value="#001144">Dk. Blue</option>
            <option value="#663300">Brown</option>
            <option value="#FF8C00">Orange</option>
            <option value="#5b6333">Olive</option>
            <option value="#29292b">V.Dk. Blue</option>
            <option value="#3c516c">Dk. Slate</option>
          </select>
        </div>
      <?php endfor; ?>

      <div data-role="fieldcontain" id="add-color-container">
        <input type="button" data-role="button" name="addcolor" id="addcolor" value="Add This Color" data-icon="plus" />
      </div>

      <ul data-role="listview" data-inset="true" id="colorlist"></ul>

      <div data-role="fieldcontain">
        <input type="hidden" name="redirect_to_image" value="true">
        <input type="submit" name="buildtartan" id="buildtartan" value="Make it!" data-role="button" />
      </div>

    </form>
    
    <div id="tartanholder">
    
    </div>

  </div><!-- /content -->

</div><!-- /page -->

<script type="text/javascript" charset="utf-8">
  (function () {

    var $colorList, $submitFormBtn, $sizeInputUI, $colorInputUI, $nameInput;

    // pagecreate fires before jQuery Mobile manipulates the DOM
    $('[data-role="page"]').live('pagecreate', function () {
      jQuery.ajaxSettings.traditional = true;

      // Only show one set of inputs. 
      // We'll dynamically handle everything else with the "add color" button
      $('.color-input:not(:first), .size-input:not(:first)').remove();
      $('#add-color-container').show();
      $('#addcolor').click(onAddColor);
    });

    // pageinit fires after jQuery Mobile DOM elements are ready to go
    $('[data-role="page"]').live('pageinit', init);

    function init () {
      $colorList     = $('#colorlist');
      $submitFormBtn = $('#buildtartan').parents('.ui-btn');
      $sizeInputUI   = $('.size-input');
      $colorInputUI  = $('.color-input');
      $nameInput     = $('#tartan_name');

      $submitFormBtn.add('label').hide();
      $colorList.click(onColorListChange);
      setColorSelectStyle();

      $colorInputUI.change(setColorSelectStyle);
      $('#tartanator_form').submit(onFormSubmit);
    }

    // User clicks the "add color" button
    function onAddColor (evt) {
      var form   = $(this).closest('form'),
          select = form.find('select'),
          name   = select.find(':selected').text(),
          hex    = select.val(),
          size   = form.find('.size-input input').val();

      if (hex && size) {
        addColor(name, size, hex);
        onColorListChange();
      } else {
        alert('Please select a size and color.');
      }
      return false;
    };

    // Upate the DOM with the new color
    function addColor (colorName, colorSize, colorValue) {
      var colorItem = [
        '<li data-role="button" data-icon="delete" style="background:', colorValue,
        '; color:', (isDarkColor(colorValue) ? '#fff' : '#000'),
        '">', colorName, ' (', colorSize + ')',
        '<input type="hidden" name="colors[]" value="', colorValue, '">',
        '<input type="hidden" name="sizes[]" value="', colorSize, '">',
        '<a data-role="button" data-icon="delete"></a>',
        '</li>'].join('');
      $colorList.append(colorItem);
      $colorInputUI.find('select').val('').selectmenu('refresh');
      $sizeInputUI.find('input').val('2').slider('refresh');
      onColorListChange();
    };

    // Called when the list of added colors changes
    // e.g., when adding a new color or deleting an existing one
    function onColorListChange (deleteClickEvent) {
      var $li;

      if (deleteClickEvent) $li = $(deleteClickEvent.target).closest('li').remove();

      $submitFormBtn[$colorList.find('li').length ? 'show' : 'hide']();
      $colorList.listview('refresh'); 
      setColorSelectStyle();
    };

    function onFormSubmit () {
      var url;
      if (!$nameInput.val() || !$colorList.find('li').length) {
        alert('Please name your tartan & add some colors.');
        return false;
      }
      url = $(this).attr('action');
      // Append the name as a GET param as well, to support
      // re-rendering the page when user hits the forward button
      $(this).attr('action', url + '?name=' + $nameInput.val() + '&width=300');
      $('[name=redirect_to_image]').val('false');
      return true;
    };

    // Set the background color of the select widget to match the color value
    function setColorSelectStyle () {
      var backgroundHex = $colorInputUI.find('select').val();
      $colorInputUI.find('.ui-btn').css({
        'background': backgroundHex || '',
        'color'     : isDarkColor(backgroundHex) ? '#fff' : '#000'
      });
    };

    // Given a hex value, do a dirty calculation to indicate whether 
    // black or white should be used as a contrast
    function isDarkColor (hex) {
      var sum;
      if (!hex) return false;
      hex = hex.match(/[^#]+/)[0];
      if (hex.length == 3) hex += hex;
      sum = parseInt(hex.substr(0,2), 16) + parseInt(hex.substr(2,2), 16) + parseInt(hex.substr(4,2), 16);
      return (sum / 3) < 128;
    };

    // Despite the docs (http://jquerymobile.com/test/docs/api/events.html), 
    // jQuery Mobile doesn't trigger pageinit when the DOM loads
    // and pagecreate is triggered too early (DOM elements not ready)
    // Until that's fixed, we'll manually fire pageinit on DOM ready
    $(function () {
      $('[data-role="page"]').trigger('pageinit');
    });


  }());
  
</script>

</body>
</html>