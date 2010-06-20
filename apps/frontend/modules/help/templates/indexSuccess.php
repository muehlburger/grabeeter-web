<?php include_partial('tweet/search', array('screen_name' => $user->getScreenName(), 'name' => $user->getName())) ?>

<div id="tweets">
	<?php include_partial('tweet/list', array('tweets' => $tweets)) ?>
</div>

<p>In the following you see some <?php echo link_to('users', '@user') ?> which are on Grabeeter right now.</p>
<?php include_partial('user/list', array('tweet_users' => $tweet_users)) ?>
