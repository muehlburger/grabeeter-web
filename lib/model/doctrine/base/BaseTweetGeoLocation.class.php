<?php

/**
 * BaseTweetGeoLocation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property float $latitude
 * @property float $longitude
 * @property Doctrine_Collection $Tweet
 * 
 * @method float               getLatitude()  Returns the current record's "latitude" value
 * @method float               getLongitude() Returns the current record's "longitude" value
 * @method Doctrine_Collection getTweet()     Returns the current record's "Tweet" collection
 * @method TweetGeoLocation    setLatitude()  Sets the current record's "latitude" value
 * @method TweetGeoLocation    setLongitude() Sets the current record's "longitude" value
 * @method TweetGeoLocation    setTweet()     Sets the current record's "Tweet" collection
 * 
 * @package    tweetex
 * @subpackage model
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTweetGeoLocation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tweet_geo_location');
        $this->hasColumn('latitude', 'float', 9, array(
             'type' => 'float',
             'notnull' => true,
             'default' => 0,
             'length' => 9,
             'scale' => '6',
             ));
        $this->hasColumn('longitude', 'float', 9, array(
             'type' => 'float',
             'notnull' => true,
             'default' => 0,
             'length' => 9,
             'scale' => '6',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Tweet', array(
             'local' => 'id',
             'foreign' => 'geolocation_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}