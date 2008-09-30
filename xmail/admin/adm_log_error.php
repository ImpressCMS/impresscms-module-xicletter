<?php
/*
* $Id: admin/adm_log_error.php
** Module: XMAIL
** Version: v2.5
* Release Date: 27 de junho de 2006
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/

include "admin_header.php";
include_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";
$param= new classparam();

//$arq=XOOPS_ROOT_PATH."/modules/xmail/upload/xmail_erros.log";
$arq=XOOPS_ROOT_PATH."/".$param->dir_upload."/xmail_erros.log";

echo "<h2>"._MD_XMAIL_ADMLOGERRO."</h2>";

$opt=$_POST['opt'];

if($opt!='send') {
	if(file_exists($arq)){
	
	if ($LogHand = fopen($arq, 'r')) {
		$conteudo=fread($LogHand, filesize ($arq)) ;
		fclose($LogHand);
	}else {
		xoops_error(_AM_XMAIL_NOTOPENARQ.": $arq") ;
		$opt=' ';
	}
	}else{
		xoops_error(_AM_XMAIL_NOTEXITARQ);
		
	}
}

if(!isset($linhas))
$linhas=50;


if(!isset($colunas))
$colunas=50;


switch($opt){
	case "send":
	if ($LogHand = fopen($arq, 'w')) {
		fputs($LogHand,$_POST['conteudo'] ) ;
		fclose($LogHand);
		xoops_result(_MD_XMAIL_SAVEOK);
	}else {
		xoops_error(_MD_XMAIL_ERRO_SAVE);
	}
	break;
	case "ver":
	echo nl2br($conteudo);


	break;
	case "editar" :

	$sform = new XoopsThemeForm('', "storyform", xoops_getenv('PHP_SELF') );
	$sform->addElement(new XoopsFormTextArea("",'conteudo', $conteudo, $linhas,$colunas));
	$sform->addElement( new XoopsFormHidden("opt", "send"));
	$sform->addElement( new XoopsFormButton("", "mail_submit", _SEND, "submit") );
	$sform->display();
	break;

	default:
	echo "<div style='width:30%;align:'center'>";
	$sform = new XoopsThemeForm('', "storyform", xoops_getenv('PHP_SELF') );
	$radiobox=new XoopsFormRadio('','opt','ver');
	$radiobox->addOptionArray(array('editar' =>_EDIT   , 'ver' => _MD_XMAIL_VIEW ));
	$sform->addElement($radiobox);

	$sform->addElement( new XoopsFormButton("", "mail_submit", _SEND, "submit") );
	$sform->display();
	echo "</div>";



}
echo "<p align='center'><a href='adm_log_error.php'> Voltar </a></p> ";
xoops_cp_footer();

?>

