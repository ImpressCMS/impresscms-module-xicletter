<?php 
/*
* $Id: admin/manut_xmail_tabperfil.php
* Module: XMAIL
** Version: v2.5
* Release Date: 18 Set 2006
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

include "admin_header.php";

require_once XOOPS_ROOT_PATH.'/kernel/module.php';
include_once XOOPS_ROOT_PATH."/class/pagenav.php";
$nomeclass= 'classxmail_tabperfil';
include XOOPS_ROOT_PATH.'/modules/xmail/include/'."{$nomeclass}.php";
$classmanut = new $nomeclass ;

        if (!empty($_POST)) {
           $var= extract($_POST);
        } elseif (!empty($_POST)) {
            $var=  extract($_POST);
        }

        if (!empty($_GET)) {
           $var=extract($_GET) ;
        } 
        
Opentable();        
        ?>
<center>


<table >
	<tr class='head' >
        <td align="center" valign="bottom" >
            <?php echo _AM_XMAIL_ADMPERUSER?>
			<?php echo ($opt=="I") ? '::'._AM_XMAIL_INCLUSAO : (($opt=="A") ? '::'._AM_XMAIL_ALTERACAO : (($opt=="M") ? "::" : (($opt=="L") ? " " : "")))?>
		</td>
    </tr>
</table>

<?php
switch($opt) {
   case "EG":		// Excluir
      $classmanut->id_perf = $id_perf;
      if($classmanut->excluir()) 
         xoops_result(_AM_XMAIL_SAVEOK);
      else 
         xoops_error(_AM_XMAIL_ERRORSAVINGDB);
      break; 
case 'AG':
   $classmanut->id_perf=$id_perf;
case "IG":
   $classmanut->descri_perf=$descri_perf; 
   if($opt=="IG") {
      if($classmanut->incluir())
         xoops_result(_AM_XMAIL_SAVEOK);
      else {
         xoops_error(_AM_XMAIL_ERRORSAVINGDB .' - '. $men_erro );
         $opt="I";
         break;
      }
   }else {
      if($classmanut->alterar())
         xoops_result(_AM_XMAIL_SAVEOK);
      else
         xoops_error(_AM_XMAIL_ERRORSAVINGDB .' - '. $men_erro   );
      }
   $opt="";
   break;
} // fecha switch
switch($opt) {
   case "A":		// Alterar dados
      $classmanut->id_perf=$id_perf;
      if(!$classmanut->busca()) {
         xoops_error(_AM_XMAIL_ERRBUSCA );
         break;
      }
      $descri_perf=$classmanut->descri_perf;
   case "I":		// Incluir 
      $sform = new XoopsThemeForm('', "storyform", xoops_getenv('PHP_SELF')."?opt={$opt}G" );
      $sform->addElement(new XoopsFormText(_AM_XMAIL_DESCRIPERF,'descri_perf',60,60,$descri_perf));
      // vari�veis ocultas (hidden)
      if($opt=="A") { 
         $sform->addElement(new XoopsFormHidden("id_perf",$id_perf));
      }
      $sform->addElement( new XoopsFormButton('', "post", "enviar", "submit") );
      $sform->display();
      break;
   case "E": // Confirmar p/ Excluir 
      echo "<div class=\"confirmMsg\">";
      echo "<h4>Para excluir o perfil  - $id_perf clique  ";
      echo "<a href='".$_SERVER['PHP_SELF']."?opt=EG&id_perf=$id_perf' >aqui</a>  ";
      echo "</h4></div>";
      $opt="";
      break;
   default:		// Selecionar  
      echo "<br />";
      $classmanut->selecionar();
   } 
echo ($opt!="") ? "<p align=\"center\"><a href='".$_SERVER['PHP_SELF']."'>Voltar</a></p>" : "";

echo "</center>";
CloseTable();
xoops_cp_footer();
?>

