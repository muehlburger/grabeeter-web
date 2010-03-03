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
		
		$screenName = $request->getParameter('n', sfConfig::get('app_default_username'));
		$this->twitterUser = $screenName;
		$count = sfConfig::get('app_twitter_count');
		$this->emptyTweets = 0;
		$this->numberOfStoredTweets = 0;

		$url = 'http://twitter.com/users/show.json?screen_name=' . $this->twitterUser;

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
			$user = Doctrine_Core::getTable('TweetUser')->createNewTweetUser($result);
			$pages = ceil($statusesCount / $count);
			$url = 'http://twitter.com/statuses/user_timeline.json?count='.$count.'&screen_name='.$this->twitterUser.'&page=';
		} else {
			$savedStatusesCount = $user->getStatusesCount();
			$pages = ceil(($statusesCount - $savedStatusesCount) / $count);

			$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
			if($tweet == false)
				$tweet = new Tweet();
				
			$url = 'http://twitter.com/statuses/user_timeline.json?since_id='. $tweet->getTweetTwitterId().'&count='.$count.'&screen_name='.$this->twitterUser.'&page=';
		}

		for($i = 1; $i <= $pages; $i++) {
			curl_setopt($curl, CURLOPT_URL, $url.$i);

			//make the request
			$results = json_decode(curl_exec($curl));
			$this->results = $results;

			if(!$results) {
				continue;
			}
				
			$this->numberOfStoredTweets += Doctrine_Core::getTable('Tweet')->saveTweets($results, $sources, $user);

		}
		curl_close($curl);
		$tweet = Doctrine_Core::getTable('Tweet')->getLastTweet($user->getId());
		if($tweet == false)
			$tweet = new Tweet();
		$tweet->setStatusesCount(0);
		Doctrine_Core::getTable('TweetUser')->updateUserStatusesCount($user->getId(), $tweet->getStatusesCount());

		$this->numberOfDeletedTweets = $statusesCount - $this->numberOfStoredTweets;
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
