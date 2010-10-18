<?php

class extractUsernamesTask extends sfBaseTask
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
		$this->name             = 'exctractUsernames';
		$this->briefDescription = 'Task for extracting twitter usernames';
		$this->detailedDescription = <<<EOF
The [exctractUsernames|INFO] task does things.
Call it with:

  [php symfony exctractUsernames|INFO]
EOF;
	}

	protected function execute($arguments = array(), $options = array())
	{
		// initialize the database connection
		$databaseManager = new sfDatabaseManager($this->configuration);
		$connection = $databaseManager->getDatabase($options['connection'])->getConnection();

		$this->logBlock('Running task for '.$arguments['username'], 'INFO');
		$screenName = $arguments['username'];
		
		$user = Doctrine::getTable('TweetUser')->getUserByScreenName($screenName);
		if(!isset($user)) {
			$this->logSection('error: ', 'Twitter Username not found in Database!');
			exit(1);
		}
		
		$userCount = Doctrine::getTable('TweetUser')
		->createQuery('a')
		->count();

		$q = Doctrine::getTable('Tweet')->getMatchingTweets(null, $screenName);
		$tweets = $q->execute();
		$extractedScreennames = Tweetex::extractMentionedScreennames($tweets);
		
		$numberOfCommunicationPartners = count($extractedScreennames);
		$this->logSection('Info: ', $numberOfCommunicationPartners . ' usernames found in ' . $screenName . '\'s tweets.');
		
	}
}
