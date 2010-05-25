<?php foreach ($tweet_users as $tweet_user): ?>
        <a href="<?php echo url_for('tweet_index', $tweet_user) ?>"><img src="<?php echo $tweet_user->getProfileImageUrl() ?>" /></a>
<?php endforeach; ?>