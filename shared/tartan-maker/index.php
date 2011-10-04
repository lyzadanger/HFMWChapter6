<!DOCTYPE html> 
<html> 
  <head> 
  <title>The Tartanator</title> 
  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 

  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css" />
  <style type="text/css">
/*    .color { 
      padding-left: 30px;
      background-image: -webkit-linear-gradient(90deg,rgba(0,0,0,.3),  transparent);
    }
*/
  </style>

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js"></script>
  <script type="text/javascript">
    // $('[data-role="page"]').live('pagecreate', function() {
    // 
    //      $('label[for^="color1"]').each(function() {
    //        $(this).addClass('color');
    //        var colorValue = $('#' + $(this).attr('for')).val();
    //        $(this).css('backgroundColor', colorValue);
    //      });
    //      $('label[for^="color1"]').click(function() {
    //        $('#size1').focus().select();
    //      });
    //      $('#addcolor').bind('click', function() {
    //        var colorSelected = $('[name="color1"]').filter('[checked="true"]');
    //        var colorValue    = $(colorSelected).val();
    //        var colorID       = $(colorSelected).attr('id');
    //        var colorName     = $('label[for="' + colorID + '"]').text();
    //        var colorSize     = $('#size1').val();
    //        var colorLI = $('<li>' + colorName + ' (' + colorSize + ')</li>');
    //        $(colorLI).data('colorData', { color: colorValue, size: colorSize });
    //        $(colorLI).click(function() { 
    //          $(this).remove(); 
    //          $('ul').listview('refresh'); 
    //        });
    //        $('#colorlist').append(colorLI);
    //        $('ul').listview('refresh');
    //      });
    //      $("#buildtartan").bind('click', function() {
    //        var tartanName = $('#tartan_name').val();
    //        var colors = new Array();
    //        var sizes = new Array();
    //        $('#colorlist li').each(function() {
    //          var colorData = $(this).data('colorData');
    //          colors[colors.length] = colorData.color;
    //          sizes[sizes.length] = colorData.size;
    //        });
    //        var formData = { colors: colors, sizes: sizes, name: tartanName };
    //        $.post('generate.php', formData, function(data) {
    //          var tartanImage = $('<img />');
    //   
    //          tartanImage.attr('src', 'image.php?name=' + data.name + '&width=320');
    //          $('#tartanholder').append(tartanImage);
    //        }, 'json');
    //      });
    //    });
  </script>

</head> 
<body> 

<div data-role="page">

  <div data-role="header">
    <h1>Create your own tartan</h1>
  </div><!-- /header -->

  <div data-role="content">  
    <form method="post" action="generate.php" id="tartanator_form" data-ajax="false">

      <div data-role="fieldcontain">
        <label for="name" id="tartan_name_label">Name the tartan:</label>
        <input type="text" name="name" id="name" />
      </div>

      <?php for ($i = 0; $i < 6; $i++): ?>

        <div class="size" data-role="fieldcontain">
          <label for="size1" id="size1-label">Size</label>
          <input type="text" name="sizes[]" min="2" max="72" value="" id="size1" /> <!-- range -->
        </div>

        <div class="color" data-role="fieldcontain">
          <label for="color1" class="select">Color:</label>
          <select name="colors[]" id="color1">
            <option value=""></option>
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

      <div data-role="fieldcontain">
        <input type="hidden" name="redirect_to_image" value="true">
        <input type="submit" data-role="button" name="addcolor" id="addcolor" value="Add This Color" data-icon="plus" />
      </div>

      <ul data-role="listview" data-inset="true" id="colorlist">
      </ul>

      <div data-role="fieldcontain">
        <input type="submit" name="buildtartan" id="buildtartan" value="Make it!" data-role="button" />
      </div>

    </form>
    
    <div id="tartanholder">
    
    </div>

  </div><!-- /content -->

</div><!-- /page -->

</body>
</html>