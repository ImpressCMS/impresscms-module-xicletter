<?php
	include '../xrincludes.php';

	if (!defined('XOOPS_ROOT_PATH'))
		die("XOOPS root path not defined");
 
	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo "<html>";
		echo "<head>";
		echo "<title>"._TINYMGR_10."</title>";
		echo "<link href='".TINY_ROOT_URL."xrmanager/css/manager.css' rel='stylesheet' type='text/css' />";
		echo "<script type=\"text/javascript\" src=\"".TINY_ROOT_URL."xrmanager/js/popup.js\"></script>";
		echo "<script type=\"text/javascript\">\n";
		echo "/*<![CDATA[*/\n";
		echo "window.resizeTo(300, 175);\n";

		echo "if(window.opener)\n";
			echo "I18N = window.opener.I18N;\n";

		echo "init = function () {\n";
			echo "__dlg_init();\n";
			echo "__dlg_translate(I18N);\n";
			echo "document.getElementById('f_foldername').focus();\n";
		echo "}\n";

		echo "function onCancel() {\n";
			echo "__dlg_close(null);\n";
			echo "return false;\n";
		echo "}\n";

		echo "function onOK() {\n";
			// pass data back to the calling window
			echo "var fields = ['f_foldername'];\n";
			echo "var param = new Object();\n";
			echo "for (var i in fields) {\n";
				echo "var id = fields[i];\n";
				echo "var el = document.getElementById(id);\n";
				echo "param[id] = el.value;\n";
			echo "}\n";
			echo "__dlg_close(param);\n";
			echo "return false;\n";
		echo "}\n";

		echo "function addEvent(obj, evType, fn) {\n";
			echo "if (obj.addEventListener) { obj.addEventListener(evType, fn, true); return true; }\n";
			echo "else if (obj.attachEvent) {  var r = obj.attachEvent('on'+evType, fn);  return r;  }\n";
			echo "else {  return false; }\n";
		echo "}\n";

		echo "addEvent(window, 'load', init);\n";

		echo "</script>";
		echo "</head>";
		echo "<body style='padding: 10px; background-color: #f0f0ee;'>";
		echo "<form action=''>";
		echo "<div class='title'>"._TINYMGR_10."</div>";
		echo "<div class='elements' style='padding-left: 5px;'>";
		echo "<fieldset><label class='pres' style='padding-right: 20px;' for='f_foldername'>"._TINYMGR_NAME."</label>";
		echo "<input type='text' id='f_foldername' /></fieldset>";
		echo "</div>";
		echo "<div style='padding-top: 10px;'>";
		echo "<div style='float:left; padding-right: 10px;'><input type='button' class='formButton' value='"._SUBMIT."' onclick='return onOK();' /></div>";
		echo "<div style='float:left;'><input type='button' class='formButton' value='"._CANCEL."' onclick='return onCancel();' /></div>";
		echo "</div>";
		echo "</form>";
		echo "</body>";
		echo "</html>";
	} else {
		die(_NOPERM);
	}

?>