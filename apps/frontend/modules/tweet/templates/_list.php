<?php use_helper('Text') ?>

<div id="tweets">
  <?php foreach ($tweets as $i => $tweet): ?>
    <div class="tweet <?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
		<?php echo link_to(image_tag($tweet->getTweetUser()->getProfileImageUrl()), 'tweet_index', array('screen_name' => $tweet->getTweetUser(), 'page' => 1)) ?>
        <p>
	        <?php echo link_to('@'.$tweet->getTweetUser(), 'http://twitter.com/'.$tweet->getTweetUser(), 'target=_blank')?>
	        &nbsp;<?php echo auto_link_text($tweet->getText(), 'all', array('target' =>'_blank')) ?>
	        <span class="description"><?php echo link_to($tweet->getDateTimeObject('tweet_created_at')->format('D, d M Y H:i:s'), 'tweet_show', $tweet) ?></span>
	        <span class="source"><?php echo link_to('access on Twitter', 'http://twitter.com/'.$tweet->getTweetUser().'/status/'.$tweet->getTweetTwitterId(), array('target' => '_blank'))?></span>
        </p>
    </div>
  <?php endforeach; ?>
</div>