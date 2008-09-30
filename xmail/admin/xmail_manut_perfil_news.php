<?php 
/*
* $Id: admin/xmail_manut_perfil_news.php
* Module: XMAIL
* Version: v2.5
* Release Date: 06 de julho de 2007 
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

include "admin_header.php"; 
include_once XOOPS_ROOT_PATH."/class/pagenav.php";
$nomeclass= 'classxmail_perfil_news';
include XOOPS_ROOT_PATH."/modules/xmail/include/{$nomeclass}.php";
$classmanut = new $nomeclass ;
$user_id=$_GET['user_id'];


$men_erro='';
$mat_post_vars=array('id_perf','user_id');
foreach ($mat_post_vars as $k => $v) {
   if(isset($_POST[$v])){
   	  ${$v}= $_POST[$v];
   }
	
}
$user_array=get_array_tab($xoopsDB->prefix('xmail_newsletter'),'user_id','user_name',"user_id=$user_id");
$user_name=$user_array[$user_id];
?>
<table  align="center"   >	<tr class='head' > <td align="center" valign="bottom" >
Administração de Perfis do Assinante <?php echo "$user_id - $user_name " ?>
<?php // echo ($opt=="I") ? "::Inclusão" : "::Alteração" ?>
		</td> </tr>
</table>
<?php

 $classmanut->user_id = $user_id;
$opt=$_GET["opt"];
switch($opt) {
   case "EG":		// Excluir
      $classmanut->user_id = $user_id;
      $classmanut->id_perf = $_GET['id_perf'] ;
      
      if($classmanut->excluir()) 
         xoops_result("Registro excluido com sucesso!");
      else 
         xoops_error("Não foi possivel excluir o registro ");
      break; 
case 'AG':
   $classmanut->user_id=$user_id;
case "IG":
   $classmanut->user_id=$user_id; 
   $classmanut->id_perf=$id_perf; 
   if($opt=="IG") {
      if($classmanut->incluir())
         xoops_result('Registro  incluido com Sucesso!!!');
      else {
         xoops_error("Ocorreu um erro na Inclusão !! " .$men_erro ); 
         $opt="I";
         break;
      }
   }else {
      if($classmanut->alterar())
         xoops_result(" Dados alterados com sucesso");
      else
         xoops_error("Não foi possivel alterar os Dados ! $men_erro");
         $opt="A";
      }
} // fecha switch
switch($opt) {
   case "A":		// Alterar dados
      $classmanut->user_id=$user_id;
      $classmanut->id_perf = $_GET['id_perf'] ;
      if(!$classmanut->busca()) {
         xoops_error('Erro na busca !!!');
         break;
      }
      $id_perf=$classmanut->id_perf;
   case "I":		// Incluir 
      $sform = new XoopsThemeForm('Informe os Dados ', "storyform", xoops_getenv('PHP_SELF')."?opt={$opt}G" );
  //    $sform->addElement(new XoopsFormLabel('Id do Assinante ',$user_id));
      $sform->addElement(new XoopsFormHidden('user_id',$user_id));
      $objperfil=new XoopsFormSelect('Selecione o Perfil','id_perf',$id_perf);
      $objperfil->addOptionArray(get_array_tab($xoopsDB->prefix('xmail_tabperfil'),'id_perf','descri_perf'));
      
      $sform->addElement($objperfil);
      
      
      // variáveis ocultas (hidden)
  //    if($opt=="A") { 
    //     $sform->addElement(new XoopsFormHidden("user_id",$user_id));
//      }
      $sform->addElement( new XoopsFormButton('', "post", "enviar", "submit") );
      $sform->display();
      break;
   case "E": // Confirmar p/ Excluir 
   		$id_perf=$_GET['id_perf'];
      echo "<div class=\"confirmMsg\">";
      echo "<h4>Para excluir  user_id  - $user_id e id_perf - $id_perf clique  ";
      echo "<a href='".$_SERVER['PHP_SELF']."?opt=EG&user_id=$user_id&id_perf=$id_perf ' >aqui</a>  ";
      echo "</h4></div>";
      $opt="";
      break;
   default:		// Selecionar  
      $classmanut->selecionar();
   } 
echo ($opt!="") ? "<p align=\"center\"><a href='".$_SERVER['PHP_SELF']."?user_id=$user_id'>Voltar</a></p>" : "";
//include(XOOPS_ROOT_PATH."/footer.php");
//echo ($opt!="") ? "<p align=\"center\"><a href='gerencia_news.php?action=rem_user&xmenu=".$_GET['xmenu']."&xsubmenu=".$_GET['xsubmenu']."'>Voltar p/ Assinantes</a></p>" : "";
echo  "<p align=\"center\"><a href='gerencia_news.php?action=rem_user&xmenu=".$_GET['xmenu']."&xsubmenu=".$_GET['xsubmenu']."'>Voltar p/ Assinantes</a></p>" ;

xoops_cp_footer();
?>