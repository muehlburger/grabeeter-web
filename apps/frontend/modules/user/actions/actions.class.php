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

	public function executeIndex(sfWebRequest $request)
	{
		$this->tweet_users = Doctrine::getTable('TweetUser')
		->createQuery('a')
		->limit(11)
		->execute();
	}

	public function executeShow(sfWebRequest $request)
	{
		//$this->tweet_user = Doctrine::getTable('TweetUser')->find(array($request->getParameter('id')));
		//$this->forward404Unless($this->tweet_user);
		$this->tweet_user = $this->getRoute()->getObject();
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
