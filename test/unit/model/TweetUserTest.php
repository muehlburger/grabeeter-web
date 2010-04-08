<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');

$t = new lime_test(2);

$t->comment('->save()');
$user = create_user();
$user->save();

$t->is($user->getScreenName(), 'hmuehlburger2', '->getScreenName() return the the screen_name of the user');
$t->is($user->__toString(), 'hmuehlburger2', '->__toString() return the the screen_name for __toString()');

function create_user($defaults = array()) {
	
	$user = new TweetUser();
	$user->fromArray(array_merge(array(
		'name' => 'Herbert Mühlburger',
    	'screen_name' => 'hmuehlburger2',
    	'twitter_user_id' => 73705954,
    	'description' => 'I\'m a Software Developer and Internet Marketer who developing a unique set of Online Internet Marketing. Tools at mywebwork.com.',
    	'followers_count' => 157,
    	'statuses_count' => 1044,
    	'url' => 'http://blog.muehlburger.at',
    	'friends_count' => 158,
    	'geo_enabled' => false,
    	'twitter_created_at' => '2009/12/09 18:42:44 +0000 2009',
    	'time_zone' => 'Vienna',
    	'location' => 'Graz, Austria',
    	'lang' => 'en',
    	'utc_offset' => 3600,
    	'profile_image_url' => 'http://a3.twimg.com/profile_images/411543229/foto-herbert-small_normal.png',
	), $defaults));
	
	return $user;
}