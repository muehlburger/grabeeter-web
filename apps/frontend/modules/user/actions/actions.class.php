<?php

/**
 * user actions.
 *
 * @package    twitarch
 * @subpackage user
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{	
	public function executeSearchTweets(sfWebRequest $request) {
		$twitterUser = "behi_at";
		$count = 200;
		$this->emptyTweets = 0;

		$url = 'http://twitter.com/users/show.json?screen_name=' . $twitterUser;

		// initialize curl
		$curl = curl_init($url);

		$this->forward404Unless($curl, "Curl could not be initialized!");

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 900);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);

		//make the request
		$result = json_decode(curl_exec($curl));

		$this->forward404Unless($result, "No results for this request!");

		$user = Doctrine_Core::getTable('TweetUser')->getUserByTwitterUserId($result->id);
		$statusesCount = $result->statuses_count;
		
		$allTweetSources = Doctrine_Core::getTable('TweetSource')->findAll(Doctrine_Core::HYDRATE_ARRAY);
		
		$sources = array();
		foreach($allTweetSources as $source) {
			$sources[$source['label']]= $source['id']; 
		}
		
		// If user doesn't exist, create new one with the new values
		if(!$user) {
			$user = Doctrine_Core::getTable('TweetUser')->createNewTwitterUser($result);
			var_dump($user);
			exit;
			
			$pages = ceil($statusesCount / $count);	
			$url = 'http://twitter.com/statuses/user_timeline.json?count='.$count.'&screen_name='.$twitterUser.'&page=';
		} else {
			// TODO: count tweets in db for this user
			$numberOfStoredTweets = 500;
			$pages = ceil(($statusesCount - $numberOfStoredTweets) / $count);
			
			// TODO: read most recent tweet id (die letzte tweet id aus db)
			$sinceId = 234234;
			$url = 'http://twitter.com/statuses/user_timeline.json?since_id='. $sinceId .'&count='.$count.'&screen_name='.$twitterUser.'&page=';
		}
					
		for($i = 1; $i <= $pages; $i++) {
			
			curl_setopt($curl, CURLOPT_URL, $url.$i);

			//make the request
			$results = json_decode(curl_exec($curl));

			$this->results = $results;

			if(!$results) {
				$this->forward404Unless($results, "Response was empty for page: " . $i);
				continue;
			}

			
			// TODO: the next if has to be moved to tweet model and return a sources object
			if(!array_key_exists($result->source, $sources)) {
				// TODO: Store tweet source
				//		$source = new TweetSource();
				//		$source->setLabel($result->source);
				//		$source->setUrl($result->source);
				// TODO: get source ID from database call
				$sourceId = 4343434;
			} else {
				$sourceId = $sources[$result->source];
			}
			
			
			// Create new Tweet and populate its values
			$tweet = new Tweet();
			$tweet->setTweetUser($user);
			$tweet->setTweetSource($source);


			// Add geo information if it is enabled
			if($result->user->geo_enabled == 1) {
				if(isset($result->geo)) {
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

			$tweet->save();

		}
		curl_close($curl);
	}
	public function executeIndex(sfWebRequest $request)
	{
		$this->tweet_users = Doctrine::getTable('TweetUser')
		->createQuery('a')
		->execute();
	}

	public function executeShow(sfWebRequest $request)
	{
		$this->tweet_user = Doctrine::getTable('TweetUser')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->tweet_user);
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new TweetUserForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new TweetUserForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($tweet_user = Doctrine::getTable('TweetUser')->find(array($request->getParameter('id'))), sprintf('Object tweet_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new TweetUserForm($tweet_user);
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($tweet_user = Doctrine::getTable('TweetUser')->find(array($request->getParameter('id'))), sprintf('Object tweet_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new TweetUserForm($tweet_user);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($tweet_user = Doctrine::getTable('TweetUser')->find(array($request->getParameter('id'))), sprintf('Object tweet_user does not exist (%s).', $request->getParameter('id')));
		$tweet_user->delete();

		$this->redirect('user/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$tweet_user = $form->save();

			$this->redirect('user/edit?id='.$tweet_user->getId());
		}
	}
}
