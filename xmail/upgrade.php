<?php
/*
* $Id: upgrade.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Mar�o 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

//include("header.php");
include("../../mainfile.php");

global $xoopsDB,$xoopsConfig;
include(XOOPS_ROOT_PATH."/header.php");

include("xoops_version.php");
$dirname= $modversion['dirname'];

if (!$xoopsUser ) {
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}

    $xoopsModule = XoopsModule::getByDirname($dirname);
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		$isadmin=false;
	}else {
        $isadmin=true;
	}


foreach ($_POST as $k => $v) {
	${$k} = $v;
}

foreach ($_GET as $k => $v) {
	${$k} = $v;
}

if ( !isset($action) || $action == "" ) {
	$action = "message";
}

 if(XOOPS_DB_TYPE!="mysql") {
	install_header();
	echo "
    <table width='100%' border='0'>
    <tr>
    <td align='center'><b>".sprintf(_MD_XMAIL_UPDATE_NOT,XOOPS_DB_TYPE)."</b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    </table>";

    include_once(XOOPS_ROOT_PATH."/footer.php");
	exit();
}


if ( $action == "message" ) {
	install_header();

	echo "
	<table width='50%' border='0'>
    <tr><td colspan='2'>"._MD_XMAIL_UPDATE3."</td></tr>

	<tr><td></td><td >"._MD_XMAIL_UPDATE4."</td></tr>
	<tr><td></td><td><span style='color:#ff0000;font-weight:bold;'>"._MD_XMAIL_UPDATE5."</span></td></tr>
	</table>
	";
	echo "<p>"._MD_XMAIL_UPDATE6."</p>";
	echo "<form action='".$HTTP_SERVER_VARS['PHP_SELF']."' method='post'><input type='submit' value="._MD_XMAIL_UPDATE7." /><input type='hidden' value='upgrade' name='action' /></form>";

    include_once(XOOPS_ROOT_PATH."/footer.php");

}

if ( $action == "upgrade" ) {
   install_header();

   echo "<p>"._MD_XMAIL_UPDATE24."</p>\n";

   //----------------------------------------------------------------------------------------
   // trocar vari�veis nos arquivos table_xmail_esquema.xml  e table_xmail_esquema.xml.antes ( que foi
   // gerado na instala��o do m�dulo)
   // trocar XOOPS_DB_NAME  e XOOPS_DB_PREFIX  pelo seu conte�do, salvar os arquivos acrescentando
   // extens�o  .tmp  e processar  para atualizar a base de dados
   //----------------------------------------------------------------------------------------

   require_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";
   $param= new classparam();
   $dirupload=XOOPS_ROOT_PATH."/".$param->dir_upload;
   
   $filename = "table_".$dirname."_esquema.xml";
   $filename_tmp=$dirupload."/".$filename.".tmp";

      $origem[]= "XOOPS_DB_PREFIX";
      $destino[]= XOOPS_DB_PREFIX;

      $origem[]= "XOOPS_DB_NAME";
      $destino[]= XOOPS_DB_NAME;


   if( troca_var($filename,$filename_tmp,$origem, $destino)) {
   
      $filename_antes = $filename.".antes";
      $filename_antes_tmp=$dirupload."/".$filename_antes.".tmp";

      if( troca_var($filename_antes,$filename_antes_tmp,$origem, $destino )) {

           //-------------------------------------------------
           // executar atualiza��o da base com os arquivos
           // $filename_tmp  e $filename_antes_tmp
           //-------------------------------------------------

            define("PATH_METABASE",XOOPS_ROOT_PATH."/modules/".$dirname."/metabase/");
            require(PATH_METABASE."xml_parser.php");
            require(PATH_METABASE."metabase_parser.php");
            require(PATH_METABASE."metabase_interface.php");
            require(PATH_METABASE."metabase_database.php");
            require(PATH_METABASE."metabase_manager.php");

            $variaveis=array();

            //---------------------------------------------------------------------------
            //Se a defini��o do esquema da sua base de dados precisa de valores de
            //vari�veis definidos no momento de instala��o, defina esses valores aqui.
            //No esquema de exemplo acima n�o foram usadas quaisquer vari�veis.
            //Portanto, a lista de vari�veis foi definida como um array vazio.
            //---------------------------------------------------------------------------

            $argumentos=array(
            "Type"=>"mysql",
            "User"=> XOOPS_DB_USER ,
            "Password"=> XOOPS_DB_PASS,
            "Host"=> XOOPS_DB_HOST ,
            "IncludePath"=> PATH_METABASE
            );

            $gestor=new metabase_manager_class;
            $sucesso=$gestor->UpdateDatabase( $filename_tmp ,$filename_antes_tmp, $argumentos, $variaveis);

            if(!$sucesso) {
                echo "<div class='errorMsg'> Error: ".$gestor->error. "</div>";
            }else  {

               	echo "<div class='confirmMsg'> "._MD_XMAIL_UPDATE23."</div>";
               	if (!copy($filename,$filename_antes)) {
                    $gestor->error[]="Falha na copia de $filename para $filename_antes , verifique as permiss�es da pasta ";
               	}

            }

            //---------------------------------------------------------------------------
            //Se o procedimento de instala��o falhou,
            //exiba a mensagem de erro para determinar o que ocorreu mal.
            //---------------------------------------------------------------------------

            if(count($gestor->warnings)>0) {
                echo "<div class='errorMsg'>" ,"<br> AVISO:\n",implode($gestor->warnings,"!\n"),"\n";
                echo " </div>";
            }

            }else {

                echo "<div class='errorMsg'>  "._MD_XMAIL_UPDATE_FALHOU. "</div>";
          }
       }else {
                echo "<div class='errorMsg'>  "._MD_XMAIL_UPDATE_FALHOU. "</div>";
       }
       @unlink($filename_tmp);
       @unlink($filename_antes_tmp);

       echo upgrade_extra();

//---------------------------

    include_once(XOOPS_ROOT_PATH."/footer.php");
}

function install_header(){
 global $modversion;
?>
<div style='text-align:center'><img src="<?php echo $modversion['image']?>" /><h4>Upgrade</h4>
<?php
	echo "
    <table width='100%' border='0'>
    <tr>
    <td align='center'><b>"._MD_XMAIL_UPDATE."</b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    </table>";

}


 function troca_var($filename,$filename_tmp,$origem="",$destino="") {

   //-----------------------------------------------------------------------------------------
   // Abre arquivo $filename  e processa trocando conte�do  da matriz $origem pela $destino
   // e grava novo arquivo $filename_tmp
   // $origem deve ser matriz o mesmo n�mero de linhas que $destino
   // cada �ndice da $origem  deve corresponder ao �ndice da $destino
   //-----------------------------------------------------------------------------------------

 if (empty($filename) or empty($filename_tmp) or empty($origem) or empty($destino)  ) {
       return false;
 }

 if (count($origem) != count($destino) ) {
     return false;
 }

 // ler o arquivo , colocando cada linha na matriz $linhas
 if($id_arq=@fopen($filename,"r")) {
    while(!feof($id_arq)) {
            $linhas[]=fgets($id_arq,300);
    }
    fclose($id_arq);
 }else {
       echo "<script>alert('N�o foi poss�vel abrir script de cria��o do banco $filename , verifique as permiss�es da pasta');</script>";
       return false;
 }

  //  trocar  variaveis $origem por $destino gerando arquivo $filename_tmp

  if($id_arq=@fopen($filename_tmp,"w")) {
      for($i=0;$i<count($linhas);$i++) {
          for($i2=0;$i2<count($origem);$i2++) {
             $linhas[$i]=ereg_replace($origem[$i2], $destino[$i2] ,$linhas[$i]);
          }
          fputs($id_arq,$linhas[$i]);
      }
      fclose($id_arq);
  }
  else {
     echo "<script>alert('Falha na gera��o do $filename_tmp , verifique as permiss�es da pasta ');</script>";
     return false;
  }
  return true;
}
?>
