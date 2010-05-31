<?php 
class RegistrationForm extends BaseForm {
	
	public function configure()
	{
		$this->setWidgets(array(
		  'username'	=>	new sfWidgetFormInputText()
		));
		
		$this->widgetSchema->setNameFormat('registration[%s]');
		
		$this->setValidators(array(
			'username'	=> new sfValidatorString(array(
				'trim' => true, 'min_length' => 1, 'max_length' => 15
			), array(
				'required'	=> 'Please enter a Twitter username!',
				'max_length' => 'The username "%value%" is too long. It must not be longer than %max_length% characters.',
			))));
	}
}