<h4>Searching Tweets for <?php echo $twitterUser ?></h4>
<ul>
	<li><?php echo $numberOfStoredTweets . ' tweets successfully saved!' ?></li>
	<?php if($numberOfStoredTweets > 0) :?>
	<li>It seems that <?php echo $twitterUser ?> has deleted <?php echo $numberOfDeletedTweets ?> tweets.</li>
	<?php endif; ?>
</ul>