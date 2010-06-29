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
				
				// Remove spaces in username
				$username = preg_replace('/\s+/', '', $username);

				$filepath = sfConfig::get('sf_data_dir').'/'.sfConfig::get('app_username_file');
				$newUsers = sfConfig::get('sf_data_dir').'/newUsers';
				
				$stordeUsernames = file_get_contents($filepath);
				$storedUsernames = explode("\n", $stordeUsernames);
				
				if(!in_array($username, $storedUsernames)) {
					$username = $username . "\n";
					$bytesStored = file_put_contents($filepath, $username, FILE_APPEND);
					$bytesNewUsers = file_put_contents($newUsers, $username, FILE_APPEND);
				}
				
				$this->redirect('@registration_thankyou');	
			}
		}
	}

}
