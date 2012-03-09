<?php

/**
 * Login form.
 *
 * @package    doctrine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LoginForm extends BaseLoginForm
{
  public function configure()
  {
	  unset($this['id'],$this['email'],$this['created_at'],$this['updated_at']);
	  $this->setWidgets(array(
      'username'   => new sfWidgetFormInputText(),
      'password'   => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'username'   => new sfValidatorString(array('max_length' => 255,'required'=>true),array('required'=>'Enater Username')),
      'password'   => new sfValidatorString(array('max_length' => 10),array('max_length'=>'password is too long','required'=>'Enter password')),
    ));
	  $this->widgetSchema->setNameFormat('login[%s]');

  }
}
