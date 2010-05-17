<div>
	 <h3>List of Users</h3>

    <?php foreach ($tweet_users as $tweet_user): ?>
	  <a href="<?php echo url_for('user_show', $tweet_user) ?>"><img src="<?php echo $tweet_user->getProfileImageUrl() ?>" /></a>
    <?php endforeach; ?>

</div>
