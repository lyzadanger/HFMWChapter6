<?php
require_once('config.php');
require_once('../tartan-maker/tartan.inc');

/* Iterate over XML files */
$icondir = TARTAN_ICON_DIR;
$dir = TARTAN_XML_DIR;
$css = '';
$tartan_list = array();
$last_tartan_letter = '';
if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if(strpos($file, 'xml') !== FALSE) {
        
          /** MAGIC HAPPENS HERE **/
          $name = substr($file, 0, strpos($file, '.xml'));
          $tartan = new LyzaTartan($name);
          $ok = $tartan->from_xml($dir . $file);
          if ($ok) {
            $tartan->set_dynamic_scale(240);
            $icon_name = $tartan->get_nicename() . '.png';
            $tartan->image(TRUE, FALSE, $icondir . $icon_name);
            ob_start();
            include('template.php');
            $string = ob_get_clean();
            $fp = fopen(TARTAN_PAGE_DIR . $tartan->get_nicename() . '.html', 'w+');
            if ($fp) {
              fwrite($fp, $string);
              fclose($fp);
            }
            ob_end_flush();
            $letter_start = substr($tartan->name, 0, 1);
            $new_letter = false;
            if (!$last_tartan_letter || ($letter_start != $last_tartan_letter)) {
              $new_letter = true;
            }
            $tartan_list[$tartan->name] = array('icon' => 'tartans/icons/' . $icon_name, 
                                                'link' => 'tartans/' . $tartan->get_nicename() . '.html',
                                                'separator' => $new_letter,
                                                'letter'    => $letter_start);
            $last_tartan_letter = $letter_start;
            $css .= sprintf("#%s { background-image:url('icons/%s'); }\n", $tartan->get_nicename(), $icon_name);
          }
          
        }
      }
      closedir($dh);
      /** CSS **/
      if ($css) {
        $fp = fopen(TARTAN_PAGE_DIR . 'tartans.css', 'w+');
        if ($fp) {
          // egregious bit o'hackery here
          fwrite($fp, '[data-role="footer"] { text-align: center; padding: 5px 0;}');
          // OK, that's over
          fwrite($fp, $css);
          fclose($fp);
        }
      }
      /** List variant 1 **/
      if (sizeof($tartan_list)) {
        ob_start();
        include('list_template.php');
        $string = ob_get_clean();
        $fp = fopen(TARTAN_PAGE_DIR . '../tartans.html', 'w+');
        if ($fp) {
          fwrite($fp, $string);
          fclose($fp);
        }
      }
      /** List variant 2 **/
      if (sizeof($tartan_list)) {
        ob_start();
        include('separated_list_template.php');
        $string = ob_get_clean();
        $fp = fopen(TARTAN_PAGE_DIR . '../tartans_separated.html', 'w+');
        if ($fp) {
          fwrite($fp, $string);
          fclose($fp);
        }
      }      
  }
}