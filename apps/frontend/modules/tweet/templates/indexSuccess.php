<?php slot('sidebar')?>
  <?php if (is_null($screenName)): ?>
  <h2>Information</h2>
  <ul>
  	<li><?php echo count($pager) ?> stored Tweets</li>
  </ul>
  <?php else: ?>
    <h2><?php echo $screenName ?></h2>
  <ul>
  	<li><?php echo count($pager) ?> stored Tweets</li>
  </ul> 
  <?php endif; ?>
<?php end_slot() ?>

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