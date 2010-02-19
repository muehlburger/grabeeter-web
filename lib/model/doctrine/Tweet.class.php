<?php

/**
 * Tweet
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    twitarch
 * @subpackage model
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Tweet extends BaseTweet
{	
	public function getTextSlug() {
		return Twitarch::slugify($this->getText());
	}
}