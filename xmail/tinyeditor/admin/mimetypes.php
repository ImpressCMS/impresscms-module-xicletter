<?php


	include 'admin_header.php';
	include XOOPS_ROOT_PATH.'/class/xoopsformloader.php';

	xoops_cp_header();
	adminMenu(5, _AM_TINYED_MIMETYPES);

	echo "<br style='clear:left;' /><div>";
	$groupform = new XoopsThemeForm(_AM_TINYED_GROUPLIST, "grouplist", "mimetypes.php");
	$group_tray = new XoopsFormElementTray( _AM_TINYED_GROUPLIST, '' );
	$group_tray->addElement( new XoopsFormSelectGroup('', 'grouplist', true, '', 1, false) );
	$group_tray->addElement(new XoopsFormButton('', 'grouplistsubmit', _GO, 'submit'));
	$groupform->addElement($group_tray);
	$groupform->display();
	echo "</div>";

		if (!empty($_POST['grouplist'])) {
			echo "<br />";
			$sql = "SELECT * FROM ".$xoopsDB->prefix('tinyeditor_mimetypes')." WHERE tinymt_gid = ".intval($_POST['grouplist'])."";
			$result = $xoopsDB->query($sql);
			list($tinymt_id, $tinymt_gid, $tinymt_types) = $xoopsDB->fetchRow($result);

			if ($tinymt_gid == '') {
				echo _AM_TINYED_NOMIMESYET;
				$tinymt_types = "image/jpeg image/pjpeg image/png image/gif";
			}

			$mimeform = new XoopsThemeForm(_AM_TINYED_ADDMIMESINSTR, 'mime_form', 'mimetypes.php');
			$mimeform->addElement(new XoopsFormTextarea('', 'tinytypes', $tinymt_types, 5, 50), true);
			$mimeform->addElement(new XoopsFormHidden('op', 'saveit'));
			$mimeform->addElement(new XoopsFormHidden('gid', $_POST['grouplist']));
				if ($tinymt_gid == '') {
					$mimeform->addElement(new XoopsFormHidden('newid', ''));
				} else {
					$mimeform->addElement(new XoopsFormHidden('newid', $tinymt_gid));
				}
			$mimeform->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
			$mimeform->display();
		}


		if (!empty($_POST['op']) && ($_POST['op'] == 'saveit')) {
			if (!empty($_POST['newid'])) {
				$sql = "UPDATE ".$xoopsDB->prefix('tinyeditor_mimetypes')." SET tinymt_types = ".$xoopsDB->quoteString($_POST['tinytypes'])." WHERE tinymt_gid = ".intval($_POST['gid'])." ";
			} else {
				$sql = "INSERT INTO ".$xoopsDB->prefix('tinyeditor_mimetypes')." (tinymt_id, tinymt_gid, tinymt_types) VALUES ('', ".intval($_POST['gid']).", ".$xoopsDB->quoteString($_POST['tinytypes']).")";
			}
			$result = $xoopsDB->query($sql);
			if ($result) {
				redirect_header('mimetypes.php', 2, _AM_TINYED_DBUPDATED);
			} else {
				redirect_header('mimetypes.php', 2, _AM_TINYED_DBERROR);
			} 
		}

	xoops_cp_footer();

?>