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
 * Class users
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class users extends Frontend
{
	public function __construct()
	{
		$this->import('Database');
		parent::__construct();
	}
	
	public function getcount($parameters)
	{
		$output['request']['module']='users';
		$output['request']['function']='getcount';
		$output['request']['datetime']=time();
		$output['result']='success';
		$objQuery=$this->Database->prepare("SELECT count(id) as cnt FROM tl_user")->executeUncached();
		$output['success']['message']='Number of users read successfully';
		$output['success']['datasets_read']=$objQuery->cnt;
		$output['result_sets']['_numbers']['count']=$objQuery->cnt;
		return $output;
	}
	
	public function getdetailsbyusername($parameters)
	{
		if(!$parameters->get('username') || $parameters->get('username')=='')//No user name provided
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00B','0001');
		}
		$objQuery=$this->Database->prepare("SELECT * FROM tl_user WHERE username=?")->executeUncached($parameters->get('username'));
		if($objQuery->numRows==0) //User not found
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00B','0002');
		}
		$output['request']['module']='users';
		$output['request']['function']='getdetailsbyusername';
		$output['request']['datetime']=time();
		$output['request']['parameters']['username']=$this->Input->get('username');
		$output['result']='success';
		$output['success']['message']='User details read successfully.';
		$output['success']['datasets_read']='1';
		$output['result_sets']['_strings']['username']=$objQuery->username;
		$output['result_sets']['_strings']['name']=$objQuery->name;
		$output['result_sets']['_strings']['email']=$objQuery->email;
		$output['result_sets']['_strings']['language']=$objQuery->language;
		$output['result_sets']['_booleans']['admin']=$objQuery->admin;
		$output['result_sets']['_booleans']['disable']=$objQuery->disable;
		$output['result_sets']['_strings']['start']=$objQuery->start;
		$output['result_sets']['_strings']['stop']=$objQuery->stop;
		$output['result_sets']['_strings']['logincount']=$objQuery->logincount;
		$output['result_sets']['_booleans']['locked']=$objQuery->locked;
		$output['result_sets']['_strings']['dateadded']=$objQuery->dateadded;
		$output['result_sets']['_strings']['currentlogin']=$objQuery->currentlogin;
		$output['result_sets']['_strings']['lastlogin']=$objQuery->lastlogin;
		$output['result_sets']['_strings']['pwchange']=$objQuery->pwchange;
		if($objQuery->groups!='')
		{
			$groups=unserialize($objQuery->groups);
			foreach($groups as $group)
			{
				$output['result_sets']['_collections']['groups'][]['_lists']['group'][]=$group;
			}
		}
		
		return $output;
	}
	
	public function getdetailsbyid($parameters)
	{
		if(!$parameters->get('id') || $parameters->get('id')=='')//No user name provided
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00B','0001');
		}
		$objQuery=$this->Database->prepare("SELECT * FROM tl_user WHERE id=?")->executeUncached($parameters->get('id'));
		if($objQuery->numRows==0) //User not found
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00B','0003');
		}
		$output['request']['module']='users';
		$output['request']['function']='getdetailsbyid';
		$output['request']['datetime']=time();
		$output['request']['parameters']['id']=$this->Input->get('id');
		$output['result']='success';
		$output['success']['message']='User details read successfully.';
		$output['success']['datasets_read']='1';
		$output['result_sets']['_strings']['username']=$objQuery->username;
		$output['result_sets']['_strings']['name']=$objQuery->name;
		$output['result_sets']['_strings']['email']=$objQuery->email;
		$output['result_sets']['_strings']['language']=$objQuery->language;
		$output['result_sets']['_booleans']['admin']=$objQuery->admin;
		$output['result_sets']['_booleans']['disable']=$objQuery->disable;
		$output['result_sets']['_strings']['start']=$objQuery->start;
		$output['result_sets']['_strings']['stop']=$objQuery->stop;
		$output['result_sets']['_strings']['logincount']=$objQuery->logincount;
		$output['result_sets']['_booleans']['locked']=$objQuery->locked;
		$output['result_sets']['_strings']['dateadded']=$objQuery->dateadded;
		$output['result_sets']['_strings']['currentlogin']=$objQuery->currentlogin;
		$output['result_sets']['_strings']['lastlogin']=$objQuery->lastlogin;
		$output['result_sets']['_strings']['pwchange']=$objQuery->pwchange;
		if($objQuery->groups!='')
		{
			$groups=unserialize($objQuery->groups);
			foreach($groups as $group)
			{
				$output['result_sets']['_collections']['groups'][]['_lists']['group'][]=$group;
			}
		}
		
		return $output;
	}
	
	public function getadministrators($parameters)
	{
		$objQuery=$this->Database->prepare("SELECT * FROM tl_user WHERE admin=1")->executeUncached();
		if($objQuery->numRows==0) //User not found
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00B','0004');
		}
		$output['request']['module']='users';
		$output['request']['function']='getadministrators';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='Administrators listed successfully.';
		$output['success']['datasets_read']=$objQuery->numRows;
		while($objQuery->next())
		{
			$output['result_sets']['_collections']['administrators'][]['_collections']['administrator'][]=array(
				'_strings'=>array(
					'Username'=>$objQuery->username
				),
				'_numbers'=>array(
					'id'=>$objQuery->id
				)
			);
		}
		return $output;
	}
}
?>