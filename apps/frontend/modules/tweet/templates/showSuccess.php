<?php use_helper('Text') ?>

<div id="tweets">
    <div class="tweet">
		<?php echo link_to(image_tag($tweet->getTweetUser()->getProfileImageUrl(), array('width' => '48px', 'height' => '48px')), '@tweet_user_tweets?screen_name='. $tweet->getTweetUser()) ?><p>
	        <strong><?php echo link_to($tweet->getTweetUser(), 'http://twitter.com/'.$tweet->getTweetUser(), 'target=_blank')?></strong>
	        <?php echo auto_link_text($tweet->getText(), 'all', array('target' =>'_blank')) ?>
	        <span class="description"><?php echo link_to($tweet->getDateTimeObject('tweet_created_at')->format('D, d M Y H:i:s'), '@tweet_show?id='. $tweet->getId()) ?></span>
	        <span class="source"><?php echo link_to('access on Twitter', 'http://twitter.com/'.$tweet->getTweetUser().'/status/'.$tweet->getTweetTwitterId(), array('target' => '_blank'))?></span>
        </p>
    </div>
</div>