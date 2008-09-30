<?php
/*
* $Id: admin/xmail_busca_assinantes.php
* Module: XMAIL
** Version: v2.5
* Release Date: 11  Julho  2007
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/
// usado com Ajax para localizar assinantes de newsletter 
// user_name  user_nick  user_email


include("../../../mainfile.php");
include '../../../include/cp_header.php';
header("Content-Type: text/html;  charset=ISO-8859-1",true) ;
ob_end_flush();


$var=$_POST['localiza'];
$sql=' select * from '.$xoopsDB->prefix('xmail_newsletter').
" where user_name  like '%$var%'  or  user_nick like '%$var%' or user_email like '%$var%'  ";
$result=$xoopsDB->query($sql);
if(!$result){
	echo "<ul><li>Erro na sql</li></ul>";
}else{
	$lista='<ul>';
	while ($cat_data=$xoopsDB->fetcharray($result)){
		$lista.="<li>".$cat_data['user_id'].'-'.$cat_data['user_name'].'('.$cat_data['user_nick'].')'.' '.$cat_data['user_email']."</li>\n";
	}
	$lista.="</ul>";
	echo $lista;	
}

?>