<?php
/*
* $Id: admin/xmail_importa_assinantes.php
* Module: xmail
* Version: v2.5
* Release Date: 15 de setembro de 2006
\* Author: Claudia Antonini Vitiello Callegari
\* Analista: Gilberto G. de Oliveira (Giba) 21 Março de 2004.
*/
//  Faz upload de arquivos para exportação


include "admin_header.php";
//set_time_limit(0);

$delimiter=',';
$tabela='xmail_newsletter';

$table=$xoopsDB->prefix($tabela);

include_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";
$param= new classparam();

$local_arq=XOOPS_ROOT_PATH."/".$param->dir_upload."/";
//$local_arq=XOOPS_ROOT_PATH."/modules/xmail/upload/";


if(isset($_POST['func'])){
	$func=$_POST['func']	;

}
if (!isset($func)) {
	$func = "one";
}
switch ($func) {
	case 'one':

	$form_title=_AM_XMAIL_FORMIMPORT;
	$uploadedfile_file= new XoopsFormFile(_AM_XMAIL_SELARQUP, 'uploadedfile','31457280');

	$func_hidden = new XoopsFormHidden("func", 'two');
	//$lopcao_hidden = new XoopsFormHidden("lopcao", $lopcao);
	$origem_hidden = new XoopsFormHidden("origem", 'site');
	$submit_button = new XoopsFormButton("", "submit",'enviar', "submit");
	$form = new XoopsThemeForm($form_title, "upload", $_SERVER['PHP_SELF']);
	$form->setExtra('enctype="multipart/form-data"') ;

	$label=sprintf(_AM_XMAIL_VALORESMAXUP,ini_get('upload_max_filesize'),ini_get('post_max_size'));

	$form->addElement(new XoopsFormLabel(_AM_XMAIL_LAYOUESPERADO, _AM_XMAIL_LAYOUPIMPORT));
	$form->addElement(new XoopsFormLabel('',$label)   );
	$form->addElement($func_hidden);
	$form->addElement($origem_hidden);
	$form->addElement($lopcao_hidden);
	$form->addElement($uploadedfile_file);
	$form->addElement(new XoopsFormText(_AM_XMAIL_DELIMITADOR,'delimiter',2,2,$delimiter),true);
	$form->addElement($submit_button);
	$form->setRequired($uploadedfile_file);


	$form->display();
	break;
	case 'two':
	require_once XOOPS_ROOT_PATH.'/modules/xmail/include/Validate.php';
	if(!isset($uploadedfile))
	$uploadedfile=$_FILES['uploadedfile']['tmp_name'];

	if($uploadedfile<>"none" ) {
		if (minimum_version('4.1.0')) {
			// versões superiores o nome do arquivo esta no array $_FILES....
			$uploadedfile_name=$_FILES['uploadedfile']['name'];
		}
		if(!copy($uploadedfile,$local_arq.$uploadedfile_name)) {
			$erro_upload=$_FILES['uploadedfile']['error'];
			echo "<script>alert('"._AM_XMAIL_ERRUPLOAD." - $erro_upload    ');</script>";
		}else {
			$arqprod=$local_arq.$uploadedfile_name;
			echo "<script>alert('"._AM_XMAIL_OKUPLOAD."')</script>";
			// inserir rotina de importação
			//layout : user_name,user_nick,user_email

			$arquivo = @fopen($arqprod, "r");
			IF ($arquivo)  {
				$delimiter=$_POST['delimiter'];
				$resultado='';
				$totreg=0;
				$sqlinsert="insert into $table (user_name,user_nick,user_email,confirmed,user_time,user_host) ";
				$values='';
				$array_email=array();  // para controle se houver emails repetidos no arquivo
				WHILE (!FEOF($arquivo)){
					$linha  = FGETS($arquivo, 4096);
					//var_dump($linha);
					$campos=explode($delimiter,$linha);
					$campos=array_map('limpa_salto', $campos);

					//var_dump($campos);
					//echo "<br>";
					if(count($campos)==3) {
						if(empty($campos[0]) or empty($campos[1])  or empty($campos[2]) ){
							$resultado.=_AM_XMAIL_CAMPOSEMPTY." - $linha <br>";
						}else{
							// verificar se email tem sintaxe válida
							$valido=Validate::email($campos[2]) ;// validar so sintaxe
							if(!$valido){
								$resultado.=_AM_XMAIL_EMAILNOTVALIDO.' - '.$campos[2]."<br>";
							}else{
								// verificar se o email ja existe
								$sql=" select * from $table where user_email='".$campos[2]."' ";
								$result=$xoopsDB->queryf($sql);
								if(!$result){
									$resultado.='Err: '.$sql.' - '.$xoopsDB->error()."<br>" ;
								}else {
									if($xoopsDB->getRowsNum($result)>0) {
										$resultado.=_AM_XMAIL_EMAILJAEXISTE.' '.$campos[2]."<br>" ;
									}else {
										if(!in_array($campos[2],$array_email)){
											if(!empty($values)){
												$values.=',';
											}
											$values.="('".addslashes($campos[0])."','".addslashes($campos[1])."','".addslashes($campos[2])."',1,now(),'import') ";
											$totreg++;
											$array_email[]=$campos[2];
										}else{
											$resultado.=_AM_XMAIL_EMAILREPETIDO.' - '.$campos[2]."<br>";

										}

									}
								}
							}



						}

					}else{
						if(!empty($linha)){
							$resultado.=_AM_XMAIL_IMPORTREGERR.": $linha <BR>";
						}
					}
				}
				if($totreg>0){
					$sql=$sqlinsert.'  values '.$values;
					$result=$xoopsDB->queryf($sql);
					if(!$result){
						$resultado.='Err: '.$sql.' - '.$xoopsDB->error()."<br>" ;
					}else {
						$resultado.="<br>".sprintf(_AM_XMAIL_IMPORTOK,$totreg)."<br>" ;
					}

				}else{
					$resultado.=_AM_XMAIL_IMPORTNAOHAREG."<br>";
				}
				@fclose($arquivo);
				@unlink($arqprod);

			}else {
				$resultado.=_AM_XMAIL_IMPORTNAOABRIUARQ.' '.$arqprod."<br>";
			}
		}

		xoops_result( $resultado);
	}
	break;
}

xoops_cp_footer();



function minimum_version($vercheck) {
	$minver = (int)str_replace('.', '', $vercheck);
	$curver = (int)str_replace('.', '', phpversion());
	if($curver >= $minver)
	return true;
	return false;
}

function limpa_salto($campo){
	$campo2 = str_replace("\n","",$campo);
	$campo2=str_replace("\r","",$campo2);
	$campo2=str_replace("\t","",$campo2);
	return $campo2;
}



?>
