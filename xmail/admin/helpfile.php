<?php

include 'admin_header.php';
if (!defined("_MI_XMAIL_FALHOU_LANG_HELPFILE")){
   define("_MI_XMAIL_FALHOU_LANG_HELPFILE","Not found file <b>helpfile.php</b> in directory of your language");
}
$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);
if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/helpfile.php") ) {
	include XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/helpfile.php";
} else {
   if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/helpfile.php") ) {
      include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/helpfile.php";
   } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_HELPFILE."</b></td></tr>\n";
		echo "</table>";
   }
}

?>
