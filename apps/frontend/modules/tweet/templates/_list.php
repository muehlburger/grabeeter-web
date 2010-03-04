<div class="tweets">
  <?php foreach ($tweets as $i => $tweet): ?>
    <div class="tweet <?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
		<a href="<?php echo url_for('user/show?id='.$tweet->getTweetUser()->getId()) ?>"><img src="<?php echo $tweet->getTweetUser()->getProfileImageUrl() ?>" /></a>
        <p>
          <a href="<?php echo url_for('user/show?id='.$tweet->getTweetUser()->getId()) ?>"><?php echo $tweet->getTweetUser() ?></a>
          &nbsp;<?php echo $tweet->getText() ?>
        <span class="description">created at <?php echo $tweet->getTweetCreatedAt() ?></span>
        </p>
    </div>
  <?php endforeach; ?>
</div>