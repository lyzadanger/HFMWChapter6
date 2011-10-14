<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>
<?php 
  $filestrings = array();
  $filestrings[] = 'Plas-yn-Iâl';
  $filestrings[] = 'Counter Point-Point';
  $filestrings[] = "Henry's Folly!";
  $filestrings[] = 'Oh: ? Yes';
  foreach($filestrings as $fs):
?>
<h3>Test String</h3>
<p>Untouched in HTML: <?php print $fs; ?></p>
<p>Stripslashes: <?php print stripslashes($fs); ?></p>
<p>Url-encoded: <?php print urlencode($fs); ?></p>
<p>Re-decoded: <?php print urldecode(urlencode($fs)); ?></p>
<p>Double url-decoded: <?php print urldecode($fs); ?></p>
<p>Replaced: <?php print preg_replace('/[\?:\s]/', '-', $fs); ?></p>

<?php endforeach; ?>


<h3>UTF-8</h3>
<?php echo utf8_decode('Test Plas-yn-I&#xE2;l'); ?>
</body>
</html>