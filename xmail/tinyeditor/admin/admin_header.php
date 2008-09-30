<?php

include("../../../mainfile.php");
include '../../../include/cp_header.php';
require_once XOOPS_ROOT_PATH.'/kernel/module.php';
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

if (is_object($xoopsUser)) {
	$xoopsModule = XoopsModule::getByDirname("tinyeditor");
	if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
		redirect_header(XOOPS_URL."/",1,_NOPERM);
		exit();
	}
} else {
	redirect_header(XOOPS_URL."/",1,_NOPERM);
	exit();
}

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname("tinyeditor");
	$config_handler =& xoops_gethandler('config');
	$moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

include_once XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/include/functions.php";
$myts =& MyTextSanitizer::getInstance();
?>