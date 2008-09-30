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

	File: tinyeditor/admin/permissions.php
	Version: 29112005-1
	Developer: frankblack (frankblack@myxoops.de)
	------------------------------------------------------------------------ */

	include 'admin_header.php';
	include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';

	xoops_cp_header();
adminMenu(3, _AM_TINYED_PERMISSIONS);

/*
* Other permissions
*/

	echo "<div style='float: left; width:100%;'><fieldset><legend style='font-weight: bold; color: #900;'>"._AM_TINYED_PERMISSIONS."</legend><div style='padding: 2px;'>";

	$other_form = new XoopsGroupPermForm('', $xoopsModule->getVar('mid'), 'TinyPerm', _AM_TINYED_PERMISSIONS);

			$other_form->addItem('1', _AM_TINYED_CANUPLOAD, 0);
			$other_form->addItem('2', _AM_TINYED_CANDELETE, 0);
			$other_form->addItem('3', 'WYSIWYG', 0);
			$other_form->addItem('4', _AM_TINYED_CANCREATEDIR, 0);
			$other_form->addItem('5', _AM_TINYED_CANDELETEDIR, 0);
			$other_form->addItem('6', _AM_TINYED_USEQUOTA, 0);
			$other_form->addItem('7', _AM_TINYED_OVERRIDEUSERDIR, 0);
			$other_form->addItem('8', _AM_TINYED_CHGEIMGATTRIB, 0);
			if  (function_exists('rename') || $moduleConfig['tinyedmgrftp'] == 1)
				$other_form->addItem('9', _AM_TINYED_RENAMEIMG, 0);
			$other_form->addItem('10', _AM_TINYED_DELETENONEMPTYDIR, 0);
			if  (function_exists('rename') || $moduleConfig['tinyedmgrftp'] == 1)
				$other_form->addItem('11', _AM_TINYED_RENAMEDIR, 0);
			if  (function_exists('copy') || $moduleConfig['tinyedmgrftp'] == 1) {
				$other_form->addItem('12', _AM_TINYED_COPYDIR, 0);
				$other_form->addItem('13', _AM_TINYED_MOVEDIR, 0);
				$other_form->addItem('14', _AM_TINYED_COPYFILE, 0);
				$other_form->addItem('15', _AM_TINYED_MOVEFILE, 0);
			}
			$other_form->addItem('16', _AM_TINYED_EDITFILE, 0);
			$other_form->addItem('17', _AM_TINYED_XRMANAGE, 0);
			$other_form->addItem('18', _AM_TINYED_FTPDEBUG, 0);

	echo $other_form->render();

	echo "</div></fieldset></div><br />";
	unset ($other_form);

	xoops_cp_footer();

?>