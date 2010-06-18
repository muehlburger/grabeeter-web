{"responseData": { "results": [<?php $nb = count($tweets); $i = 0; foreach ($tweets as $url => $tweet): ++$i ?>
{"url":"<?php echo $url ?>", <?php $nb1 = count($tweet); $j = 0; foreach ($tweet as $key => $value): ++$j ?>
<?php $json->$key = $value; ?>
"<?php echo $key ?>":<?php echo json_encode($value).($nb1 == $j ? '' : ',') ?>
<?php endforeach; ?>
}<?php echo $nb == $i ? '' : ',' ?>
<?php endforeach; ?>
]}}