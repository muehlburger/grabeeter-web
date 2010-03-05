<div class="entry" id="1">
	 <h3 class="storytitle"><a href="#" rel="bookmark">List of Users</a></h3>

    <?php foreach ($tweet_users as $tweet_user): ?>
	  <a href="<?php echo url_for('user/show?id='.$tweet_user->getId()) ?>"><img src="<?php echo $tweet_user->getProfileImageUrl() ?>" /></a>
    <?php endforeach; ?>

  <br /><a href="<?php echo url_for('user/new') ?>">New</a>
</div>
