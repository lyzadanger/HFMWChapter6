<?php
require_once('config.php');
require_once('tartan.inc');
if ($_GET['name']) {
  $tartan = new LyzaTartan($_GET['name']);
  $filename = TARTAN_XML_DIR . $_GET['name'] . '.xml';
  $ok = $tartan->from_xml($filename);
  if (isset($_GET['width'])) {
    $tartan->set_dynamic_scale($_GET['width']);
  }
  $tartan->image(TRUE);
}