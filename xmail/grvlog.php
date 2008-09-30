<?php
// grvlog.php
//      Function: GrvLog - Grava Log em arquivos TEXTOS padrÆo ASCII
//      Function: GrvLog - SAve Log file TEXT default ASCII

Function GrvLog($LogArqnome="", $writeStr="") {
//  $LogArqnome=  nome do arquivo a ser gravado - FileName for save
// $writeStr=  string a ser gravada no final do arquivo - string for save in end file.

if ($LogArqnome=="" or  $writeStr=="") {
   echo "Falta parametros para gravar arquivo de log "; // falta traduzir   - no translation
   echo "veja    $LogArqnome  -  $writeStr" ; //falta traduzir - no translation
    return false;
}

$LogHand = fopen($LogArqnome, 'a+') ;
if($LogHand){
	fputs($LogHand,$writeStr);
	fclose($LogHand);
	return true;
} else {
	return false ;
}

}
?>