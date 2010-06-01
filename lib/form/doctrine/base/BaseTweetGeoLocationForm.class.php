<?php

/**
 * TweetGeoLocation form base class.
 *
 * @method TweetGeoLocation getObject() Returns the current form's model object
 *
 * @package    tweetex
 * @subpackage form
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTweetGeoLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'latitude'   => new sfWidgetFormInputText(),
      'longitude'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'latitude'   => new sfValidatorNumber(array('required' => false)),
      'longitude'  => new sfValidatorNumber(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tweet_geo_location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TweetGeoLocation';
  }

}
