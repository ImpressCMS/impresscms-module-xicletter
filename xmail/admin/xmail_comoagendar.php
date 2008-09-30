<?php
/*
* $Id: admin/xmail_comoagendar.php
* Module: XMAIL
* Version: v2.0
* Release Date: 27 de junho de 2006
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

include 'admin_header.php';
if (!defined(_MI_XMAIL_FALHOU_LANG_COMO_AGENDAR)){
   define("_MI_XMAIL_FALHOU_LANG_COMO_AGENDAR","Not found file <b>comoagendar.php</b> in directory of your language");
}

$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diretório do módulo. - GibaPhp

if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/comoagendar.php") ) {
   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/comoagendar.php";
} else {
   if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/comoagendar.php") ) {
      include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/comoagendar.php";
   } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_COMO_AGENDAR."</b></td></tr>\n";
		echo "</table>";
   }
}
xoops_cp_footer();
?>
