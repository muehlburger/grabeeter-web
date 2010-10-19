<?php

/**
 * registration actions.
 *
 * @package    tweetex
 * @subpackage registration
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registrationActions extends sfActions
{

	/**
	 * Executes the thankyou action
	 * 
	 * @param sfWebRequest $request
	 */
	public function executeThankyou(sfWebRequest $request) {
			
	}

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->form = new RegistrationForm();

		
		if($request->isMethod('post')) {
			$this->form->bind($request->getParameter('registration'));
			
			if($this->form->isValid()) {	
				$username = $this->form->getValue('username');
				
				Tweetex::registerUsername($username);
				$this->redirect('@registration_thankyou');	
			}
		}
	}

}
