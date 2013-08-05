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
 * Class extensions
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class extensions extends Frontend
{
	public function __construct()
	{
		$this->import('Database');
		parent::__construct();
	}
	
	public function getcount($parameters)
	{
		$objQuery=$this->Database->prepare("SELECT count(id) as cnt FROM tl_repository_installs")->executeUncached();
		$output['request']['module']='extensions';
		$output['request']['function']='getcount';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='Number of installed extensions read successfully';
		$output['success']['datasets_read']=$objQuery->cnt;
		$output['result_sets']['_numbers']['count']=$objQuery->cnt;
		return $output;
	}
	
	public function getextensionsfromdatabase($parameters)
	{
		$objQuery=$this->Database->prepare("SELECT id, extension FROM tl_repository_installs")->executeUncached();
		if($objQuery->numRows==0)
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00C','0001');
		}
		$output['request']['module']='extensions';
		$output['request']['function']='getextensionsfromdatabase';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='Number of installed extensions read successfully';
		$output['success']['datasets_read']=$objQuery->numRows;
		while($objQuery->next())
		{
			$output['result_sets']['_collections']['extensions'][]['_collections']['extension'][]=array(
				'_strings'=>array(
					'extensions'=>$objQuery->extension
				),
				'_numbers'=>array(
					'id'=>$objQuery->id
				)
			);
		}
		return $output;
	}
	
	public function getextensionfolders($parameters)
	{
		$handle=opendir('./system/modules/');
		
		if($handle==false)
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00C','0002');
		}
		while($file=readdir($handle))
		{
			if(is_dir('./system/modules/' . $file) && ($file!='.') && ($file!='..'))
			{
				$output['result_sets']['_collections']['extensionfolders'][]=array(
					'_strings'=>array(
						'folder'=>$file
					)
				);
			}
		}	
		
		$output['request']['module']='extensions';
		$output['request']['function']='getextensionfolders';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='Extension folders listed successfully';
		$output['success']['datasets_read']=count($output['result_sets']['_collections']['extensionfolders']);
		return $output;
	}
	
	public function getdetailsbyid($parameters)
	{
		if(!$parameters->get('id') || $parameters->get('id')=='')
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00C','0003');
		}
		$objQuery=$this->Database->prepare("SELECT * FROM tl_repository_installs WHERE id=?")->executeUncached($parameters->get('id'));
		if($objQuery->numRows==0)
		{
			$outputgenerator = new mi_outputgenerator();
			return $outputgenerator->generateErrorData('00C','0004');
		}
		$output['request']['module']='extensions';
		$output['request']['function']='getdetailsbyid';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='Extension information retrieved successfully';
		$output['success']['datasets_read']='1';
		$output['result_sets']['_numbers']['id']=$objQuery->id;
		$output['result_sets']['_strings']['extension']=$objQuery->extension;
		$output['result_sets']['_strings']['version']=$objQuery->version;
		$output['result_sets']['_numbers']['build']=$objQuery->build;
		$output['result_sets']['_booleans']['alpha']=$objQuery->alpha;
		$output['result_sets']['_booleans']['beta']=$objQuery->beta;
		$output['result_sets']['_booleans']['rc']=$objQuery->rc;
		$output['result_sets']['_booleans']['stable']=$objQuery->stable;
		$output['result_sets']['_booleans']['deletion_protected']=$objQuery->delprot;
		$output['result_sets']['_booleans']['upddate_protected']=$objQuery->updprot;
		return $output;
	}
}
?>