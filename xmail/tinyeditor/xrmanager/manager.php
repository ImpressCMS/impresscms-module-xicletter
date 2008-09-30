<?php
/*
* XRManager - Xoops Resources Manager
* built for TinyEditor by ralf57
* Version 1.0 - Genuary 2006
* based on Wei Zhuo's Image Manager
* Licensed under the terms of the GNU Lesser General Public License:
* http://www.opensource.org/licenses/lgpl-license.php
*/

	include_once "xrincludes.php";

	if (!defined('XOOPS_ROOT_PATH')) 
		die("XOOPS root path not defined");

	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {

		require_once TINY_ROOT_PATH.'include/config.inc.php';
		require_once TINY_ROOT_PATH.'class/XRManager.php';
		include_once TINY_ROOT_PATH.'class/HTMLGraph.php';
		include_once TINY_ROOT_PATH.'include/tinyperm.php';

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

	if (checkRightTiny('TinyPerm', 6, $groups, $module_id) && !checkRightTiny('TinyPerm', 7, $groups, $module_id)) {
		function fsizeman($file) {
			$size = 0;

			if (is_dir($file)) {
				if ($dh = opendir($file)) {
					while (($filecnt = readdir($dh)) !== false) {
						if ($filecnt == '.' || $filecnt == '..') 
							continue;
						if (is_dir($file.'/'.$filecnt)) 
							$size += fsizeman($file.'/'.$filecnt);
						else 
							$size += filesize($file.'/'.$filecnt);
					}
				} else {
					return false;
        		}
    		} else {
        		$size = filesize($file);
    		}
    	return $size;
		}
	
	$sql = "SELECT diskquota FROM ".$xoopsDB->prefix('tinyeditor_toolset')." WHERE tinyed_gid = ".intval($thegroupid)."";
				$result = $xoopsDB->query($sql);
				list($diskquota) = $xoopsDB->fetchRow($result);
				$dir_size = fsizeman(XOOPS_ROOT_PATH.$moduleConfig['tinyedmgruploads'].'/user_'.$uid.'_');

				$quota_perc = number_format(($dir_size * 100) / $diskquota);

	}

		$manager = new ResourceManager($IMConfig);
		$dirs = $manager->getDirs();

		$max_width = $IMConfig['max_width'];
		$max_height = $IMConfig['max_height'];

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
		echo "<head>";
		if (checkRightTiny('TinyPerm', 6, $groups, $module_id) && !checkRightTiny('TinyPerm', 7, $groups, $module_id))
			echo "<title>"._TINYMGR_7." - ".$quota_perc."% disk space used</title>";
		if (!checkRightTiny('TinyPerm', 6, $groups, $module_id) && !checkRightTiny('TinyPerm', 7, $groups, $module_id))
			echo "<title>"._TINYMGR_7."</title>";
		echo "<link type='text/css' rel='stylesheet' href='".TINY_ROOT_URL."xrmanager/css/manager.css' />";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/manager.js'></script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/popup.js'></script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/dialog.js'></script>";
		echo "<script type='text/javascript'>\n";
		echo "/*<![CDATA[*/\n";
		echo "var thumbdir = '".$IMConfig['thumbnail_dir']."';\n";
        echo "var base_url = '".$manager->getBaseURL()."';\n";
		echo "/*]]>*/\n";
		echo "</script>";
		echo "</head>";
		echo "<body onload='window.focus();init();'>";
		echo "<form action='".TINY_ROOT_URL."xrmanager/files.php' name='uploadForm' id='uploadForm' method='post' enctype='multipart/form-data'>";
		echo "<div id='page'>";
		echo "<div id='top_panel'>";
		echo "<div class='pres'>";
		echo $xoopsConfig['sitename']."<br />";
		echo _TINYMGR_7;
		echo "</div>";
		echo "<div class='top_nav'>";
		echo "<div class='dirs'>";
		echo "<label for='dirPath'>"._TINYMGR_11."</label>";
		echo "<select name='dir' class='dirWidth' id='dirPath' onchange=\"updateDir(this, '"._TINYMGR_LOADING."')\">";
		echo "<option value='/'>/</option>";
		
			foreach ($dirs as $relative=>$fullpath) {
				echo "<option value='".rawurlencode($relative)."'>".$relative."</option>";
			}
		
		echo "</select>";
		echo "<a href='#' onclick=\"javascript: goUpDir('"._TINYMGR_LOADING."');\"><img src='".TINY_ROOT_URL."xrmanager/images/dir_up.png' height='16' width='16' alt='"._TINYMGR_9."' title='"._TINYMGR_9."' /></a>";

		if ($gperm_handler->checkRight('TinyPerm', 4, $groups, $module_id)) {
			echo "<a href='#' onclick='newFolder();'><img src='".TINY_ROOT_URL."xrmanager/images/dir_new.png' height='16' width='16' alt='"._TINYMGR_10."' title='"._TINYMGR_10."' /></a>";
		}
		
		echo "<div id='messages' style='display: none;'><span id='message'></span><img src='".TINY_ROOT_URL."xrmanager/images/dots.gif' width='22' height='12' alt='...' /></div>";
		echo "</div>";
		echo "</div>";
		echo "<div class='clearboth'></div>";
		echo "</div>";
		echo "<div id='main_panel'>";
		echo "<iframe src='".TINY_ROOT_URL."xrmanager/files.php' name='imgManager' id='imgManager' class='imageFrame' scrolling='auto' frameborder='0'></iframe>";
		echo "<br /><br />";
		
		if ($gperm_handler->checkRight('TinyPerm', 1, $groups, $module_id)) {
			if (checkRightTiny('TinyPerm', 6, $groups, $module_id) && !checkRightTiny('TinyPerm', 7, $groups, $module_id) && $dir_size >= $diskquota) {
				//nothing
			} else {
				echo "<fieldset class=\"uploadArea\">";
				echo "<legend><b>"._TINYMGR_6."</b></legend>";
				echo "<label for='upload'>"._TINYMGR_UPNEWFILE."</label>";
				echo "<div style='float:left; padding-right:10px;' id='uploadDiv'><input class='formbutton' type='file' name='upload' id='upload' size='28' /></div><div><input type='submit' name='submit' value='"._TINYMGR_SUBMITFILE."' onclick=\"doUpload('"._TINYMGR_UPLOADING."');\" class='formButton' /></div>";
				echo "</fieldset>";
			}
		}
		
		echo "<br />";
		echo "</div>";
		echo "</div></form>";
		echo "</body>";
		echo "</html>";
	} else {
		die(_NOPERM);
	}

?>