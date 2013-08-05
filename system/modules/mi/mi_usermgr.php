<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package   mi
 * @author    Andreas Koob
 * @license   LGPL
 * @copyright © 2013 Andreas Koob
 */

/**
 * Class mi_usermgr
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class mi_usermgr extends Frontend
{
	public function __construct()
	{
		$this->import('Database');
		// call the constructor from Frontend
		parent::__construct();
	}
	
	public function checkToken($token)
	{
		$objQuery=$this->Database->prepare("SELECT * FROM tl_mi_user WHERE token=?")->executeUncached($token);
		$currentTime=time();
		
		if($objQuery->numRows==0){return '0001';}
		if(($objQuery->startdate=='' || $objQuery->startdate<=$currentTime)&&($objQuery->enddate=='' || $objQuery->enddate>=$currenttime))
		{
			return '-1';
		}
		else
		{
			return '0002';
		}
	}
	
	public function checkPermission($token, $module, $function)
	{
		$objQuery=$this->Database->prepare("SELECT * FROM tl_mi_user WHERE token=?")->executeUncached($token);
		if($objQuery->$module=='1')
		{
			return true;
		}
		else
		{
			return false;
		}
		return false;
	}
}
?>