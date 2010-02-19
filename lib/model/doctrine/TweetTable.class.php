<?php

class TweetTable extends Doctrine_Table
{
	public function saveTweets(&$results, &$sources, &$user) {

		$numberOfTweets = 0;
		$conn = $this->getConnection();
		$conn->beginTransaction();

		try {
			foreach($results as $result) {
				if(!array_key_exists($result->source, $sources)) {
					$source = new TweetSource();
					// TODO: Parse url and label correctly here
					$source->setLabel($result->source);
					$source->setUrl($result->source);
					$source->save();
					$sources[$source->getLabel()] = $source->getId();
					$sourceId = $source->getId();
				} else {
					$sourceId = $sources[$result->source];
				}

				// Create new Tweet and populate its values
				$tweet = new Tweet();
				$tweet->setTweetUser($user);
				$tweet->setStatusesCount($result->user->statuses_count);
				$tweet->setSourceId($sourceId);


				// Add geo information if it is enabled
				if($result->user->geo_enabled == 1) {
					if(isset($result->user->geo)) {
						// TODO: Parse and update correct geolocation
						$tweet->setGeolocationId(new TweetGeoLocation());
					}
				}

				// Tweet is a reply
				if(isset($result->in_reply_to_status_id)) {
					$tweet->setInReplyToStatusId($result->in_reply_to_status_id);
					$tweet->setInReplyToUserId($result->in_reply_to_user_id);
				}

				$parsedDate = date_parse($result->created_at);
				$createdAt = "{$parsedDate['year']}-{$parsedDate['month']}-{$parsedDate['day']} {$parsedDate['hour']}:{$parsedDate['minute']}:{$parsedDate['second']}";
				$tweet->setTweetCreatedAt($createdAt);

				$tweet->setTweetTwitterId($result->id);
				$tweet->setText($result->text);

				$numberOfTweets++;
				$tweet->save($conn);
			}
				$conn->commit();
				
		} catch(Exception $e) {
			$conn->rollback();
			throw $e;
		}
			return $numberOfTweets;
	}

	public function getLastTweet($userId) {
		$q = $this->createQuery('t')
		->select('t.tweet_twitter_id')
		->from('Tweet t')
		->where('t.user_id = ?', $userId)
		->orderBy('t.tweet_twitter_id DESC')
		->limit(1);
			
		return $q->fetchOne();
	}

	public function createNewTweet($result) {

	}
}
