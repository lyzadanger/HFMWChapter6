<?php
require('config.php');
require('tartan.inc');

$name = $_POST['name'];
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
$tartan->set_dynamic_scale(300);
$tartan->set_stripe_size($stripe);

$xml = $tartan->to_xml();

if ($_POST['redirect_to_image'] == "true") {
  header('Location:  /image.php?name=' . $_POST['name'] . '&width=320');
  exit();
} else {
  print json_encode(array('name' => $tartan->get_nicename()));
}
?>
