<?php

	if (file_exists('../../../mainfile.php')) include '../../../mainfile.php';
	if (file_exists('../../../../mainfile.php')) include '../../../../mainfile.php';

	if (!defined('XOOPS_ROOT_PATH')) die('Something fishy happened!');

	define('TINY_ROOT_URL', XOOPS_URL.'/modules/tinyeditor/');
	define('TINY_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/tinyeditor/');

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname("tinyeditor");
	$config_handler =& xoops_gethandler('config');
	$moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
	$module_id = $module->getVar('mid');
	$gperm_handler = &xoops_gethandler('groupperm');

	function sanitizePath($inpath) {
		$outpath = ereg_replace("\.[\.]+", "", $inpath);
		$outpath = ereg_replace("^[\/]+", "", $outpath);
		$outpath = ereg_replace("^[A-Za-z][:\|][\/]?", "", $outpath);
		return($outpath);
	}

	// This function cleans the vars from not allowed characters
	function makeVarsSafe($var) {
		$regex = '#\.\.|[^A-Za-z0-9\.\_\- ]#';
		$var = preg_replace($regex, '', $var) ;
		$var = str_replace(' ', '_', $var);
		return $var;
	}

	$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);

		if ( file_exists(XOOPS_ROOT_PATH."/modules/tinyeditor/language/".$xoopsConfig['language']."/xrmanager.php") ) {
			include_once XOOPS_ROOT_PATH."/modules/tinyeditor/language/".$xoopsConfig['language']."/xrmanager.php";
		} else {
			include_once XOOPS_ROOT_PATH."/modules/tinyeditor/language/english/xrmanager.php";
		}

	

?>