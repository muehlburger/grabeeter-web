<?php

require_once dirname(__FILE__).'/../lib/affiliateGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/affiliateGeneratorHelper.class.php';

/**
 * affiliate actions.
 *
 * @package    grabeeter
 * @subpackage affiliate
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliateActions extends autoAffiliateActions
{
	public function executeListActivate()
	{
		$affiliate = $this->getRoute()->getObject();
		$affiliate->activate();

		// send an email to the affiliate
		$message = $this->getMailer()->compose(
		array('muehlburger@tugraz.at' => 'Grabeeter API Bot'),
		$affiliate->getEmail(),
      'Grabeeter affiliate token',
      <<<EOF
Your Grabeeter affiliate account has been activated.
 
Your token is {$affiliate->getToken()}.
 
The Grabeeter API Bot.
EOF
		);

		$this->getMailer()->send($message);
		$this->redirect('affiliate');
	}

	public function executeListDeactivate()
	{
		$this->getRoute()->getObject()->deactivate();

		$this->redirect('affiliate');
	}

	public function executeBatchActivate(sfWebRequest $request)
	{
		$q = Doctrine_Query::create()
		->from('Affiliate a')
		->whereIn('a.id', $request->getParameter('ids'));

		$affiliates = $q->execute();

		foreach ($affiliates as $affiliate)
		{
			$affiliate->activate();
		}

		$this->redirect('affiliate');
	}

	public function executeBatchDeactivate(sfWebRequest $request)
	{
		$q = Doctrine_Query::create()
		->from('Affiliate a')
		->whereIn('a.id', $request->getParameter('ids'));

		$affiliates = $q->execute();

		foreach ($affiliates as $affiliate)
		{
			$affiliate->deactivate();
		}

		$this->redirect('affiliate');
	}

}
