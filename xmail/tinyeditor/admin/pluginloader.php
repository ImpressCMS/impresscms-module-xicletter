<?php

	include 'admin_header.php';
	if (function_exists('copy') || $xoopsModuleConfig['tinyedmgrftp'] == 1) {
	if ($xoopsModuleConfig['tinyedmgrftp'] == 1) {
		include XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfigplugin.php';
		if (TINY_FTPSERVERPLUGIN == '' || TINY_FTPUSERPLUGIN == '' || TINY_FTPPASSPLUGIN == '')
			exit(_AM_TINYED_STATSMISSFTP);
	}

	if (isset($_POST['op']) && $_POST['op'] == 'upload_unzip') $op = 'upload_unzip';

	function upload_unzip() {
		global $xoopsModuleConfig;
		$is_plug = '';
		$append = '';
		$noxoopsroot = '';

		include_once XOOPS_ROOT_PATH.'/class/uploader.php';
		
		$allowed_mimetypes = array('application/zip', 'application/x-zip', 'application/x-zip-compressed', 'application/x-compress', 'application/x-compressed');
		$maxfilesize = 1000000;
		$maxfilewidth = 0;
		$maxfileheight = 0;

		$unzip_dir = XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins';
		
		

		// so what is the file called? we have to process this further
		$uploaded_filename = $_FILES['upload_file_name']['name'];

		// check if it is a language file
		if (preg_match("/langfile/", $uploaded_filename)) {
			// set variables to define that it is not a plugin and the directory to be attached
			$is_plug = 0;;
			// we have to extract the plugin name from the uploaded file first
			$plugname = preg_replace('/(.*)langfile_|.zip/msU', '', $uploaded_filename);
			$append = '/'.$plugname.'/langs';
			// stop the script because there is no plugin for the language file
			if (!is_dir(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname))
				redirect_header('pluginloader.php', 2, _AM_TINYED_PLUGNOPLUG);
		} elseif (preg_match("/plugin/", $uploaded_filename)) {
			$if_plug = 1;
			$append = '';
			// we have to extract the plugin name from the uploaded file first
			$plugname = preg_replace('/(.*)plugin_|.zip/msU', '', $uploaded_filename);
			if (is_dir(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname))
				redirect_header('pluginloader.php', 2, _AM_TINYED_PLUGEXIST);
		} else {
			redirect_header('pluginloader.php', 2, 'Upload failed: name');
		}

		if ($xoopsModuleConfig['tinyedmgrftp'] == 1) {
			include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/class/ftpclass.php';
			$noxoopsroot = str_replace(XOOPS_ROOT_PATH.'/', '', $unzip_dir);
			$ftp = new ftp();
			$ftp->ftpConnect(TINY_FTPSERVERPLUGIN);
			$ftp->ftpLogin(TINY_FTPUSERPLUGIN, TINY_FTPPASSPLUGIN);
			$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATHPLUGIN.$noxoopsroot.$append.'');
			$ftp->ftpClose();
		} else {		
			@chmod($unzip_dir.$append, 0777);
		}	

$uploader = new XoopsMediaUploader($unzip_dir.$append, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);

		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			if (!$uploader->upload()) {
				// errors? not here! ;-)
				echo $uploader->getErrors();
			} else {
				include XOOPS_ROOT_PATH.'/modules/tinyeditor/class/pclzip.lib.php';
				$archive = new PclZip($unzip_dir.$append.'/'.$uploaded_filename);
				
				if ($archive->extract(PCLZIP_OPT_PATH, XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins'.$append) == 0) {
				// extraction failed so we have to clean up plugins
					if ($xoopsModuleConfig['tinyedmgrftp'] == 1) {
						$source_del = str_replace(XOOPS_ROOT_PATH.'/', '', $unzip_dir.$append.'/'.$uploaded_filename);
						$noxoopsroot = str_replace(XOOPS_ROOT_PATH.'/', '', $unzip_dir.$append);
						include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/class/ftpclass.php';
						$ftp = new ftp();
						$ftp->ftpConnect(TINY_FTPSERVERPLUGIN);
						$ftp->ftpLogin(TINY_FTPUSERPLUGIN, TINY_FTPPASSPLUGIN);
						$ftp->ftpDelete(TINY_FTPOPTPATHPLUGIN.$source_del);
						$ftp->ftpSite('CHMOD 0755 '.TINY_FTPOPTPATHPLUGIN.$noxoopsroot.'');
						$ftp->ftpClose();
					} else {
						unlink($unzip_dir.$append.'/'.$uploaded_filename);
						@chmod(XOOPS_ROOT_PATH.'/'.$unzip_dir.$append, 0755);
					}
					redirect_header('index.php', 2, _AM_TINYED_UNZIPFAIL.$archive->errorInfo(true));					
				} else {
				// although extraction did not fail, the zip has to be deleted anyway
					if ($xoopsModuleConfig['tinyedmgrftp'] == 1) {
						$source_del = str_replace(XOOPS_ROOT_PATH.'/', '', $unzip_dir.$append.'/'.$uploaded_filename);
						$noxoopsroot = str_replace(XOOPS_ROOT_PATH.'/', '', $unzip_dir.$append);
						include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/class/ftpclass.php';
						$ftp = new ftp();
						$ftp->ftpConnect(TINY_FTPSERVERPLUGIN);
						$ftp->ftpLogin(TINY_FTPUSERPLUGIN, TINY_FTPPASSPLUGIN);
						$ftp->ftpDelete(TINY_FTPOPTPATHPLUGIN.$source_del);
						$ftp->ftpSite('CHMOD 0755 '.TINY_FTPOPTPATHPLUGIN.$noxoopsroot.'');
						// just to be sure
						$ftp->ftpSite('CHMOD 0755 '.TINY_FTPOPTPATHPLUGIN.'modules/tinyeditor/editor/plugins');
						// ridiculous I know, but I don't know a better way yet
						$ftp->ftpSite('CHMOD 0755 '.TINY_FTPOPTPATHPLUGIN.'modules/tinyeditor/editor/plugins/'.$plugname);
						// we have now to copy the image for the plugin to the admin image directory of tinyeditor
						$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATHPLUGIN.'modules/tinyeditor/admin/images');
						$ftp->ftpPut(TINY_FTPOPTPATHPLUGIN.'modules/tinyeditor/admin/images/'.$plugname.'.gif', XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname.'/images/'.$plugname.'.gif', 1);
						$ftp->ftpSite('CHMOD 0755 '.TINY_FTPOPTPATHPLUGIN.'modules/tinyeditor/admin/images');
						// all directories have to be made 'safe' now
						$dir = opendir(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname);
						while ($dirlist = readdir($dir)) {
							if ($dirlist[0] != "." && $dirlist[0] != ".." && !is_file($dirlist)) {
								$dirlist = str_replace(XOOPS_ROOT_PATH.'/', '', $dirlist);
								$ftp->ftpSite('CHMOD 0755 '.TINY_FTPOPTPATHPLUGIN.'modules/tinyeditor/editor/plugins/'.$plugname.'/'.$dirlist.'');
							}
						}
						closedir($dir);
						$ftp->ftpClose();
					} else {
						if ($append == '') 
							copy(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname.'/images/'.$plugname.'.gif', XOOPS_ROOT_PATH.'/modules/tinyeditor/admin/images/'.$plugname.'.gif');
						unlink($unzip_dir.$append.'/'.$uploaded_filename);
						@chmod(XOOPS_ROOT_PATH.'/'.$unzip_dir.$append, 0755);
						// just to be sure
						@chmod(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins', 0755);
						// ridiculous I know, but I don't know a better way yet
						@chmod(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname, 0755);
						$dir = opendir(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname);
						while ($dirlist = readdir($dir)) {
							if ($dirlist[0] != "." && $dirlist[0] != ".." ) {
								@chmod(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/'.$plugname.'/'.$dirlist, 0755);
							}
						}
						closedir($dir);
					}
				redirect_header('toolsets.php', 2, _AM_TINYED_UNZIPSUCC);
				}
			}
		}
	}

	function plugin_index() {
		global $xoopsModuleConfig;
		adminMenu(6, _AM_TINYED_PLUGINUP);
		if ((!is_writable(XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins') || !is_writable(XOOPS_ROOT_PATH.'/modules/tinyeditor/admin/images')) && $xoopsModuleConfig['tinyedmgrftp'] != 1) {
			echo "<div style='color:#ff0000; font-weight:bold; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:14px;'>"._AM_TINYED_DIRNOTWRITE."</div><br />";
		}
		$fileform = new XoopsThemeForm(_AM_TINYED_PLUGINUP, "plugin_up", "pluginloader.php");
		$fileform->setExtra('enctype="multipart/form-data"');
		$fileform->addElement(new XoopsFormFile(_AM_TINYED_FILE, 'upload_file_name', 1000000));
		$fileform->addElement(new XoopsFormHidden('op', 'upload_unzip'));
		$fileform->addElement(new XoopsFormButton('', 'pluginsubmit', _SUBMIT, 'submit'));
		$fileform->display();		
	}

	xoops_cp_header();

	if (!isset($op)) {
		$op = '';
	}

	switch ($op) {

		case 'upload_unzip':
		upload_unzip();
		break;

		case 'default':
		default:
		plugin_index();
		break;

	}

	xoops_cp_footer();
	} else {
		redirect_header('index.php', 5, _AM_TINYED_STATSNOCOPY);
	}
?>