<?php
require_once('config.php');
require_once('tartan.inc');
$icondir = '/Users/lyzadanger/Documents/dev/tartans/images/tartans/icons/';
$dir = TARTAN_XML_DIR;
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
          if(strpos($file, 'xml') !== FALSE) {
            $name = substr($file, 0, strpos($file, '.xml'));
            $tartan = new LyzaTartan($name);
            $ok = $tartan->from_xml($dir . $file);
            if ($ok) {
              $tartan->set_dynamic_scale(160);
              $tartan->image(TRUE, FALSE, $icondir . $name . '-icon.png');
            }
          }
        }
        closedir($dh);
    }
}