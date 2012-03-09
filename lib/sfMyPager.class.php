<?php

/*
  Pager Class.
 
  @package    lainanweb
 * @author     RMY
 * @version    SVN: $Id: sfMyPager.class.php,v 1.2 2010/07/16 15:14:40 shashank Exp $
 * @filesource
 */


class sfMyPager 
{
    public $oRequest;
    public $oUser;
    public $oContext;
    public $oPager;
    
    /*
     * Execute sfMyPager constructor set request and context instance
    */
    function sfMyPager()
    {
        $this->oRequest  = sfContext::getInstance()->getRequest();
        $this->oContext  = sfContext::getInstance();
       
    }   
    /*
     * Execute getResults function setpag
     * 
     * @param $ssTableName = Table Name
     * @param $snPagesize = Page Size
     * @param $oQuery = Query
     */ 
    public function getResults($ssTableName,$snPagesize,$oQuery)
    {
        $this->oPager = new sfDoctrinePager($ssTableName,$snPagesize);
        $this->oPager->setQuery($oQuery);
        
        $this->oPager->setPage($this->oRequest->getParameter('page', 1));
        $this->oPager->init();
        if($this->oRequest->getParameter('page') > $this->oPager->getLastPage())
        {
            $this->oPager->setPage($this->oPager->getLastPage());
            $this->oPager->init();
        }   
        return $this->oPager;
    }
    
}