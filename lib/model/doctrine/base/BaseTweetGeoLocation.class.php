<?php

/**
 * BaseTweetGeoLocation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property float $latitude
 * @property float $longitude
 * @property Doctrine_Collection $Tweets
 * 
 * @method float               getLatitude()  Returns the current record's "latitude" value
 * @method float               getLongitude() Returns the current record's "longitude" value
 * @method Doctrine_Collection getTweets()    Returns the current record's "Tweets" collection
 * @method TweetGeoLocation    setLatitude()  Sets the current record's "latitude" value
 * @method TweetGeoLocation    setLongitude() Sets the current record's "longitude" value
 * @method TweetGeoLocation    setTweets()    Sets the current record's "Tweets" collection
 * 
 * @package    twitarch
 * @subpackage model
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
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
             'length' => '9',
             'scale' => '6',
             ));
        $this->hasColumn('longitude', 'float', 9, array(
             'type' => 'float',
             'notnull' => true,
             'default' => 0,
             'length' => '9',
             'scale' => '6',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Tweet as Tweets', array(
             'local' => 'id',
             'foreign' => 'geolocation_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}