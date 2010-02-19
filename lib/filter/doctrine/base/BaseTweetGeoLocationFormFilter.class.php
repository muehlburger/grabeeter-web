<?php

/**
 * TweetGeoLocation filter form base class.
 *
 * @package    tweetex
 * @subpackage filter
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTweetGeoLocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'latitude'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'longitude'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'latitude'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitude'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tweet_geo_location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TweetGeoLocation';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'latitude'   => 'Number',
      'longitude'  => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
