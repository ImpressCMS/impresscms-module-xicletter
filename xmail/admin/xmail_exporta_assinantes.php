<?php
/*
* $Id:  admin/ xmail_exporta_assinantes.php
* Module: xmail
* Version: v2.0
* Release Date:  15 de setembro de 2006
\* Author: Claudia Antonini Vitiello Callegari
*/
//
//

include "admin_header.php";
include_once XOOPS_ROOT_PATH."/modules/xmail/grvlog.php";

$delimiter=',';
$tabela='xmail_newsletter';
$table=$xoopsDB->prefix($tabela);

include_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";
$param= new classparam();

$local_arq=XOOPS_ROOT_PATH."/".$param->dir_upload."/";
//$local_arq=XOOPS_ROOT_PATH."/modules/xmail/upload/";

$arqsaida= "$table.txt";


if($_GET['fase']=='2'){

	//var_dump($_POST['List2'])	;
	$delimiter=$_POST['delimiter'];

	$tipo=$_POST['tipo'];

	$sql=" select user_name,user_nick,user_email from $table  ";
	if($tipo=='c'){
		$sql.='  where confirmed=1 '	;
	}elseif($tipo=='n'){
		$sql.='  where confirmed=0 '	;
	}

	$result=$xoopsDB->queryf($sql);
	if(!$result){
		xoops_error("Error  ",$sql );
	}


	$conteudo="";
	if($xoopsDB->getRowsNum($result)>0) {
	while($cat_data=$xoopsDB->fetcharray($result)){
		//	var_dump($cat_data);
		//	echo "<br><br>";
		$primeiro=1;
		foreach($cat_data as $key =>$value ){
			if($primeiro){
				$primeiro=0;
			}else{
				$conteudo.=$delimiter;
			}
			// verificar se precisa de conversão
			$func=$conv_campos[$key];
			if(!empty($func) or !is_null($func)  ){
				$value=$func($value);
			}

			$conteudo.=$value;
		}
		$conteudo.="\r\n";
	}

	unlink($local_arq.$arqsaida);

	if(grvlog($local_arq.$arqsaida,$conteudo)){
		chmod ($local_arq.$arqsaida, 0777);
		//$resultado.="\n Arquivo gerado com sucesso ".$local_arq.$arqsaida;
		$resultado.="\n"._AM_XMAIL_ARQSUCCESS;
		$gerou_arq=true;
	}else {
		$resultado.="\n "._AM_XMAIL_ARQERR.$local_arq.$arqsaida;
	}
	
	}else{
		$resultado.=_AM_XMAIL_NAOHAREG;	
	}

	echo "<p class='odd'> ". nl2br($resultado)."</p>";
	
	
	
}else{

	$sform = new XoopsThemeForm(_AM_XMAIL_FORMEXPORT, "export", '?fase=2');

	$radiotipo=new XoopsFormRadio(_AM_XMAIL_SELELECIONAR,'tipo','a');

	$radiotipo->addOption('c',_AM_XMAIL_CONFIRMADOS);
	$radiotipo->addOption('n',_AM_XMAIL_NAOCONFIRMADOS);
	$radiotipo->addOption('a',_AM_XMAIL_AMBOS);
	$sform->addElement($radiotipo);

	$sform->addElement(new XoopsFormText(_AM_XMAIL_DELIMITADOR,'delimiter',2,2,$delimiter));
	$sform->addElement(new XoopsFormButton("", "submit", _SEND, "submit"));
	$sform->display();

}
if($gerou_arq) {
	echo "<script type='text/javascript'>openedWindow=window.open('xmail_download.php?arq=$arqsaida','baixa','height=200,width=400');</script>";
}



xoops_cp_footer();


?>
