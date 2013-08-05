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
class api extends Frontend
{
	public function connectiontest($parameters)
	{
		$output['request']['module']='api';
		$output['request']['function']='connectiontest';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['message']='API test function call was successful!';
		return $output;
	}
	
	public function teststructure($parameters)
	{
		$output['request']['module']='api';
		$output['request']['function']='teststructure';
		$output['request']['datetime']=time();
		$output['result']='success';
		$output['success']['datasets_read']='2';
		$output['success']['message']='Test structure successfully retrieved.';
		$output['result_sets']['_collections']['users'][]['_collections']['user'][]=array(
			'_strings'=>array(
					'Username'=>'Test user'
			),
			'_booleans'=>array(
					'is_admin'=>false
			),
			'_collections'=>array(
				'groups'=>array(
					array(
						'_lists'=>array(
							'group'=>array(
								1,5,10
							)
						)
					)
				)
			)
		);
		
		$output['result_sets']['_collections']['users'][]['_collections']['user'][]=array(
			'_strings'=>array(
					'Username'=>'Second user'
			),
			'_booleans'=>array(
					'is_admin'=>true
			),
			'_collections'=>array(
				'groups'=>array(
					array(
						'_lists'=>array(
							'group'=>array(
								2
							)
						)
					)
				)
			)
		);
		return $output;
	}
}
?>