<?php

/**
 * api actions.
 *
 * @package    tweetex
 * @subpackage api
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
	public function executeList(sfWebRequest $request) {
		$this->tweets = array();
		foreach ($this->getRoute()->getObjects() as $tweet) {
			$this->tweets[$this->generateUrl('tweet_show', $tweet, true)] = $tweet->asArray();
		}
		
		switch ($request->getRequestFormat())
	    {
	      case 'yaml':
	        $this->setLayout(false);
	        $this->getResponse()->setContentType('text/yaml');
	        break;
	    }
	}
}
