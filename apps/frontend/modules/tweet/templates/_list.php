<div id="tweets">
  <?php foreach ($tweets as $i => $tweet): ?>
    <div class="tweet <?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
		<a href="<?php echo url_for('tweet_index', $tweet->getTweetUser()) ?>?page=1"><img src="<?php echo $tweet->getTweetUser()->getProfileImageUrl() ?>" /></a>
        <p>
        <!-- <a href="<?php echo url_for('user_show', $tweet->getTweetUser()) ?>"><?php echo $tweet->getTweetUser() ?></a> -->
        <a href="http://twitter.com/<?php echo $tweet->getTweetUser() ?>" target="_blank">@<?php echo $tweet->getTweetUser() ?></a>
          &nbsp;<?php echo $tweet->getText() ?>
        <span class="description"><a href="<?php echo url_for('tweet_show', $tweet) ?>">created at </a> &nbsp;<?php echo $tweet->getDateTimeObject('tweet_created_at')->format('jS, F Y (H:i:s T)') ?></span>
        </p>
    </div>
  <?php endforeach; ?>
</div>