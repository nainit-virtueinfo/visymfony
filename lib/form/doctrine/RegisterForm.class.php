<?php

/**
 * Login form.
 *
 * @package    doctrine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RegisterForm extends BaseLoginForm
{
  public function configure()
  {
	  unset($this['id'],$this['created_at'],$this['updated_at'],$this['salt']);
	  if(!$this->isNew())
		  unset($this['password']);
	  $this->widgetSchema['first_name'] =new sfWidgetFormInputText();
	  $this->widgetSchema['last_name'] =new sfWidgetFormInputText();
	  $this->widgetSchema['username'] =new sfWidgetFormInputText();
	  if($this->isNew())
		  $this->widgetSchema['password'] =new sfWidgetFormInputPassword();

	  $this->widgetSchema['email'] =new sfWidgetFormInputText();

	  $this->validatorSchema['first_name'] =new sfValidatorString(array('max_length' => 255,'required'=>true),array('required'=>'Enter firstname'));  
	  $this->validatorSchema['last_name'] =new sfValidatorString(array('max_length' => 255,'required'=>true),array('required'=>'Enter lastname'));
	  if($this->isNew())
	  {
			$this->validatorSchema['username'] =new sfValidatorAnd(
                              array(new sfValidatorString(array('max_length' => 255,'required'=>true),array('required'=>'Enter username')),
									new sfValidatorDoctrineUnique(array('model'  => 'Login','column' => 'username','throw_global_error'=>true),array('invalid'=>__('Username already exists'))))
									, array('required' => true, 'trim' => true ), array('required'=>__('Enter username')));
			$this->validatorSchema['password'] =new sfValidatorString(array('max_length' => 10),array('max_length'=>'password is too long','required'=>'Enter password'));
			$this->validatorSchema['email'] = new sfValidatorAnd( 
                                  array(new sfValidatorEmail(array('trim' => true),array('invalid'=>__('Please enter valid email. Example : "something@something.com"'),'required' => __('Please enter email'))), 
                                        new sfValidatorDoctrineUnique(array('model'=>'Login' ,'column'=>'email','throw_global_error'=>true), array('invalid'=>__('Email already exists'))),    
                                      ), array('required' => true, 'trim' => true ), array('required'=>__('Please enter email')));
	  }
	  else
	  { 
		  $oRecord = $this->getObject()->getData();
		  $this->validatorSchema['username'] = new sfValidatorAnd( 
                    array(new sfValidatorString(array('trim' => true),array('required' =>__('Please enter username'))),
                    new sfValidatorCallback( 
                    array('callback'=> array($this, 'checkUniqueField'), 
                                              'arguments'=> array('snId'=>$oRecord['id'], 
                                              'ssModuleName'=>'Login', 
                                              'ssFieldName'=>'username', 
                                              'ssIdName'=>'id', 
                                              )), 
                    array('invalid'=>__('Username already exists'))),), 
                    array('required' => true, 'trim' => true), array('required'=>__("Please enter username")));
                    
		  $this->validatorSchema['email'] = new sfValidatorAnd( 
                    array(new sfValidatorEmail(array('trim' => true),array('invalid'=>__('Please enter valid email. Example : "something@something.com"'),'required' => __('Please enter email'))),
                    new sfValidatorCallback( 
                    array('callback'=> array($this, 'checkUniqueField'), 
                                              'arguments'=> array('snId'=>$oRecord['id'], 
                                              'ssModuleName'=>'Login', 
                                              'ssFieldName'=>'email', 
                                              'ssIdName'=>'id', 
                                              )), 
                    array('invalid'=>__('Email already exists'))),), 
                    array('required' => true, 'trim' => true), array('required'=>__("Please enter email")));
	  }
	  $this->widgetSchema->setNameFormat('login[%s]');
	  $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
