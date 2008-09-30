<?php
// Claudia Antonini Vitiello Callegari
//  fazer teste
set_time_limit(0);
// troca.php

//echo " dei return  para n�o executar...  ";
//return;
$origem[]= 'vers�o 1.11';
$destino[]= 'vers�o 2.0';


// extens�es v�lidas
//$ext_valid[]='*' ; // todos arquivos
$ext_valid[]='php';
$ext_valid[]='inc';
$ext_valid[]='txt';

$dirpath=$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
$arq_log="trocas.log";
$faz_troca=true ;  // indica se far� troca ou so registrar� no log
$case_sensitive=true ;  // indica se usar� fun��o ereg_replace (true) ou eregi_replace( false)
$tot_trocas=0;
//   $extension='.tmp';
$extension='';   // se definido gerar� outro arquivo com a extens�o definida
$gravalog=true;  // indica se gravar� arquivo de log ou n�o

//global $tot_trocas ;
$funcao= ($case_sensitive) ? "ereg_replace" : "eregi_replace" ;

$alt= ($faz_troca) ? "Alterou " : "N�o alterou";



require("grvlog.php");

if($gravalog)
    grvlog($arq_log,"\n".str_repeat("-", 80)."\n Log gerado em ".date("d-m-Y")." pelo script ".$_SERVER['PHP_SELF'])."\n" ;
ler($dirpath,$origem,$destino);
if($gravalog)
   grvlog($arq_log," \n - Total de trocas: ".$tot_trocas);


function troca_var($filename,$filename_tmp,$origem="",$destino="") {
     global $arq_log,$funcao,$alt,$tot_trocas,$faz_troca,$gravalog;
     global $ext_valid;
  // Abre arquivo $filename  e processa trocando conte�do  da matriz $origem pela $destino
  // e grava novo arquivo $filename_tmp
 // $origem deve ser matriz o mesmo n�mero de linhas que $destino
 // cada �ndice da $origem  deve corresponder ao �ndice da $destino


 if(basename($filename)==basename($_SERVER['PHP_SELF']) or basename($filename)==$arq_log or basename($filename)=='grvlog.php'  ) {
//     echo "<script>alert('N�o alterar o script em execu��o ou o log de erros')</script> ";
     return false;
 }
  $_arq= explode('.',basename($filename));
  $ext_arq=$_arq[count($_arq)-1];

  if( !in_array($ext_arq,$ext_valid) and !in_array('*',$ext_valid)) {
      echo "<br> Extens�o n�o v�lida  $ext_arq ";
       return false;
  }

 if (empty($filename) or empty($filename_tmp) or empty($origem) or empty($destino)  ) {
     echo "<script>alert('variaveis vazias ')</script> ";
     echo "<b> veja as vars ", $filename,$filename_tmp,$origem,$destino ,"</b>";
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
       echo "<script>alert('N�o foi poss�vel abrir $filename ');</script>";
       return false;
 }

  //  trocar  variaveis $origem por $destino gerando arquivo $filename_tmp
  if($id_arq=@fopen($filename_tmp,"w")) {
      for($i=0;$i<count($linhas);$i++) {
          for($i2=0;$i2<count($origem);$i2++) {
             $antes=$linhas[$i];
//             $depois= eregi_replace($origem[$i2], $destino[$i2] ,$linhas[$i]);
             $depois= $funcao($origem[$i2], $destino[$i2] ,$linhas[$i]);
             if($faz_troca) {
                $linhas[$i]=$depois;
             }
             if($antes!=$depois) {
                if($faz_troca) {
                   $tot_trocas++;
                }
                $output= "\n".$filename_tmp."\n ".$alt." linha $i: Antes: ".$antes." Depois: ".$depois;
                if($gravalog)
                   grvlog($arq_log,$output) ;
             }
             
          }
          fputs($id_arq,$linhas[$i]);
      }
      fclose($id_arq);
  }
  else {
     echo "<script>alert('Falha na gera��o do $filename_tmp ');</script>";
     return false;
  }
  return true;
}



function ler($file,$origem,$destino ) {
global $extension;
if (is_dir($file)) {
 $handle = opendir($file);
 while($filename = readdir($handle)) {
  if ($filename != "." && $filename != "..") {
     ler($file."/".$filename,$origem,$destino);
  }
 }
  closedir($handle);
// echo "<br> <br> ver dir ",($file);
} else {
   if(!troca_var($file,$file.$extension,$origem,$destino)) {
        echo "falhou troca em $file ";
   }

//  echo "<br> ver  arq ",($file);
}
}







?>
