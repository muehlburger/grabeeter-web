<?php

/**
 * TweetUser filter form base class.
 *
 * @package    tweetex
 * @subpackage filter
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTweetUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'               => new sfWidgetFormFilterInput(),
      'screen_name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'twitter_user_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'        => new sfWidgetFormFilterInput(),
      'followers_count'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'statuses_count'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'                => new sfWidgetFormFilterInput(),
      'friends_count'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'geo_enabled'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'twitter_created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'time_zone'          => new sfWidgetFormFilterInput(),
      'location'           => new sfWidgetFormFilterInput(),
      'lang'               => new sfWidgetFormFilterInput(),
      'utc_offset'         => new sfWidgetFormFilterInput(),
      'profile_image_url'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'               => new sfValidatorPass(array('required' => false)),
      'screen_name'        => new sfValidatorPass(array('required' => false)),
      'twitter_user_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'        => new sfValidatorPass(array('required' => false)),
      'followers_count'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'statuses_count'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'url'                => new sfValidatorPass(array('required' => false)),
      'friends_count'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'geo_enabled'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'twitter_created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'time_zone'          => new sfValidatorPass(array('required' => false)),
      'location'           => new sfValidatorPass(array('required' => false)),
      'lang'               => new sfValidatorPass(array('required' => false)),
      'utc_offset'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'profile_image_url'  => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tweet_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TweetUser';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'name'               => 'Text',
      'screen_name'        => 'Text',
      'twitter_user_id'    => 'Number',
      'description'        => 'Text',
      'followers_count'    => 'Number',
      'statuses_count'     => 'Number',
      'url'                => 'Text',
      'friends_count'      => 'Number',
      'geo_enabled'        => 'Boolean',
      'twitter_created_at' => 'Date',
      'time_zone'          => 'Text',
      'location'           => 'Text',
      'lang'               => 'Text',
      'utc_offset'         => 'Number',
      'profile_image_url'  => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
