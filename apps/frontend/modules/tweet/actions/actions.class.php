<?php

/**
 * tweet actions.
 *
 * @package    twitarch
 * @subpackage tweet
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tweetActions extends sfActions
{
	public function executeSearch(sfWebRequest $request) {
		if(!$query = $request->getParameter('query')) {
			$query = "";
		}

		$this->tweets = Doctrine::getTable('Tweet')->getForLuceneQuery($query);

		if ($request->isXmlHttpRequest())
		{
			if ('*' == $query || !$this->tweets)
			{
				return $this->renderText('No results.');
			}
			else
			{
				return $this->renderPartial('tweet/list', array('tweets' => $this->tweets));
			}
		}
	}

	public function executeIndex(sfWebRequest $request)
	{
		$this->screenName = $request->getParameter('screen_name');

		$q = Doctrine::getTable('Tweet')->getMatchingTweets(null, $this->screenName);
		$this->pager = new sfDoctrinePager('Tweet', sfConfig::get('app_max_tweets_on_page'));
		$this->pager->setQuery($q);
		$this->pager->setPage($request->getParameter('page'), 1);
		$this->pager->init();
		 
		if(!is_null($this->screenName)) {
			$this->user = Doctrine::getTable('TweetUser')->getUserByScreenName($this->screenName);
			$this->linkCount = Doctrine::getTable('Tweet')->getLinkCount($this->user);
			$this->relativeNumberOfLinks = round($this->linkCount / count($this->pager) * 100);
			$this->relativeNumberOfIndexedTweets = round(count($this->pager) / $this->user->getStatusesCount() * 100);
		}

	}

	public function executeShow(sfWebRequest $request)
	{
		$this->tweet = $this->getRoute()->getObject();
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new TweetForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new TweetForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		//$this->forward404Unless($tweet = Doctrine::getTable('Tweet')->find(array($request->getParameter('id'))), sprintf('Object tweet does not exist (%s).', $request->getParameter('id')));
		$this->tweet = $this->getRoute()->getObject();
		$this->form = new TweetForm($this->tweet);
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($tweet = Doctrine::getTable('Tweet')->find(array($request->getParameter('id'))), sprintf('Object tweet does not exist (%s).', $request->getParameter('id')));
		$this->form = new TweetForm($tweet);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($tweet = Doctrine::getTable('Tweet')->find(array($request->getParameter('id'))), sprintf('Object tweet does not exist (%s).', $request->getParameter('id')));
		$tweet->delete();

		$this->redirect('tweet/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$tweet = $form->save();

			$this->redirect('tweet/edit?id='.$tweet->getId());
		}
	}
}
