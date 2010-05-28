<?php

class TweetUserTable extends Doctrine_Table
{
	
	public function updateLastSavedTweet($userId, $tweetId) {
		$q = $this->createQuery('u')
			->update('TweetUser')
			->set('last_saved_tweet_id', $tweetId)
			->where('id = ?', $userId);
		return $q->execute();
	}
	
	public function updateUserStatusesCount($userId, $statusesCount) {
		$q = $this->createQuery('u')
			->update('TweetUser')
    		->set('statuses_count', $statusesCount)
    		->where('id = ?', $userId);
    	return $q->execute();
	}

	public function createNewTweetUser($result) {
		$user = new TweetUser();
		$user->setName($result->name);
		$user->setScreenName($result->screen_name);
		$user->setTwitterUserId($result->id);
		$user->setDescription($result->description);
		$user->setFollowersCount($result->followers_count);
		$user->setStatusesCount($result->statuses_count);
		$user->setUrl($result->url);
		$user->setFriendsCount($result->friends_count);
		$user->setGeoEnabled($result->geo_enabled);

		$parsedDate = date_parse($result->created_at);
		$createdAt = "{$parsedDate['year']}-{$parsedDate['month']}-{$parsedDate['day']} {$parsedDate['hour']}:{$parsedDate['minute']}:{$parsedDate['second']}";
		$user->setTwitterCreatedAt($createdAt);
		$user->setTimeZone($result->time_zone);
		$user->setLocation($result->location);
		$user->setLang($result->lang);
		$user->setUtcOffset($result->utc_offset);
		$user->setProfileImageUrl($result->profile_image_url);

		$user->save();
		return $user;
	}

	public function getTweetTwitterIds() {
		$q = $this->createQuery('t')
		->select('t.tweet_twitter_id')
		->from('Tweet t');
			
		return $q->fetchArray();
	}

	public function getUserByTwitterUserId($twitterUserId) {
		$q = $this->createQuery('u')
		->from('TweetUser u')
		->where('u.twitter_user_id = ?', $twitterUserId);

		return $q->fetchOne();
	}
	
	public function getStatusesCount($twitterUserId) {
		$q = $this->createQuery('u')
		->from('TweetUser u')
		->where('u.twitter_user_id = ?', $twitterUserId);

		echo $q->execute();
	}

}
