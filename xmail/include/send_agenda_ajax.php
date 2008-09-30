<?php

// include/send_agenda_ajax.php
require_once('../../../mainfile.php');
$timerefresh=29;
$config_handler =& xoops_gethandler('config');
// carregar arquivos de tradução
if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php") ) {
	include_once XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php";
} else {
	if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php") ) {
		include_once XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php";
	}
}

$path_javascript=XOOPS_URL.'/modules/xmail/javascripts/scriptaculous-js-1.7.0/';
echo "<script src=\"$path_javascript/lib/prototype.js\" type=\"text/javascript\"></script>";
echo "<script src=\"$path_javascript/src/scriptaculous.js\" type=\"text/javascript\"></script>";


echo "<h3 align='center' > "._MD_XMAIL_EXECAGENDA." </h3>";

echo "<h4 align='center'>".sprintf(_MD_XMAIL_EXECAGENDADESCRI,$timerefresh)."</h4>";
echo "<div align='center' id='resultado_agenda'  > </div> ";

echo "<h5 align='center'> <a href='javascript:window.close()'>"._MD_XMAIL_PARAR." </a></h5>";


//  instanciar classe  ajax
$script_agenda=XOOPS_URL.'/modules/xmail/include/send_agenda.php';
?> <script type='text/javascript' >
	 new Ajax.PeriodicalUpdater('resultado_agenda','<?php echo $script_agenda?>',{method:'post',encoding:'ISO-8859-1',frequency:'<?php echo $timerefresh?>',onLoading:function(){$('resultado_agenda').innerHTML='<?php echo _MD_XMAIL_EMPROC ?><img src="../images/ajax-loader.gif"> '},evalScripts:true})
 </script>
<?php 
//
?>


