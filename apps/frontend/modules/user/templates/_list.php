<?php foreach ($tweet_users as $tweet_user): ?>
  <a href="<?php echo url_for('@tweet_user_tweets?screen_name='. $tweet_user) ?>"><img src="<?php echo $tweet_user->getProfileImageUrl() ?>" width="48px" height="48px" /></a>
<?php endforeach; ?>