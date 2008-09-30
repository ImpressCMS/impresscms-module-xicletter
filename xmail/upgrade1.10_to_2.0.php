<?php
/*
* $Id: UPGRADE1.10_to_2.0.php
* Module: XMAIL
 Version: v2.0
* Release Date: 18 Mar�o 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/

include("upgrade.php");

function upgrade_extra() {
   // aqui deve entrar altera��es que n�o � poss�vel no esquema do metabase
   $retorno='';
   global $xoopsDB;
   $sql='alter table '.$xoopsDB->prefix('xmail_tabperfil').' ADD PRIMARY KEY (id_perf) ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ";
   }
   $sql='alter table '.$xoopsDB->prefix('xmail_tabperfil').' CHANGE id_perf  id_perf int(11) NOT NULL AUTO_INCREMENT ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ";
   }
   
   $sql='alter table '.$xoopsDB->prefix('xmail_newsletter').' ADD PRIMARY KEY (user_id) ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ";
   }
   $sql='alter table '.$xoopsDB->prefix('xmail_newsletter').' CHANGE user_id user_id int(11) NOT NULL AUTO_INCREMENT ';
   $result=$xoopsDB->queryf($sql);
   if(!$result) {
      $retorno.=" <br> Err: $sql ";
   }

   return $retorno;

}


?>
