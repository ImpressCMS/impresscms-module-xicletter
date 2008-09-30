<?php
/*
* $Id: download.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/
// Adaptado de .... Adaptation of
// $Id: download.php,v 1.1 2006/02/17 20:37:33 claudia Exp $
ob_start();
include 'header.php';


$fileid=$_GET['fileid'];
if ( empty($fileid) ) {
	redirect_header("index.php");
}



include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");

$classfiles= new classfiles();
$classfiles->fileid=$fileid;

if ($classfiles->busca() ) {

	//   $workdir=XOOPS_ROOT_PATH."/".$classfiles->dir_upload."/";
	$workdir=XOOPS_ROOT_PATH."/".$classfiles->dir_upload;
	$filename= $classfiles->filerealname;

	if (!is_readable($workdir."/".$filename)) {
		echo sprintf(_MD_XMAIL_FILENOTFOUND, $workdir."/".$filename);
		exit();
	}

	$size=filesize($workdir."/".$filename);
	$dlfilename = $filename;

	ob_end_clean();
	if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) {      // For IE
		if (file_exists(XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language']."/convert.php")) {
			$langdir = XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language'];
		} else {
			$langdir = XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/language/english";
		}
		include_once($langdir."/convert.php");
		$dlfilename = WfsConvert::filenameForWin($dlfilename);

		header("Content-Type: ".$classfiles->getMinetype());
		header("Content-Length: $size");

		header("Cache-control: private");
		header("Content-Disposition: attachment; filename=$dlfilename");
	}else
	{  // For Other browsers
		header("Content-Type: ".$classfiles->getMinetype());
		header("Content-Length: $size");
		if (preg_match("/[^a-zA-Z0-9_\-\.]/",$dlfilename)) $dlfilename=$fileid.".".$file->getExt();
		header("Content-Disposition: attachment; filename=\"$dlfilename\"");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}
	if(!readfile($workdir."/".$filename)){
		echo 'Erro no arquivo '.$workdir."/".$filename;
	}
}else  {

	echo "message not found  $fileid ";

}

