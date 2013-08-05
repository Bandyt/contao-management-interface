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
 * Class mi_errormgr
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class mi_errormgr extends Frontend
{
	public $err = array();
	
	public function __construct()
	{
		$this->err['000']['0000'] = 'An unknown error occured.';
		$this->err['00A']['0001'] = 'Token not found.';
		$this->err['00A']['0002'] = 'Token user not valid.';
		$this->err['00A']['0003'] = 'No API function provided.';
		$this->err['00A']['0004'] = 'Invalid API function format.';
		$this->err['00A']['0005'] = 'Insufficient permissions to call function.';
		$this->err['00A']['0006'] = 'Module or function not found.';
		$this->err['00A']['0007'] = 'No hook for requested function found.';
		
		$this->err['00B']['0001'] = 'No or empty user name/id provided.';
		$this->err['00B']['0002'] = 'User name not found.';
		$this->err['00B']['0003'] = 'Id not found.';
		$this->err['00B']['0004'] = 'No administrator found.';
		
		$this->err['00C']['0001'] = 'No extensions installed.';
		$this->err['00C']['0002'] = 'Unable to open extension folder.';
		
		$this->err['00D']['0001'] = 'No or empty user name/id provided.';
		$this->err['00D']['0002'] = 'User name not found.';
		$this->err['00D']['0003'] = 'Id not found.';
		parent::__construct();
	}

	public function getErrorDescription($err_group, $err_code)
	{
		return $this->err[$err_group][$err_code];
	}
}
?>