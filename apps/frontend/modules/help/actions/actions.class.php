<?php

/**
 * help actions.
 *
 * @package    tweetex
 * @subpackage help
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class helpActions extends sfActions
{
	/**
	 * Executes index action
	 * 
	 * @param sfWeRequest $request
	 */
	public function executeIndex(sfWebRequest $request) {
		$this->tweet_users = Doctrine::getTable('TweetUser')
		->createQuery('a')
		->limit(11)
		->execute();
		
		$q = Doctrine::getTable('Tweet')
		->getMatchingTweets(null, sfConfig::get('app_default_user_on_starpage'));
		$q->limit(sfConfig::get('app_max_tweets_on_startpage'));
		
		$this->tweets = $q->execute();
	}
	/**
	 * Executes faq action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeFaq(sfWebRequest $request) {
		 
	}

	/**
	 * Executes userGuide action
	 * @param sfRequest $request A request object
	 */
	public function executeUserguide(sfWebRequest $request) {

	}

	public function executeApi(sfWebRequest $request) {
		 
	}
}
