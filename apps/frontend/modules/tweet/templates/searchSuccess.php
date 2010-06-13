<h2>What do you want to find?</h2>

<?php include_partial('tweet/search', array('screen_name' => $screenName)) ?>

<h3>Results</h3>
<?php include_partial('tweet/list', array('tweets' => $tweets))?>
