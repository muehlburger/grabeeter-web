<?php

/**
 * Tweet filter form base class.
 *
 * @package    tweetex
 * @subpackage filter
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTweetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TweetUser'), 'add_empty' => true)),
      'source_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TweetSource'), 'add_empty' => true)),
      'geolocation_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TweetGeoLocation'), 'add_empty' => true)),
      'in_reply_to_user_id'   => new sfWidgetFormFilterInput(),
      'in_reply_to_status_id' => new sfWidgetFormFilterInput(),
      'tweet_created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tweet_twitter_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'statuses_count'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TweetUser'), 'column' => 'id')),
      'source_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TweetSource'), 'column' => 'id')),
      'geolocation_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TweetGeoLocation'), 'column' => 'id')),
      'in_reply_to_user_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'in_reply_to_status_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tweet_created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'tweet_twitter_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'statuses_count'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'text'                  => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tweet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tweet';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'user_id'               => 'ForeignKey',
      'source_id'             => 'ForeignKey',
      'geolocation_id'        => 'ForeignKey',
      'in_reply_to_user_id'   => 'Number',
      'in_reply_to_status_id' => 'Number',
      'tweet_created_at'      => 'Date',
      'tweet_twitter_id'      => 'Number',
      'statuses_count'        => 'Number',
      'text'                  => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
