<?php
/*
* $Id: admin/xmail_importa_assinantes_perf.php
* Module: xmail
* Version: v2.5
* Release Date: 07 de junho de 2007
\* Author: Claudia Antonini Vitiello Callegari
\* Analista: Gilberto G. de Oliveira (Giba) 21 Março de 2004.
*/
//  Faz upload de arquivos para importação

// Importar perfis de assinantes
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

	$form_title=_AM_XMAIL_FORMIMPORT2;
	$uploadedfile_file= new XoopsFormFile(_AM_XMAIL_SELARQUP, 'uploadedfile','31457280');

	$func_hidden = new XoopsFormHidden("func", 'two');
	//$lopcao_hidden = new XoopsFormHidden("lopcao", $lopcao);
	$origem_hidden = new XoopsFormHidden("origem", 'site');
	$submit_button = new XoopsFormButton("", "submit",'enviar', "submit");
	$form = new XoopsThemeForm($form_title, "upload", $_SERVER['PHP_SELF']);
	$form->setExtra('enctype="multipart/form-data"') ;

	$label=sprintf(_AM_XMAIL_VALORESMAXUP,ini_get('upload_max_filesize'),ini_get('post_max_size'));

	$form->addElement(new XoopsFormLabel(_AM_XMAIL_LAYOUESPERADO, _AM_XMAIL_LAYOUPIMPORT2));
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
				$resultado='';
				$totreg=0;

				WHILE (!FEOF($arquivo)){
					$linha  = FGETS($arquivo, 4096);
					//var_dump($linha);
					$campos=explode($delimiter,$linha);
					$campos=array_map('limpa_salto', $campos);
					
					//var_dump($campos);
					//echo "<br>";
					if(count($campos)>1) {
						// verificar se o email ja existe
						$sql=" select * from $table where user_email='".$campos[0]."' ";
						$result=$xoopsDB->queryf($sql);
						if(!$result){
							$resultado.='Err: '.$sql.' - '.$xoopsDB->error()."<br>" ;
						}else {
							if($xoopsDB->getRowsNum($result)>0) {
								// ok email existe, pegar o id
								$cat_data=$xoopsDB->fetcharray($result);
								$iduser=$cat_data['user_id'];
								for($i=1;$i<count($campos);$i++){
									// verificar se o perfil está cadastrado
									$sql=' select id_perf from '.$xoopsDB->prefix('xmail_tabperfil').' where id_perf='.intval($campos[$i]);
   								    $result=$xoopsDB->queryf($sql);
								    if(!$result){
										$resultado.='Err: '.$sql.' - '.$xoopsDB->error()."<br>" ;
									}else {
										if($xoopsDB->getRowsNum($result)==0) {
											// não encontrou
											$resultado.='Err: '._AM_XMAIL_PERFILNOTFOUND.' :'.$campos[$i]."<br>" ;
										}else{
										  $sql=' insert into '.$xoopsDB->prefix('xmail_perfil_news')." (user_id,id_perf) 
										   values ($iduser,".intval($campos[$i]).")";
										   $result=$xoopsDB->queryf($sql);
										   if(!$result){
												$resultado.='Err: '.$sql.' - '.$xoopsDB->error()."<br>" ;
											}else {
												$totreg++;	
											}
										}
									}
								}
							}else {
									$resultado.=_AM_XMAIL_EMAILNOTFOUND.' :'.$campos[0]."<br>";
							}
						}
					}else{
						if(!empty($linha)){
						   $resultado.=_AM_XMAIL_IMPORTREGERR.": $linha <BR>";
						}
					}
				}
				if($totreg>0){
					$resultado.="<br>".sprintf(_AM_XMAIL_IMPORTOK,$totreg)."<br>" ;
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
