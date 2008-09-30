<?php
/**
 * The frame that contains the image to be edited.
 * @author $Author: frankblacksf $
 * @version $Id: editorFrame.php,v 1.2 2006/04/20 16:17:32 frankblacksf Exp $
 * @package ImageManager
 * Xoops module by ralf57
 */

	include "../xrincludes.php";

	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {

		require_once TINY_ROOT_PATH.'include/config.inc.php';
		require_once TINY_ROOT_PATH.'class/XRManager.php';
		require_once TINY_ROOT_PATH.'class/ImageEditor.php';

		$manager = new ResourceManager($IMConfig);
		$editor = new ImageEditor($manager);
		$imageInfo = $editor->processImage();

		echo "<html>";
		echo "<head>";
		echo "<title>"._TINYMGR_EDITOR."</title>";
		echo "<link href='".TINY_ROOT_URL."xrmanager/css/editorFrame.css' rel='stylesheet' type='text/css' />";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/wz_jsgraphics.js'></script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/EditorContent.js'></script>";
		echo "<script type='text/javascript'>\n";
		echo "if(window.top)\n";
			echo "I18N = window.top.I18N;\n";

		echo "function i18n(str) {\n";
			echo "if(I18N)\n";
				echo "return (I18N[str] || str);\n";
			echo "else\n";
				echo "return str;\n";
		echo "};\n";

		echo "var mode = '".$editor->getAction()."'\n"; //crop, scale, measure

		echo "var currentImageFile = '";

		if (count($imageInfo)>0)
			echo rawurlencode($imageInfo['file']);
		
		echo "'\n";

		if ($editor->isFileSaved() == 1) {
			echo "alert(i18n('File saved.'));\n";
		} else if ($editor->isFileSaved() == -1) {
			echo "alert(i18n('File was not saved.'));\n";
		}

		echo "</script>\n";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/editorFrame.js'></script>";
		echo "</head>";
		echo "<body>";
		echo "<div id='status'></div>";
		echo "<div id='ant' class='selection' style='visibility: hidden;'><img src='".TINY_ROOT_URL."xrmanager/images/editor/spacer.gif' width='0' height='0' border='0' alt='' id='cropContent' /></div>";

		if ($editor->isGDEditable() == -1) { 
			echo '<div style="text-align:center; padding:10px;"><span class="error">'._TINYMGR_NOGIFSUPP.'</span></div>';
		}

		echo "<table height='100%' width='100%'>";
		echo "<tr>";
		echo "<td>";

		if (count($imageInfo) > 0 && is_file($imageInfo['fullpath'])) {
			echo "<span id='imgCanvas' class='crop'><img src='".$imageInfo['src']."' ".$imageInfo['dimensions']." alt='' id='theImage' name='theImage' /></span>";
		} else {
			echo "<span class='error'>"._TINYMGR_NOIMG."</span>";
		}

		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</body>";
		echo "</html>";
	} else {
		die(_NOPERM);
	}

?>