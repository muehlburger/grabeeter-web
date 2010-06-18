
<h2>Search Tweets from <?php echo $user->getName() ?></h2>
<?php include_partial('tweet/search', array('screen_name' => $user->getScreenName())) ?>
<div id="tweets">
	<?php include_partial('tweet/list', array('tweets' => $tweets)) ?>
</div>

<p>In the following you can seen some sample users which decided to use Grabeeter:</p>
<?php include_partial('user/list', array('tweet_users' => $tweet_users)) ?>
