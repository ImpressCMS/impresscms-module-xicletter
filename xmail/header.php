<?php
/*
* $Id: header.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

require("../../mainfile.php");
require_once( XOOPS_ROOT_PATH . "/header.php" );

require_once XOOPS_ROOT_PATH."/modules/xmail/include/functions.php";
require_once XOOPS_ROOT_PATH."/class/xoopstree.php";
require XOOPS_ROOT_PATH."/class/xoopsformloader.php";
require_once XOOPS_ROOT_PATH."/class/xoopsmodule.php";

require_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";


$path_javascriptx=XOOPS_URL.'/modules/xmail/javascripts/';
$xoopsTpl->assign('xoops_module_header','<script type="text/javascript" src="'.$path_javascriptx.'/xmail_funcoes.js"></script>
' . $xoopsTpl->get_template_vars( "xoops_module_header" ));
 
if(!isset($nomenu)){
	$nomenu=false;
}


$myts = & MyTextSanitizer :: getInstance();
if (!$xoopsUser ) {
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}

// checar se user é admin
//	$xoopsModule = XoopsModule::getByDirname($modversion['dirname']);
// acima não deu certo pois não reconhece $modversion  -  verificar qual melhor forma de fazer
//  sem colocar explicitamente  xmail  e sim resgatar com função
//  Couldn't make work as above since $modversion isn't recognized. To do: check the
//  best way to set $xoopsModule without the need to input "xmail", i.e., fetch it with
//  a function as in the commented line above.

    
	$menuprincipal="<h5><a href='index.php' > "._MD_XMAIL_MENUPRINCIP."</a>";
	
	$xoopsModule = XoopsModule::getByDirname("xmail");
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		$isadmin=false;
	}else {
        $isadmin=true;
        //$menuprincipal.="&nbsp;&nbsp;&nbsp;&nbsp;<a href='admin/index.php'>"._CPHOME."</a>";
        $menuprincipal.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='admin/index.php' >"._CPHOME."</a>";
	}

	$menuprincipal.="</h5>";
	
	if(!$nomenu){
	   echo $menuprincipal;	
	}
	if(isset($xoopsTpl)){
	   $xoopsTpl->assign(array('menuprincipal' => $menuprincipal  ));	
	}
	
	
