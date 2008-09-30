<?php
/*
* XRManager - Xoops Resources Manager
* built for TinyEditor by ralf57
* Version 1.0 - Genuary 2006
* Licensed under the terms of the GNU Lesser General Public License:
*/

	include "xrincludes.php";

	if (!defined('XOOPS_ROOT_PATH')) 
		die("XOOPS root path not defined");

	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {

	if ($moduleConfig['tinyedmgrftp'] == 1) {
		if (!defined('TINY_FTPSERVER') || !defined('TINY_FTPUSER') || !defined('TINY_FTPPASS'))
			include TINY_ROOT_PATH.'include/ftpconfig.php';
		if (TINY_FTPSERVER == '' || TINY_FTPUSER == '' || TINY_FTPPASS == '')
			exit(_AM_TINYED_STATSMISSFTP);
	}

		require_once TINY_ROOT_PATH.'include/config.inc.php';
		require_once TINY_ROOT_PATH.'class/XRManager.php';
		require_once TINY_ROOT_PATH.'include/iconlookup.php';
		include TINY_ROOT_PATH.'include/ctxmenu.php';
		include_once TINY_ROOT_PATH.'include/functions.php';
		include_once TINY_ROOT_PATH.'include/tinyperm.php';

		//default path is /
		$relative = '/';
		$manager = new ResourceManager($IMConfig);

		//process any file actions
		$manager->processCopyFile(); // both copy and move cases
		$manager->processCopyFolder(); // both copy and move cases
		$manager->processUploads();
		$manager->renameFiles();
		$manager->renameFolders();
		$manager->deleteFiles();

		$refreshDir = false;

		//process any directory functions
		if ($manager->deleteDirs() || $manager->processNewDir() || $manager->processCopyFolder() || $manager->processUploads())
			$refreshDir = true;

		//check for any sub-directory request
		//check that the requested sub-directory exists
		//and valid
		if (isset($_REQUEST['dir'])) {
			$path = rawurldecode($_REQUEST['dir']);
			if ($manager->validRelativePath($path))
				$relative = $path;
		}

		//get the list of files and directories
		$list = $manager->getFiles($relative);

		$imagepath = $IMConfig['img_url'];

		/* ================= OUTPUT/DRAW FUNCTIONS ======================= */
		/**
		 * Draw the files in an table.
		 */
		//Added modifications for TinyMCE - Ryan Demmer
		function drawFiles($list, &$manager) {
        	global $relative, $imagepath, $xoopsUser, $i, $tiny_thumbcols, $menu_id, $xoopsDB, $groupid, $mimetype_array, $tiny_persdir, $tiny_mgruploads, $groups, $module_id, $IMConfig, $moduleConfig;
			$prepend = "";

	$thegroupid = '';

	if (is_object($xoopsUser)) {
		$uid = $xoopsUser->getVar('uid');
		$getthegroupid = $xoopsUser->getGroups($uid);
		if ($moduleConfig['tinygroupoverride'] != '') {
			$split_override_array = explode(" ", $moduleConfig['tinygroupoverride']);
			foreach ($split_override_array as $override_value) {
				$pieces = explode("|", $override_value);
				$group_pointer = array_pop($pieces);
				if (array_intersect($getthegroupid, $pieces)) {
					$thegroupid = $group_pointer;
					break;
				} else {
			$thegroupid = array_slice($getthegroupid, 0, 1);
			$thegroupid = implode(" ", $thegroupid);
			$thegroupid = trim($thegroupid);					
				}
			}
		} else {	
			$thegroupid = array_slice($getthegroupid, 0, 1);
			$thegroupid = implode(" ", $thegroupid);
			$thegroupid = trim($thegroupid);
		}
	} else {
		$thegroupid = 3;
	}

		$xuser_name = 'user_'.$uid.'_';

		$mimes = getMimeArray($thegroupid);

			foreach($list as $entry => $file) {

		$serverpathtofile = str_replace(XOOPS_URL, XOOPS_ROOT_PATH, $imagepath.$file['relative']);

		$mimetype = new ResourceManager($IMConfig);
		$mimeread = $mimetype->getMime($serverpathtofile);

		// case 1: userdirs and no override
		if ($tiny_persdir == 1 && preg_match("/".$xuser_name."/", $serverpathtofile) && !checkRightTiny('TinyPerm', 7, $groups, $module_id)) {
				if (in_array($mimeread, $mimes)) {
				
				if ($file['image']) {
					$itemtype = "image"; 
				} else { 
					$itemtype = "other";
				} //used in context menu

        		echo $prepend;
                echo "<td>\n";
				echo "<table width='120' cellpadding='0' cellspacing='0' border='0'>\n";
				echo "<tr>\n";
				echo "<td class='block'>\n";
                echo "<a href='javascript:;' onclick=\"insertFile('".$imagepath.$file['relative']."');\" title=\"".$entry." - ".Files::formatSize($file['stat']['size'])."\"><img src=\"".$manager->getThumbnail($file['relative'])."\" alt=\"".$entry." - ".Files::formatSize($file['stat']['size'])."\" /></a><br />\n";
				echo displayItemMenu($itemtype, $entry, $menu_id, $imagepath.$file['relative'], $relative, $file['relative'], '');
                echo "</td>\n";
				echo "</tr>\n";
				echo "</table>\n";
				echo "</td>\n";

				$i++; // incremental cells counter
				$menu_id++; // increment contextmenu id
				
				if (!($i % $tiny_thumbcols)) 
					$prepend = "</tr>\n<tr>\n";
				else 
					$prepend = "";
			}
        }

		// case 2: userdirs and override
		if ($tiny_persdir == 1 && checkRightTiny('TinyPerm', 7, $groups, $module_id) == 1) {
			if (in_array($mimeread, $mimes)) {
				
				if ($file['image']) 
					$itemtype = "image"; 
				else 
					$itemtype = "other";

        		echo $prepend;
                echo "<td>\n";
				echo "<table width='120' cellpadding='0' cellspacing='0' border='0'>\n";
				echo "<tr>\n";
				echo "<td class='block'>\n";
                echo "<a href='javascript:;' onclick=\"insertFile('".$imagepath.$file['relative']."');\" title=\"".$entry." - ".Files::formatSize($file['stat']['size'])."\"><img src=\"".$manager->getThumbnail($file['relative'])."\" alt=\"".$entry." - ".Files::formatSize($file['stat']['size'])."\" /></a><br />\n";
				echo displayItemMenu($itemtype, $entry, $menu_id, $imagepath.$file['relative'], $relative, $file['relative'], '');
                echo "</td>\n";
				echo "</tr>\n";
				echo "</table>\n";
				echo "</td>\n";

				$i++;
				$menu_id++;
				
				if (!($i % $tiny_thumbcols)) 
					$prepend = "</tr>\n<tr>\n";
				else 
					$prepend = "";
				}
        	}

		// case 3: no userdirs
		if ($tiny_persdir == 0) {
			if (in_array($mimeread, $mimes)) {
				
				if ($file['image']) 
					$itemtype = "image"; 
				else 
					$itemtype = "other";

        		echo $prepend;
                echo "<td>\n";
				echo "<table width='120' cellpadding='0' cellspacing='0' border='0'>\n";
				echo "<tr>\n";
				echo "<td class='block'>\n";
                echo "<a href='javascript:;' onclick=\"insertFile('".$imagepath.$file['relative']."');\" title=\"".$entry." - ".Files::formatSize($file['stat']['size'])."\"><img src=\"".$manager->getThumbnail($file['relative'])."\" alt=\"".$entry." - ".Files::formatSize($file['stat']['size'])."\" /></a><br />\n";
				echo displayItemMenu($itemtype, $entry, $menu_id, $imagepath.$file['relative'], $relative, $file['relative'], '');
                echo "</td>\n";
				echo "</tr>\n";
				echo "</table>\n";
				echo "</td>\n";

				$i++;
				$menu_id++;
				
				if (!($i % $tiny_thumbcols)) 
					$prepend = "</tr>\n<tr>\n";
				else 
					$prepend = "";
				}
        	}
		} //foreach
	} //end function drawFiles

		/**
		 * Draw the directories in a table.
		 */
		function drawDirs($list, &$manager) {

			global $relative, $xoopsUser, $i, $tiny_thumbcols, $menu_id, $tiny_mgrdelnonempty, $tiny_persdir, $tiny_mgruploads, $groups, $module_id, $moduleConfig;
			$prepend = "";

			if ($tiny_persdir == 1 && !is_dir(XOOPS_ROOT_PATH.$tiny_mgruploads.'/user_'.$xoopsUser->getVar('uid').'_')) {
				$xuser_name = 'user_'.$xoopsUser->getVar('uid').'_';
				if ($moduleConfig['tinyedmgrftp'] == '0') {
					@mkdir (XOOPS_ROOT_PATH.$tiny_mgruploads.'/'.$xuser_name, 0777);
					@chmod (XOOPS_ROOT_PATH.$tiny_mgruploads.'/'.$xuser_name, 0777);
				} else {
					include_once TINY_ROOT_PATH.'class/ftpclass.php';
					$destpath = $tiny_mgruploads.'/'.$xuser_name;
					$ftp = new ftp();
					if (checkRightTiny('TinyPerm', 18, $groups, $module_id) && !$xoopsUser->isAdmin($module_id))
						$ftp->debug = TRUE;				
					$ftp->ftpConnect(TINY_FTPSERVER);
					$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
					$ftp->ftpMkdir(TINY_FTPOPTPATH.$destpath);
					$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATH.$destpath.'');
					$ftp->ftpClose();
				}
			} else {
				$xuser_name = 'user_'.$xoopsUser->getVar('uid').'_';
			}

			foreach($list as $path => $dir) {
				// case 1: userdirs and no override
				if ($tiny_persdir == 1 && preg_match("/".$xuser_name."/", $path) && !checkRightTiny('TinyPerm', 7, $groups, $module_id)) {
					echo $prepend;

					$itemtype = "dir";
					$dir_del_alert = 0;
				
					if ($tiny_mgrdelnonempty == 0 && $dir['count'] > 0) 
						$dir_del_alert = 1;
                
					echo "<td>\n";
					echo "<table width='120' cellpadding='0' cellspacing='0' border='0'>\n";
					echo "<tr>\n";
					echo "<td class='block'>\n";
               		echo "<a href=\"files.php?dir=".rawurlencode($path)."\" onclick=\"updateDir('".$path."', '"._TINYMGR_LOADING."')\" title=\"".$dir['entry']."\"><img src='images/folder.gif' height='48' width='48' alt=\"".$dir['entry']."\" /></a><br />\n";
					echo displayItemMenu($itemtype, $dir['entry'], $menu_id, $path, $relative, '', $dir_del_alert);
                	echo "</td>\n";
					echo "</tr>\n";
					echo "</table>\n";
					echo "</td>\n";

					$i++; // increment cells counter
					$menu_id++; // increment contextmenu id
					if (!($i % $tiny_thumbcols)) {
						$prepend = "</tr>\n<tr>\n"; // draw new row
						echo $prepend; //fix a funny bug - now is ok
					} else {
						$prepend = ""; //add cell(s) in the old row
					}
        		}
        	
				// case 2: userdirs and override        	
				if ($tiny_persdir == 1 && checkRightTiny('TinyPerm', 7, $groups, $module_id) == 1) {
					echo $prepend;

					$itemtype = "dir";
					$dir_del_alert = 0;
				
					if ($tiny_mgrdelnonempty == 0 && $dir['count'] > 0) 
						$dir_del_alert = 1;
                
					echo "<td>\n";
					echo "<table width='120' cellpadding='0' cellspacing='0' border='0'>\n";
					echo "<tr>\n";
					echo "<td class='block'>\n";
               		echo "<a href=\"files.php?dir=".rawurlencode($path)."\" onclick=\"updateDir('".$path."', '"._TINYMGR_LOADING."')\" title=\"".$dir['entry']."\"><img src='images/folder.gif' height='48' width='48' alt=\"".$dir['entry']."\" /></a><br />\n";
					echo displayItemMenu($itemtype, $dir['entry'], $menu_id, $path, $relative, '', $dir_del_alert);
                	echo "</td>\n";
					echo "</tr>\n";
					echo "</table>\n";
					echo "</td>\n";

					$i++; // increment cells counter
					$menu_id++; // increment contextmenu id
					if (!($i % $tiny_thumbcols)) {
						$prepend = "</tr>\n<tr>\n"; // draw new row
						echo $prepend; //fix a funny bug - now is ok
					} else {
						$prepend = ""; //add cell(s) in the old row
					}
        		}        	

				// case 3: no userdirs        	
				if ($tiny_persdir == 0) {
					echo $prepend;

					$itemtype = "dir";
					$dir_del_alert = 0;
				
					if ($tiny_mgrdelnonempty == 0 && $dir['count'] > 0) 
						$dir_del_alert = 1;
                
					echo "<td>\n";
					echo "<table width='120' cellpadding='0' cellspacing='0' border='0'>\n";
					echo "<tr>\n";
					echo "<td class='block'>\n";
               		echo "<a href=\"files.php?dir=".rawurlencode($path)."\" onclick=\"updateDir('".$path."', '"._TINYMGR_LOADING."')\" title=\"".$dir['entry']."\"><img src='images/folder.gif' height='48' width='48' alt=\"".$dir['entry']."\" /></a><br />\n";
					echo displayItemMenu($itemtype, $dir['entry'], $menu_id, $path, $relative, '', $dir_del_alert);
                	echo "</td>\n";
					echo "</tr>\n";
					echo "</table>\n";
					echo "</td>\n";

					$i++; // increment cells counter
					$menu_id++; // increment contextmenu id
					if (!($i % $tiny_thumbcols)) {
						$prepend = "</tr>\n<tr>\n"; // draw new row
						echo $prepend; //fix a funny bug - now is ok
					} else {
						$prepend = ""; //add cell(s) in the old row
					}
        		}
			} // end foreach
		} // end function drawDirs

		/**
		 * No directories and no files.
		 */
		function drawNoResults() {

			echo "<table width='100%'>";
			echo "<tr>";
			echo "<td class='noResult'>"._TINYMGR_EMPTYDIR."</td>";
			echo "</tr>";
			echo "</table>";
		}

		/**
		 * No directories and no files.
		 */
		function drawErrorBase(&$manager) {

			echo "<table width='100%'>";
			echo "<tr>";
			echo "<td class='error'>"._TINYMGR_INVALIDBASEDIR.$manager->config['base_dir']."</td>";
			echo "</tr>";
			echo "</table>";
		}

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
		echo "<head>";
		echo "<title>xrmanager</title>";
		echo "<link href='".TINY_ROOT_URL."xrmanager/css/fileslist.css' rel='stylesheet' type='text/css' />";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/contextmenu.js'></script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/ie5.js'></script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/dialog.js'></script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/imagePopup.js'></script>";
		// the upload field was never cleared after upload and so I made this ugly hack :-(
		echo "<script type='text/javascript'>\n";
		echo "function clearUpField() {\n";
		echo "window.top.document.getElementById('uploadDiv').innerHTML = window.top.document.getElementById('uploadDiv').innerHTML;\n";
		echo "}\n";
		echo "</script>\n";
		echo "<script type='text/javascript'>\n";
		echo "/*<![CDATA[*/\n";

		echo "if(window.top)\n";
			echo "I18N = window.top.I18N;\n";

		echo "function hideMessage() {\n";
			echo "var topDoc = window.top.document;\n";
			echo "var messages = topDoc.getElementById('messages');\n";
			echo "if(messages)\n";
				echo "messages.style.display = 'none';\n";
		echo "}\n";

		echo "init = function() {\n";
			echo "hideMessage();\n";
			echo "var topDoc = window.top.document;\n";

		//we need to refesh the drop directory list
		//save the current dir, delete all select options
		//add the new list, re-select the saved dir.

		if ($refreshDir == true) {
			$dirs = $manager->getDirs();

			echo "var selection = topDoc.getElementById('dirPath');\n";
			echo "var currentDir = selection.options[selection.selectedIndex].text;\n";

			echo "while(selection.length > 0) {\n";
				echo "selection.remove(0);\n";
			echo "}\n";

			echo "selection.options[selection.length] = new Option('/','".rawurlencode('/')."');\n";

			foreach ($dirs as $relative=>$fullpath) {
				echo "selection.options[selection.length] = new Option('".$relative."','".rawurlencode($relative)."');\n";
			}

			echo "for(var i = 0; i < selection.length; i++) {\n";
				echo "var thisDir = selection.options[i].text;\n";
				echo "if(thisDir == currentDir) {\n";
					echo "selection.selectedIndex = i;\n";
					echo "break;\n";
				echo "}\n";
			echo "}\n";
		}
		echo "}\n";

		echo "function editImage(image) {\n";
			echo "var url = '".TINY_ROOT_URL."xrmanager/tools/editor.php?img='+image;\n";
			echo "Dialog(url, function(param) {\n";
				echo "if (!param)\n";
					echo "return false;\n";
				echo "else\n";
					echo "return true;\n";
			echo "}, null);\n";
		echo "}\n";
		echo "/*]]>*/\n";
		echo "</script>";
		echo "<script type=\"text/javascript\" src=\"".TINY_ROOT_URL."xrmanager/js/files.js\"></script>";
		echo "</head>";
		echo "<body onload='clearUpField();'>";

		if ($manager->isValidBase() == false) { 
			drawErrorBase($manager);
		}
		elseif (count($list[0]) > 0 || count($list[1]) > 0) {
			echo "<table>";
			echo "<tr>";

			$menu_id = "1";
			$i = 0;  // cells counter.
			$cell_width = 1.65*$tiny_mgrthuwidth-10;
			drawDirs($list[0], $manager);
        	drawFiles($list[1], $manager);
			echo "</table>";
		} else {
			drawNoResults();
		}

		echo "</body>";
		echo "</html>";

	} else {
		die(_NOPERM);
	}
	
?>