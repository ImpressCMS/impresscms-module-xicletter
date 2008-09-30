<?php
/*
* $Id: admin/index.php
* Module: XMAIL
** Version: v2.5
* Release Date: 18 Setembro 2006
* Credits for FrankBlack (great idea)
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/
#######################################################################################################
## include "admin_header.php"; - É necessário em todo módulo que irá ter opções de menus e mesmo     ##
##                               para os itens que forem de sub-menu.                                ##
#######################################################################################################
error_reporting(E_ALL);
include 'admin_header.php';

#######################################################################################################
## Pegando o ID deste módulo atual.                                                                  ##
## Return Srting with number ID module.                                                              ##
#######################################################################################################

$module_id = $xoopsModule->getVar('mid');

echo "<h4 align='center' ><a href='".XOOPS_URL."/modules/".$admin_mydirname."' > "._MD_XMAIL_MENUPRINCIP."</a></h4>";
if (file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/presentation.php")) {
	include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/presentation.php";
} else {
    if (file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/presentation.php")) {
	   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/presentation.php";
    } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_PRESENTATION."</b></td></tr>\n";
		echo "</table>";

    }
}
xoops_cp_footer();
?>
