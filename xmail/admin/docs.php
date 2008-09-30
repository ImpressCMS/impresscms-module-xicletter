<?php
####################################################################################################
## Sample utils generic mods.
####################################################################################################
include 'admin_header.php';
if (!defined(_MI_XMAIL_FALHOU_LANG_DOCS)){
   define("_MI_XMAIL_FALHOU_LANG_DOCS","Not found file <b>docs.php</b> in directory of your language");
}

$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diretório do módulo. - GibaPhp

if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/docs.php") ) {
   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/docs.php";
} else {
   if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/docs.php") ) {
      include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/docs.php";
   } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_DOCS."</b></td></tr>\n";
		echo "</table>";
   }
}
xoops_cp_footer();
?>
