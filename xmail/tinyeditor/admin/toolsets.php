<?php

	include 'admin_header.php';
	include XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
	xoops_cp_header();
	adminMenu(4, _AM_TINYED_TOOLSETS);

	// preload some icons for faster loading (I hope so)
	echo "<br style='clear:left;' /><div>";

	$groupform = new XoopsThemeForm(_AM_TINYED_GROUPLIST, "grouplist", "toolsets.php");
	$group_tray = new XoopsFormElementTray( _AM_TINYED_GROUPLIST, '' );
	$group_tray->addElement( new XoopsFormSelectGroup('', 'grouplist', true, '', 1, false) );
	$group_tray->addElement(new XoopsFormButton('', 'grouplistsubmit', _GO, 'submit'));
	$groupform->addElement($group_tray);
	$groupform->display();

	echo "</div>";

if (!empty($_POST['grouplist'])) {

	include_once XOOPS_ROOT_PATH.'/modules/tinyeditor/include/commandsets.php';
	echo "<br />";
	$sql = "SELECT * FROM ".$xoopsDB->prefix('tinyeditor_toolset')." WHERE tinyed_gid = ".intval($_POST['grouplist'])." ";
	$result = $xoopsDB->query($sql);
	list($tinyed_id, $tinyed_gid, $tinyed_row1, $tinyed_row2, $tinyed_row3, $imgwidth, $imgheight, $diskquota, $activeplugs, $validelements, $extvalidelements, $invalidelements) = $xoopsDB->fetchRow($result);

	if ($tinyed_gid == '') {
		echo _AM_TINYED_NOTOOLSETYET;
		$tinyed_row1 = '<img id="fontselect" src="images/fontselect.gif" align="middle" style="padding-bottom:3px" /> <img id="fontsizeselect" src="images/fontsizeselect.gif" align="middle" style="padding-bottom:3px" /> <img id="formatselect" src="images/formatselect.gif" align="middle" style="padding-bottom:3px" /> <img id="styleselect" src="images/styleselect.gif" align="middle" style="padding-bottom:3px" />';
		$tinyed_row2 = '<img id="bold" src="images/bold.gif" align="middle" style="padding-bottom:3px" /> <img id="italic" src="images/italic.gif" align="middle" style="padding-bottom:3px" /> <img id="underline" src="images/underline.gif" align="middle" style="padding-bottom:3px" /> <img id="strikethrough" src="images/strikethrough.gif" align="middle" style="padding-bottom:3px" /> <img id="separator" src="images/separator.gif" align="middle" style="padding-bottom:3px" /> <img id="justifyleft" src="images/justifyleft.gif" align="middle" style="padding-bottom:3px" /> <img id="justifycenter" src="images/justifycenter.gif" align="middle" style="padding-bottom:3px" /> <img id="justifyright" src="images/justifyright.gif" align="middle" style="padding-bottom:3px" /> <img id="justifyfull" src="images/justifyfull.gif" align="middle" style="padding-bottom:3px" /> <img id="separator" src="images/separator.gif" align="middle" style="padding-bottom:3px" /> <img id="cut" src="images/cut.gif" align="middle" style="padding-bottom:3px" /> <img id="copy" src="images/copy.gif" align="middle" style="padding-bottom:3px" /> <img id="paste" src="images/paste.gif" align="middle" style="padding-bottom:3px" /> <img id="bullist" src="images/bullist.gif" align="middle" style="padding-bottom:3px" /> <img id="numlist" src="images/numlist.gif" align="middle" style="padding-bottom:3px" /> <img id="indent" src="images/indent.gif" align="middle" style="padding-bottom:3px" /> <img id="outdent" src="images/outdent.gif" align="middle" style="padding-bottom:3px" />';
		$tinyed_row3 = '<img id="undo" src="images/undo.gif" align="middle" style="padding-bottom:3px" /> <img id="redo" src="images/redo.gif" align="middle" style="padding-bottom:3px" /> <img id="separator" src="images/separator.gif" align="middle" style="padding-bottom:3px" /> <img id="sub" src="images/sub.gif" align="middle" style="padding-bottom:3px" /> <img id="sup" src="images/sup.gif" align="middle" style="padding-bottom:3px" /> <img id="forecolor" src="images/forecolor.gif" align="middle" style="padding-bottom:3px" /> <img id="backcolor" src="images/backcolor.gif" align="middle" style="padding-bottom:3px" /> <img id="removeformat" src="images/removeformat.gif" align="middle" style="padding-bottom:3px" /> <img id="separator" src="images/separator.gif" align="middle" style="padding-bottom:3px" /> <img id="link" src="images/link.gif" align="middle" style="padding-bottom:3px" /> <img id="unlink" src="images/unlink.gif" align="middle" style="padding-bottom:3px" /> <img id="anchor" src="images/anchor.gif" align="middle" style="padding-bottom:3px" /> <img id="image" src="images/image.gif" align="middle" style="padding-bottom:3px" /> <img id="cleanup" src="images/cleanup.gif" align="middle" style="padding-bottom:3px" /> <img id="hr" src="images/hr.gif" align="middle" style="padding-bottom:3px" /> <img id="charmap" src="images/charmap.gif" align="middle" style="padding-bottom:3px" /> <img id="separator" src="images/separator.gif" align="middle" style="padding-bottom:3px" /> <img id="visualaid" src="images/visualaid.gif" align="middle" style="padding-bottom:3px" /> <img id="code" src="images/code.gif" align="middle" style="padding-bottom:3px" />';
		$validelements = '';
		$extvalidelements = '';
		$invalidelements = '';
	} else {
		// the following three ifs are to avoid empty images in the editor
		if ($tinyed_row1 != '') {
			$tinyed_row1array = split(' ', $tinyed_row1);
			$tinyed_row1 = '';
			foreach ($tinyed_row1array as $value1) {
			$tinyed_row1 .= ' <img id="'.$value1.'" style="padding-bottom:3px" src="images/'.$value1.'.gif" align="middle" /> ';
			}
		}

		if ($tinyed_row2 != '') {
			$tinyed_row2array = split(' ', $tinyed_row2);
			$tinyed_row2 = '';
			foreach ($tinyed_row2array as $value2) {
			$tinyed_row2 .= ' <img id="'.$value2.'" style="padding-bottom:3px" src="images/'.$value2.'.gif" align="middle" /> ';
			}
		}

		if ($tinyed_row3 != '') {
			$tinyed_row3array = split(' ', $tinyed_row3);
			$tinyed_row3 = '';
			foreach ($tinyed_row3array as $value3) {
			$tinyed_row3 .= ' <img id="'.$value3.'" style="padding-bottom:3px" src="images/'.$value3.'.gif" align="middle" /> ';
			}
		}

		$tinyed_row1 = trim($tinyed_row1);
		$tinyed_row2 = trim($tinyed_row2);
		$tinyed_row3 = trim($tinyed_row3);
		}

	$availplugins = '';
	$plugins_string = '';
	$dirname = XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/';
	$dir = opendir($dirname);
		while ($filename = readdir($dir)) {
			if ($filename != "." && $filename != ".." && $filename != 'owntoolbar' && $filename != 'CVS' && $filename != 'index.html') {
				$availplugins .= ' tool'.$filename;
				if ($filename == 'table') {
					$plugins_string .= ' tool'.$filename;
				} else {
					$plugins_string .= ' '.$filename;
				}
			}
		}
	closedir($dir);
	
	$availplugins = str_replace(' ', ',', trim($availplugins));
	$availplugins = str_replace('tooltable', 'tooltablecontrols', $availplugins);
	$availplugins = str_replace('toolsearchreplace', 'toolsearch, toolreplace', $availplugins);
	$availplugins = str_replace('toolpaste', 'toolpasteword, toolpastetext, toolselectall', $availplugins);
	$availplugins = str_replace('toolxquotecode', 'toolxquote, toolxcode', $availplugins);
	$availplugins = str_replace('tooldirectionality', 'toolltr, toolrtl', $availplugins);
	$availplugins = str_replace('toolinsertdatetime', 'toolinsertdate, toolinserttime', $availplugins);
	$availplugins = str_replace('tooltemplates', 'toolhtmltemplate, toolsavehtmltemplate', $availplugins);
	$availplugins = str_replace('toolxhtmlxtras', 'toolabbr, toolacronym, toolcite, tooldel, toolins', $availplugins);

	$plugins_string = trim($plugins_string);
	$plugins_string = str_replace('tooltable', 'table', $plugins_string);
	$plugins_string = str_replace('searchreplace', 'search replace', $plugins_string);
	$plugins_string = str_replace('paste', 'pasteword pastetext selectall', $plugins_string);
	$plugins_string = str_replace('xquotecode', 'xquote xcode', $plugins_string);
	$plugins_string = str_replace('directionality', 'ltr rtl', $plugins_string);
	$plugins_string = str_replace('insertdatetime', 'insertdate inserttime', $plugins_string);
	$plugins_string = str_replace('templates', 'htmltemplate savehtmltemplate', $plugins_string);
	$plugins_string = str_replace('xhtmlxtras', 'abbr acronym cite del ins', $plugins_string);

	$toolform = new XoopsThemeForm('', "valuesform", "toolsets.php");
	$toolform->insertBreak(_AM_TINYED_CLICKHERE.'
	<script language="javascript" type="text/javascript" src="'.XOOPS_URL.'/modules/tinyeditor/editor/tiny_mce.js"></script><script language="javascript" type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	editor_selector : "mceEditor",
	theme : "advanced",
	language : "'.$xoopsModuleConfig["tinyedlang"].'",
	convert_urls : false,
	object_resizing : false,
	theme_advanced_toolbar_align : "left",
	plugins : "owntoolbar",
	theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "toolbold,toolitalic,toolunderline,toolstrikethrough,toolseparator,toolleft,toolcenter,toolright,toolfull,toolcut,toolcopy,toolpaste,toolbullist,toolnumlist,toolindent,tooloutdent,toolundo,toolredo,toolsub,toolsup,toolforecolor,toolbackcolor,toolremoveformat,toollink,toolunlink,toolanchor,toolimage,toolcleanup,toolhr,toolcharmap,toolcode,toolhelp,toolfontselect,toolfontsizeselect,toolformatselect,toolstyleselect,toolvisualaid,toolxrmanager",
	theme_advanced_buttons2 : "'.$availplugins.'",
	theme_advanced_buttons3 : "",
	valid_elements : "img,br",
	extended_valid_elements : "img[id|src|style|align]",
	width: "100%",
	height: "200px",
	cleanup: "true",
	debug : "false"
	});</script><style type="text/css">a.mceButtonDisabled img, a.mceButtonNormal img, a.mceButtonSelected img {
	width: auto;
	height: 20px;
	cursor: default;
	margin-top: 1px;
	margin-left: 1px;
	float: left;
} td.mceToolbarTop { padding-bottom: 10px; }</style>', 'head');

	$toolsrow1 = new XoopsFormTextArea(_AM_TINYED_ROW1, 'tinyedbuts1', $tinyed_row1, 5, 50);
	$toolsrow1->setExtra(' class="mceEditor" ');
	$toolform->addElement($toolsrow1);
	$toolform->insertBreak('<hr style="height: 2px; border: 2px #000000 solid; width: 100%;">', 'odd');

	$toolsrow2 = new XoopsFormTextArea(_AM_TINYED_ROW2, 'tinyedbuts2', $tinyed_row2, 5, 50);
	$toolsrow2->setExtra(' class="mceEditor" ');
	$toolform->addElement($toolsrow2);
	$toolform->insertBreak('<hr style="height: 2px; border: 2px #000000 solid; width: 100%;">', 'odd');

	$toolsrow3 = new XoopsFormTextArea(_AM_TINYED_ROW3, 'tinyedbuts3', $tinyed_row3, 5, 50);
	$toolsrow3->setExtra(' class="mceEditor" ');
	$toolform->addElement($toolsrow3);
	$toolform->insertBreak('<hr style="height: 2px; border: 2px #000000 solid; width: 100%;">', 'odd');
	$toolform->addElement(new XoopsFormText(_AM_TINYED_IMGWIDTH, 'imgwidth', 4, 5, $imgwidth));
	$toolform->addElement(new XoopsFormText(_AM_TINYED_IMGHEIGHT, 'imgheight', 4, 5, $imgheight));
	$toolform->addElement(new XoopsFormText(_AM_TINYED_DISKQUOTA." (Bytes)", 'diskquota', 15, 16, $diskquota));

	$toolform->addElement(new XoopsFormHidden('op', 'saveit'));
	$toolform->addElement(new XoopsFormHidden('plugins_string', $plugins_string));
	$toolform->addElement(new XoopsFormHidden('gid', $_POST['grouplist']));

	if ($tinyed_gid == '') {
		$toolform->addElement(new XoopsFormHidden('newid', ''));
	} else {
		$toolform->addElement(new XoopsFormHidden('newid', $tinyed_gid));
	}

echo "<script type=\"text/javascript\">
function insertCommandset() {
	
if (document.valuesform.comselect.selectedIndex == '1') {
	texta = '".$myts->htmlSpecialChars($com_valid1)."'; 
	textb = '".$myts->htmlSpecialChars($com_extvalid1)."';
	textc = '".$myts->htmlSpecialChars($com_invalid1)."';
	document.valuesform.validelements.value += texta; 
	document.valuesform.extvalidelements.value += textb;
	document.valuesform.invalidelements.value += textc;
}
if (document.valuesform.comselect.selectedIndex == '2') {
	texta = '".$myts->htmlSpecialChars($com_valid2)."'; 
	textb = '".$myts->htmlSpecialChars($com_extvalid2)."';
	textc = '".$myts->htmlSpecialChars($com_invalid2)."';
	document.valuesform.validelements.value += texta; 
	document.valuesform.extvalidelements.value += textb;
	document.valuesform.invalidelements.value += textc;
}
if (document.valuesform.comselect.selectedIndex == '3') {
	texta = '".$myts->htmlSpecialChars($com_valid3)."'; 
	textb = '".$myts->htmlSpecialChars($com_extvalid3)."';
	textc = '".$myts->htmlSpecialChars($com_invalid3)."';
	document.valuesform.validelements.value += texta; 
	document.valuesform.extvalidelements.value += textb;
	document.valuesform.invalidelements.value += textc;
}
}
</script>";

	$comselect = new XoopsFormSelect(_AM_TINYED_COMMANDSETS, 'comselect', '', 1, false);
	$comselect->addOption('', '-----');
	$comselect->addOptionArray($commandset);
	$comselect->setExtra( "onchange='insertCommandset()'" );
	$toolform->addElement($comselect);

	$toolformvalid = new XoopsFormTextArea(_AM_TINYED_VALIDELEMENTS, 'validelements', $myts->htmlSpecialChars($validelements), 5, 50);
	$toolformvalid->setExtra( "style='width: 100%; height: 200px; wrap='virtual''" );
	$toolform->addElement($toolformvalid);
	$toolformextvalid = new XoopsFormTextArea(_AM_TINYED_EXTVALIDELEMENTS, 'extvalidelements', $myts->htmlSpecialChars($extvalidelements), 5, 50);
	$toolformextvalid->setExtra( "style='width: 100%; height: 200px;' wrap='virtual'" );
	$toolform->addElement($toolformextvalid);
	$toolforminvalid = new XoopsFormTextArea(_AM_TINYED_INVALIDELEMENTS, 'invalidelements', $myts->htmlSpecialChars($invalidelements), 5, 50);
	$toolforminvalid->setExtra( "style='width: 100%; height: 200px; wrap='virtual''" );
	$toolform->addElement($toolforminvalid);
	$toolform->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
	$toolform->display();
}


if (!empty($_POST['op']) && ($_POST['op'] == 'saveit')) {

	$tinyedbuts1 = stripslashes($_POST['tinyedbuts1']);
	$tinyedbuts2 = stripslashes($_POST['tinyedbuts2']);
	$tinyedbuts3 = stripslashes($_POST['tinyedbuts3']);	

	$tinyedbuts1 = trim(str_replace('&nbsp;', '', $tinyedbuts1));
	$tinyedbuts1 = trim(preg_replace('/\s\s+/', '', $tinyedbuts1));
	$tinyedbuts2 = trim(str_replace('&nbsp;', '', $tinyedbuts2));
	$tinyedbuts2 = trim(preg_replace('/\s\s+/', '', $tinyedbuts2));
	$tinyedbuts3 = trim(str_replace('&nbsp;', '', $tinyedbuts3));
	$tinyedbuts3 = trim(preg_replace('/\s\s+/', '', $tinyedbuts3));

	// remove some elements except the value of id
	$tinyedbuts1 = preg_replace('/<(.*)id="|"(.*)>/msU', ' ', $tinyedbuts1);
	$tinyedbuts2 = preg_replace('/<(.*)id="|"(.*)>/msU', ' ', $tinyedbuts2);
	$tinyedbuts3 = preg_replace('/<(.*)id="|"(.*)>/msU', ' ', $tinyedbuts3);

	// remove leading, ending and double spaces
	$tinyedbuts1 = trim(preg_replace('/\s\s+/', ' ', $tinyedbuts1));
	$tinyedbuts2 = trim(preg_replace('/\s\s+/', ' ', $tinyedbuts2));
	$tinyedbuts3 = trim(preg_replace('/\s\s+/', ' ', $tinyedbuts3));

	//make an array of the buttons
	$tinyed_buts1array = split(' ', $tinyedbuts1);
	$tinyed_buts2array = split(' ', $tinyedbuts2);
	$tinyed_buts3array = split(' ', $tinyedbuts3);

	//merge the arrays into one
	$allbuttons_array = array_merge($tinyed_buts1array, $tinyed_buts2array, $tinyed_buts3array);

	$plugins_array = split(' ', $_POST['plugins_string']);

	$plugins_array = array_unique(array_intersect($allbuttons_array, $plugins_array));

	// check plugins with double functions
	if (in_array('inserttime', $allbuttons_array)) {
		$insertdatetime = ' insertdatetime';
	} elseif (in_array('insertdate', $allbuttons_array)) {
		$insertdatetime = ' insertdatetime';
	} else {
		$insertdatetime = '';
	}

	if (in_array('search', $allbuttons_array)) {
		$searchreplace = ' searchreplace';
	} elseif (in_array('replace', $allbuttons_array)) {
		$searchreplace = ' searchreplace';
	} else {
		$searchreplace = '';
	}

	if (in_array('htmltemplate', $allbuttons_array)) {
		$templates = ' templates';
	} elseif (in_array('savehtmltemplate', $allbuttons_array)) {
		$templates = ' templates';
	} else {
		$templates = '';
	}

	if (in_array('tablecontrols', $allbuttons_array)) {
		$table = ' table';
	} else {
		$table = '';
	}

	if (in_array('xcode', $allbuttons_array)) {
		$xquotecode = ' xquotecode';
	} elseif (in_array('xquote', $allbuttons_array)) {
		$xquotecode = ' xquotecode';
	} else {
		$xquotecode = '';
	}

	if (in_array('pasteword', $allbuttons_array)) {
		$paste = ' paste';
	} elseif (in_array('pastetext', $allbuttons_array)) {
		$paste = ' paste';
	} elseif (in_array('selectall', $allbuttons_array)) {
		$paste = ' paste';
	} else {
		$paste = '';
	}

	if (in_array('abbr', $allbuttons_array)) {
		$xhtmlxtras = ' xhtmlxtras';
	} elseif (in_array('acronym', $allbuttons_array)) {
		$xhtmlxtras = ' xhtmlxtras';
	} elseif (in_array('cite', $allbuttons_array)) {
		$xhtmlxtras = ' xhtmlxtras';
	} elseif (in_array('del', $allbuttons_array)) {
		$xhtmlxtras = ' xhtmlxtras';
	} elseif (in_array('ins', $allbuttons_array)) {
		$xhtmlxtras = ' xhtmlxtras';
	} else {
		$xhtmlxtras = '';
	}

	if (in_array('rtl', $allbuttons_array)) {
		$direction = ' directionality';
	} elseif (in_array('ltr', $allbuttons_array)) {
		$direction = ' directionality';
	} else {
		$direction = '';
	}

	if (!empty($_POST['newid'])) {
		$actplugs2 = implode(' ', $plugins_array);
		$actplugs2 = $actplugs2.$insertdatetime.$searchreplace.$table.$xquotecode.$paste.$direction.$templates.$xhtmlxtras;
	} else {
		$actplugs2 = '';
	}

	if (!empty($_POST['newid'])) {
	$sql = "UPDATE ".$xoopsDB->prefix('tinyeditor_toolset')." SET tinyed_row1 = ".$xoopsDB->quoteString($tinyedbuts1).", tinyed_row2 = ".$xoopsDB->quoteString($tinyedbuts2).", tinyed_row3 = ".$xoopsDB->quoteString($tinyedbuts3).", imgwidth = ".intval($_POST['imgwidth']).", imgheight = ".intval($_POST['imgheight']).", diskquota = ".intval($_POST['diskquota']).", activeplugs = ".$xoopsDB->quoteString($actplugs2).", validelements = ".$xoopsDB->quoteString($_POST['validelements']).", extvalidelements = ".$xoopsDB->quoteString($_POST['extvalidelements']).", invalidelements = ".$xoopsDB->quoteString($_POST['invalidelements'])." WHERE tinyed_gid=".intval($_POST['gid'])." ";
	} else {
		$sql = "INSERT INTO ".$xoopsDB->prefix('tinyeditor_toolset')." (tinyed_id, tinyed_gid, tinyed_row1, tinyed_row2, tinyed_row3, imgwidth, imgheight, diskquota, activeplugs, validelements, extvalidelements, invalidelements) VALUES ('', ".intval($_POST['gid']).", ".$xoopsDB->quoteString($tinyedbuts1).", ".$xoopsDB->quoteString($tinyedbuts2).", ".$xoopsDB->quoteString($tinyedbuts3).", ".intval($_POST['imgwidth']).", ".intval($_POST['imgheight']).", ".intval($_POST['diskquota']).", ".$xoopsDB->quoteString($actplugs2).", ".$xoopsDB->quoteString($_POST['validelements']).", ".$xoopsDB->quoteString($_POST['extvalidelements']).", ".$xoopsDB->quoteString($_POST['invalidelements']).")";
	}
	$result = $xoopsDB->query($sql);
	redirect_header('toolsets.php', 2, _AM_TINYED_DBUPDATED);
}

	xoops_cp_footer();
?>