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
 * Class php
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class php extends Frontend
{
	public function __construct()
	{
		$this->import('Database');
		parent::__construct();
	}
	
	public function getphpinfo($parameters)
	{
		$output['request']['module']='php';
		$output['request']['function']='getphpinfo';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='PHP info retrieved successfully';
		$output['success']['datasets_read']='1';
		ob_start();
		phpinfo();
		$phpinfo=ob_get_contents();
		$output['result_sets']['_complex']['phpinfo']=$phpinfo;
		ob_end_clean();
		return $output;
	}
}
?>