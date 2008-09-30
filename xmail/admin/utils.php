<?php
####################################################################################################
## Sample utils generic mods.
####################################################################################################
include 'admin_header.php';
if (!defined(_MI_XMAIL_FALHOU_LANG_UTILS_INDEX)){
   define("_MI_XMAIL_FALHOU_LANG_UTILS_INDEX","Not found file <b>utils_index.php</b> in directory of your language");
}

$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diretório do módulo. - GibaPhp

if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/utils_index.php") ) {
   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/utils_index.php";
} else {
   if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/utils_index.php") ) {
      include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/utils_index.php";
   } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_UTILS_INDEX."</b></td></tr>\n";
		echo "</table>";
   }
}
xoops_cp_footer();
?>
