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
    $sizeInputUI.first().find('input').focus().select();
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