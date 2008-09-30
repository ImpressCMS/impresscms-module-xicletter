<?php

	include 'admin_header.php';
	global $moduleConfig;
	if ($moduleConfig['tinyedmgrftp'] == 1) {
		include XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfigchmod.php';
		if (TINY_FTPSERVERCHMOD == '' || TINY_FTPUSERCHMOD == '' || TINY_FTPPASSCHMOD == '')
			exit(_AM_TINYED_STATSMISSFTPCHMOD);

	if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
	
	if (isset($_POST['op']) && $_POST['op'] == 'chmod_11oo10') $op = 'chmod_11oo10';
	if (isset($_POST['op']) && $_POST['op'] == 'delete_chmod') $op = 'delete_chmod';
	if (isset($_GET['op']) && $_GET['op'] == 'delete_chmod') $op = 'delete_chmod';
	
	function sanitizeChmodPath($inpath) {
		$outpath = ereg_replace("\.[\.]+", "", $inpath);
		$outpath = ereg_replace("^[\/]+", "", $outpath);
		$outpath = ereg_replace("^[A-Za-z][:\|][\/]?", "", $outpath);
		return($outpath);
	}

	function chmod_11oo10() {
		global $xoopsDB;
		include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/class/ftpclass.php';
		$ftp = new ftp();
		$ftp->ftpConnect(TINY_FTPSERVERCHMOD);
		$ftp->ftpLogin(TINY_FTPUSERCHMOD, TINY_FTPPASSCHMOD);

		// Checking if the chmod is octal
		$pos = strpos(htmlentities($_POST['mod']), "0");
			
			if ($pos === false) {
				$mod = '0'.htmlentities($_POST['mod']);
			} else {
				$mod = htmlentities($_POST['mod']);
			}

		// try to chmod $path directory
		if ($ftp->ftpSite('CHMOD '.$mod.' '.TINY_FTPOPTPATHCHMOD.$_POST["ftp_path_name"].'') !== false) {
			$success = true;
			if ($mod == '0777') {
				$xoopsDB->query("INSERT INTO ".$xoopsDB->prefix('tinyeditor_chmods')." (tinychmods_paths) VALUES (".$xoopsDB->quoteString($_POST['ftp_path_name']).")");
			} else {
				$xoopsDB->query("DELETE FROM ".$xoopsDB->prefix('tinyeditor_chmods')." WHERE tinychmods_paths = ".$xoopsDB->quoteString($_POST['ftp_path_name'])." ");
			}
		} else {
			$success = false;
		}

		// close the connection
		$ftp->ftpClose();	
		if ($success == true)
			redirect_header('index.php', 2, _AM_TINYED_CHMODSUCC);
		else
			redirect_header('chmod.php', 2, _AM_TINYED_CHMODFAIL);
	}

	function delete_chmod($del=0) {

	global $xoopsDB;

		if (isset($_POST['del']) && $_POST['del'] == 1) {
		$sql = "DELETE FROM ".$xoopsDB->prefix('tinyeditor_chmods')." WHERE tinychmods_id = ".intval($_POST['chmodid'])." ";

			if ($xoopsDB->query($sql)) {
			redirect_header('chmod.php', 2, $_POST['pathname'].' '._AM_TINYED_CHMODDELETED);
			}
			else {
			redirect_header('chmod.php', 2, $_POST['pathname'].' '._AM_TINXED_CHMODNOTDELETED);
			}
		exit();
		}
		else {
		echo "<h4>"._AM_TINYED_CHMOD."</h4>";
		xoops_confirm(array('chmodid' => $_POST['chmodid'], 'pathname' => $_POST['pathname'], 'del' => 1), 'chmod.php?op=delete_chmod', _AM_TINYED_SUREDELETECHMOD.' '.$_POST['pathname']);
		}
	}

	function chmod_index() {
		global $xoopsDB;
		adminMenu(7, _AM_TINYED_CHMOD);
		
		$chmodform = new XoopsThemeForm(_AM_TINYED_CHMOD, "chmod_it", "chmod.php");
		$chmodform->addElement(new XoopsFormText(_AM_TINYED_THEPATH, 'ftp_path_name', 50, 500, ''), true);
		$chmodform->addElement(new XoopsFormText(_AM_TINYED_FTPCHMOD, 'mod', 4, 4, ''), true);
		$chmodform->addElement(new XoopsFormHidden('op', 'chmod_11oo10'));
		$chmodform->addElement(new XoopsFormButton('', 'chmodsubmit', _SUBMIT, 'submit'));
		$chmodform->display();	
		echo "<br style='clear:both;' />";
		$result = $xoopsDB->query("SELECT tinychmods_id, tinychmods_paths FROM ".$xoopsDB->prefix('tinyeditor_chmods')." ORDER BY tinychmods_paths ASC");
		if ($result) {
			echo "<form name='deletethemod' action='chmod.php' method='post' id='deletethemod'><table class='outer' width='100%' cellspacing='5' cellpadding='5'>";
			echo "<th colspan='3' style='padding:3px;'>"._AM_TINYED_HAVE777."</th>";
				while (list($tinychmods_id, $tinychmods_paths) = $xoopsDB->fetchRow($result)) {
					echo "<tr>";
					echo "<td class='even' width='90%' id='thispath".$tinychmods_id."'>";
					
					echo $tinychmods_paths;
					if (preg_match("/\./", $tinychmods_paths))  {
						if (!is_file(XOOPS_ROOT_PATH.'/'.$tinychmods_paths))
							echo _AM_TINYED_FILENOTEXISTANYMORE;
					} else {
						if (!is_dir(XOOPS_ROOT_PATH.'/'.$tinychmods_paths))
							echo _AM_TINYED_DIRNOTEXISTANYMORE;
					}
					echo "</td>";
					echo "<td class='odd' width='5%' align='center'><a href='#' onclick='javascript:elementnode=document.getElementById(\"thispath".$tinychmods_id."\");document.chmod_it.ftp_path_name.value=elementnode.firstChild.nodeValue;'><img src='./images/copy.gif' alt='"._AM_TINYEDCOPY."' /></a></td>";
					echo "<td class='odd' width='5%' align='center'><input type='image' src='./images/delete.gif' style='border:none;' /><input type='hidden' name='op' value='delete_chmod' /><input type='hidden' name='chmodid' value='".$tinychmods_id."' /><input type='hidden' name='pathname' value='".$tinychmods_paths."' /></td>";
					echo "</tr>";
				}
			echo "</table></form>";
		}
	}

	xoops_cp_header();

	if (!isset($op)) {
		$op = '';
	}

	switch ($op) {

		case 'chmod_11oo10':
		chmod_11oo10();
		break;

		case 'delete_chmod':
		delete_chmod();
		break;

		case 'default':
		default:
		chmod_index();
		break;

	}

	xoops_cp_footer();
	} else {
		redirect_header('index.php', 2, _AM_TINYED_NOCHMODONWIN);
	}
		} else {
		redirect_header('index.php', 2, _AM_TINYED_NEEDFTP);
	}
?>