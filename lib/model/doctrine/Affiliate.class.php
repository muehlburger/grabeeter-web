<?php

/**
 * Affiliate
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    grabeeter
 * @subpackage model
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Affiliate extends BaseAffiliate
{
	public function activate()
	{
		$this->setIsActive(true);
		return $this->save();
	}

	public function deactivate()
	{
		$this->setIsActive(false);
		return $this->save();
	}


	public function save(Doctrine_Connection $connection = null) {
		if(!$this->getToken()) {
			$this->setToken(sha1($this->getEmail().rand(11111, 99999)));
		}

		return parent::save($connection);
	}
}