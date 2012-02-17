<?php

/**
 * nominator actions.
 *
 * @package    nomination
 * @subpackage Company
 * @author     shashank
 * @version    SVN: $Id: actions.class.php,v 1.13 2010/08/26 04:52:17 shashank Exp $
 */

sfProjectConfiguration::getActive()->loadHelpers(array('I18N','Partial'));
class loginActions extends sfActions
{
	/**
	* PreExecutes action 
	*/
	public function preExecute()  
	{
		$this->getResponse()->addCacheControlHttpHeader('no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->getUser()->setAttribute('ssSelected','Users');
		$this->oAppCommon                     = new appCommon('login');
		$this->oAppCommon->ssBaseId           = 'id';

		// Table Name Must be in Camel case later
		$this->oAppCommon->ssTableName        = 'Login';
	  
		$this->oAppCommon->ssLink             = 'login/index';     
		$this->oAppCommon->ssRankRequired     = false;
		$this->oAppCommon->ssShowCreateButton = true;
		$this->oAppCommon->ssShowDeleteButton = true;
		$this->oAppCommon->ssShowCheckBox     = true;
		$this->oAppCommon->ssMetaDataRequired = false;
	}
        
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->oAppCommon->ssTitle = __('User');
	  
		// Get all Users for listing
		$this->oAppCommon->oQuery= Doctrine::getTable('Login')->getAllUser($this->getUser());                
		// Delete Button Code
		if($this->getRequestParameter('ssAction')=="delete")
		{
			if($this->getRequestParameter('deleteIds') != "")
			{
			//   loginTable::UnlinkImages($this->getRequestParameter('deleteIds'));
				$this->oAppCommon->deleteRecords($this->getRequestParameter('deleteIds'));
			}
			$this->getUser()->setFlash('succ_msg',__("Record Has Been Deleted SuccessFully"));
			//$this->redirect('login/index');
		}
		// This is for update rank
		if($this->getRequest()->getMethod() == sfRequest::POST && count($this->getRequestParameter('aIdRank')) > 0 && $this->getRequestParameter('ssAction') != "delete") 
			$this->oAppCommon->updateRank($this->getRequestParameter('aIdRank'),$this->getRequestParameter('snRank1'),$this->getRequestParameter('snRank2'));
		
		// Default Sorting Field on the time of listing
		$this->oAppCommon->ssSortOn = 'L.username';
		// Default Sorting Order on the time of listing
		$this->oAppCommon->ssSortBy = 'asc';
		// Array of fields on which you want to give search
		$this->oAppCommon->aSearchOptions = array('L.first_name'=>__('First Name'),'L.last_name'=>__('Last Name'),'L.username'=>__('User Name'),'L.email' => __('Email'));
		// array of fields which you want to show on the time of listing
		$this->oAppCommon->aFields = array('["username"]'=>array("caption"=>__('User Name'),"width"=>"12%",'sortkey'=>'L.username','link'=>'login/addEdit','includeBaseId'=>true,'postLink'=>true),
										   '["first_name"]'=>array("caption"=>__('First Name'),"width"=>"12%",'sortkey'=>'L.first_name'),
										   '["last_name"]'=>array("caption"=>__('Last Name'),"width"=>"12%",'sortkey'=>'L.last_name'),
										   '["email"]'=>array("caption"=>__('Email'),'sortkey'=>'L.email',"width"=>"12%"));
		// Function call for getting list
		$this->oAppCommon->getList();
			if($this->getRequest()->getMethod()== sfRequest::POST && !$request->getParameter('postLink'))
			return $this->renderPartial('global/List',array('oAppCommon'=>$this->oAppCommon));
	}

	/**
	* Executes Login action
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogin(sfWebRequest $oRequest)
	{
		if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin'))
			$this->redirect('/login/index');
	  
		$this->form = new LoginForm();

		if($oRequest->isMethod('post'))
		{
			$this->form->bind($oRequest->getParameter('login'));
			if($this->form->isValid())
			{ 
				$asParam = $oRequest->getParameter('login');
				$asUserLogin= Doctrine::getTable('Login')->getUser($asParam['username'],$asParam['password']);

				if(is_array($asUserLogin) && !empty($asUserLogin))
				{
					$this->getUser()->setAttribute('username', $asParam['username']);
					$this->getUser()->setAuthenticated(true);
					$this->getUser()->addCredential('admin');
					$this->redirect('/login/welcome');
				}
				else
					$this->getUser()->setFlash('login_error','Invalid username and password');
			}
		}
	}

	/**
	* Executes addEdit action
	*
	* @param sfRequest $request A request object
	*/
	public function executeAddEdit(sfWebRequest $request)
	{
		$this->oAppCommon->ssTitle = ($request->getParameter($this->oAppCommon->ssBaseId)) ? __("Edit User") : __("Add User");         

		if($request->getParameter($this->oAppCommon->ssBaseId))
		{
	  		$oRecords = Doctrine::getTable('Login')->find($request->getParameter($this->oAppCommon->ssBaseId));
			$this->oAppCommon->oForm = new RegisterForm($oRecords);
		}
		else
			$this->oAppCommon->oForm = new RegisterForm();
		
		$asPostData = $this->oAppCommon->oForm->getObject()->getData();

		if($this->oAppCommon->processForm($request))
		{
			$asPostData = $request->getParameter($this->oAppCommon->oForm->getName());
			$this->oAppCommon->saveFormData();
			$this->getUser()->setFlash('succ_msg',__("User Has Been %ssStatus% SuccessFully",array('%ssStatus%'=>(!$request->getParameter($this->oAppCommon->ssBaseId))? __('Added'):__('Updated'))));
			
			if($request->getParameter($this->oAppCommon->ssBaseId))
				$this->oAppCommon->ssPostForm = true;
			else
				$this->redirect('login/index');
		} 
	}

	/**
	* Executes changepassword action
	*
	* @param sfRequest $request A request object
	*/
	public function executeChangePassword(sfWebRequest $request) 
	{
		$this->getUser()->setAttribute('ssSelected','Settings');
		$ssUsername= $this->getUser()->getAttribute('username');
		if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin'))
		{
			$this->omForm = new ChangePasswordForm();
			if($request->isMethod('post')) 
			{   
				$asPostData = $request->getParameter('changePassword');
				$this->omForm->bind($request->getParameter('changePassword'));
				$ssOldPassword = $asPostData['password'];
				$ssNewPassword = $asPostData['new_password'];
				$ssConfirmPassword = $asPostData['confirm_password'];

				if($this->omForm->isValid())
				{
					$oValidate = Login::validateChangePwd($ssUsername,$ssOldPassword,$ssNewPassword);
					if($oValidate)
					{
						$oAdmin = $request->getParameter('changePassword');
						$this->getUser()->setFlash('msgSucc', __('Password Has Been Changed Successfully'));
					}
					else
						$this->getUser()->setFlash('password_error', __('Old Password does not match in Database'));
					$this->redirect('login/changePassword');
				}  
			}  
		}
		else
			$this->redirect('login/index');        
	}

	/**
	* Executes forgetpassword action
	*
	* @param sfRequest $request A request object
	*/
	public function executeForgetPassword(sfWebRequest $request) 
	{
		$this->omForm = new forgetPasswordForm();
		if($request->isMethod('post')) 
		{   
			$asPostData = $request->getParameter('forgetPassword');
		    $this->omForm->bind($request->getParameter('forgetPassword'));
		    $ssEmail =  $asPostData['email'];

		    if($this->omForm->isValid()) 
		    {
				$oValidate = Login::validateAdminEmailAddress($ssEmail);
				if($oValidate)
				{
					$oAdmin = $request->getParameter('forgetPassword');
					$ssNewpass=rand();
					$subject="UR's new password";
					$mail_body= "Hi! ur new password is".$ssNewpass;
					$Name = "Nainit";
					$email = "noReply@virtueinfo.com"; 
					$recipient = $ssEmail;
					$header = "From: ". $Name . " <" . $email . ">\r\n";
					mail($recipient, $subject, $mail_body, $header);
					Doctrine::getTable('Login')->updatePass($ssEmail,$ssNewpass);
				    $this->getUser()->setFlash('msgSucc', __('New Password Has Been Sent to Your Email Address.'));
				}
				else
				    $this->getUser()->setFlash('mail_error', __('Email Id does not exist.'));
				$this->redirect('login/forgetPassword');
		    }
		}
	} 

	/**
	* Executes Cancel action
	*
	* @param sfRequest $request A request object
	*/
	public function executeCancel(sfWebRequest $request)
	{
		$this->redirect('loign/index');
	}

	/**
	* Executes Welcome action
	*
	* @param sfRequest $request A request object
	*/
	public function executeWelcome(sfWebRequest $request)
	{
		$this->getUser()->setAttribute('ssSelected','Home');
	}

	/**
	* Executes Logout action
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogout()
	{
		$this->getUser()->clearCredentials();
		$this->getUser()->setAuthenticated(false);
		$this->redirect('/login/login');
	}
} 