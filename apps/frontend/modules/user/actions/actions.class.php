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
		$this->twitterUser = "hmuehlburger";

		$url = 'http://twitter.com/statuses/user_timeline.json?count=3&screen_name=hmuehlburger';

		// initialize curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);

		//make the request
		$results = json_decode(curl_exec($curl));
		
		foreach ($results as $result) {
			$tweet = new Tweet();
			$tweet->setText($result->text);
			
			echo $result->text;
			break;
		}
		
		
		curl_close($curl);
		exit;

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
