<?php


	if (file_exists('../../../mainfile.php')) include_once "../../../mainfile.php";
	if (file_exists('../../../../mainfile.php')) include_once "../../../../mainfile.php";
	if (!defined('XOOPS_ROOT_PATH')) die("XOOPS root path not defined");

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname("tinyeditor");
	$config_handler =& xoops_gethandler('config');
	$moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
	$module_id = $module->getVar('mid');
	$gperm_handler = &xoops_gethandler('groupperm');

	if ($moduleConfig['tinyedmgrftp'] == 1) {
		if (!defined('TINY_FTPSERVER') || !defined('TINY_FTPUSER') || !defined('TINY_FTPPASS'))
			include XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfig.php';
		if (TINY_FTPSERVER == '' || TINY_FTPUSER == '' || TINY_FTPPASS == '')
			exit(_AM_TINYED_STATSMISSFTP);
	}

	$tiny_mgruploads = $moduleConfig['tinyedmgruploads'];
	$tiny_mgrimglib = $moduleConfig['tinyedmgrimglib'];
	$tiny_mgrimglibpath = $moduleConfig['tinyedmgrimglibpath'];
	$tiny_mgrthuwidth = $moduleConfig['tinyedmgrthuwidth'];
	$tiny_mgrthuheight = $moduleConfig['tinyedmgrthuheight'];
	$tiny_mgrthupref = $moduleConfig['tinyedmgrthupref'];
	$IMConfig['thumbnail_dir'] = $moduleConfig['tinyedmgrthudir'];
		
	$tiny_mgrdefthumb = $moduleConfig['tinyedmgrdefthumb'];
	$IMConfig['tmp_prefix'] = $moduleConfig['tinyedmgrtemppref'];
	$tiny_lang = $moduleConfig['tinyedlang'];
	$tiny_thumbcols = $moduleConfig['tinyedthumbcols'];
	$tiny_persdir = $moduleConfig['tinyedmgrpersdir'];

	if ($gperm_handler->checkRight('TinyPerm', 10, $groups, $module_id)) {
		$IMConfig['del_ne_fold'] = 1;
		$tiny_mgrdelnonempty = 1;
	} else {
		$IMConfig['del_ne_fold'] = 0;
		$tiny_mgrdelnonempty = 0;
	}

	$tiny_mgrspaceorg = $moduleConfig['tinyedmgrspaceorg'];
	$tiny_mgrdateform = str_replace('%', '', $moduleConfig['tinyedplugdate']);

	if ($tiny_lang == '')
		$lang_files = $xoopsConfig['language'];
	else
		$lang_files = 	$tiny_lang;

	$tiny_mgrbasedir = XOOPS_ROOT_PATH."$tiny_mgruploads";
	$tiny_mgrbaseurl = XOOPS_URL."$tiny_mgruploads";

	switch ($tiny_mgrspaceorg) {

		case 'name' : //Each user manages his own directory
			global $xoopsUser, $moduleConfig, $groups, $module_id;
			if (is_object($xoopsUser)) {
				$name  = $xoopsUser->getVar('uid');
				$userdir = "/user_".$username."_";
			}
			$persdir = $tiny_mgrbasedir."/$userdir";
			$persurl = $tiny_mgrbaseurl."/$userdir";
			
			if (is_dir($persdir) && is_writable($persdir)) {
				$tiny_mgrbasedir = $persdir;
				$tiny_mgrbaseurl = $persurl;
			} else {		
				if ($moduleConfig['tinyedmgrftp'] == 0) {
				mkdir ($persdir , 0777);
				@chmod ($persdir , 0777);
				} else {
					include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/class/ftpclass.php';
					$persdir = str_replace(XOOPS_ROOT_PATH.'/', '', $persdir);
					$ftp = new ftp();
					//todo
					if (checkRightTiny('TinyPerm', 18, $groups, $module_id) && !$xoopsUser->isAdmin($module_id))
						$ftp->debug = TRUE;
					$ftp->ftpConnect(TINY_FTPSERVER);
					$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
					$ftp->ftpMkdir(TINY_FTPOPTPATH.$persdir);
					$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATH.$persdir.'');
					$ftp->ftpClose();					
				}
				$tiny_mgrbasedir = $persdir;
				$tiny_mgrbaseurl = $persurl;
			}
		break;

		case 'date' :
			global $xoopsUser, $moduleConfig, $groups, $module_id;
			$curr_date = date($tiny_mgrdateform);

			$datedir = $tiny_mgrbasedir."/$curr_date";
			$dateurl = $tiny_mgrbaseurl."/$curr_date";
			
			if (is_dir($datedir) && is_writable($datedir)) {
				$tiny_mgrbasedir = $datedir;
				$tiny_mgrbaseurl = $dateurl;
			} else {		
				if ($moduleConfig['tinyedmgrftp'] == 0) {
				mkdir ($datedir , 0777);
				@chmod ($datedir , 0777);
				} else {
					include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/class/ftpclass.php';
					$persdir = str_replace(XOOPS_ROOT_PATH.'/', '', $persdir);
					$ftp = new ftp();
					if (checkRightTiny('TinyPerm', 18, $groups, $module_id))
						$ftp->debug = TRUE;
					$ftp->ftpConnect(TINY_FTPSERVER);
					$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
					$ftp->ftpMkdir(TINY_FTPOPTPATH.$persdir);
					$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATH.$persdir.'');
					$ftp->ftpClose();					
				}
				$tiny_mgrbasedir = $datedir;
				$tiny_mgrbaseurl = $dateurl;
			}
		break;

		default:
		break;

}

	$IMConfig['base_dir'] = $tiny_mgrbasedir;
	$IMConfig['base_url'] = $tiny_mgrbaseurl;
	$IMConfig['img_url'] = $tiny_mgrbaseurl;
	$IMConfig['safe_mode'] = ini_get('safe_mode');
	define('IMAGE_CLASS', $tiny_mgrimglib);
	define('IMAGE_TRANSFORM_LIB_PATH', $tiny_mgrimglibpath);
	$IMConfig['thumbnail_prefix'] = $tiny_mgrthupref;
	$IMConfig['default_thumbnail'] = $tiny_mgrdefthumb;
	$IMConfig['thumbnail_width'] = $tiny_mgrthuwidth;
	$IMConfig['thumbnail_height'] = $tiny_mgrthuheight;

?>