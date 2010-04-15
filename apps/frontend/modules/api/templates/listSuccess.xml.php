<?xml version="1.0" encoding="utf-8"?>
<tweets>
<?php foreach ($tweets as $url => $tweet): ?>
  <tweet url="<?php echo $url ?>"<?php foreach ($tweet as $key => $value): ?> <?php echo $key ?>="<?php echo $value ?>"<?php endforeach; ?>/>
<?php endforeach; ?>
</tweets>