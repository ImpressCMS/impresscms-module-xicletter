<?php
/*  ------------------------------------------------------------------------
	                XOOPS - PHP Content Management System
	                    Copyright (c) 2000 XOOPS.org
	                       <http://www.xoops.org/>
	------------------------------------------------------------------------
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	at your option) any later version.

	You may not change or alter any portion of this comment or credits
	of supporting developers from this source code or any supporting
	source code which is considered copyrighted (c) material of the
	original comment or credit authors.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA

	File: tinyeditor/include/ctxmenu.php
	Version: 18062006
	Developer: frankblack (frankblack@myxoops.de)
	------------------------------------------------------------------------ */

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname("tinyeditor");
	$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
	$module_id = $module->getVar('mid');
	$gperm_handler = &xoops_gethandler('groupperm');
	$config_handler =& xoops_gethandler('config');
	$moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

	function displayItemMenu ($itemtype, $entry, $menu_id, $path, $relative, $file_relative, $dir_del_alert) {
	global $groups, $gperm_handler, $module_id, $moduleConfig;
	
	if (function_exists('copy') || $moduleConfig['tinyedmgrftp'] == 1)	
		$copy_method = true;
	else
		$copy_method = false;

	if (function_exists('rename') || $moduleConfig['tinyedmgrftp'] == 1)	
		$rename_method = true;
	else
		$rename_method = false;
	
	switch ($itemtype) {
		case 'dir' :
			echo "<table cellspacing='0' cellpadding='0' id='menu".$menu_id."' class='ctxmenu'>
        			<tr>
            		<td>
            		<a class='item1' href='javascript:void(0)'>".$entry."</a>
            		<div class='section'>
					<table cellspacing='2' cellpadding='0'>
					<tr>
					<td style='width: 72px;'>
                	<a class='item2' href='files.php?dir=".rawurlencode($path)."' onclick=\"updateDir('".$path."', '"._TINYMGR_LOADING."');\"><img src='images/open_folder.png' class='sixteenicon' alt='"._TINYMGR_24."' title='"._TINYMGR_24."' /></a>";
					
					if ($gperm_handler->checkRight('TinyPerm', 12, $groups, $module_id) && $copy_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"copyFolder('".$path."', true);\"><img src='images/copy.png' class='sixteenicon' alt='"._TINYMGR_CPFOLD."' title='"._TINYMGR_CPFOLD."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 13, $groups, $module_id) && $copy_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"copyFolder('".$path."', false);\"><img src='images/move.png' class='sixteenicon' alt='"._TINYMGR_MVFOLD."' title='"._TINYMGR_MVFOLD."' /></a>";
					}

					if ($gperm_handler->checkRight('TinyPerm', 11, $groups, $module_id) && $rename_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"renameFolder('".$path."');\"><img src='images/rename.png' class='sixteenicon' alt='"._TINYMGR_RNMFOLD."' title='"._TINYMGR_RNMFOLD."' /></a>";
					}

					if ($gperm_handler->checkRight('TinyPerm', 5, $groups, $module_id)) {
					echo "<a class='item2' href='files.php?dir=".$relative."&amp;deld=".rawurlencode($path)."' onclick=\"return confirmDeleteDir('".$dir_del_alert."', '"._TINYMGR_15."', '"._TINYMGR_16."');\"><img src='images/delete_folder.png' class='sixteenicon' alt='"._TINYMGR_14."' title='"._TINYMGR_14."' /></a>";
					}
					echo "</td>
					</tr>
					</table>
            		</div>
        			</td>
        			</tr>
        			</table>
					<script type='text/javascript'>
    					var menu".$menu_id." = new CtxMenu1(\"menu".$menu_id."\");
    					menu".$menu_id.".type = \"horizontal\";
						if (document.all) {
   							menu".$menu_id.".position.left = 20;
						} else {
							menu".$menu_id.".position.left = 20;
						}
						menu".$menu_id.".position.top = 0;
						menu".$menu_id.".delay.show = 1000;
						menu".$menu_id.".delay.hide = 0;
    					menu".$menu_id.".init();
    				</script>";

		break;

		case 'image' :
    		echo "<table cellspacing='0' cellpadding='0' id='menu".$menu_id."' class='ctxmenu'>
        			<tr>
            		<td>
            		<a class='item1' href='javascript:void(0)'>".$entry."</a>
            		<div class='section'>
					<table cellspacing='2' cellpadding='0'>
					<tr>
                	<td style='width: 72px;'>
					<a class='item2' href='javascript:;' onclick=\"insertFile('".$path."');\"><img src='images/insert.png' class='sixteenicon' alt='"._TINYMGR_20."' title='"._TINYMGR_20."' /></a>
					<a class='item2' href='javascript:;' onclick=\"imagePopup('".$path."','".$entry."');\"><img src='images/view_image.png' width='16' height='16' alt='"._TINYMGR_17."' title='"._TINYMGR_17."' /></a>";
					
					if ($gperm_handler->checkRight('TinyPerm', 14, $groups, $module_id) && $copy_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"copyFile('".$path."', true);\"><img src='images/copy.png' class='sixteenicon' alt='"._TINYMGR_21."' title='"._TINYMGR_21."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 15, $groups, $module_id) && $copy_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"copyFile('".$path."', false);\"><img src='images/move.png' class='sixteenicon' alt='"._TINYMGR_22."' title='"._TINYMGR_22."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 9, $groups, $module_id) && $rename_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"renameFile('".$path."');\"><img src='images/rename.png' class='sixteenicon' alt='"._TINYMGR_23."' title='"._TINYMGR_23."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 16, $groups, $module_id)) {
					echo "<a class='item2' href='javascript:;' onclick=\"editImage('".rawurlencode($file_relative)."');\"><img src='images/edit_image.png' class='sixteenicon' alt='"._TINYMGR_13."' title='"._TINYMGR_13."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 2, $groups, $module_id)) {
					echo "<a class='item2' href='files.php?dir=".$relative."&amp;delf=".rawurlencode($file_relative)."' onclick=\"return confirmDeleteFile('".$entry."');\"><img src='images/delete_file.png' class='sixteenicon' alt='"._TINYMGR_18."' title='"._TINYMGR_18."' /></a>";
					}
					
					echo "</td>
					</tr>
					</table>
            		</div>
        			</td>
        			</tr>
        			</table>
					<script type='text/javascript'>
    					var menu".$menu_id." = new CtxMenu1(\"menu".$menu_id."\");
    					menu".$menu_id.".type = \"vertical\";
						if (document.all) {
   							menu".$menu_id.".position.left = 20;
						} else {
							menu".$menu_id.".position.left = -100;
						}
						menu".$menu_id.".position.top = 0;
						menu".$menu_id.".delay.show = 1000;
						menu".$menu_id.".delay.hide = 0;
    					menu".$menu_id.".init();
    				</script>";
		break;

		case 'other' :
    		echo "<table cellspacing='0' cellpadding='0' id='menu".$menu_id."' class='ctxmenu'>
        			<tr>
            		<td>
            		<a class='item1' href='javascript:void(0)'>".$entry."</a>
            		<div class='section'>
					<table cellspacing='2' cellpadding='0'>
					<tr>
					<td style='width: 72px;'>
                	<a class='item2' href='javascript:;' onclick=\"insertFile('".$path."');\"><img src='images/insert.png' class='sixteenicon' alt='"._TINYMGR_19."' title='"._TINYMGR_19."' /></a>";

					if ($gperm_handler->checkRight('TinyPerm', 14, $groups, $module_id) && $copy_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"copyFile('".$path."', true);\"><img src='images/copy.png' class='sixteenicon' alt='"._TINYMGR_CPFILE."' title='"._TINYMGR_CPFILE."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 15, $groups, $module_id) && $copy_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"copyFile('".$path."', false);\"><img src='images/move.png' class='sixteenicon' alt='"._TINYMGR_MVFILE."' title='"._TINYMGR_MVFILE."' /></a>";
					}
					
					if ($gperm_handler->checkRight('TinyPerm', 9, $groups, $module_id) && $rename_method == true) {
					echo "<a class='item2' href='javascript:;' onclick=\"renameFile('".$path."');\"><img src='images/rename.png' class='sixteenicon' alt='"._TINYMGR_RNMFILE."' title='"._TINYMGR_RNMFILE."' /></a>";
					echo "<a class='item2' href='files.php?dir=".$relative."&amp;delf=".rawurlencode($file_relative).">' onclick=\"return confirmDeleteFile('".$entry."');\"><img src='images/delete_file.png' class='sixteenicon' alt='"._TINYMGR_12."' title='"._TINYMGR_12."' /></a>";
					}
					
					echo "</td>
					</tr>
					</table>
            		</div>
        			</td>
        			</tr>
        			</table>
					<script type='text/javascript'>
    					var menu".$menu_id." = new CtxMenu1(\"menu".$menu_id."\");
    					menu".$menu_id.".type = \"vertical\";
						if (document.all) {
   							menu".$menu_id.".position.left = 20;
						} else {
							menu".$menu_id.".position.left = -100;
						}
						menu".$menu_id.".position.top = 0;
						menu".$menu_id.".delay.show = 1000;
						menu".$menu_id.".delay.hide = 0;
    					menu".$menu_id.".init();
    				</script>";
		break;
		
		default :
		break;
	}
}
?>