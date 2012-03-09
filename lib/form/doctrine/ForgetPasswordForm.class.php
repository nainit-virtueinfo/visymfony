<?php

/**
 * Admin form.
 *
 * @package    login
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: ForgetPasswordForm.class.php,v 1.5 2010/08/18 10:39:15 shashank Exp $
 */
class ForgetPasswordForm extends BaseForm
{
  public function configure()
  {
	  $this->setWidgets(array(
		  'email' => new sfWidgetFormInputText(array(),array('maxlength' => 70,'size' => 62,'tabindex' => 1)),
	   ));

       $this->widgetSchema->setLabels(array(
		  'email'  => __('E-Mail ID'),
	   ));
	   
      $this->setValidators(array(
		  'email'  => new sfValidatorEmail(array('required' => true,'trim' => true),array('required'=> __('Please enter email address'),'invalid'=> __('Please provide valid email address'))),
	  ));
	   
      $this->widgetSchema->setNameFormat('forgetPassword[%s]');
	  $this->validatorSchema->setOption('allow_extra_fields', true);
	  $this->validatorSchema->setOption('filter_extra_fields', false);
  }
}
