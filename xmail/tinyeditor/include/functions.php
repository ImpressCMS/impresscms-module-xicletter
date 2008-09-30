<?php

function getMimeArray($groupid) {
		
		global $xoopsDB, $xoopsUser;

		$sql = "SELECT tinymt_types FROM ".$xoopsDB->prefix('tinyeditor_mimetypes')." WHERE tinymt_gid = ".intval($groupid)."";
		$result = $xoopsDB->query($sql);
		list($mimetype_array) = $xoopsDB->fetchRow($result);
		$mimetype_array = split(' ', trim($mimetype_array));
		
		return $mimetype_array;
}

function adminMenu ($currentoption = 0, $breadcrumb = '')
{
	/* Nice button styles */
	?><style type="text/css">
	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid #b7ae88; border-left: 1px solid #b7ae88; border-right: 1px solid #b7ae88; margin: 0; }
	#buttonbar { float:left; width:100%; background: #e7e7e7 url("../images/bg.gif") repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid #b7ae88; border-right: 1px solid #b7ae88; margin-bottom: 12px; }
	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
	#buttonbar li { display:inline; margin:0; padding:0; }
	#buttonbar a { float:left; background:url("../images/left_both.gif") no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #b7ae88; text-decoration:none; }
	#buttonbar a span { float:left; display:block; background:url("../images/right_both.gif") no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
	/* Commented Backslash Hack hides rule from IE5-Mac \*/
	#buttonbar a span {float:none;}
	/* End IE5-Mac hack */
	#buttonbar a:hover span { color:#272727; }
	#buttonbar #current a { background-position:0 -150px; border-width:0; }
	#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#272727; }
	#buttonbar a:hover { background-position:0% -150px; }
	#buttonbar a:hover span { background-position:100% -150px; }
	.tdbuttonsmall, .tdbuttonsmall_off { vertical-align: top; border: 0px #cccccc solid; padding: 3px; }
	.tdbuttonsmall_off {filter: alpha(opacity=30); -moz-opacity: 0.3; opacity: 0.30; }
	.subtitle { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
	</style><?php
	global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
	$x22 = false;
	$xv = str_replace('XOOPS ','',XOOPS_VERSION);
	if (substr($xv,2,1)=='2') {
		$x22 = true;
	}
	$tblCol = array();
	if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN')
		$tblCol[0]=$tblCol[1]=$tblCol[2]=$tblCol[3]=$tblCol[4]=$tblCol[5]=$tblCol[6]=$tblCol[7]=$tblCol[8]='';
	else
		$tblCol[0]=$tblCol[1]=$tblCol[2]=$tblCol[3]=$tblCol[4]=$tblCol[5]=$tblCol[6]=$tblCol[7]='';
	
	$tblCol[$currentoption] = 'current';

	echo "<div id='buttontop'>";
	echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
	echo "<td style=\"width: 100%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>".$xoopsModule->name()._AM_TINYED_MODADMIN."</b></td>";
	echo "</tr></table>";
	echo "</div>";

	echo "<div id='buttonbar'>";
	echo "<ul>";
	echo "<li id='".$tblCol[0]."'><a href=\"index.php\"><span>"._AM_TINYED_INDEX."</span></a></li>";
	echo "<li id='".$tblCol[1]."'><a href=\"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule ->getVar('mid')."&amp;&confcat_id=1\"><span>"._AM_TINYED_EDITOROPTS."</span></a></li>";
	if($x22) {
	echo "<li id='".$tblCol[1]."'><a href=\"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule ->getVar('mid')."&amp;&confcat_id=2\"><span>"._AM_TINYED_MNGROPTS."</span></a></li>";
	}
	//echo "<li id='".$tblCol[2]."'><a href=\"#\"><span>"._AM_TINYED_HELP."</span></a></li>";
	echo "<li id='".$tblCol[3]."'><a href=\"permissions.php\"><span>"._AM_TINYED_PERMISSIONS."</span></a></li>";
	echo "<li id='".$tblCol[4]."'><a href=\"toolsets.php\"><span>"._AM_TINYED_TOOLSETS."</span></a></li>";
	echo "<li id='".$tblCol[5]."'><a href=\"mimetypes.php\"><span>"._AM_TINYED_MIMETYPES."</span></a></li>";
	echo "<li id='".$tblCol[6]."'><a href=\"pluginloader.php\"><span>"._AM_TINYED_PLUGINUP."</span></a></li>";
	if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
		echo "<li id='".$tblCol[7]."'><a href=\"chmod.php\"><span>"._AM_TINYED_CHMOD."</span></a></li>";
		echo "<li id='".$tblCol[8]."'><a href=\"about.php\"><span>"._AM_TINYED_ABOUT."</span></a></li>";
	} else {
		echo "<li id='".$tblCol[7]."'><a href=\"about.php\"><span>"._AM_TINYED_ABOUT."</span></a></li>";
	}
	echo "</ul></div>";
	echo "<br style='clear:both;' />";
}

?>