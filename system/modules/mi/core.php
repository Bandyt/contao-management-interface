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
 * Class api
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class core extends Frontend
{
	public function getVersion($parameters)
	{
		$output=array();
		$output['result']='success';
		$output['success']['message']='Version retrieved successfully';
		$output['result_sets']=array(
			'_fields'=>array(
				'version'=>VERSION
				)
		);
		return $output;
	}
}
?>