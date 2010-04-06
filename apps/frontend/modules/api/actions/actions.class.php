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
		
		switch ($request->getRequestFormat())
	    {
	      case 'yaml':
	        $this->setLayout(false);
	        $this->getResponse()->setContentType('text/yaml');
	        break;
	    }
	}
	
	/**
	 * Executes the search action.
	 * Returns a list of tweets matching the search query.
	 * 
	 * @param sfWebRequest $request
	 */
	public function executeSearch(sfWebRequest $request) {
		$this->tweets = array();
		if(!$query = $request->getParameter('q')) {
			$query = "";
		}

		$results = Doctrine::getTable('Tweet')->getForLuceneQuery($query);
		
		foreach ($results as $tweet) {
			$this->tweets[$this->generateUrl('tweet_show', $tweet, true)] = $tweet->asArray();
		}
		
		switch ($request->getRequestFormat())
	    {
	      case 'yaml':
	        $this->setLayout(false);
	        $this->getResponse()->setContentType('text/yaml');
	        break;
	    }
	    
	    $this->setTemplate('list');
		
	}
}
