<?php
/*
* admin_header.php
* Module: XMAIL
* Version: v2.5
* Release Date: 23 Setembro  2006
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/


include("../../../mainfile.php");
include '../../../include/cp_header.php';
require_once XOOPS_ROOT_PATH.'/kernel/module.php';
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diret�rio do m�dulo. - GibaPhp

if (is_object($xoopsUser)) {
	$xoopsModule = XoopsModule::getByDirname($admin_mydirname);
	if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
		redirect_header(XOOPS_URL."/",3,_NOPERM);
		exit();
	}
} else {
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}

include_once XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/include/functions.php";

############################################################################################################
## Fun��o para tratamento de menu especial                                                                ##
############################################################################################################

include_once XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/include/func_menus.php";

############################################################################################################
## Incluido - GibaPhp ## Para pegar Classe de parametros                                                  ##
############################################################################################################

include_once XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/include/classparam.php";  //incluido giba

############################################################################################################
## Incluido - GibaPhp ## Para pegar constantes modinfo da tradu��o                                        ##
############################################################################################################

$xoopsConfig['language'] = preg_replace("/[^0-9a-z\-_,]+/i", "", $xoopsConfig['language']);

$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diret�rio do m�dulo. - GibaPhp

if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/modinfo.php") ) {
	include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/modinfo.php";
} else {
    if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/modinfo.php") ) {
	    include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/modinfo.php";
    } else {
		echo "<table class='outer' width=100%>";
		echo "<tr width=100%><td class=\"odd\"><b>"._MI_XMAIL_FALHOU_LANG_MODINFO."</b></td></tr>\n";
		echo "</table>";
	}
}
if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/main.php") ) {
	include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/main.php";
} else {
    if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/main.php") ) {
	     include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/main.php";
	}
}

if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/admin.php") ) {
	include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/".$xoopsConfig['language']."/admin.php";
} else {
    if ( file_exists(XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/admin.php") ) {
	     include XOOPS_ROOT_PATH."/modules/".$admin_mydirname."/language/english/admin.php";
	}
}

############################################################################################################
## Fim                                                                                                    ##
############################################################################################################

$myts =& MyTextSanitizer::getInstance();

xoops_cp_header();

$path_javascript=XOOPS_URL.'/modules/xmail/javascripts/scriptaculous-js-1.7.0/';
echo "<script src=\"$path_javascript/lib/prototype.js\" type=\"text/javascript\"></script>";
echo "<script src=\"$path_javascript/src/scriptaculous.js\" type=\"text/javascript\"></script>";



########################by rplima - submenu#########################################
$xmenu = (isset($_GET['xmenu']))?$_GET['xmenu']:'';
$xsubmenu = (isset($_GET['xsubmenu']))?$_GET['xsubmenu']:'';
adminMenu($xmenu,$xsubmenu);
########################by rplima - submenu#########################################
?>
