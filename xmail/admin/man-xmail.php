<?php
####################################################################################################
## Sample utils generic mods.
####################################################################################################
include 'admin_header.php';
if (!defined(_MI_XMAIL_FALHOU_LANG_MANXMAIL)){
   define("_MI_XMAIL_FALHOU_LANG_MANXMAIL","Not found file <b>man-xmail.php</b> in your directory docs into language");
}

$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diretório do módulo. - GibaPhp


if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/docs/".$xoopsConfig['language']."/man-xmail.php") ) {
   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/docs/".$xoopsConfig['language']."/man-xmail.php";
} else {
   if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/docs/english/man-xmail.php") ) {
      include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/docs/english/man-xmail.php";
   } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_MANXMAIL."</b></td></tr>\n";
		echo "</table>";
   }
}
xoops_cp_footer();
?>
