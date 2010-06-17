<h2>Grabeeter lets you</h2>
<ul>
	<li>Search in your Tweets</li>
	<li>Filter your Tweets by date</li>
	<li>Search in your Tweets offline using the Grabeeter Client</li>
	<li>Filter your tweets offline using the Grabeeter Client</li>
	<li>Grabeeter provides an <?php echo link_to('API', '@help_api')?></li>
</ul>

<div><?php include_partial('tweet/list', array('tweets' => $tweets)) ?></div>
<p>In the following you can seen some sample users which decided to use Grabeeter:</p>
<div><?php include_partial('user/list', array('tweet_users' => $tweet_users)) ?></div>
