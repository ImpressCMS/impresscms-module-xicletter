<?php
header("content-type: application/x-javascript");
include "../../../../../mainfile.php";
	if (!defined('XOOPS_ROOT_PATH'))
		exit();
error_reporting(0);
$GLOBALS["xoopsLogger"]->activated = false;
$shorturltheme = XOOPS_URL.'/modules/tinyeditor/editor/themes/advanced/images/';
$shorturlplug = XOOPS_URL.'/modules/tinyeditor/editor/plugins/';
$shortrootplug = XOOPS_ROOT_PATH.'/modules/tinyeditor/editor/plugins/';

echo "tinyMCE.importPluginLanguagePack('owntoolbar');\n";

echo "var TinyMCE_OwnToolbar = {
	getInfo : function() {
		return {
			longname : 'Own toolbar',
			author : 'frankblack',
			authorurl : '',
			infourl : '',
			version : tinyMCE.majorVersion + '.' + tinyMCE.minorVersion
		};
	},";

echo "getControlHTML : function(cn) {";
		echo "switch (cn) {";
			echo 'case "toolbold":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_bold_desc', '".$shorturltheme."bold.gif', 'mceToolBold');";

			echo 'case "toolitalic":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_italic_desc', '".$shorturltheme."italic.gif', 'mceToolItalic');";

			echo 'case "toolunderline":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_underline_desc', '".$shorturltheme."underline.gif', 'mceToolUnderline');";

			echo 'case "toolstrikethrough":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_strikethrough_desc', '".$shorturltheme."strikethrough.gif', 'mceToolStrikethrough');";

			echo 'case "toolseparator":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_separator_desc', '".$shorturltheme."separator.gif', 'mceToolSeparator');";

			echo 'case "toolleft":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_left_desc', '".$shorturltheme."justifyleft.gif', 'mceToolLeft');";

			echo 'case "toolcenter":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_center_desc', '".$shorturltheme."justifycenter.gif', 'mceToolCenter');";

			echo 'case "toolright":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_right_desc', '".$shorturltheme."justifyright.gif', 'mceToolRight');";

			echo 'case "toolfull":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_full_desc', '".$shorturltheme."justifyfull.gif', 'mceToolFull');";

			echo 'case "toolcut":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_cut_desc', '".$shorturltheme."cut.gif', 'mceToolCut');";

			echo 'case "toolcopy":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_copy_desc', '".$shorturltheme."copy.gif', 'mceToolCopy');";

			echo 'case "toolpaste":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_paste_desc', '".$shorturltheme."paste.gif', 'mceToolPaste');";

			echo 'case "toolbullist":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_bullist_desc', '".$shorturltheme."bullist.gif', 'mceToolBullist');";

			echo 'case "toolnumlist":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_numlist_desc', '".$shorturltheme."numlist.gif', 'mceToolNumlist');";

			echo 'case "toolindent":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_indent_desc', '".$shorturltheme."indent.gif', 'mceToolIndent');";

			echo 'case "tooloutdent":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_outdent_desc', '".$shorturltheme."outdent.gif', 'mceToolOutdent');";

			echo 'case "toolundo":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_undo_desc', '".$shorturltheme."undo.gif', 'mceToolUndo');";

			echo 'case "toolredo":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_redo_desc', '".$shorturltheme."redo.gif', 'mceToolRedo');";

			echo 'case "toolsub":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_sub_desc', '".$shorturltheme."sub.gif', 'mceToolSub');";

			echo 'case "toolsup":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_sup_desc', '".$shorturltheme."sup.gif', 'mceToolSup');";

			echo 'case "toolforecolor":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_forecolor_desc', '".$shorturltheme."forecolor.gif', 'mceToolForecolor');";

			echo 'case "toolbackcolor":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_backcolor_desc', '".$shorturltheme."backcolor.gif', 'mceToolBackcolor');";

			echo 'case "toolremoveformat":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_removeformat_desc', '".$shorturltheme."removeformat.gif', 'mceToolRemoveformat');";

			echo 'case "toollink":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_link_desc', '".$shorturltheme."link.gif', 'mceToolLink');";

			echo 'case "toolunlink":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_unlink_desc', '".$shorturltheme."unlink.gif', 'mceToolUnlink');";

			echo 'case "toolanchor":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_anchor_desc', '".$shorturltheme."anchor.gif', 'mceToolAnchor');";

			echo 'case "toolimage":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_image_desc', '".$shorturltheme."image.gif', 'mceToolImage');";

			echo 'case "toolcleanup":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_cleanup_desc', '".$shorturltheme."cleanup.gif', 'mceToolCleanup');";

			echo 'case "toolhr":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_hr_desc', '".$shorturltheme."hr.gif', 'mceToolHr');";

			echo 'case "toolcharmap":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_charmap_desc', '".$shorturltheme."charmap.gif', 'mceToolCharmap');";

			echo 'case "toolcode":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_code_desc', '".$shorturltheme."code.gif', 'mceToolCode');";

			echo 'case "toolhelp":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_help_desc', '".$shorturltheme."help.gif', 'mceToolHelp');";

			echo 'case "toolfontselect":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_fontselect_desc', '".$shorturltheme."fontselect.gif', 'mceToolFontselect');";

			echo 'case "toolfontsizeselect":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_fontsizeselect_desc', '".$shorturltheme."fontsizeselect.gif', 'mceToolFontsizeselect');";

			echo 'case "toolformatselect":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_formatselect_desc', '".$shorturltheme."formatselect.gif', 'mceToolFormatselect');";

			echo 'case "toolstyleselect":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_styleselect_desc', '".$shorturltheme."styleselect.gif', 'mceToolStyleselect');";

			echo 'case "toolvisualaid":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_visualaid_desc', '".$shorturltheme."visualaid.gif', 'mceToolVisualaid');";

			echo 'case "toolxrmanager":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_xrmanager_desc', '".$shorturltheme."xrmanager.gif', 'mceToolXrmanager');";
				
			// and now the interesting part - automatic retrieval of the plugins
			// achtung muss noch die ausnahmen programmieren - ausnahme sind auskommentiert

	$dir = opendir($shortrootplug);

		while ($filename = readdir($dir)) {
			if ($filename != "." && $filename != ".." && $filename != 'owntoolbar' && $filename != 'CVS' && $filename != 'index.html' && $filename != 'readme.txt') {
				if ($filename == 'insertdatetime') {
          echo "case 'toolinsertdate':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_insertdate_desc', '".$shorturlplug."insertdatetime/images/insertdate.gif', 'mceToolInsertdate');";
          echo "case 'toolinserttime':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_inserttime_desc', '".$shorturlplug."insertdatetime/images/inserttime.gif', 'mceToolInserttime');";
        } elseif ($filename == 'searchreplace') {
          echo "case 'toolsearch':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_search_desc', '".$shorturlplug."searchreplace/images/search.gif', 'mceToolSearch');";
          echo "case 'toolreplace':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_replace_desc', '".$shorturlplug."searchreplace/images/replace.gif', 'mceToolReplace');";
        } elseif ($filename == 'table') {
          echo "case 'tooltablecontrols':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_tablecontrols_desc', '".$shorturlplug."table/images/tablecontrols.gif', 'mceToolTablecontrols');";
        } elseif ($filename == 'xquotecode') {
          echo "case 'toolxquote':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_xquote_desc', '".$shorturlplug."xquotecode/images/xquote.gif', 'mceToolXquote');";
          echo "case 'toolxcode':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_xcode_desc', '".$shorturlplug."xquotecode/images/xcode.gif', 'mceToolXcode');";
        } elseif ($filename == 'paste') {
          echo "case 'toolpasteword':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_pasteword_desc', '".$shorturlplug."paste/images/pasteword.gif', 'mceToolPasteword');";
          echo "case 'toolpastetext':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_pastetext_desc', '".$shorturlplug."paste/images/pastetext.gif', 'mceToolPastetext');";
          echo "case 'toolselectall':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_selectall_desc', '".$shorturlplug."paste/images/selectall.gif', 'mceToolSelectall');";
        } elseif ($filename == 'directionality') {
          echo "case 'toolltr':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_ltr_desc', '".$shorturlplug."directionality/images/ltr.gif', 'mceToolLtr');";
          echo "case 'toolrtl':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_rtl_desc', '".$shorturlplug."directionality/images/rtl.gif', 'mceToolRtl');";
        } elseif ($filename == 'templates') {
          echo "case 'toolhtmltemplate':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_htmltemplate_desc', '".$shorturlplug."templates/images/htmltemplate.gif', 'mceToolHtmltemplate');";
          echo "case 'toolsavehtmltemplate':";
          echo "return tinyMCE.getButtonHTML(cn, 'lang_savehtmltemplate_desc', '".$shorturlplug."templates/images/savehtmltemplate.gif', 'mceToolSavehtmltemplate');";
        } elseif ($filename == 'xhtmlxtras') {
          echo 'case "toolabbr":';
  		    echo "return tinyMCE.getButtonHTML(cn, 'lang_abbr_desc', '".$shorturlplug."xhtmlxtras/images/abbr.gif', 'mceToolAbbr');";
          echo 'case "toolacronym":';
          echo "return tinyMCE.getButtonHTML(cn, 'lang_acronym_desc', '".$shorturlplug."xhtmlxtras/images/acronym.gif', 'mceToolAcronym');";
          echo 'case "tooldel":';
          echo "return tinyMCE.getButtonHTML(cn, 'lang_del_desc', '".$shorturlplug."xhtmlxtras/images/del.gif', 'mceToolDel');";
          echo 'case "toolins":';
          echo "return tinyMCE.getButtonHTML(cn, 'lang_ins_desc', '".$shorturlplug."xhtmlxtras/images/ins.gif', 'mceToolIns');";
          echo 'case "toolcite":';
          echo "return tinyMCE.getButtonHTML(cn, 'lang_cite_desc', '".$shorturlplug."xhtmlxtras/images/cite.gif', 'mceToolCite');";
        } else {
        echo 'case "tool'.$filename.'":';
				echo "return tinyMCE.getButtonHTML(cn, 'lang_".$filename."_desc', '".$shorturlplug.$filename."/images/".$filename.".gif', 'mceTool".ucfirst($filename)."');";
        }
			}
		}
closedir($dir);

		echo "}";

		echo 'return "";';
	echo "},";

	/**
	 * Executes the mceInsertDate command.
	 */
	echo "execCommand : function(editor_id, element, command, user_interface, value) {
		function addZeros(value, len) {
			value = '' + value;

			if (value.length < len) {
				for (var i=0; i<(len-value.length); i++)
					value = '0' + value;
			}

			return value;
		}";

		/* Returns the image */
		echo "function getBold() {
			format = \"  <img id='bold' src='".$shorturltheme."bold.gif' style='padding-bottom-bottom:3px;' align='middle' />  \";
			return format;
		}";

		echo "function getItalic() {
			format = \"  <img src='".$shorturltheme."italic.gif' style='padding-bottom:3px;' align='middle' id='italic'>  \";
			return format;
		}";

		echo "function getUnderline() {
			format = \"  <img src='".$shorturltheme."underline.gif' style='padding-bottom:3px;' align='middle' id='underline'>  \";
			return format;
		}";

		echo "function getStrikethrough() {
			format = \"  <img src='".$shorturltheme."strikethrough.gif' style='padding-bottom:3px;' align='middle' id='strikethrough'>  \";
			return format;
		}";

		echo "function getSeparator() {
			format = \"  <img src='".$shorturltheme."separator.gif' style='padding-bottom:3px;' align='middle' id='separator'>  \";
			return format;
		}";

		echo "function getLeft() {
			format = \"  <img src='".$shorturltheme."justifyleft.gif' style='padding-bottom:3px;' align='middle' id='justifyleft'>  \";
			return format;
		}";

		echo "function getCenter() {
			format = \"  <img src='".$shorturltheme."justifycenter.gif' style='padding-bottom:3px;' align='middle' id='justifycenter'>  \";
			return format;
		}";

		echo "function getRight() {
			format = \"  <img src='".$shorturltheme."justifyright.gif' style='padding-bottom:3px;' align='middle' id='justifyright'>  \";
			return format;
		}";

		echo "function getFull() {
			format = \"  <img src='".$shorturltheme."justifyfull.gif' style='padding-bottom:3px;' align='middle' id='justifyfull'>  \";
			return format;
		}";

		echo "function getCut() {
			format = \"  <img src='".$shorturltheme."cut.gif' style='padding-bottom:3px;' align='middle' id='cut'>  \";
			return format;
		}";

		echo "function getCopy() {
			format = \"  <img src='".$shorturltheme."copy.gif' style='padding-bottom:3px;' align='middle' id='copy'>  \";
			return format;
		}";

		echo "function getPaste() {
			format = \"  <img src='".$shorturltheme."paste.gif' style='padding-bottom:3px;' align='middle' id='paste'>  \";
			return format;
		}";

		echo "function getBullist() {
			format = \"  <img src='".$shorturltheme."bullist.gif' style='padding-bottom:3px;' align='middle' id='bullist'>  \";
			return format;
		}";

		echo "function getNumlist() {
			format = \"  <img src='".$shorturltheme."numlist.gif' style='padding-bottom:3px;' align='middle' id='numlist'>  \";
			return format;
		}";

		echo "function getIndent() {
			format = \"  <img src='".$shorturltheme."indent.gif' style='padding-bottom:3px;' align='middle' id='indent'>  \";
			return format;
		}";

		echo "function getOutdent() {
			format = \"  <img src='".$shorturltheme."outdent.gif' style='padding-bottom:3px;' align='middle' id='outdent'>  \";
			return format;
		}";

		echo "function getUndo() {
			format = \"  <img src='".$shorturltheme."undo.gif' style='padding-bottom:3px;' align='middle' id='undo'>  \";
			return format;
		}";

		echo "function getRedo() {
			format = \"  <img src='".$shorturltheme."redo.gif' style='padding-bottom:3px;' align='middle' id='redo'>  \";
			return format;
		}";

		echo "function getSub() {
			format = \"  <img src='".$shorturltheme."sub.gif' style='padding-bottom:3px;' align='middle' id='sub'>  \";
			return format;
		}";

		echo "function getSup() {
			format = \"  <img src='".$shorturltheme."sup.gif' style='padding-bottom:3px;' align='middle' id='sup'>  \";
			return format;
		}";

		echo "function getForecolor() {
			format = \"  <img src='".$shorturltheme."forecolor.gif' style='padding-bottom:3px;' align='middle' id='forecolor'>  \";
			return format;
		}";

		echo "function getBackcolor() {
			format = \"  <img src='".$shorturltheme."backcolor.gif' style='padding-bottom:3px;' align='middle' id='backcolor'>  \";
			return format;
		}";

		echo "function getRemoveformat() {
			format = \"  <img src='".$shorturltheme."removeformat.gif' style='padding-bottom:3px;' align='middle' id='removeformat'>  \";
			return format;
		}";

		echo "function getLink() {
			format = \"  <img src='".$shorturltheme."link.gif' style='padding-bottom:3px;' align='middle' id='link'>  \";
			return format;
		}";

		echo "function getUnlink() {
			format = \"  <img src='".$shorturltheme."unlink.gif' style='padding-bottom:3px;' align='middle' id='unlink'>  \";
			return format;
		}";

		echo "function getAnchor() {
			format = \"  <img src='".$shorturltheme."anchor.gif' style='padding-bottom:3px;' align='middle' id='anchor'>  \";
			return format;
		}";

		echo "function getImage() {
			format = \"  <img src='".$shorturltheme."image.gif' style='padding-bottom:3px;' align='middle' id='image'>  \";
			return format;
		}";

		echo "function getCleanup() {
			format = \"  <img src='".$shorturltheme."cleanup.gif' style='padding-bottom:3px;' align='middle' id='cleanup'>  \";
			return format;
		}";

		echo "function getHr() {
			format = \"  <img src='".$shorturltheme."hr.gif' style='padding-bottom:3px;' align='middle' id='hr'>  \";
			return format;
		}";

		echo "function getCharmap() {
			format = \"  <img src='".$shorturltheme."charmap.gif' style='padding-bottom:3px;' align='middle' id='charmap'>  \";
			return format;
		}";

		echo "function getCode() {
			format = \"  <img src='".$shorturltheme."code.gif' style='padding-bottom:3px;' align='middle' id='code'>  \";
			return format;
		}";

		echo "function getHelp() {
			format = \"  <img src='".$shorturltheme."help.gif' style='padding-bottom:3px;' align='middle' id='help'>  \";
			return format;
		}";

		echo "function getFontselect() {
			format = \"  <img src='".$shorturltheme."fontselect.gif' style='padding-bottom:3px;' align='middle' id='fontselect'>  \";
			return format;
		}";

		echo "function getFontsizeselect() {
			format = \"  <img src='".$shorturltheme."fontsizeselect.gif' style='padding-bottom:3px;' align='middle' id='fontsizeselect'>  \";
			return format;
		}";

		echo "function getFormatselect() {
			format = \"  <img src='".$shorturltheme."formatselect.gif' style='padding-bottom:3px;' align='middle' id='formatselect'>  \";
			return format;
		}";

		echo "function getStyleselect() {
			format = \"  <img src='".$shorturltheme."styleselect.gif' style='padding-bottom:3px;' align='middle' id='styleselect'>  \";
			return format;
		}";

		echo "function getVisualaid() {
			format = \"  <img src='".$shorturltheme."visualaid.gif' style='padding-bottom:3px;' align='middle' id='visualaid'>  \";
			return format;
		}";

		echo "function getXrmanager() {
			format = \"  <img src='".$shorturltheme."xrmanager.gif' style='padding-bottom:3px;' align='middle' id='xrmanager'>  \";
			return format;
		}";
$dir2 = opendir($shortrootplug);
		while ($filename2 = readdir($dir2)) {
			if ($filename2 != "." && $filename2 != ".." && $filename2 != 'owntoolbar' && $filename2 != 'CVS' && $filename2 != 'index.html' && $filename2 != 'readme.txt') {
				if ($filename2 == 'insertdatetime') {
          echo "function getInsertdate() {
			format = \"  <img src='".$shorturlplug."insertdatetime/images/insertdate.gif' style='padding-bottom:3px;' align='middle' id='insertdate'>  \";
			return format;
		}";
    echo "function getInserttime() {
			format = \"  <img src='".$shorturlplug."insertdatetime/images/inserttime.gif' style='padding-bottom:3px;' align='middle' id='inserttime'>  \";
			return format;
		}";
        } elseif ($filename2 == 'searchreplace') {
echo "function getSearch() {
			format = \"  <img src='".$shorturlplug."searchreplace/images/search.gif' style='padding-bottom:3px;' align='middle' id='search'>  \";
			return format;
		}";
echo "function getReplace() {
			format = \"  <img src='".$shorturlplug."searchreplace/images/replace.gif' style='padding-bottom:3px;' align='middle' id='replace'>  \";
			return format;
		}";
        } elseif ($filename2 == 'table') {
echo "function getTablecontrols() {
			format = \"  <img src='".$shorturlplug."table/images/tablecontrols.gif' style='padding-bottom:3px;' align='middle' id='tablecontrols'>  \";
			return format;
}";
        } elseif ($filename2 == 'xquotecode') {
echo "function getXquote() {
			format = \"  <img src='".$shorturlplug."xquotecode/images/xquote.gif' style='padding-bottom:3px;' align='middle' id='xquote'>  \";
			return format;
		}";
echo "function getXcode() {
			format = \"  <img src='".$shorturlplug."xquotecode/images/xcode.gif' style='padding-bottom:3px;' align='middle' id='xcode'>  \";
			return format;
		}";
        } elseif ($filename2 == 'paste') {
echo "function getPasteword() {
			format = \"  <img src='".$shorturlplug."paste/images/pasteword.gif' style='padding-bottom:3px;' align='middle' id='pasteword'>  \";
			return format;
		}";
echo "function getPastetext() {
			format = \"  <img src='".$shorturlplug."paste/images/pastetext.gif' style='padding-bottom:3px;' align='middle' id='pastetext'>  \";
			return format;
		}";
echo "function getSelectall() {
			format = \"  <img src='".$shorturlplug."/paste/images/selectall.gif' style='padding-bottom:3px;' align='middle' id='selectall'>  \";
			return format;
		}";
        } elseif ($filename2 == 'directionality') {
echo "function getLtr() {
			format = \"  <img src='".$shorturlplug."directionality/images/ltr.gif' style='padding-bottom:3px;' align='middle' id='ltr'>  \";
			return format;
		}";
echo "function getRtl() {
			format = \"  <img src='".$shorturlplug."directionality/images/rtl.gif' style='padding-bottom:3px;' align='middle' id='rtl'>  \";
			return format;
		}";
        } elseif ($filename2 == 'templates') {
echo "function getHtmltemplate() {
			format = \"  <img src='".$shorturlplug."templates/images/htmltemplate.gif' style='padding-bottom:3px;' align='middle' id='htmltemplate'>  \";
			return format;
		}";
echo "function getSavehtmltemplate() {
			format = \"  <img src='".$shorturlplug."templates/images/savehtmltemplate.gif' style='padding-bottom:3px;' align='middle' id='savehtmltemplate'>  \";
			return format;
		}";
        } elseif ($filename2 == 'xhtmlxtras') {
echo "function getIns() {
			format = \"  <img src='".$shorturlplug."xhtmlxtras/images/ins.gif' style='padding-bottom:3px;' align='middle' id='ins'>  \";
			return format;
		}";
echo "function getAbbr() {
			format = \"  <img src='".$shorturlplug."xhtmlxtras/images/abbr.gif' style='padding-bottom:3px;' align='middle' id='abbr'>  \";
			return format;
		}";
echo "function getAcronym() {
			format = \"  <img src='".$shorturlplug."xhtmlxtras/images/acronym.gif' style='padding-bottom:3px;' align='middle' id='acronym'>  \";
			return format;
		}";
echo "function getDel() {
			format = \"  <img src='".$shorturlplug."xhtmlxtras/images/del.gif' style='padding-bottom:3px;' align='middle' id='del'>  \";
			return format;
		}";
echo "function getCite() {
			format = \"  <img src='".$shorturlplug."xhtmlxtras/images/cite.gif' style='padding-bottom:3px;' align='middle' id='cite'>  \";
			return format;
		}";
        } else {
		      echo "function get".ucfirst($filename2)."() {
			      format = \"  <img src='".$shorturlplug.$filename2."/images/".$filename2.".gif' style='padding-bottom:3px;' align='middle' id='".$filename2."'>  \";
			      return format;
		      }";
        }
			}
		}
closedir($dir2);
		// Handle commands
		echo "switch (command) {";
			echo "case 'mceToolBold':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getBold());
				return true;";

			echo "case 'mceToolItalic':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getItalic());
				return true;";

			echo "case 'mceToolUnderline':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getUnderline());
				return true;";

			echo "case 'mceToolStrikethrough':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getStrikethrough());
				return true;";

			echo "case 'mceToolSeparator':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getSeparator());
				return true;";

			echo "case 'mceToolLeft':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getLeft());
				return true;";

			echo "case 'mceToolCenter':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCenter());
				return true;";

			echo "case 'mceToolRight':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getRight());
				return true;";

			echo "case 'mceToolFull':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getFull());
				return true;";

			echo "case 'mceToolCut':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCut());
				return true;";

			echo "case 'mceToolCopy':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCopy());
				return true;";

			echo "case 'mceToolPaste':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getPaste());
				return true;";

			echo "case 'mceToolBullist':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getBullist());
				return true;";

			echo "case 'mceToolNumlist':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getNumlist());
				return true;";

			echo "case 'mceToolIndent':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getIndent());
				return true;";

			echo "case 'mceToolOutdent':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getOutdent());
				return true;";

			echo "case 'mceToolUndo':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getUndo());
				return true;";

			echo "case 'mceToolRedo':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getRedo());
				return true;";

			echo "case 'mceToolSub':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getSub());
				return true;";

			echo "case 'mceToolSup':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getSup());
				return true;";

			echo "case 'mceToolForecolor':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getForecolor());
				return true;";

			echo "case 'mceToolBackcolor':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getBackcolor());
				return true;";

			echo "case 'mceToolRemoveformat':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getRemoveformat());
				return true;";

			echo "case 'mceToolLink':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getLink());
				return true;";

			echo "case 'mceToolUnlink':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getUnlink());
				return true;";

			echo "case 'mceToolAnchor':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getAnchor());
				return true;";

			echo "case 'mceToolImage':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getImage());
				return true;";

			echo "case 'mceToolCleanup':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCleanup());
				return true;";

			echo "case 'mceToolHr':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getHr());
				return true;";

			echo "case 'mceToolCharmap':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCharmap());
				return true;";

			echo "case 'mceToolCode':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCode());
				return true;";

			echo "case 'mceToolHelp':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getHelp());
				return true;";

			echo "case 'mceToolFontselect':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getFontselect());
				return true;";

			echo "case 'mceToolFontsizeselect':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getFontsizeselect());
				return true;";

			echo "case 'mceToolFormatselect':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getFormatselect());
				return true;";

			echo "case 'mceToolStyleselect':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getStyleselect());
				return true;";

			echo "case 'mceToolVisualaid':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getVisualaid());
				return true;";

			echo "case 'mceToolXrmanager':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getXrmanager());
				return true;";
$dir3 = opendir($shortrootplug);
		while ($filename3 = readdir($dir3)) {
			if ($filename3 != "." && $filename3 != ".." && $filename3 != 'owntoolbar' && $filename3 != 'CVS' && $filename3 != 'index.html' && $filename3 != 'readme.txt') {
				if ($filename3 == 'insertdatetime') {
echo "case 'mceToolInsertdate':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getInsertdate());
				return true;";
echo "case 'mceToolInserttime':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getInserttime());
				return true;";
        } elseif ($filename3 == 'searchreplace') {
echo "case 'mceToolSearch':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getSearch());
				return true;";
echo "case 'mceToolReplace':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getReplace());
				return true;";
        } elseif ($filename3 == 'table') {
echo "case 'mceToolTablecontrols':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getTablecontrols());
				return true;";
        } elseif ($filename3 == 'xquotecode') {
echo "case 'mceToolXquote':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getXquote());
				return true;";
echo "case 'mceToolXcode':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getXcode());
				return true;";
        } elseif ($filename3 == 'paste') {
echo "case 'mceToolPasteword':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getPasteword());
				return true;";
echo "case 'mceToolPastetext':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getPastetext());
				return true;";
echo "case 'mceToolSelectall':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getSelectall());
				return true;";
        } elseif ($filename3 == 'directionality') {
echo "case 'mceToolLtr':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getLtr());
				return true;";
echo "case 'mceToolRtl':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getRtl());
				return true;";
        } elseif ($filename3 == 'templates') {
echo "case 'mceToolHtmltemplate':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getHtmltemplate());
				return true;";
echo "case 'mceToolSavehtmltemplate':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getSavehtmltemplate());
				return true;";
        } elseif ($filename3 == 'xhtmlxtras') {
echo "case 'mceToolAbbr':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getAbbr());
				return true;";
echo "case 'mceToolAcronym':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getAcronym());
				return true;";
echo "case 'mceToolIns':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getIns());
				return true;";
echo "case 'mceToolDel':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getDel());
				return true;";
echo "case 'mceToolCite':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, getCite());
				return true;";
        } else {
		      echo "case 'mceTool".ucfirst($filename3)."':
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, get".ucfirst($filename3)."());
				return true;";
        }
			}
		}        
closedir($dir3);
		echo "}";

		// Pass to next handler in chain
		echo "return false;";
	echo "}";
echo "};";

echo "tinyMCE.addPlugin('owntoolbar', TinyMCE_OwnToolbar);";
?>