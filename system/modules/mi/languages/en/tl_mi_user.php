<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_mi_user']['username']		= array ('User name', 'Name of the user');
$GLOBALS['TL_LANG']['tl_mi_user']['token']			= array ('Token', 'Token or password of the user. Will be transmitted unencrypted.');
$GLOBALS['TL_LANG']['tl_mi_user']['startdate']		= array ('Start date', 'Date after which the user will be active.');
$GLOBALS['TL_LANG']['tl_mi_user']['enddate']		= array ('End date', 'Date after which the user will be inactive.');
$GLOBALS['TL_LANG']['tl_mi_user']['permissions']	= 'Permissions';
$GLOBALS['TL_LANG']['tl_mi_user']['api']			= array ('API', 'Check if user is allowed to call api functions.');
$GLOBALS['TL_LANG']['tl_mi_user']['core']			= array ('Core', 'Check if user is allowed to call core functions.');
$GLOBALS['TL_LANG']['tl_mi_user']['extensions']		= array ('Extensions', 'Check if user is allowed to call extensions functions.');
$GLOBALS['TL_LANG']['tl_mi_user']['members']		= array ('Members', 'Check if user is allowed to call members functions.');
$GLOBALS['TL_LANG']['tl_mi_user']['php']			= array ('PHP', 'Check if user is allowed to call PHP functions.');
$GLOBALS['TL_LANG']['tl_mi_user']['users']			= array ('Users', 'Check if user is allowed to call users functions.');
/**
 * Reference
 */


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_mi_user']['new']    = array('Add user', 'Adds a new user');
$GLOBALS['TL_LANG']['tl_mi_user']['edit']   = array('Edit user', 'Edits the user');
$GLOBALS['TL_LANG']['tl_mi_user']['copy']   = array('Copy user', 'Creates a copy of the user');
$GLOBALS['TL_LANG']['tl_mi_user']['delete'] = array('Delete user', 'Removes the user');
$GLOBALS['TL_LANG']['tl_mi_user']['show']   = array('Show user', 'Displays the user');
?>