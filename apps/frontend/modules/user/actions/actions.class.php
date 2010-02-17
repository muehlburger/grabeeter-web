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
	/**
	 * 
	 * @param CONST $results
	 * @param VAR $sources
	 * @param CONST $user
	 * @return void
	 */
	private function saveTweets(&$results, &$sources, &$user) {

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

			$tweet->save();
		}
	}
	public function executeSearchTweets(sfWebRequest $request) {
		$twitterUser = "hmuehlburger";
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

		if(!$user) {
			$user = Doctrine_Core::getTable('TweetUser')->createNewTwitterUser($result);

			$pages = ceil($statusesCount / $count);
			$url = 'http://twitter.com/statuses/user_timeline.json?count='.$count.'&screen_name='.$twitterUser.'&page=';
		} else {
			$numberOfStoredTweets = $user->getStatusesCount();
			$pages = ceil(($statusesCount - $numberOfStoredTweets) / $count);

			$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
			$url = 'http://twitter.com/statuses/user_timeline.json?since_id='. $tweet->getTweetTwitterId() .'&count='.$count.'&screen_name='.$twitterUser.'&page=';
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
			
			$this->saveTweets($results, $sources, $user);

		}
		curl_close($curl);
		$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
		Doctrine_Core::getTable('TweetUser')->updateUserStatusesCount($user->getId(), $tweet->getStatusesCount());
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
