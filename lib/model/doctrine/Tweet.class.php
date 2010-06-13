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
	public function asArray() {
		return array(
			'text'			=>		$this->getText(),
			'screen_name'	=>		$this->getTweetUser(),
			'created'		=>		$this->getDateTimeObject('tweet_created_at')->format('Y-m-d')
		);	
	}
	
	public function save(Doctrine_Connection $conn = null) {
		$ret = parent::save($conn);

		Doctrine::getTable('TweetUser')->updateLastSavedTweet($this->getUserId(), $this->getTweetTwitterId());
		$this->updateLuceneIndex();
		return $ret;
	}

	public function updateLuceneIndex() {
		$index = $this->getTable()->getLuceneIndex();

		// remove existing entries
		foreach ($index->find('pk:'.$this->getId()) as $hit)
		{
			$index->delete($hit->id);
		}

		$doc = new Zend_Search_Lucene_Document();
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('text', $this->getText(), 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('screenName', $this->getTweetUser()));

		// add tweet to the index
		$index->addDocument($doc);
		$index->commit();
	}

	public function getTextSlug() {
		return Tweetex::slugify($this->getText());
	}
}
