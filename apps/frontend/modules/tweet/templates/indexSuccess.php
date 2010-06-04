<?php slot('sidebar')?>
  <?php if (is_null($screenName)): ?>
  <h2>Information</h2>
  <ul>
  	<li>Stored Tweets: <?php echo count($pager) ?></li>
  	<li>Monitored Users: <?php echo $userCount ?></li>
  </ul>
  <?php else: ?>
  	<?php echo link_to(image_tag($user->getProfileImageUrl()), '@user_show?screen_name='. $user->getScreenName()) ?>
  	<h2><?php echo $user->getName() ?></h2>
  <ul>
    <li>Twitter User: <?php echo $user->getScreenName() ?></li>
    <li>Tweets: <?php echo $user->getStatusesCount() ?></li>
  	<li>Indexed Tweets: <?php echo count($pager) .' ('. $relativeNumberOfIndexedTweets ?> %)</li>
  	<li>Links: <?php echo $linkCount . ' ('. $relativeNumberOfLinks ?> %)</li>
  </ul>
  <ul>
  	<li>Friends: <?php echo $user->getFriendsCount() ?></li>
  	<li>Followers: <?php echo $user->getFollowersCount() ?></li>
  	<?php if($user->getUrl()): ?>
  		<li>Url: <?php echo link_to($user->getUrl(), $user->getUrl(), 'target=_blank') ?></li>
  	<?php endif;?>
  </ul>
    <ul>
  	<li>On Twitter: <br /><?php echo $user->getDateTimeObject('twitter_created_at')->format('D, d M Y H:i:s') ?></li>
  	<li>On Grabeeter: <br /><?php echo $user->getDateTimeObject('created_at')->format('D, d M Y H:i:s') ?></li>
  </ul>
      <p><?php echo $user->getDescription() ?></p>
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