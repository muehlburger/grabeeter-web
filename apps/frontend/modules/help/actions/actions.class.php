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
		$users = Doctrine::getTable('TweetUser')
		->createQuery('a')
		->select('a.*, RANDOM() rand')
		->orderBy('rand')	
		->limit(sfConfig::get('app_max_users_on_startpage'))
		->execute();
		
		$randomUserIndex = rand(0, sizeof($users) - 1);
		$user = $users[$randomUserIndex];
		$screenName = $user->getScreenName();
				
		$q = Doctrine::getTable('Tweet')
		->getMatchingTweets(null, $screenName);
		$q->limit(sfConfig::get('app_max_tweets_on_startpage'));
		
		$this->tweets = $q->execute();
		
		foreach ($this->tweets as $tweet) {
			$this->$usernames = Tweetex::extractUsernames($tweet);
		}
		$this->tweet_users = $users;
		$this->user = $user;
	}
	/**
	 * Executes faq action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeFaq(sfWebRequest $request) {
		 
	}

	/**
	 * Executes help action
	 * @param sfRequest $request A request object
	 */
	public function executeHelp(sfWebRequest $request) {

	}

	/**
	 * Executes api action
	 * @param sfWebRequest $request
	 */
	public function executeApi(sfWebRequest $request) {
		 
	}
}
