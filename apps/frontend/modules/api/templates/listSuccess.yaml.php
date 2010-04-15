<?php foreach ($tweets as $url => $tweet): ?>
-
  url: <?php echo $url ?>
 
<?php foreach ($tweet as $key => $value): ?>
  <?php echo $key ?>: <?php echo sfYaml::dump($value) ?>

<?php endforeach; ?>
<?php endforeach; ?>