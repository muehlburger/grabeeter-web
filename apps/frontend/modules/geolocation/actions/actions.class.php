<?php

/**
 * geolocation actions.
 *
 * @package    twitarch
 * @subpackage geolocation
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class geolocationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tweet_geo_locations = Doctrine::getTable('TweetGeoLocation')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->tweet_geo_location = Doctrine::getTable('TweetGeoLocation')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->tweet_geo_location);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TweetGeoLocationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TweetGeoLocationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tweet_geo_location = Doctrine::getTable('TweetGeoLocation')->find(array($request->getParameter('id'))), sprintf('Object tweet_geo_location does not exist (%s).', $request->getParameter('id')));
    $this->form = new TweetGeoLocationForm($tweet_geo_location);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tweet_geo_location = Doctrine::getTable('TweetGeoLocation')->find(array($request->getParameter('id'))), sprintf('Object tweet_geo_location does not exist (%s).', $request->getParameter('id')));
    $this->form = new TweetGeoLocationForm($tweet_geo_location);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tweet_geo_location = Doctrine::getTable('TweetGeoLocation')->find(array($request->getParameter('id'))), sprintf('Object tweet_geo_location does not exist (%s).', $request->getParameter('id')));
    $tweet_geo_location->delete();

    $this->redirect('geolocation/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tweet_geo_location = $form->save();

      $this->redirect('geolocation/edit?id='.$tweet_geo_location->getId());
    }
  }
}
