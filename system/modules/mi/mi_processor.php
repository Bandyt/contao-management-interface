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
 * Class mi_processor
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class mi_processor extends Frontend
{
	public function __construct()
	{
		$this->import('Input');
		parent::__construct();
	}

	/**
	 * Run
	 */
	public function run()
	{
		$usermgr = new mi_usermgr();
		$outputgenerator = new mi_outputgenerator();
		
		//Check if format is set and valid. Fallback is XML
		switch(strtoupper($this->Input->get('format')))
		{
			case 'XML':
				$format='XML';
				header ("Content-Type:text/xml");
				break;
			case 'JSON':
				$format='JSON';
				header("Content-Type: application/json");
				break;
			default:
				$format='XML';
				header ("Content-Type:text/xml");
		}
		
		//Get Token and check for a valid user
		$token=$this->Input->get('token');
		$tokenCheck=$usermgr->checkToken($token);
		
		//If token or user is invalid, issue error feedback.
		if ($tokenCheck!='-1')
		{
			return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A',$tokenCheck), $format);
		}
		//Get API function, check validity and call hooks if required
		$function=strtolower($this->Input->get('function'));
		if($function==''){return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A','0003'), $format);}
		if(strpos($function,'.')==false){return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A','0004'), $format);}
		$apiModule=substr($function,0,strpos($function,'.'));
		$apiFunction=substr($function,strpos($function,'.')+1);
		if(substr($apiModule,0,1)=='z')//If module starts with 'z' call hooks
		{
			if (isset($GLOBALS['TL_HOOKS']['mi'][$apiModule][$apiFunction]) && is_array($GLOBALS['TL_HOOKS']['mi'][$apiGroup][$apiFunction]))
			{
				foreach ($GLOBALS['TL_HOOKS']['mi'][$apiModule][$apiFunction] as $callback)
				{
					if($usermgr->checkPermission($this->Input->get('token'), $apiModule,$apiFunction)==true)
					{
						$this->import($callback[0]);
						$output=$this->$callback[0]->$callback[1]($this->Input);
						return $outputgenerator->generateOutput($output, $format);
					}
					else
					{
						return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A','0005'), $format);
					}
				}
			}
			else
			{
				return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A','0007'), $format);
			}
		}
		else
		{
			if(method_exists($apiModule,$apiFunction))
			{
				if($usermgr->checkPermission($this->Input->get('token'), $apiModule,$apiFunction)==true)
				{
					$this->import($apiModule);
					$output=$this->$apiModule->$apiFunction($this->Input);
					return $outputgenerator->generateOutput($output, $format);
				}
				else //User has no permission to call the function
				{
					return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A','0005'), $format);
				}
			 }
			 else
			 {
				return $outputgenerator->generateOutput($outputgenerator->generateErrorData('00A','0006'), $format);
			 }
		}
		return $outputgenerator->generateOutput($outputgenerator->generateErrorData('000','0000'), $format);
	}
}
?>