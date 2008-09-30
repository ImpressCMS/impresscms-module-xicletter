<?php
/**
 * $Id: about.php,v 1.2 2006/06/28 10:31:32 frankblacksf Exp $
 * Module: TinyEditor
 * Version: v 0.5
 * Release Date: 01 Sep 2005
 * Author: ralf57
 * Licence: GNU
 */
include "admin_header.php";
$module_handler = &xoops_gethandler('module');
$versioninfo = &$module_handler->get($xoopsModule->getVar('mid'));
xoops_cp_header();
adminMenu(6, _AM_TINYED_ABOUT);

echo "<img src='" . XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/" . $versioninfo->getInfo('image') . "' alt='' hspace='0' vspace='0' align='left' style='margin-right: 10px;'/></a>";
echo "<div style='margin-top: 10px; color: #33538e; margin-bottom: 4px; font-size: 18px; line-height: 18px; font-weight: bold; display: block;'>" . $versioninfo->getInfo('name') . " version " . $versioninfo->getInfo('version') . "</div>";
if ($versioninfo->getInfo('author_realname') != '') {
    $author_name = $versioninfo->getInfo('author') . " (" . $versioninfo->getInfo('author_realname') . ")";
} else {
    $author_name = $versioninfo->getInfo('author');
} 

echo "<div style = 'line-height: 16px; font-weight: bold; display: block;'>" . _AM_TINYED_AUTHOR . " " . $author_name;
echo "</div>";
echo "<div style = 'line-height: 16px; display: block;'>" . $versioninfo->getInfo('license') . "</div>\n";

echo "<br />\n";
// Module Development information
echo "<fieldset><legend>" . _AM_TINYED_DEVINFOS . "</legend>";
echo "<table width='100%' cellspacing=1 cellpadding=1 border=0>";
/*echo "<tr>";
echo "<td class='bg3' align='left'><b>" . _AM_TINY_DEVINFOS . "</b></td>";
echo "</tr>";*/
echo "<tr>";
echo "<td class='even' align='left'><a href='http://dev.xoops.org/modules/xfmod/project/?tinyeditor' target='blank'>"._AM_TINYED_DEVSITE."</a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'><a href='http://dev.xoops.org/modules/xfmod/tracker/?group_id=1197&atid=961' target='blank'>"._AM_TINYED_BUGSREP."</a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'><a href='http://dev.xoops.org/modules/xfmod/tracker/?group_id=1197&atid=964' target='blank'>"._AM_TINYED_RFEREP."</a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'><a href='http://dev.xoops.org/modules/xfmod/forum/?group_id=1197' target='blank'>"._AM_TINYED_FORUMS."</a></td>";
echo "</tr>";
echo "</table></fieldset>";

echo "<br />\n";
xoops_cp_footer();
?>