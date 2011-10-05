<?php
require('config.php');
require('tartan.inc');

$name = $_POST['name'];
$width = 300;
$stripe = 2;
$sett = array();
for($i=0; $i < sizeof($_POST['colors']); $i++) {
  // check for submitted blank values
  if ($_POST['colors'][$i] && $_POST['sizes'][$i]) {
    $sett[] = array('color' => $_POST['colors'][$i],
                    'count' => $_POST['sizes'][$i]);
  }
}
$tartan = new LyzaTartan($name, $sett, 1);
$tartan->set_dynamic_scale($width);
$tartan->set_stripe_size($stripe);

$xml = $tartan->to_xml();

// Support jQuery Mobile automatic ajax "caching"
if (empty($name)) {
  $name = $_GET['name'];
}

$redirect_path = ($_POST['redirect_to_image'] == "true") ? 'image.php' : 'post_create.php';
header('Location:  /' . $redirect_path . '?name=' . $name . '&width=' . $width);
exit();

