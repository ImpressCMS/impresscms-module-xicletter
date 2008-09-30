<?php

include 'admin_header.php';
$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diretório do módulo. - GibaPhp

if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/admin_newsletter.php") ) {
   include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/admin_newsletter.php";
} else {
   if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/admin_newsletter.php") ) {
      include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/admin_newsletter.php";
   } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_ADMIN_NEWSLETTER."</b></td></tr>\n";
		echo "</table>";
   }
}

xoops_cp_footer();

?>
