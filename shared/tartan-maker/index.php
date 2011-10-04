<!DOCTYPE html> 
<html> 
  <head> 
  <title>The Tartanator</title> 
  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 

  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.css" />
  <style type="text/css">
    .color { 
      padding-left: 30px;
      background-image: -webkit-linear-gradient(90deg,rgba(0,0,0,.3),  transparent);
    }
  </style>

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/1.0b3/jquery.mobile-1.0b3.min.js"></script>
  <script type="text/javascript">
    $('[data-role="page"]').live('pagecreate', function() {

      $('label[for^="color1"]').each(function() {
        $(this).addClass('color');
        var colorValue = $('#' + $(this).attr('for')).val();
        $(this).css('backgroundColor', colorValue);
      });
      $('label[for^="color1"]').click(function() {
        $('#size1').focus().select();
      });
      $('#addcolor').bind('click', function() {
        var colorSelected = $('[name="color1"]').filter('[checked="true"]');
        var colorValue    = $(colorSelected).val();
        var colorID       = $(colorSelected).attr('id');
        var colorName     = $('label[for="' + colorID + '"]').text();
        var colorSize     = $('#size1').val();
        var colorLI = $('<li>' + colorName + ' (' + colorSize + ')</li>');
        $(colorLI).data('colorData', { color: colorValue, size: colorSize });
        $(colorLI).click(function() { 
          $(this).remove(); 
          $('ul').listview('refresh'); 
        });
        $('#colorlist').append(colorLI);
        $('ul').listview('refresh');
      });
      $("#buildtartan").bind('click', function() {
        var tartanName = $('#tartan_name').val();
        var colors = new Array();
        var sizes = new Array();
        $('#colorlist li').each(function() {
          var colorData = $(this).data('colorData');
          colors[colors.length] = colorData.color;
          sizes[sizes.length] = colorData.size;
        });
        var formData = { colors: colors, sizes: sizes, name: tartanName };
        $.post('generate.php', formData, function(data) {
          var tartanImage = $('<img />');
   
          tartanImage.attr('src', 'image.php?name=' + data.name + '&width=320');
          $('#tartanholder').append(tartanImage);
        }, 'json');
      });
    });
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
        <label for="tartan_name" id="tartan_name_label">Name the tartan:</label>
        <input type="text" name="tartan_name" id="tartan_name" />
      </div>
      <div data-role="fieldcontain">
        <label for="size1" id="size1-label">Size</label>
        <input type="range" name="size1" min="2" max="72" value="2" id="size1" />
      </div>
      <div data-role="fieldcontain">

        <input type="radio" name="color1" id="color1-option-1" value="#000000" />
        <label for="color1-option-1" id="color1-option-1-label" >Black</label>
        <input type="radio" name="color1" id="color1-option-2" value="#ff3344" />
        <label for="color1-option-2" id="color1-option-2-label" >Rose</label>
        <input type="radio" name="color1" id="color1-option-3" value="#00cc00"  />
        <label for="color1-option-3" id="color1-option-3-label" >Lt. Green</label>
        <input type="radio" name="color1" id="color1-option-4" value="#B0E0E6"  />
        <label for="color1-option-4" id="color1-option-4-label" >Lt. Blue</label>
        <input type="radio" name="color1" id="color1-option-5" value="#cc9966"  />
        <label for="color1-option-5" id="color1-option-5-label" >Lt. Tan</label>
        <input type="radio" name="color1" id="color1-option-6" value="#ffec00"  />
        <label for="color1-option-6" id="color1-option-6-label" >Yellow</label>

        <input type="radio" name="color1" id="color1-option-7" value="#ffffff" />
        <label for="color1-option-7" id="color1-option-7-label" >White</label>
        <input type="radio" name="color1" id="color1-option-8" value="#cc0000" />
        <label for="color1-option-8" id="color1-option-8-label" >Red</label>
        <input type="radio" name="color1" id="color1-option-9" value="#008000"  />
        <label for="color1-option-9" id="color1-option-9-label" >Green</label>
        <input type="radio" name="color1" id="color1-option-10" value="#274086"  />
        <label for="color1-option-10" id="color1-option-10-label" >Blue</label>
        <input type="radio" name="color1" id="color1-option-11" value="#996600"  />
        <label for="color1-option-11" id="color1-option-11-label" >Tan</label>
        <input type="radio" name="color1" id="color1-option-12" value="#65295f"  />
        <label for="color1-option-12" id="color1-option-12-label" >Purple</label>

        <input type="radio" name="color1" id="color1-option-13" value="#cccccc" />
        <label for="color1-option-13" id="color1-option-13-label" >Grey</label>
        <input type="radio" name="color1" id="color1-option-14" value="#660000" />
        <label for="color1-option-14" id="color1-option-14-label" >Dk. Red</label>
        <input type="radio" name="color1" id="color1-option-15" value="#126846"  />
        <label for="color1-option-15" id="color1-option-15-label" >Bluegreen</label>
        <input type="radio" name="color1" id="color1-option-16" value="#001144"  />
        <label for="color1-option-16" id="color1-option-16-label" >Dk. Blue</label>
        <input type="radio" name="color1" id="color1-option-17" value="#663300"  />
        <label for="color1-option-17" id="color1-option-17-label" >Brown</label>
        <input type="radio" name="color1" id="color1-option-18" value="#FF8C00"  />
        <label for="color1-option-18" id="color1-option-18-label" >Orange</label>

        <input type="radio" name="color1" id="color1-option-19" value="#5b6333" />
        <label for="color1-option-19" id="color1-option-19-label" >Olive</label>
        <input type="radio" name="color1" id="color1-option-20" value="#29292b" />
        <label for="color1-option-20" id="color1-option-20-label" >V.Dk. Blue</label>
        <input type="radio" name="color1" id="color1-option-21" value="#3c516c" />
        <label for="color1-option-21" id="color1-option-21-label" >Dk. Slate</label>

    </div>

    <div data-role="fieldcontain">
      <input type="button" data-role="button" name="addcolor" id="addcolor" value="Add This Color" data-icon="plus" />
    </div>
    <ul data-role="listview" data-inset="true" id="colorlist">

    </ul>
    <div data-role="fieldcontain">
      <input type="button" name="buildtartan" id="buildtartan" value="Make it!" data-role="button" />
    </div>
    </form>
    
    <div id="tartanholder">
    
    </div>

  </div><!-- /content -->

</div><!-- /page -->

</body>
</html>