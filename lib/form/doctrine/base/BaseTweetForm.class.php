<?php

/**
 * Tweet form base class.
 *
 * @method Tweet getObject() Returns the current form's model object
 *
 * @package    tweetex
 * @subpackage form
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTweetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TweetUser'), 'add_empty' => false)),
      'source_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TweetSource'), 'add_empty' => false)),
      'geolocation_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TweetGeoLocation'), 'add_empty' => true)),
      'in_reply_to_user_id'   => new sfWidgetFormInputText(),
      'in_reply_to_status_id' => new sfWidgetFormInputText(),
      'tweet_created_at'      => new sfWidgetFormDateTime(),
      'tweet_twitter_id'      => new sfWidgetFormInputText(),
      'statuses_count'        => new sfWidgetFormInputText(),
      'text'                  => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TweetUser'))),
      'source_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TweetSource'))),
      'geolocation_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TweetGeoLocation'), 'required' => false)),
      'in_reply_to_user_id'   => new sfValidatorInteger(array('required' => false)),
      'in_reply_to_status_id' => new sfValidatorInteger(array('required' => false)),
      'tweet_created_at'      => new sfValidatorDateTime(),
      'tweet_twitter_id'      => new sfValidatorInteger(),
      'statuses_count'        => new sfValidatorInteger(),
      'text'                  => new sfValidatorString(array('max_length' => 140)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tweet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tweet';
  }

}
