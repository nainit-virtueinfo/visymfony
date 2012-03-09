<?php

/**
 * Project form base class.
 *
 * @package    doctrine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
  }

	 /**
	 * function checkUniqueField for checkUniqueField Validation for form
	 * @param $validator = Validator field 
	 * @param $values = Unique field
	 * @param $arguments = Extra Parameters 
	 */
	 public function checkUniqueField($validator,$values,$arguments)
	 {
		if(sfGeneral::checkUniqeNameExist($values,$arguments)==0)
			return $values;
		else
			throw new sfValidatorError($validator, 'invalid');
    }    
}
