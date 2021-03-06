<?php

 /**
 * Login
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    doctrine
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Login extends BaseLogin
{
	/**
	* function to validate the old password and change old password when admin want to change his/her password
	* @access public
	* @param $ssUsername to store the username
	* @param $ssOldPassword to store the old password
	* @param $ssNewPassword to store the new password
	*/
	public static function validateChangePwd($ssUsername,$ssOldPassword,$ssNewPassword) 
	{   
		if(!empty($ssUsername) && !empty($ssOldPassword)) 
		{ 
			$oUser = Doctrine::getTable('Login')->findOneByUsername(trim($ssUsername));

			if($oUser) 
			{ 
				if($oUser->getPassword() == $ssOldPassword) 
				{ 
					$oUser->setPassword($ssNewPassword); 
					$oUser->save(); 
					return true; 
				} 
			} 
		} 
		return false; 
	}

	/**
	* function to validate the email address when admin want to forget his password
	* @access public
	* @param $ssEmail to store the email address
	*/
	public static function validateAdminEmailAddress($ssEmail)
	{
		if(!empty($ssEmail))
		{
			$oUser = Doctrine::getTable('Login')->findOneByEmail(trim($ssEmail));
			if($oUser)
			{
				if($oUser->getEmail())
				{
					return true;
				}
			}
		}
		return false;
	}
}