<?php
// $Id: reducedinitcode.php,v 1.3 2006/06/28 10:25:33 frankblacksf Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

	if (file_exists('../../../mainfile.php')) include_once '../../../mainfile.php';

	if (file_exists('../../mainfile.php')) include_once '../../mainfile.php';

	if (!defined('XOOPS_ROOT_PATH')) exit();

	$xoopsConfig['language'] = preg_replace("/[^a-z0-9_\-]/i", "", $xoopsConfig['language']);
	if (file_exists(XOOPS_ROOT_PATH."/modules/tinyeditor/language/".$xoopsConfig['language']."/main.php"))
		include_once XOOPS_ROOT_PATH."/modules/tinyeditor/language/".$xoopsConfig['language']."/main.php";
	else
		include_once XOOPS_ROOT_PATH."/modules/tinyeditor/language/english/main.php";

	if ($moduleConfig['tinyedlang'] == '') $moduleConfig['tinyedlang'] = 'en';
	
	echo '<script language="javascript" type="text/javascript" src="'.XOOPS_URL.'/modules/tinyeditor/editor/tiny_mce.js"></script><script language="javascript" type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	editor_selector : "mceEditor",
	theme : "advanced",
	language : "'.$moduleConfig["tinyedlang"].'",';

		if ($moduleConfig['tinyedcss'] == '') {
			$fallbackcssfile = str_replace(XOOPS_THEME_URL, XOOPS_THEME_PATH, xoops_getcss($xoopsConfig['theme_set']));
			$handle = fopen ($fallbackcssfile, "r");
			$buffer = fgets($handle);
			$pos = strpos ($buffer, "@");
			if ($pos === false) {
				echo 'content_css: "'.xoops_getcss($xoopsConfig['theme_set']).'",';
				fclose($handle);
			} else {
			$buffer = preg_replace('/(.*)\(|\)(.*)/msU', '', trim($buffer));
			$buffer = str_replace(';', '', $buffer);
			$fallbackcssfile = str_replace(XOOPS_THEME_PATH, XOOPS_THEME_URL, $fallbackcssfile);
			$cssfilename = end(explode("/", $fallbackcssfile));
			$fallbackcssfile = str_replace($cssfilename, $buffer, $fallbackcssfile);
			fclose($handle);
			echo 'content_css: "'.$fallbackcssfile.'",';
			}
		} else {
			echo 'content_css: "'.XOOPS_URL.$moduleConfig['tinyedcss'].'",';
		}

	echo 'convert_urls : false,
	button_tile_map: true,
	theme_advanced_toolbar_align : "left",
	plugins : "ximagemanager,xcode,xquote,emotions",
	theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "link,unlink,image,ximagemanager,xcode,xquote,forecolor,bold,italic,strikethrough,emotions",
	theme_advanced_buttons2 : "fontsizeselect,fontselect",
	theme_advanced_buttons3 : "",
	valid_elements : "a[href|target=_blank],b,i,u,strike,font,img,p",
  extended_valid_elements: "img[src|align],font[size|face|color]",
	width: "100%",
	height: "400px",
	cleanup: "true",
	debug : "false"
	});</script>';

?>