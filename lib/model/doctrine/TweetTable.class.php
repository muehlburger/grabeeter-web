<?php

class TweetTable extends Doctrine_Table
{
	public function getLinkCount($user) {
		$q = $this->createQuery('t')
		->where('t.user_id = ?', $user->getId())
		->andWhere('t.text LIKE ?', '%http://%');

		return $q->count();
	}

	public function getForUsername($params) {
		$q = $this->createQuery('t')
		->leftJoin('t.TweetUser u')
		->where('u.screen_name = ?', $params['screen_name'])
		->orderBy('t.tweet_created_at DESC');
		return $q->execute();
	}

	public function getMatchingTweets(Doctrine_Query $q = null, $screenName = null) {
		if(is_null($q)) {
			$q = $this->createQuery('t')->leftJoin('t.TweetUser u')->orderBy('tweet_created_at DESC');
			if(!is_null($screenName))
			$q = $q->where('u.screen_name = ?', $screenName);
		}

		return $q;
	}

	public function getForLuceneQuery($query, $screenName) {
		if($query != "*")
		$query = 'text:"'. $query .'" AND screenName:' . $screenName;
		else
		$query = 'screenName:' . $screenName;
			
		$hits = $this->getLuceneIndex()->find($query);

		$pks = array();
		foreach ($hits as $hit) {
			$pks[] = $hit->pk;
		}
			
		if(empty($pks))
		{
			return array();
		}
			
		$q = $this->createQuery('t')
		->whereIn('t.id', $pks)
		->orderBy('t.tweet_created_at DESC');

		$q = $this->getMatchingTweets($q, $screenName);
			
		return $q;
	}

	static public function getLuceneIndex() {
		ProjectConfiguration::registerZend();

		if(file_exists($index = self::getLuceneIndexFile())) {
			return Zend_Search_Lucene::open($index);
		} else {
			return Zend_Search_Lucene::create($index);
		}
	}

	static public function getLuceneIndexFile() {
		return sfConfig::get('sf_data_dir').'/tweet.'.sfConfig::get('sf_environment').'.index';
	}

	public function saveTweets($results, $sources, $user) {

		// start with the oldest element
		$results = array_reverse($results);

		$numberOfTweets = 0;
		$conn = $this->getConnection();
		$conn->beginTransaction();


		try {
			foreach($results as $result) {
				
				
//				$sourceData = Tweetex::extractSourceData($result->source);
//
//				$label = $sourceData[0];
//				$url = $sourceData[1];
//				
//				print("url: " . $url . "\n");
//				print("label: " . $label . "\n");
//				var_dump($sources);
//
//				if(isset($sources)) {
//					if(!array_key_exists($url, $sources)) {
//						$source = new TweetSource();
//						if($url != '')
//						$source->setUrl($url);
//
//						if($label != '')
//						$source->setLabel($label);
//
//						$source->save();
//						$sourceId = $source->getId();
//					} else {
//						$sourceId = $sources[$url];
//					}
//					$tweet->setSourceId($sourceId);
//				}

				// Create new tweet
				$tweet = new Tweet();
				
				// Populate tweet's values
				$tweet->setTweetUser($user);
				$tweet->setStatusesCount($result->user->statuses_count);
				$tweet->setSourceId(new TweetSource());

				// Add geo information if it is enabled
				if($result->user->geo_enabled == 1) {
					if(isset($result->user->geo)) {
						// TODO: Parse and update correct geolocation
						$tweet->setGeolocationId(new TweetGeoLocation());
					}
				}

				// Tweet is a reply
				if(isset($result->in_reply_to_status_id_str)) {
					$tweet->setInReplyToStatusId($result->in_reply_to_status_id_str);
					$tweet->setInReplyToUserId($result->in_reply_to_user_id_str);
				}

				$parsedDate = date_parse($result->created_at);
				$createdAt = "{$parsedDate['year']}-{$parsedDate['month']}-{$parsedDate['day']} {$parsedDate['hour']}:{$parsedDate['minute']}:{$parsedDate['second']}";
				$tweet->setTweetCreatedAt($createdAt);

				$tweet->setTweetTwitterId($result->id_str);
				$tweet->setText($result->text);

				$numberOfTweets++;

				$tweet->save($conn);
			}
			$conn->commit();

		} catch(Exception $e) {
			echo $e->getMessage();
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

}
