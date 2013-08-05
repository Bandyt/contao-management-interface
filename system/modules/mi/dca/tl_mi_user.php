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
 * Table tl_mi_user
 */
$GLOBALS['TL_DCA']['tl_mi_user'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('username'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('username'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mi_user']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mi_user']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mi_user']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mi_user']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'username,token,startdate,enddate;{permissions},api,core,extensions,members,php,users'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'username' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['username'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
		'token' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['token'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true)
		),
		'startdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['startdate'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false,'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'enddate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['enddate'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false,'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'api' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['api'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('mandatory'=>false)
		),
		'core' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['core'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('mandatory'=>false)
		),
		'extensions' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['extensions'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('mandatory'=>false)
		),
		'members' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['members'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('mandatory'=>false)
		),
		'php' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['php'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('mandatory'=>false)
		),
		'users' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mi_user']['users'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('mandatory'=>false)
		)
	)
);
