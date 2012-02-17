<?php

/**
 * error actions.
 *
 * @package    nomination
 * @subpackage error
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.1 2010/07/22 05:53:58 shashank Exp $
 */
class errorActions extends sfActions
{
  public function preExecute()
  {
	 $this->getResponse()->setTitle('404 Not Found');
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }
}
