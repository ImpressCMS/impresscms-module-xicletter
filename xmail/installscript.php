<?php
/*
* $Id: installscript.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

function xoops_module_install_xmail($module)  {
  // copiar arquivo de esquema dos dados (em xml) antes da instalação.
  // copy file scheme data (XML) before instaltion
   $dir_array=$module->getVars('dirname');
   $dirname= $dir_array['dirname']['value'];
  $file=XOOPS_ROOT_PATH."/modules/".$dirname."/table_".$dirname."_esquema.xml";
  if (!copy($file, $file.'.antes')){
     //return false ;
  }else{
     //return true;
  }   
  // verificar se pasta uploads/xmail ja existe, para cria-la   
     
  $dirupload=XOOPS_ROOT_PATH.'/uploads/'.$dirname;
  if(!is_dir($dirupload)) {
      if(!mkdir("$dirupload", octdec(0770))) {
            return false; 
       }
   }
  
   return true;
  	
  	
  } 
  
  
?>
