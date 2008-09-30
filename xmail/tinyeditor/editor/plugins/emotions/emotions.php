<?php
// $Id: emotions.php,v 1.3 2006/04/28 07:35:27 frankblacksf Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

	if (file_exists('../../../../mainfile.php')) include_once '../../../../mainfile.php';

	if (file_exists('../../../../../mainfile.php')) include_once '../../../../../mainfile.php';

	if (file_exists('../../../../../../mainfile.php')) include_once '../../../../../../mainfile.php';

	if (file_exists('../../../../../../../mainfile.php')) include_once '../../../../../../../mainfile.php';

	if (file_exists('../../../mainfile.php')) include_once '../../../mainfile.php';

	if (file_exists('../../mainfile.php')) include_once '../../mainfile.php';

	if (file_exists('../mainfile.php')) include_once '../mainfile.php';

	if (!defined('XOOPS_ROOT_PATH'))
		exit();

$sql = "SELECT smile_url, emotion FROM ".$xoopsDB->prefix('smiles')." WHERE display = 1";
$result = $xoopsDB->query($sql);
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_emotions_title}</title>
	<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="jscripts/functions.js"></script>
	<base target="_self" />
</head>
<body style="display: none">
	<div align="center">
		<div class="title">{$lang_emotions_title}:<br /><br /></div>
		<table border="0" cellspacing="0" cellpadding="4">
		  <tr><td><?php
		  while(list($smile_url, $emotion) = $xoopsDB->fetchRow($result)) {
		  	$smile_url = XOOPS_URL.'/uploads/'.$smile_url;
		  	echo "<a href=\"javascript:insertEmotion('".$smile_url."','".$emotion."');\"><img src=\"".$smile_url."\" border=\"0\" alt=\"".$emotion."\" title=\"".$emotion."\" style=\"float: left; padding: 2px;\" /></a>";
		  }
		?></td></tr></table>
	</div>
</body>
</html>