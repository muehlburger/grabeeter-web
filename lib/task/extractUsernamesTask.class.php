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

		foreach ($extractedScreennames as $username) {
			$username = preg_replace('/\s+/', '', $username);

			$filepath = sfConfig::get('sf_data_dir').'/'.sfConfig::get('app_username_file');
			$newUsers = sfConfig::get('sf_data_dir').'/newUsers';

			$storedUsernames = file_get_contents($filepath);
			$explodedStoredUsernames = explode("\n", $storedUsernames);

			if(!in_array($username, $explodedStoredUsernames)) {
				$username = $username . "\n";
				$fileContent = $username . $storedUsernames;

				$bytesStored = file_put_contents($filepath, $fileContent);
				$bytesNewUsers = file_put_contents($newUsers, $username, FILE_APPEND);
			}
		}

		//		$configuration = ProjectConfiguration::getApplicationConfiguration($options['application'] , $options['env'], true);
		//
		//		sfContext::createInstance($configuration);
		//		$request = sfContext::getInstance()->getRequest();
		//
		//		// configure it
		//		$request->setParameter('registration[username]', '123456');
		//		$request->setMethod('post');
		//
		//		// Create your action
		//		//$action = new registrationActions($options['dev'], "registration", "executeIndex");
		//		$action = sfContext::getInstance()->getController()->getAction("registration", "index");
		//
		//		// and execute it as the front web controller would do it in a "normal/web" navigation
		//		$action->execute($request);
	}
}
