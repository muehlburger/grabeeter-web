<h2>Tweets</h2>		  
<p class="subheader">
	<strong><?php echo count($pager) ?> available Tweets | </strong><em>Page <?php echo $pager->getPage() ?> of <?php echo $pager->getLastPage() ?></p> 
<p>
  <?php if ($pager->haveToPaginate()): ?>
  <?php endif; ?>
</p>
<?php include_partial('tweet/pagination', array('pager' => $pager, 'urlFor' => 'tweet'))?>
<?php include_partial('tweet/list', array('tweets' => $pager->getResults())) ?>
<?php include_partial('tweet/pagination', array('pager' => $pager, 'urlFor' => 'tweet'))?>