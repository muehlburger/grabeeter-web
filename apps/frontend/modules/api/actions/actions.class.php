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
	/**
	 * Executes the list action which returns a list of tweets for
	 * the given twitter screen_name.
	 * 
	 * @param sfWebRequest $request
	 */
	public function executeList(sfWebRequest $request) {
		$this->tweets = array();

		foreach ($this->getRoute()->getObjects() as $tweet) {
			$this->tweets[$this->generateUrl('tweet_show', $tweet, true)] = $tweet->asArray();
		}
		
		$response = $this->getResponse();
		
		$response->setStatusCode(200);
	    $response->addVaryHttpHeader('Accept-Language');
	    $response->addCacheControlHttpHeader('no-cache');
		
		switch ($request->getRequestFormat())
	    {
	      case 'yaml':
	        $this->setLayout(false);
	        $response->setContentType('text/yaml');
	        break;
	      case 'xml':
	      	$this->setLayout(false);
	      	$response->setContentType('application/xml');
	      	break;
	      case 'json':
	      	$this->setLayout(false);
	      	$response->setContentType('application/json');
	    }
	}
}
