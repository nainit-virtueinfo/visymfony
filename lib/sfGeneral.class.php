<?php 
/**
 * General class
 * 
 * @package    Common Functions 
 * @author     HRP,AKP
 * @copyright  Copyright @ 2008, Fiare OY
 * @version    $Id: sfGeneral.class.php,v 1.4 2010/07/22 05:55:24 shashank Exp $
 */

class sfGeneral
{
   	/**
	 * Execute checkUniqeNameExist function check unique value of field.
	 * 
	 * @param $ssValue = value of Field
	 * @param $aArguments = arguments of field.
	 */	 
   static public function checkUniqeNameExist($ssValue,$aArguments)
	{
		if($ssValue != '' && is_array($aArguments) && count($aArguments) >= 4)
		{
			$ssQuery = Doctrine_Query::create()
				  ->from($aArguments['ssModuleName']." ".strtolower(substr($aArguments['ssModuleName'],0,1)))
				  ->where(strtolower(substr($aArguments['ssModuleName'],0,1)).".".$aArguments['ssFieldName'].' = ?', $ssValue);

				  if(isset($aArguments['aFields']))
				  {
	
						foreach($aArguments['aFields'] as $snFieldName =>$ssVal)
							$ssQuery->andWhere(strtolower(substr($aArguments['ssModuleName'],0,1)).".".$snFieldName.' = ?', $ssVal);
		
				  }			
				  if(isset($aArguments['snId']) && $aArguments['snId']!='')	  
					$ssQuery->andWhere(strtolower(substr($aArguments['ssModuleName'],0,1)).".".$aArguments['ssIdName'].' != ?', $aArguments['snId']);
					
			return $oResult = $ssQuery->count();
		}
		else
			return false;	
		
		  
	}
	/**
	 * Execute setPriceFormat function setPriceFormat of price.
	 * 
	 * @param $snPrice = price 
	 */
	 static public function setPriceFormat($snPrice)
	 {
	 	return sfConfig::get('app_currency_symbol').((is_float($snPrice)) ? number_format($snPrice,2,'.',',') : number_format($snPrice,2));
	 }
	 
	 
	 /**
	 * Execute checkArrayValue function check key exist in array or not
	 * 
	 * @param $aArray = array
	 * @param $snKey  = key of array
	 */
	 static public function checkArrayValue($aArray,$snKey)
	 {
	 	return isset($aArray[$snKey]) ? $aArray[$snKey] : '';
	 }
	 /**
	 * Execute generateThumbnailImage function generate thumbnail image of image
	 * 
	 * @param $ssImageName = image name 
	 * @param $ssThumbnailImage = thumbnail image name
	 * @param $snWidth = width of thumbnail image 
	 * @param $snHeight = height of thumbnail image
	 * @param $ssType = type of thumbnail image  
	 */
	 static public function generateThumbnailImage($ssImageName,$ssThumbnailImage,$snWidth,$snHeight,$ssType)
	 {
	 	 $omThumbnail = new sfThumbnail($snWidth, $snHeight, true,true); 
		 
         $omThumbnail->loadFile(sfConfig::get('sf_upload_dir').'/'.$ssImageName); 
         
		 $omThumbnail->save(sfConfig::get('sf_upload_dir').'/'.$ssThumbnailImage, $ssType);
         
	 }
	 
	 /**
	  * Execute setDateFormat function return Date with spacific format.
	  *
	  * @param $ssDate = Date on which format to be apply.
	  */
	 static public function setDateFormat($ssDate)
	 {
		if ($ssDate != '')
			return date('d.m.Y',strtotime($ssDate));
			
		return false;
	 }
	 
	 /**
	  * Execute setDateTimeFormat function return Date with spacific format.
	  *
	  * @param $ssDate = Date on which format to be apply.
	  */
	 static public function setDateTimeFormat($ssDate,$ssDateFormat='d.m.Y H:i:s')
	 {
	 	if ($ssDate != '')
	 		return date($ssDateFormat,strtotime($ssDate));
 		
	 	return false;
	 }
		
	/**
	 * Execute getPlaceOfferStatusClass function return class of offer from status
	 * 
	 * @param $ssStatus = status
	 */
	 static public function getPlaceOfferStatusClass($ssStatus)
	 {
	 	switch($ssStatus)
	 	{
	 		case 'conditional':
	 		     return 'partial';
	 		case 'winning':
	 		     return 'offerIn';
	 		case 'lost':
	 		     return 'withdrawn';  	
	 	}
	 	
	 }
		
	 /**
	 * Execute getLink function return jquery link of sorting 
	 * 
	 * @param $ssTitle = title of link
	 * @param $ssFieldName  = field Name 
	 */
	 static public function getLink($ssTitle,$ssFieldName)
	 {
	 
	 	$ssSortBy = (sfContext::getInstance()->getRequest()->getParameter('sortOn')==$ssFieldName && sfContext::getInstance()->getRequest()->getParameter('sortBy')=='asc' ) ? 'desc' : 'asc';
	 	
	 	if(sfContext::getInstance()->getRequest()->getParameter('sortOn')==$ssFieldName && sfContext::getInstance()->getRequest()->getParameter('sortBy')=='asc')
	 	$ssClassName = 'fright';
	 	elseif(sfContext::getInstance()->getRequest()->getParameter('sortOn')==$ssFieldName && sfContext::getInstance()->getRequest()->getParameter('sortBy')=='desc')
	 	$ssClassName = 'fright';
	 	else
	 	$ssClassName = 'fright';	
		
		return jq_link_to_remote($ssTitle,array('url'=>'listing/index','update'=>'listingsPanel','with'=>"'sortOn=".$ssFieldName."&sortBy=".$ssSortBy."&ssShowExpire='+(document.getElementById('ssShowExpire').checked ? 1 : 0 )",'loading'=>"$('getListingProgress').show();",'complete'=>"$('getListingProgress').hide();"),array('class'=>$ssClassName));
	 }
	 
	 /**
	 * Execute getRecordById function return record  
	 * 
	 * @param $ssTableName = table name
	 * @param $ssBaseId  = primary id name
	 */
	 static public function getRecordById($ssTableName,$ssBaseId)
	 {
	 	if($ssTableName!='' || $ssBaseId != '')
	 	{
	 		if(Doctrine::getTable($ssTableName))
	 		return $oResult = Doctrine::getTable($ssTableName)->find($ssBaseId);	
	 	}	
	 }
	
	/**
	 * Execute nominationMail Function.
	 * Function use to send a mail
	 *
	 * @param $ssSender = Sender Email address.
	 * @param $ssReceiver = Receiver Email address.
	 * @param $ssSubject = Mail Subject.
	 * @param $ssMailBody = Mail Body
	 */
	public static function sendQuoteMail($ssMailTo, $ssMailFrom , $ssMailSubject , $ssMailBody)
	{
		if ($ssMailTo != '' && $ssMailFrom != '' && $ssMailSubject != '' && $ssMailBody != '')
		{
			$oMail = sfContext::getInstance()->getMailer()->compose();
			$oMail->setSubject($ssMailSubject);
			$oMail->setTo(trim($ssMailTo));
			$oMail->setFrom($ssMailFrom);
			$oMail->setBody($ssMailBody, 'text/html');
		    sfContext::getInstance()->getMailer()->send($oMail);
		    return true;
		}
		else
			return false;
	}
			
	/**
	 * Execute getLink function return jquery link of sorting 
	 * 
	 * @param $ssTitle = title of link
	 * @param $ssFieldName  = field Name 
	 */
	 static public function getSorting($ssTitle,$ssFieldName, $ssUrl,$ssDivId ='listingsPanel')
	 {
	 	$ssSortBy = (sfContext::getInstance()->getRequest()->getParameter('sortOn')==$ssFieldName && sfContext::getInstance()->getRequest()->getParameter('sortBy')=='asc' ) ? 'desc' : 'asc';
	 	
	 	if(sfContext::getInstance()->getRequest()->getParameter('sortOn')==$ssFieldName && sfContext::getInstance()->getRequest()->getParameter('sortBy')=='asc')
			$ssClassName = 'fright';
	 	elseif(sfContext::getInstance()->getRequest()->getParameter('sortOn')==$ssFieldName && sfContext::getInstance()->getRequest()->getParameter('sortBy')=='desc')
			$ssClassName = 'fright';
	 	else
			$ssClassName = 'fright';	
		
		$ssSortOnBy = "sortOn=".$ssFieldName."&sortBy=".$ssSortBy;
		return jq_link_to_remote($ssTitle,array('url'=>$ssUrl,'update'=>$ssDivId,'with'=>'"'.$ssSortOnBy.'"'),array('class'=>$ssClassName));
	 }
	 
	 static public function getHeaderIconsPage()
	 {
	 	$oCms = Doctrine::getTable('Cms')->getAllActiveCms(sfContext::getInstance()->getUser()->getCulture());
		$oButtonLinks =  array();
		$aButtonMenu = array('Home','contactus','sitemap');
		foreach($oCms as $oCms)
		{
			
			if(in_array($oCms['page_type'],$aButtonMenu))
				$oButtonLinks[$oCms['page_type']] = $oCms;
		}
		
		return $oButtonLinks;
		
	 
	 }	
}
?> 
