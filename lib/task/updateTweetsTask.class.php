<?php

class updateTweetsTask extends sfBaseTask
{
	protected function configure()
	{
		// add your own arguments here
		$this->addArguments(array(
		new sfCommandArgument('username', sfCommandArgument::REQUIRED, 'Twitter Username'),
		));

		$this->addOptions(array(
		new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
		new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
		new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
		// add your own options here
		));

		$this->namespace        = '';
		$this->name             = 'updateTweets';
		$this->briefDescription = 'Task for updating tweets';
		$this->detailedDescription = <<<EOF
The [updateTweets|INFO] task is implemented using symfony's task system.
 
  [./symfony updateTweets <username>|INFO]
 
Use this task to store the tweets of the given user using
the [username|COMMENT] argument.
EOF;
	}

	protected function execute($arguments = array(), $options = array())
	{
		// initialize the database connection
		$databaseManager = new sfDatabaseManager($this->configuration);
		$connection = $databaseManager->getDatabase($options['connection'])->getConnection();

		$this->logBlock('Running task for '.$arguments['username'], 'INFO');
		$screenName = $arguments['username'];
		$this->twitterUser = $screenName;
		$count = sfConfig::get('app_twitter_count');
		$this->emptyTweets = 0;
		$this->numberOfStoredTweets = 0;

		$url = 'http://twitter.com/users/show.json?screen_name=' . $this->twitterUser;

		// initialize curl
		$curl = curl_init($url);
		if(!isset($curl)) {
			$this->logSection('error: ', 'Curl could not be initialized!');
			exit(1);
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 3600);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);

		//make the request
		$this->logSection('Info: ', 'Getting userdata: '. $url);
		$curlReturnValue = curl_exec($curl);

		$httpStatusCode = $this->getHttpStatusOk($curl);

		switch($httpStatusCode) {
			case 200:
				$result = json_decode($curlReturnValue);
				if($result->protected == true) {
					$this->logSection('Error: ', 'cannot access protected tweets from user: '. $screenName);
					exit(3);
				}
				break;
			case 401:
				exit(2);
				break;
			case 404:
				exit(2);
				break;
			case 502:
				exit(2);
				break;
			default:
				$result = new stdClass();
				$result->error = "Curl failed, check your internet connection!";
		}

		if(isset($result->error)) {
			$this->logSection('Error: ', $result->error);
			exit(1);
		}

		if(!isset($result->id_str)) {
			$this->logSection('Error: ', 'Twitter not reachable!');
			exit(1);
		}

		$user = Doctrine_Core::getTable('TweetUser')->getUserByTwitterUserId($result->id_str);
		$statusesCount = $result->statuses_count;

		// Just try to access the first 3200 tweets
		if($statusesCount > sfConfig::get('app_twitter_statuses_limit'));
		$statusesCount = sfConfig::get('app_twitter_statuses_limit');
			
//		$allTweetSources = Doctrine_Core::getTable('TweetSource')->findAll(Doctrine_Core::HYDRATE_ARRAY);
		$pages = ceil($statusesCount / $count);

		$sources = array();
//		foreach($allTweetSources as $source) {
//			$sources[$source['url']]= $source['id'];
//		}
		
		$url = 'http://twitter.com/statuses/user_timeline.json?count='.$count.'&screen_name='.$this->twitterUser.'&page=';
		if(!$user) {
			$user = Doctrine_Core::getTable('TweetUser')->createNewTweetUser($result);
		} else {
			$lastSavedTwitterId = $user->getLastSavedTweetId();
			if($lastSavedTwitterId > 0)
			$url = 'http://twitter.com/statuses/user_timeline.json?since_id='. $lastSavedTwitterId .'&count='.$count.'&screen_name='.$this->twitterUser.'&page=';
		}

		$tweetsTable = Doctrine_Core::getTable('Tweet');
		for($i = $pages; $i > 0; $i--) {
			$this->logSection('Info: ', 'Processing pages: '. $url.$i);
			curl_setopt($curl, CURLOPT_URL, $url.$i);

			//make the request
			$curlReturnValue = curl_exec($curl);

			$httpStatusCode = $this->getHttpStatusOk($curl);

			if($httpStatusCode == 200)
			$results = json_decode($curlReturnValue);
			else {
				$results = new stdClass();
				$results->error = "Curl failed, check your internet connection!";
			}

			if(isset($results->error)) {
				$this->logSection('Error: ', $results->error);
				exit(1);
			}

			$this->numberOfStoredTweets += $tweetsTable->saveTweets($results, $sources, $user);

		}
		curl_close($curl);
		
		$this->logSection('Info: ', 'getLastTweet of user with id: '. $user->getId());
		$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
		if($tweet == false) {
			$tweet = new Tweet();
			$tweet->setStatusesCount(0);
		}
		$this->logSection('Info: ', 'updateUserStatusesCount of user with id: '. $user->getId());
		Doctrine_Core::getTable('TweetUser')->updateUserStatusesCount($user->getId(), $tweet->getStatusesCount());

		$this->logBlock('Task run successfuly for '.$arguments['username'], 'INFO');

	}

	private function getHttpStatusOk($curl) {
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		switch ($statusCode) {
			case 200:
				return $statusCode;
			case 400:
				$this->logSection('Error: ', 'HTTP Status Code: '. $statusCode);
				return $statusCode;
			case 401:
				$this->logSection('Error: ', 'HTTP Status Code: '. $statusCode);
				$this->logSection('Error: ', 'User has protected his tweets!');
				return $statusCode;
			case 404:
				$this->logSection('Error: ', 'HTTP Status Code: '. $statusCode);
				$this->logSection('Error: ', 'Not a valid Twitter Username!');
				return $statusCode;
			case 502:
				$this->logSection('Error: ', 'HTTP Status Code: '. $statusCode);
				return $statusCode;
			case 503:
				$this->logSection('Error: ', 'HTTP Status Code: '. $statusCode);
				return $statusCode;
			default:
				$this->logSection('Info: ', 'HTTP Status Code: '. $statusCode);
				return $statusCode;
		}
	}
}
