<?php

class common
{

	 /**
	  * Function to genrate random password to send user via mail.
	  * @param string $ssEmail username entered by the user.
	  * @access public
	  */
	 public static function randomNumber($ssEmail = '')
	 {  
		$snLength=10;
		$ssCharacters="0123456789abcdefghijklmnopqrstuvwxyz";

		for($p=0;$p<$snLength;$p++)
		{
		    $smRandom=$ssCharacters[mt_rand(0,strlen($ssCharacters))];
		}
      
		return $snEncryptRandom=substr(md5($ssEmail.$smRandom),0,10);
	 }


	/**
	 * This Function is used to generate the salt key
	 * @access_type public
	 * @param string $smUsername username entered by the user.
	 */
	 public static function generateSalt($smUsername = '')
	 {   
		  return md5($smUsername.gettimeofday(true));
	 }

	 /**
	 * This Function is used to encrypt the password on parameter
	 * @access public
	 * @param string $smSalt store the salt key.
	 * @param string $smPassword store the salt key
	 */
	 public static function encryptPassword($smSalt = '',$smPassword = '')
	 {
		return sha1($smSalt.$smPassword);
	 }

	/**
	 * This Function is used to save new password in database when user want to forget his/her password
	 * @access_type public
	 * @param string $ssTableName table name to store a new password.
	 * @param string $ssUsername username entered by the user.
	 * @param string $smPassword generated random number.
	 */
	 public static function saveNewPassword($ssTableName, $ssUsername, $smPassword)
	 {
		if(!empty($ssTableName) && !empty($ssUsername) && !empty($smPassword)) 
		{
			$oUser = Doctrine::getTable($ssTableName)->findOneByEmail($ssUsername); 

			if($oUser) 
			{
				$smEncryptPassword = common::encryptPassword($oUser->getSalt(),$smPassword);
				$oUser->setPassword($smEncryptPassword); 
				$oUser->save(); 
				return true; 
			} 
		} 
		return false; 
	 }


	/**
	 * This Function is used to get a record by his/her email.
	 * @access_type public
	 * @param string $ssTableName table name to store a new password.
	 * @param string $ssValue field value of a table.
	 */
     public static function getRecordByMail($ssTableName = '', $ssValue = '')
     {
		return $arResult = Doctrine_Query::create()
						->select('a.*')
						->from($ssTableName.' a')
						->where('a.email = ?', $ssValue)
						->fetchArray();
     }

	/**
	 * This Function is used to get a record of company and person on search keyword to fill the autocomplete textbox. 
	 * @access_type public
	 * @param string $ssKeyword keyword of search textbox.
	 */
     public static function getAutoCompleteData($ssKeyword)
     {
		$arNominationResult = Doctrine_Query::create()
						->select("n.first_name as name")
						->from('Nomination n')
						->Where('n.first_name LIKE ?', $ssKeyword."%")
						->andwhere('n.id_nomination != -1')
						->andwhere('n.approval_status = ?', 1)
						->andwhere('n.is_nominator = ?','N')
						->groupBy('n.first_name')
						->fetchArray();

		$arCompanyResult = Doctrine_Query::create()
						->select('c.company_name as name')
						->from('Company c')
						->where('c.company_name LIKE ?',$ssKeyword."%")
						->andwhere('c.id_company != 0')
						->groupBy('c.company_name')
						->fetchArray();

		
		$ssResult = array_merge($arNominationResult, $arCompanyResult);

		//function to sort the array by key in asecending order.
		function makeSortFunction($field) 
		{   
		    $code = "return strnatcmp(\$a['$field'], \$b['$field']);";   
		    return create_function('$a,$b', $code); 
		}  
		$compare = makeSortFunction('name'); 

		usort($ssResult, $compare);

		return $ssResult;
     }
} 
?>