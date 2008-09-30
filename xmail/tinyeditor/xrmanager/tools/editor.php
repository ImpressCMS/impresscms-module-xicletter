<?php
/**
 * The PHP Image Editor user interface.
 * @author $Author: frankblacksf $
 * @version $Id: editor.php,v 1.2 2006/04/20 16:17:32 frankblacksf Exp $
 * @package ImageManager
*  Xoops module by ralf57
 */

	include "../xrincludes.php";

	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {

		require_once TINY_ROOT_PATH.'include/config.inc.php';
		require_once TINY_ROOT_PATH.'class/XRManager.php';
		require_once TINY_ROOT_PATH.'class/ImageEditor.php';

		$manager = new ResourceManager($IMConfig);
		$editor = new ImageEditor($manager);

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo "<html>";
		echo "<head>";
		echo "<title>"._TINYMGR_EDITOR."</title>";
		echo "<link href=\"".TINY_ROOT_URL."xrmanager/css/editor.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<script type=\"text/javascript\" src=\"".TINY_ROOT_URL."xrmanager/js/slider.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"".TINY_ROOT_URL."xrmanager/js/popup.js\"></script>";
		echo "<script type=\"text/javascript\">\n";
		echo "/*<![CDATA[*/\n";
		echo "window.resizeTo(673, 531);\n";

		echo "if(window.opener)\n";
			echo "I18N = window.opener.I18N;\n";
		echo "/*]]>*/\n";
		echo "</script>";
		echo "<script type='text/javascript' src='".TINY_ROOT_URL."xrmanager/js/editor.js'></script>";
		echo "</head>";
		echo "<body>";
		echo "<div id='indicator'>";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/spacer.gif' id='indicator_image' height='20' width='20' alt='' />";
		echo "</div>";
		echo "<div id='tools'>";
		echo "<div id='tools_crop' style='display:none;'>";
		echo "<div id='tool_inputs'>";
		echo "<label for='cx'>"._TINYMGR_EDITORSTX."</label><input type='text' id='cx' class='textInput' onchange=\"updateMarker('crop')\" />";
		echo "<label for='cy'>"._TINYMGR_EDITORSTY."</label><input type='text' id='cy' class='textInput' onchange=\"updateMarker('crop')\" />";
		echo "<label for='cw'>"._TINYMGR_EDITORWIDTH."</label><input type='text' id='cw' class='textInput' onchange=\"updateMarker('crop')\" />";
		echo "<label for='ch'>"._TINYMGR_EDITORHEIGHT."</label><input type='text' id='ch' class='textInput' onchange=\"updateMarker('crop')\" />";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt='|' />";
		echo "</div>";
		echo "<a href=\"javascript: editor.doSubmit('crop');\" class='buttons' title='"._TINYMGR_EDITOROK."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/btn_ok.gif' height='30' width='30' alt='"._TINYMGR_EDITOROK."' /></a>";
		echo "<a href='javascript: editor.reset();' class='buttons' title='"._TINYMGR_EDITORCANC."'><img src='../images/editor/btn_cancel.gif' height='30' width='30' alt='"._TINYMGR_EDITORCANC."' /></a>";
		echo "</div>";
		echo "<div id='tools_scale' style='display:none;'>";
		echo "<div id='tool_inputs'>";
		echo "<label for='sw'>"._TINYMGR_EDITORWIDTH."</label><input type='text' id='sw' class='textInput' onchange=\"checkConstrains('width')\" />";
		echo "<a href='javascript:toggleConstraints();' title='Lock'><img src='".TINY_ROOT_URL."xrmanager/images/editor/islocked2.gif' id='scaleConstImg' height='14' width='8' alt='"._TINYMGR_EDITORLOCK."' class='div' /></a><label for='sh'>"._TINYMGR_EDITORHEIGHT."</label>";
		echo "<input type='text' id='sh' class='textInput' onchange=\"checkConstrains('height')\" />";
		echo "<input type='checkbox' id='constProp' value='1' checked='checked' onclick='toggleConstraints();' />";
		echo "<label for='constProp'>"._TINYMGR_EDITORCONSPROPS."</label>";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt='|' />";
		echo "</div>";
		echo "<a href=\"javascript: editor.doSubmit('scale');\" class='buttons' title='"._TINYMGR_EDITOROK."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/btn_ok.gif' height='30' width='30' alt='<?php echo _TINYMGR_EDITOROK; ?>' /></a>";
		echo "<a href='javascript: editor.reset();' class='buttons' title='"._TINYMGR_EDITORCANC."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/btn_cancel.gif' height='30' width='30' alt='"._TINYMGR_EDITORCANC."' /></a>";
		echo "</div>";
		echo "<div id='tools_rotate' style='display:none;'>";
		echo "<div id='tool_inputs'>";
		echo "<select id='flip' name='flip' style='margin-left: 10px; vertical-align: middle;'>";
		echo "<option selected='selected'>"._TINYMGR_EDITORFLIP."</option>";
		echo "<option>-----------------</option>";
		echo "<option value='hoz'>"._TINYMGR_EDITORFLIPH."</option>";
		echo "<option value='ver'>"._TINYMGR_EDITORFLIPV."</option>";
		echo "</select>";
		echo "<select name='rotate' onchange='rotatePreset(this)' style='margin-left: 20px; vertical-align: middle;'>";
		echo "<option selected='selected'>"._TINYMGR_ROTATE."</option>";
		echo "<option>-----------------</option>";
		echo "<option value='180'>"._TINYMGR_ROTATEA."</option>";
		echo "<option value='90'>"._TINYMGR_ROTATEB."</option>";
		echo "<option value='-90'>"._TINYMGR_ROTATEC."</option>";
		echo "</select>";
		echo "<label for='ra'>"._TINYMGR_ANGLE."</label><input type='text' id='ra' class='textInput' />";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt='|' />";
		echo "</div>";
		echo "<a href=\"javascript: editor.doSubmit('rotate');\" class='buttons' title='"._TINYMGR_EDITOROK."'><img src='../images/editor/btn_ok.gif' height='30' width='30' alt='"._TINYMGR_EDITOROK."' /></a>";
		echo "<a href='javascript: editor.reset();' class='buttons' title='"._TINYMGR_EDITORCANC."'><img src='../images/editor/btn_cancel.gif' height='30' width='30' alt='"._TINYMGR_EDITORCANC."' /></a>";
		echo "</div>";
		echo "<div id='tools_measure' style='display:none;'>";
		echo "<div id='tool_inputs'>";
		echo "<label>"._TINYMGR_EDITORX."</label><input type='text' class='measureStats' id='sx' />";
		echo "<label>"._TINYMGR_EDITORY."</label><input type='text' class='measureStats' id='sy' />";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt='|' />";
		echo "<label>"._TINYMGR_EDITORW."</label><input type='text' class='measureStats' id='mw' />";
		echo "<label>"._TINYMGR_EDITORH."</label><input type='text' class='measureStats' id='mh' />";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt='|' />";
		echo "<label>"._TINYMGR_EDITORA."</label><input type='text' class='measureStats' id='ma' />";
		echo "<label>"._TINYMGR_EDITORD."</label><input type='text' class='measureStats' id='md' />";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt='|' />";
		echo "<button type='button' onclick='editor.reset();'>"._TINYMGR_CLEAR."</button>";
		echo "</div>";
		echo "</div>";
		echo "<div id='tools_save' style='display:none;'>";
		echo "<div id='tool_inputs'>";
		echo "<label for='save_filename'>"._TINYMGR_FILENAME."</label><input type='text' id='save_filename' value='".$editor->getDefaultSaveFile()."' />";
		echo "<select name='format' id='save_format' style='margin-left: 10px; vertical-align: middle;' onchange='updateFormat(this)'>";
		echo "<option value='' selected='selected'>"._TINYMGR_IMGFORMAT."</option>";
		echo "<option value=''>---------------------</option>";
		echo "<option value='jpeg,85'>"._TINYMGR_JPEGHIGH."</option>";
		echo "<option value='jpeg,60'>"._TINYMGR_JPEGMED."</option>";
		echo "<option value='jpeg,35'>"._TINYMGR_JPEGLOW."</option>";
		echo "<option value='png'>"._TINYMGR_PNG."</option>";

		if ($editor->isGDGIFAble() != -1) {
			echo "<option value='gif'>"._TINYMGR_GIF."</option>";
		}

		echo "</select>";
		echo "<label>"._TINYMGR_QUALITY."</label>";
		echo "<table style='display: inline; vertical-align: middle;' cellpadding='0' cellspacing='0'>";
		echo "<tr>";
		echo "<td>";
		echo "<div id='slidercasing'>";
		echo "<div id='slidertrack' style='width:100px'><img src='".TINY_ROOT_URL."xrmanager/images/editor/spacer.gif' width='1' height='1' border='0' alt='"._TINYMGR_TRACK."' /></div>";
		echo "<div id='sliderbar' style='left:85px' onmousedown='captureStart();'><img src='".TINY_ROOT_URL."xrmanager/images/editor/spacer.gif' width='1' height='1' border='0' alt='"._TINYMGR_TRACK."' /></div>";
		echo "</div>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "<input type='text' id='quality' onchange=\"updateSlider(this.value)\" style='width: 2em;' value='85' />";
		echo "<img src='".TINY_ROOT_URL."xrmanager/images/editor/div.gif' height='30' width='2' class='div' alt="|" />";
		echo "</div>";
		echo "<a href=\"javascript: editor.doSubmit('save');\" class='buttons' title='"._TINYMGR_EDITOROK."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/btn_ok.gif' height='30' width='30' alt='"._TINYMGR_EDITOROK."' /></a>";
		echo "<a href='javascript: editor.reset();' class='buttons' title='"._TINYMGR_EDITORCANC."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/btn_cancel.gif' height='30' width='30' alt='"._TINYMGR_EDITORCANC."' /></a>";
		echo "</div>";
		echo "</div>";
		echo "<div id='toolbar'>";
		echo "<a href=\"javascript:toggle('crop')\" id='icon_crop' title='"._TINYMGR_CROP."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/crop.gif' height='20' width='20' alt='"._TINYMGR_CROP."' /><span>"._TINYMGR_CROP."</span></a>";
		echo "<a href=\"javascript:toggle('scale')\" id='icon_scale' title='"._TINYMGR_RES."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/scale.gif' height='20' width='20' alt='"._TINYMGR_RES."' /><span>"._TINYMGR_RES."</span></a>";
		echo "<a href=\"javascript:toggle('rotate')\" id='icon_rotate' title='"._TINYMGR_ROTATE."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/rotate.gif' height='20' width='20' alt='"._TINYMGR_ROTATE."' /><span>"._TINYMGR_ROTATE."</span></a>";
		echo "<a href=\"javascript:toggle('measure')\" id='icon_measure' title='"._TINYMGR_MEASURE."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/measure.gif' height='20' width='20' alt='"._TINYMGR_MEASURE."' /><span>"._TINYMGR_MEASURE."</span></a>";
		echo "<a href='javascript: toggleMarker();' title='"._TINYMGR_MARKER."'><img id='markerImg' src='".TINY_ROOT_URL."xrmanager/images/editor/t_black.gif' height='20' width='20' alt='"._TINYMGR_MARKER."' /><span>"._TINYMGR_MARKER."</span></a>";
		echo "<a href=\"javascript:toggle('save')\" id='icon_save' title='"._TINYMGR_SAVE."'><img src='".TINY_ROOT_URL."xrmanager/images/editor/save.gif' height='20' width='20' alt='"._TINYMGR_SAVE."' /><span>"._TINYMGR_SAVE."</span></a>";
		echo "</div>";
		echo "<div id='contents'>";
		echo "<iframe src='".TINY_ROOT_URL."xrmanager/tools/editorFrame.php?img=";
		
		if (isset($_GET['img']))
			echo rawurlencode($_GET['img']);
		else 
			echo "";

		echo "' name='editor' id='editor' scrolling='auto' title='"._TINYMGR_EDITOR."' frameborder='0'></iframe>";
		echo "</div>";
		echo "<div id='bottom'></div>";
		echo "</body>";
		echo "</html>";
	} else {
		die(_NOPERM);
	}

?>