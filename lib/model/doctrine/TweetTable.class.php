<?php

class TweetTable extends Doctrine_Table
{
	public function getForUsername($username) {
		$q = $this->createQuery('t')
		->leftJoin('t.TweetUser u')
		->where('u.screen_name = ?', $username)
		//->limit(3)
		->orderBy('tweet_created_at DESC');

			
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
	
	public function getForLuceneQuery($query) {
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
	  	->whereIn('t.id', $pks);
//	  	->limit(50);
	  	
	  $q = $this->getMatchingTweets($q);
	  
	  return $q->execute();
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
	
	public function saveTweets(&$results, &$sources, &$user) {

		// start with the oldest element
		$results = array_reverse($results);
		
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
				
//				echo "id: ";
//				echo $tweet->getTweetTwitterId();
//				echo "\n";
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

}
