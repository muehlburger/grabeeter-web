<h2>What do you want to find?</h2>

<?php include_partial('tweet/search', array('screen_name' => $screenName)) ?>

<?php if(count($tweets)): ?>
<h3>Results</h3>
<?php include_partial('tweet/list', array('tweets' => $tweets))?>
<?php else: ?>
<h3>Your search did not return any results.</h3>
<?php endif; ?>