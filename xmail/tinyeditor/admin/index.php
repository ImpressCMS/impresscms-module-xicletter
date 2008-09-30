<?php

	include 'admin_header.php';
	$module_id = $xoopsModule->getVar('mid');
	xoops_cp_header();
	adminMenu(0, _AM_TINYED_INDEX);
	
	$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
	if (file_exists(XOOPS_ROOT_PATH."/modules/tinyeditor/language/".$xoopsConfig['language']."/presentation.php")) {
	include XOOPS_ROOT_PATH."/modules/tinyeditor/language/".$xoopsConfig['language']."/presentation.php";
	} else {
		include XOOPS_ROOT_PATH."/modules/tinyeditor/language/english/presentation.php";
	}
	echo "<div>";
	if (@extension_loaded('zlib'))
		echo _AM_TINYED_STATSZLIB;
	if (@ini_get('safe_mode') == true && $moduleConfig['tinyedmgrftp'] == 0)
		echo _AM_TINYED_STATSSAFEMODE;
	if (!function_exists('copy') && $moduleConfig['tinyedmgrftp'] == 0)
		echo _AM_TINYED_STATSNOCOPY;
	if (!function_exists('rename') && $moduleConfig['tinyedmgrftp'] == 0)
		echo _AM_TINYED_STATSNORENAME;
	if (!function_exists('unlink') && $moduleConfig['tinyedmgrftp'] == 0)
		echo _AM_TINYED_STATSNOUNLINK;
	if (is_writable(XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfig.php'))
		echo _AM_TINYED_ISWRITEFTP1;
	if (is_writable(XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfigchmod.php'))
		echo _AM_TINYED_ISWRITEFTP2;
	if (is_writable(XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfigplugin.php'))
		echo _AM_TINYED_ISWRITEFTP3;

	echo "</div>";
	xoops_cp_footer();

?>