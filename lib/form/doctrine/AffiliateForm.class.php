<?php

/**
 * Affiliate form.
 *
 * @package    grabeeter
 * @subpackage form
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AffiliateForm extends BaseAffiliateForm
{
	public function configure()
	{
		$this->useFields(array(
      'url', 
      'email', 
      ));
      $this->widgetSchema['url']->setLabel('Website URL');
      $this->widgetSchema['url']->setAttribute('size', 50);

      $this->widgetSchema['email']->setAttribute('size', 50);

      $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true));
       
	}
}
