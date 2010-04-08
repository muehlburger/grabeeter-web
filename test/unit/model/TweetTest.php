<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');

$t = new lime_test(7);

$t->comment('->getTextSlug()');
$tweet = Doctrine_Core::getTable('Tweet')->createQuery()->fetchOne();
$t->is($tweet->getTextSlug(), Tweetex::slugify($tweet->getText()), '->getTextSlug() return the slug for the tweet text');

$t->comment('->save()');

$tweet = create_tweet();
$tweet->save();
$text = 'RT @webupd8 Fix Internet Explorer 6 and 7 bugs (Make IE behave like a standards-compliant browser) http://cli.gs/ymTWYV';
$textslug = Tweetex::slugify($text);
    	
$t->is($tweet->getText(), $text, '->save() save the text in the database');
$t->is($tweet->getInReplyToUserId(), 15284045, '->save() save the in reply to userid in the database');
$t->is($tweet->getStatusesCount(), 1000, '->save() save the in_reply_to_user_id in the database');
$t->is($tweet->getInReplyToStatusId(), 1558468493, '->save() save the in_reply_to_status_id in the database');
$t->is($tweet->getDateTimeObject('tweet_created_at')->format('Y-m-d H'), '2009-04-19 19', '->save() save the tweet_created_at in the database');
$t->is($tweet->getTweetTwitterId(), 1559088336, '->save() save the tweet_twitter_id in the database');

function create_tweet($defaults = array()) {
	static $user = null;
	if(is_null($user)) {
		$user = Doctrine_Core::getTable('TweetUser')
		  ->createQuery()
		  ->limit(1)
		  ->fetchOne();
	}
	
	static $source = null;
	if(is_null($source)) {
		$source = Doctrine_Core::getTable('TweetSource')
		  ->createQuery()
		  ->limit(1)
		  ->fetchOne();
	}
	
	static $geolocation = null;
	if(is_null($geolocation)) {
		$geolocation = Doctrine_Core::getTable('TweetGeoLocation')
		  ->createQuery()
		  ->limit(1)
		  ->fetchOne();
	}
	
	$tweet = new Tweet();
	$tweet->fromArray(array_merge(array(
		'user_id'			=>	$user->getId(),
		'source_id'			=>	$source->getId(),
		'geolocation_id' 	=>	$geolocation->getId(),
		'in_reply_to_user_id' => 15284045,
		'statuses_count'	=> 1000,
		'in_reply_to_status_id' => 1558468493,
		'tweet_created_at'	=> '2009-04-19 19:34',
		'tweet_twitter_id'	=> 1559088336,
    	'text' 				=> 'RT @webupd8 Fix Internet Explorer 6 and 7 bugs (Make IE behave like a standards-compliant browser) http://cli.gs/ymTWYV'
	), $defaults));
	
	return $tweet;
}