<?php

/**
 * TweetUser form base class.
 *
 * @method TweetUser getObject() Returns the current form's model object
 *
 * @package    tweetex
 * @subpackage form
 * @author     Herbert Muehlburger
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTweetUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'name'               => new sfWidgetFormInputText(),
      'screen_name'        => new sfWidgetFormInputText(),
      'twitter_user_id'    => new sfWidgetFormInputText(),
      'description'        => new sfWidgetFormInputText(),
      'followers_count'    => new sfWidgetFormInputText(),
      'statuses_count'     => new sfWidgetFormInputText(),
      'url'                => new sfWidgetFormInputText(),
      'friends_count'      => new sfWidgetFormInputText(),
      'geo_enabled'        => new sfWidgetFormInputCheckbox(),
      'twitter_created_at' => new sfWidgetFormDateTime(),
      'time_zone'          => new sfWidgetFormInputText(),
      'location'           => new sfWidgetFormInputText(),
      'lang'               => new sfWidgetFormInputText(),
      'utc_offset'         => new sfWidgetFormInputText(),
      'profile_image_url'  => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'screen_name'        => new sfValidatorString(array('max_length' => 15)),
      'twitter_user_id'    => new sfValidatorInteger(),
      'description'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'followers_count'    => new sfValidatorInteger(array('required' => false)),
      'statuses_count'     => new sfValidatorInteger(array('required' => false)),
      'url'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'friends_count'      => new sfValidatorInteger(array('required' => false)),
      'geo_enabled'        => new sfValidatorBoolean(array('required' => false)),
      'twitter_created_at' => new sfValidatorDateTime(),
      'time_zone'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'location'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'               => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'utc_offset'         => new sfValidatorInteger(array('required' => false)),
      'profile_image_url'  => new sfValidatorString(array('max_length' => 255)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'TweetUser', 'column' => array('screen_name')))
    );

    $this->widgetSchema->setNameFormat('tweet_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TweetUser';
  }

}
