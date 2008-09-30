<?php
/*
* $Id: admin/xmail_download.php
* Module: xmail
* Version: v2.0
* Release Date: 15 de setembro de 2006
\* Author: Claudia Antonini Vitiello Callegari
*/
ob_start();
clearstatcache();
//session_cache_limiter('private_no_expire');  // incluido para funcionar relatório em pdf -pois enviava SESSION para o header
include('admin_header.php');


include_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";
$param= new classparam();


//$local_arq=XOOPS_ROOT_PATH."/modules/xmail/upload/";
$local_arq=XOOPS_ROOT_PATH."/".$param->dir_upload."/";

$arq=$local_arq.$_GET['arq'];


$filename = realpath($arq);
$file_extension = strtolower(substr(strrchr($filename,"."),1));
if($file_extension<>'txt'  and $file_extension<>'TXT' )  {
	$arq='Erro '._AM_XMAIL_EXTENSIONINVALID.' '.$_GET['arq']. 'filename '.$filename;

}
ob_end_clean();
if(ereg('^Erro',$arq)) {
	echo "<p align='center'><b>$arq<br><br><a href='javascript:history.go(-1);'>"._AM_XMAIL_VOLTAR."</a></p>";
}else{
	if(file_exists($arq)){
		$tamanho = filesize($arq);
		$nome=basename($arq);
		//               header("Content-type: Application/unknown");
		header("Content-type: Application/save");
		header("Content-length: $tamanho");
		header("Content-Disposition: attachment; filename=$nome");
		header("Content-Description: PHP Generated Data");

		if(readfile($arq)){
			//              header("Location: $HTTP_REFERER");
		} else {
			echo _AM_XMAIL_ERRCARREGAR." - $nome .";
		}
	} else {
		echo "Erro:  Arquivo $arq não existe";
		echo "<p align='center'><a href='javascript:history.go(-1);'>"._AM_XMAIL_VOLTAR."</a></p>";
	}
}
//   }  // fecha if
