<?php

/**
 * Tweet form.
 *
 * @package    twitarch
 * @subpackage form
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TweetForm extends BaseTweetForm
{
  public function configure()
  {
  	unset($this['updated_at'], $this['tweet_twitter_id']);
  	unset($this['source_id'], $this['geolocation_id'], $this['in_reply_to_user_id'], $this['in_reply_to_status_id']);
  }
}
