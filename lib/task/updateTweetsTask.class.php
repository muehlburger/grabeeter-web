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
The [say:hello|INFO] task is an implementation of the classical
Hello World example using symfony's task system.
 
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
		curl_setopt($curl, CURLOPT_TIMEOUT, 900);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);

		//make the request
		$result = json_decode(curl_exec($curl));

		if(isset($result->error)) {
			$this->logSection('error: ', $result->error);
			exit(1);
		}

		$user = Doctrine_Core::getTable('TweetUser')->getUserByTwitterUserId($result->id);
		$statusesCount = $result->statuses_count;
		$allTweetSources = Doctrine_Core::getTable('TweetSource')->findAll(Doctrine_Core::HYDRATE_ARRAY);

		$sources = array();
		foreach($allTweetSources as $source) {
			$sources[$source['label']]= $source['id'];
		}

		if(!$user) {
			$user = Doctrine_Core::getTable('TweetUser')->createNewTweetUser($result);
			$pages = ceil($statusesCount / $count);
			$url = 'http://twitter.com/statuses/user_timeline.json?count='.$count.'&screen_name='.$this->twitterUser.'&page=';
		} else {
			$savedStatusesCount = $user->getStatusesCount();
			$pages = ceil(($statusesCount - $savedStatusesCount) / $count);

			$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
			$url = 'http://twitter.com/statuses/user_timeline.json?since_id='. $tweet->getTweetTwitterId() .'&count='.$count.'&screen_name='.$this->twitterUser.'&page=';
		}
		
		for($i = 1; $i <= $pages; $i++) {
			curl_setopt($curl, CURLOPT_URL, $url.$i);

			//make the request
			$results = json_decode(curl_exec($curl));
			

			if(isset($results->error)) {
				$this->logSection('error: ', $results->error);
				exit(1);
			}
//			if(!$results) {
//				continue;
//			}

			$this->results = $results;				
			$this->numberOfStoredTweets += Doctrine_Core::getTable('Tweet')->saveTweets($results, $sources, $user);

		}
		curl_close($curl);
		$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
		if($tweet == false)
			$tweet = new Tweet();
		$tweet->setStatusesCount(0);
		Doctrine_Core::getTable('TweetUser')->updateUserStatusesCount($user->getId(), $tweet->getStatusesCount());

		$this->numberOfDeletedTweets = $statusesCount - $this->numberOfStoredTweets;
		$this->logBlock('Task run successfuly for '.$arguments['username'], 'INFO');

	}
}
