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
$GLOBALS['TL_LANG']['tl_mi_user']['username']		= array ('Benutzername', 'Name des Benutzers');
$GLOBALS['TL_LANG']['tl_mi_user']['token']			= array ('Token', 'Token oder Passwort f&uuml;r diesen Benutzer. Wird im Klartext &uuml;bertragen.');
$GLOBALS['TL_LANG']['tl_mi_user']['startdate']		= array ('Start', 'Datum, ab dem dieser Benutzer aktiv ist.');
$GLOBALS['TL_LANG']['tl_mi_user']['enddate']		= array ('Ende', 'Datum, ab dem dieser Benutzer inaktiv ist.');
$GLOBALS['TL_LANG']['tl_mi_user']['permissions']	= 'Berechtigungen';
$GLOBALS['TL_LANG']['tl_mi_user']['api']			= array ('API', 'Anklicken, wenn der Benutzer API-Funktionen nutzen darf.');
$GLOBALS['TL_LANG']['tl_mi_user']['core']			= array ('Core', 'Anklicken, wenn der Benutzer Core-Funktionen nutzen darf.');
$GLOBALS['TL_LANG']['tl_mi_user']['extensions']		= array ('Extensions', 'Anklicken, wenn der Benutzer Extensions-Funktionen nutzen darf.');
$GLOBALS['TL_LANG']['tl_mi_user']['members']		= array ('Members', 'Anklicken, wenn der Benutzer Members-Funktionen nutzen darf.');
$GLOBALS['TL_LANG']['tl_mi_user']['php']			= array ('PHP', 'Anklicken, wenn der Benutzer PHP-Funktionen nutzen darf.');
$GLOBALS['TL_LANG']['tl_mi_user']['users']			= array ('Users', 'Anklicken, wenn der Benutzer Users-Funktionen nutzen darf.');
/**
 * Reference
 */


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_mi_user']['new']    = array('Benutzer hinzuf&uuml;gen', 'F&uuml;gt einen neuen Benutzer hinzu');
$GLOBALS['TL_LANG']['tl_mi_user']['edit']   = array('Benutzer bearbeiten', 'Bearbeitet den Benutzer');
$GLOBALS['TL_LANG']['tl_mi_user']['copy']   = array('Benutzer kopieren', 'Erstellt eine Kopie des Benutzer');
$GLOBALS['TL_LANG']['tl_mi_user']['delete'] = array('Benutzer l&ouml;schen', 'Entfernt den Benutzer');
$GLOBALS['TL_LANG']['tl_mi_user']['show']   = array('Benutzer anzeigen', 'Zeigt den Benutzer an');

?>