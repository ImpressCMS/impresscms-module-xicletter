<?php
/*
* $Id: upgrade2.0_to_2.5.alpha.php
* Module: XMAIL
 Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/

include("upgrade.php");

function upgrade_extra() {
   // aqui deve entrar alterações que não é possível no esquema do metabase
   $retorno='';
   global $xoopsDB;
   $sql='alter table '.$xoopsDB->prefix('xmail_aux_send_l').
   ' ADD dt_agenda int(10) default 0 not null   ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ".$xoopsDB->error();
   }

   $sql='alter table '.$xoopsDB->prefix('xmail_send_log').
   ' ADD is_user_news tinyint(1) default 0 not null   ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ".$xoopsDB->error();
   }
   
   $sql='alter table '.$xoopsDB->prefix('xmail_param').
   ' ADD minutos_intervalo tinyint(2) NOT NULL default 0 ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ".$xoopsDB->error();
   }

	$sql='alter table '.$xoopsDB->prefix('xmail_param').
   ' ADD lotes_por_hora tinyint(3) NOT NULL default 0 ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ".$xoopsDB->error();
   }

   
   
   
   
   return $retorno;

   
   
     

   
   
   
   
}


?>
