<?php

/**
 * source actions.
 *
 * @package    tweetex
 * @subpackage source
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sourceActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	 $this->pager = new sfDoctrinePager('TweetSource', sfConfig::get('app_max_sources_on_page'));
	 $this->pager->setQuery(Doctrine::getTable('TweetSource')->createQuery('a'));
	 $this->pager->setPage($request->getParameter('page'), 1);
	 $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->tweet_source = Doctrine::getTable('TweetSource')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->tweet_source);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TweetSourceForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TweetSourceForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tweet_source = Doctrine::getTable('TweetSource')->find(array($request->getParameter('id'))), sprintf('Object tweet_source does not exist (%s).', $request->getParameter('id')));
    $this->form = new TweetSourceForm($tweet_source);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tweet_source = Doctrine::getTable('TweetSource')->find(array($request->getParameter('id'))), sprintf('Object tweet_source does not exist (%s).', $request->getParameter('id')));
    $this->form = new TweetSourceForm($tweet_source);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tweet_source = Doctrine::getTable('TweetSource')->find(array($request->getParameter('id'))), sprintf('Object tweet_source does not exist (%s).', $request->getParameter('id')));
    $tweet_source->delete();

    $this->redirect('source/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tweet_source = $form->save();

      $this->redirect('source/edit?id='.$tweet_source->getId());
    }
  }
}
