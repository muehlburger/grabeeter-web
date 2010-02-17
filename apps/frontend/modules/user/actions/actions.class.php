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

		$url = 'http://twitter.com/statuses/user_timeline.json?count=200&screen_name='.$twitterUser;

		// initialize curl
		$curl = curl_init($url);

		$this->forward404Unless($curl, "Curl could not be initialized!");

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 900);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);

		//make the request
		$results = json_decode(curl_exec($curl));

		$this->forward404Unless($results, "No results for this request!");
		$statusesCount = $results[0]->user->statuses_count;
		$pages = ceil($statusesCount / $count);

		if($pages < 0)
		$pages = 1;
			
		for($i = 1; $i <= $pages; $i++) {
			$url = 'http://twitter.com/statuses/user_timeline.json?count='.$count.'&page='.$i.'&screen_name='.$twitterUser;
			curl_setopt($curl, CURLOPT_URL, $url);

			//make the request
			$results = json_decode(curl_exec($curl));

			$this->results = $results;
			$result = $results[0];

			if(!$result)
				continue;

			$user = Doctrine_Core::getTable('TweetUser')->getUserByTwitterUserId($result->user->id);

			// If user doesn't exist, create new one with the new values
			if(!$user) {
				$user = Doctrine_Core::getTable('TweetUser')->createNewTwitterUser($result);
				// TODO: Here create the new tweet
				$tweet = Doctrine_Core::getTable('Tweet')->createNewTweet($result);
			} else {
				// TODO: Here update the user's tweets
			}

			$tweetTwitterIds = Doctrine_Core::getTable('TweetUser')->getTweetTwitterIds();

			foreach ($results as $result) {
				$break = false;
				foreach ($tweetTwitterIds as $id) {
					if ($result->id == $id['tweet_twitter_id']) {
						$break = true;
						break;
					}
				}
				if($break) {
					break;
				} else {

					// Create new TweetSource
					$source = new TweetSource();
					$source->setLabel($result->source);
					$source->setUrl($result->source);

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

			}
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
