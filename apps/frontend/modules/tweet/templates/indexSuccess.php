<h3>List of Tweets</h3>
<p>
<strong><?php echo count($pager) ?></strong> available tweets
  <?php if ($pager->haveToPaginate()): ?>
    - currently watching at page <strong><?php echo $pager->getPage() ?></strong> (out of <?php echo $pager->getLastPage() ?> pages)
  <?php endif; ?>
</p>
<?php include_partial('tweet/pagination', array('pager' => $pager, 'urlFor' => 'tweet'))?>
<?php include_partial('tweet/list', array('tweets' => $pager->getResults())) ?>
<?php include_partial('tweet/pagination', array('pager' => $pager, 'urlFor' => 'tweet'))?>