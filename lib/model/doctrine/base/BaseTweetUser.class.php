<?php

/**
 * BaseTweetUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $screen_name
 * @property integer $twitter_user_id
 * @property string $description
 * @property integer $followers_count
 * @property integer $statuses_count
 * @property string $url
 * @property integer $friends_count
 * @property boolean $geo_enabled
 * @property timestamp $twitter_created_at
 * @property string $time_zone
 * @property string $location
 * @property string $lang
 * @property integer $utc_offset
 * @property string $profile_image_url
 * @property Doctrine_Collection $Tweet
 * @property Doctrine_Collection $Tweets
 * 
 * @method string              getName()               Returns the current record's "name" value
 * @method string              getScreenName()         Returns the current record's "screen_name" value
 * @method integer             getTwitterUserId()      Returns the current record's "twitter_user_id" value
 * @method string              getDescription()        Returns the current record's "description" value
 * @method integer             getFollowersCount()     Returns the current record's "followers_count" value
 * @method integer             getStatusesCount()      Returns the current record's "statuses_count" value
 * @method string              getUrl()                Returns the current record's "url" value
 * @method integer             getFriendsCount()       Returns the current record's "friends_count" value
 * @method boolean             getGeoEnabled()         Returns the current record's "geo_enabled" value
 * @method timestamp           getTwitterCreatedAt()   Returns the current record's "twitter_created_at" value
 * @method string              getTimeZone()           Returns the current record's "time_zone" value
 * @method string              getLocation()           Returns the current record's "location" value
 * @method string              getLang()               Returns the current record's "lang" value
 * @method integer             getUtcOffset()          Returns the current record's "utc_offset" value
 * @method string              getProfileImageUrl()    Returns the current record's "profile_image_url" value
 * @method Doctrine_Collection getTweet()              Returns the current record's "Tweet" collection
 * @method Doctrine_Collection getTweets()             Returns the current record's "Tweets" collection
 * @method TweetUser           setName()               Sets the current record's "name" value
 * @method TweetUser           setScreenName()         Sets the current record's "screen_name" value
 * @method TweetUser           setTwitterUserId()      Sets the current record's "twitter_user_id" value
 * @method TweetUser           setDescription()        Sets the current record's "description" value
 * @method TweetUser           setFollowersCount()     Sets the current record's "followers_count" value
 * @method TweetUser           setStatusesCount()      Sets the current record's "statuses_count" value
 * @method TweetUser           setUrl()                Sets the current record's "url" value
 * @method TweetUser           setFriendsCount()       Sets the current record's "friends_count" value
 * @method TweetUser           setGeoEnabled()         Sets the current record's "geo_enabled" value
 * @method TweetUser           setTwitterCreatedAt()   Sets the current record's "twitter_created_at" value
 * @method TweetUser           setTimeZone()           Sets the current record's "time_zone" value
 * @method TweetUser           setLocation()           Sets the current record's "location" value
 * @method TweetUser           setLang()               Sets the current record's "lang" value
 * @method TweetUser           setUtcOffset()          Sets the current record's "utc_offset" value
 * @method TweetUser           setProfileImageUrl()    Sets the current record's "profile_image_url" value
 * @method TweetUser           setTweet()              Sets the current record's "Tweet" collection
 * @method TweetUser           setTweets()             Sets the current record's "Tweets" collection
 * 
 * @package    tweetex
 * @subpackage model
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTweetUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tweet_user');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('screen_name', 'string', 15, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 15,
             ));
        $this->hasColumn('twitter_user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('followers_count', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('statuses_count', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('friends_count', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('geo_enabled', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('twitter_created_at', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('time_zone', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('location', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('lang', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));
        $this->hasColumn('utc_offset', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('profile_image_url', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));


        $this->index('mainUserIndex', array(
             'fields' => 
             array(
              0 => 'name',
              1 => 'description',
             ),
             ));
        $this->index('additionalUserIndex', array(
             'fields' => 
             array(
              0 => 'url',
              1 => 'time_zone',
              2 => 'location',
              3 => 'lang',
             ),
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Tweet', array(
             'local' => 'id',
             'foreign' => 'source_id'));

        $this->hasMany('Tweet as Tweets', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}