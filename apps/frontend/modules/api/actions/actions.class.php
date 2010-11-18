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
	public function executeRegister(sfWebRequest $request) {
		$username = $request->getParameter('screen_name');
		$token = $request->getParameter('token');

		$affiliate = Doctrine_Core::getTable('Affiliate') ->findOneByToken($token);

		if (!$affiliate || !$affiliate->getIsActive()) {
			throw new sfError404Exception(sprintf('Affiliate with token "%s" does not exist or is not activated.', $token));
		} else {
			Tweetex::registerUsername($username);
			$this->username = $username;
		}
	}

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

		$this->setLayout(false);
		switch ($request->getRequestFormat())
		{
			case 'yaml':
				$response->setContentType('text/yaml');
				break;
			case 'xml':
				$response->setContentType('application/xml');
				break;
			case 'json':
				$response->setContentType('application/json');
		}
	}
}
