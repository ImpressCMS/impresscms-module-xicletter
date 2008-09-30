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

include 'admin_header.php';

#######################################################################################################
## Pegando o ID deste módulo atual.                                                                  ##
## Return Srting with number ID module.                                                              ##
#######################################################################################################

$module_id = $xoopsModule->getVar('mid');

if (file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/historic.php")) {
	include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/historic.php";
} else {
    if (file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/historic.php")) {
	   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/historic.php";
    } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_HISTORIC."</b></td></tr>\n";
		echo "</table>";

    }
}
xoops_cp_footer();
?>
