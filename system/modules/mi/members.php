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
 * Class members
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class members extends Frontend
{
	public function __construct()
	{
		$this->import('Database');
		// call the constructor from Frontend
		parent::__construct();
	}
	
	//getCount
	public function getcount($parameters)
	{
		$output['result']='success';
		$objQuery=$this->Database->prepare("SELECT count(id) as cnt FROM tl_member")->executeUncached();
		$output['success']['message']='Number of members read successfully';
		$output['success']['datasets_read']=$objQuery->cnt;
		$output['result_sets']['_fields']['count']=$objQuery->cnt;
		return $output;
	}
	
	public function getdetailsbyid($parameters)
	{
		if(!$parameters->get('id') || $parameters->get('id')=='')//No id provided
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00D','0001');
		}
		$objQuery=$this->Database->prepare("SELECT * FROM tl_member WHERE id=?")->executeUncached($parameters->get('id'));
		if($objQuery->numRows==0) //Member not found
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00D','0003');
		}
		$output['request']['module']='members';
		$output['request']['function']='getdetailsbyid';
		$output['request']['datetime']=time();
		$output['request']['parameters']['id']=$this->Input->get('id');
		$output['result']='success';
		$output['success']['message']='Member details read successfully.';
		$output['success']['datasets_read']='1';
		$output['result_sets']['_strings']['username']=$objQuery->username;
		$output['result_sets']['_strings']['firstname']=$objQuery->firstname;
		$output['result_sets']['_strings']['lastname']=$objQuery->lastname;
		$output['result_sets']['_strings']['email']=$objQuery->email;
		$output['result_sets']['_numbers']['dateofbirth']=$objQuery->dateOfBirth;
		$output['result_sets']['_strings']['gender']=$objQuery->gender;
		$output['result_sets']['_strings']['company']=$objQuery->company;
		$output['result_sets']['_strings']['street']=$objQuery->street;
		$output['result_sets']['_number']['postal']=$objQuery->postal;
		$output['result_sets']['_strings']['city']=$objQuery->city;
		$output['result_sets']['_strings']['state']=$objQuery->state;
		$output['result_sets']['_strings']['country']=$objQuery->country;
		$output['result_sets']['_strings']['phone']=$objQuery->phone;
		$output['result_sets']['_strings']['mobile']=$objQuery->mobile;
		$output['result_sets']['_strings']['fax']=$objQuery->fax;
		$output['result_sets']['_strings']['email']=$objQuery->email;
		$output['result_sets']['_strings']['language']=$objQuery->language;
		$output['result_sets']['_booleans']['disable']=$objQuery->disable;
		$output['result_sets']['_strings']['start']=$objQuery->start;
		$output['result_sets']['_strings']['stop']=$objQuery->stop;
		$output['result_sets']['_numbers']['dateaadded']=$objQuery->dateAdded;
		$output['result_sets']['_numbers']['locked']=$objQuery->locked;
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
}
?>