<?php

/**
 * Admin form.
 * @package    form
 * @subpackage Admin
 * @version    SVN: $Id: ChangePasswordForm.class.php,v 1.5 2010/08/18 10:39:14 shashank Exp $
 */
class ChangePasswordForm extends BaseLoginForm
{
  public function configure()
  {

	$this->useFields(array('password')); 
	
	$this->setWidgets(array('password'				=> new sfWidgetFormInputPassword(array(),array('maxlength'=>60,'size'=>20,'tabindex'=>1)),
							'new_password'  	=> new sfWidgetFormInputPassword(array(),array('maxlength'=>60,'size'=>20,'tabindex'=>1)),
					   	    'confirm_password'  => new sfWidgetFormInputPassword(array(),array('maxlength'=>60,'size'=>20,'tabindex'=>1)),		  
					  ));	  	  
	  
	$this->widgetSchema->setLabels(array('password'  	  		=> __("Old Password"),
										 'new_password' 	=> __("New Password"),
										 'confirm_password' => __("Confirm Password"),		  
								  ));
	
	 $this->setValidators(array('password'  => new sfValidatorAnd(array(new sfValidatorString(), 
	 														 	   new sfValidatorCallback(array('callback'=> array($this,'checkOldPassword'),'arguments'=> array()),
														          array('invalid'=>__('Please enter valid old password')))),
																array('required' => true, 'trim' => true),
																array('required'=>__('Please enter old password')))));
																	
		 $this->validatorSchema['new_password']= new sfValidatorAnd(
										  array(new sfValidatorRegex(array('pattern' => '/^[a-z0-9 _åÅäÄöÖ€éšàâäèéêëîïôœùûüÿÀÁÄÈÉÊËÎÏÔŒÙÛÜŸçÇ€íáéíóúüÁÉÍÓÚÜñÑ¿¡€ßƒæåœøÆÅŒØ€-]*$/i'),
									   array('invalid' => __('Please enter valid password')))),
									   array('required'=>true, 'trim' => true ),
									   array('required'=>__('Please enter new password')));

		$this->validatorSchema['confirm_password'] = new sfValidatorString(array('required'=>true, 'trim' => true ),array('required'=>__('Please enter confirm password')));
		  


		$this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('confirm_password', sfValidatorSchemaCompare::EQUAL, 'new_password',
											array('throw_global_error' => false),
    										array('invalid' => __('New password & confirm password do not match'))));

	
    $this->widgetSchema->setNameFormat('changePassword[%s]');
    $this->validatorSchema->setOption('allow_extra_fields', true);
	$this->validatorSchema->setOption('filter_extra_fields', false);

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        
  }  
      
	/**
 	 * Function for check Old Password with inputed Password
 	 * @param $validator = validator call
	 * @param $values = Password
	 */      
      
     public function checkOldPassword($validator, $values)   
     {
     		$ssUserName =  sfContext::getInstance()->getUser()->getAttribute('username','','login');
			$oUser = Doctrine::getTable('Login')->findOneByUsername(trim($ssUserName));		
			if($oUser) 
			{
				if($oUser->getPassword() == sha1($oUser->getSalt().$values))	
					 return $values;								
				else
	                 throw new sfValidatorError($validator, 'invalid');				 
			}
	 }            												          
}
