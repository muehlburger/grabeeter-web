<?php slot('sidebar')?>
  <?php if (is_null($screenName)): ?>
  <h2>Information</h2>
  <ul>
  	<li>Stored Tweets: <?php echo count($pager) ?></li>
  	<li>Monitored Users: <?php echo $userCount ?></li>
  </ul>
  <?php else: ?>
  	<?php echo image_tag($user->getProfileImageUrl()) ?>
  	<h2><?php echo $user->getName() ?></h2>
  	<p><?php echo $user->getDescription() ?></p>
  <ul>
    <li>Twitter User: <?php echo $user->getScreenName() ?></li>
    <li>Tweets on Twitter: <?php echo $user->getStatusesCount() ?></li>
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
  <!-- <h3>Communication Partners (<?php echo $numberOfCommunicationPartners?>)</h3>
  <p><?php echo $user->getName() ?> mentioned the following Twitter users:</p>
  <?php foreach ($usernames as $username): ?>
  <ul>
   	<li><a href="http://twitter.com/<?php echo $username ?>" target="_blank"><?php echo $username ?></a></li>
  </ul>
	<?php endforeach; ?>
   -->
  <h3>Statistics</h3>
    <ul>
  	<li>On Twitter: <br /><?php echo $user->getDateTimeObject('twitter_created_at')->format('D, d M Y H:i:s') ?></li>
  	<li>On Grabeeter: <br /><?php echo $user->getDateTimeObject('created_at')->format('D, d M Y H:i:s') ?></li>
  </ul>
  
  <h3>Export Tweets</h3>
    <ul>
  	<li><?php echo link_to('Export Tweets as XML', '@api_tweets?screen_name='.$screenName, array('target' => '_blank')) ?></li>
  	<li><?php echo link_to('Export Tweets as JSON', '@api_tweets?sf_format=json&screen_name='.$screenName, array('target' =>'_blank')) ?></li>
  </ul>
  <?php include_partial('help/launchgrabeeter') ?>
  <?php endif; ?>
<?php end_slot() ?>

<?php include_partial('tweet/search', array('screen_name' => $screenName, 'name'	=> 	$user->getName())) ?>
<div id="tweets">
<p class="subheader">
	<strong><?php echo count($pager) ?> available Tweets | </strong><em>Page <?php echo $pager->getPage() ?> of <?php echo $pager->getLastPage() ?></em></p> 
<p>
  <?php if ($pager->haveToPaginate()): ?>
  <?php endif; ?>
</p>
<?php include_partial('tweet/pagination', array('pager' => $pager, 'screen_name' => $screenName))?>
<?php include_partial('tweet/list', array('tweets' => $pager->getResults())) ?>
<?php include_partial('tweet/pagination', array('pager' => $pager, 'screen_name' => $screenName))?>
</div>