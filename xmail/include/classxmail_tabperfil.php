<?php
/*
* $Id: include/classxmail_tabperfil.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

 
class classxmail_tabperfil{
   var $id_perf;
   var $descri_perf;

   function  classxmail_tabperfil() { 
      $this->id_perf='';
      $this->descri_perf='';

   }  // fecha function principal   
   function  incluir() { 
      global  $xoopsDB,$men_erro ; 
      if($this->validar("I")) { 
         $sql = "INSERT INTO ".$xoopsDB->prefix("xmail_tabperfil");
         $sql.="(descri_perf)";
         $sql.=" VALUES (";
         $sql.= "'". $this->descri_perf."')";
         $result= $xoopsDB->queryF($sql);
         if(!$result) {
          	return false;
         }
         return true;
      }else {
         return false;

      } // fecha if validar   
   } // fecha function incluir   
   function validar($opt) {
      global $men_erro;
      // inserir codigo para validar campos...

      return true;
   }  // fecha function validar 
   function  alterar() { 
      global  $xoopsDB, $men_erro  ; 
      if($this->validar("A")) { 
         $sql = "UPDATE ".$xoopsDB->prefix("xmail_tabperfil")." SET  " ;
         $sql.= "descri_perf='$this->descri_perf'"; 
         $sql.= " where id_perf='$this->id_perf' "; 
          $result= $xoopsDB->queryF($sql);
         if(!$result) {
          	return false;
         }
         return true;
      }else {
         return false;

      } // fecha if validar   
   } // fecha function alterar 
   function  excluir() { 
      global  $xoopsDB, $men_erro , $_GET ; 
      if($this->validar("E")) { 
         $sql = "DELETE FROM  ".$xoopsDB->prefix("xmail_tabperfil");
         $sql.= " where id_perf='$this->id_perf' "; 
          $result= $xoopsDB->queryF($sql);
         if(!$result) {
             return false;
         }
         return true;
      }else {
         return false;

      } // fecha if validar   
   } // fecha function excluir  
   function  busca() { 
      global  $xoopsDB  ; 
         $sql = "SELECT * FROM  ".$xoopsDB->prefix("xmail_tabperfil");
         $sql.= " where id_perf='$this->id_perf' "; 
          $result= $xoopsDB->queryF($sql);
         if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
          	return false;
         }
         $cat_data = $xoopsDB->fetcharray($result) ;
         $this->id_perf=$cat_data["id_perf"];
         $this->descri_perf=$cat_data["descri_perf"];
         return true;

   } // fecha function busca  
   function  selecionar() { 
      global  $xoopsDB   ; 
      $PHP_SELF=$_SERVER["PHP_SELF"];
      $sql = "SELECT tab.* ,count(perf.user_id) as totu FROM  ".$xoopsDB->prefix("xmail_tabperfil").' as tab ';
	  $sql.= " left join ".$xoopsDB->prefix("xmail_perfil_news").' as perf on tab.id_perf=perf.id_perf ';
      $sql.= " group by tab.id_perf order by  tab.id_perf  "; 
      
       $result= $xoopsDB->queryF($sql);

       if(!$result ) {
         xoops_error(_AM_XMAIL_ERRBUSCA.' - '.$xoopsDB->error() );
         return;
      }
       
       
       if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
         xoops_error(_AM_XMAIL_NOTHAREG);
      }
      else   {
         echo "<table border='1' rules='cols' cellpadding='0' cellspacing='0' align='center'>";
         echo "	<tr class='head'> ";
         $reg_p_page=30;
         $regstart = isset($_GET['regstart']) ? intval($_GET['regstart']) : 0;
         $regfim = $regstart+$reg_p_page;
         $totreg = $xoopsDB->getRowsNum($result);
         $arg="" ;// exemplo: "cpf=$cpf&nome=$nome&op=enviar"; // arqumento (variaveis passadas por get )complementar para chamar a pagina
         $nav = new XoopsPageNav($totreg, $reg_p_page, $regstart, "regstart", $arg);
         echo "<td align=center >"._AM_XMAIL_ID."</td>";
         echo "<td align=center > "._AM_XMAIL_DESCRIPERF."</td>";
         echo "<td align=center > "._AM_XMAIL_ASSINANTES." </td>";
         echo "<td align=center > "._AM_XMAIL_OPT." </td>";
         
         echo "	</tr>";
         $i=0;
         while ($cat_data = $xoopsDB->fetcharray($result)) {
            if($i>=$regstart  and $i<$regfim) {
            if(($i%2)==0) {
               echo "<tr class='even' >";
            }else {
               echo "<tr  class='odd'>";
            } 
            echo "<td  >".$cat_data['id_perf']."</td>";
            echo "<td >".$cat_data['descri_perf']."</td>";
            echo "<td  align=center ><a href=\"gerencia_news.php?action=rem_user&xmenu=5&xsubmenu=1&idperf=".$cat_data['id_perf']. "\" title='"._AM_XMAIL_VERASSINANTES."'  > ".$cat_data['totu']."</a></td>";
            
            
            
            //http://localhost/x2018/modules/xmail/admin/gerencia_news.php?action=rem_user&xmenu=5&xsubmenu=1
            
            
            echo "<td ><a href=\"$PHP_SELF?opt=A&id_perf=".$cat_data['id_perf']. "\"><img src='".XOOPS_URL."/modules/xmail/images/Alterar.bmp' border='0'></a>&nbsp;";
            echo " <a  href=\"$PHP_SELF?opt=E&id_perf=" .$cat_data['id_perf'] . "\"><img src='".XOOPS_URL."/modules/xmail/images/RECYFULL.BMP' border='0'></a>";
            echo "  </td>";
            echo "  </tr>";
            } // fecha if da paginação  
            $i++;
         }
         echo "</table>";
         echo "<p align='center' >".$nav->renderNav(4)." </p>"; 
         }
         echo "<p  align='center' class='footer' ><a href=\"$PHP_SELF?opt=I\"> Incluir</a>";
         echo"</table>\n";
   } // fecha function selecionar  

   function get_user_perf($id_user) {
    // retorna array com o perfil de um usuário
    global $xoopsDB;
    $retorno=array();
    $sql='select * from '.$xoopsDB->prefix('xmail_perfil_news').' where user_id="'.$id_user.'"';
    $result=$xoopsDB->queryf($sql);
    if($result) {
      while ($cat_data = $xoopsDB->fetcharray($result)) {
         $retorno[]=$cat_data['id_perf'];
      }
    }
    return $retorno;
   }

 function get_tab_perf($add='') {
    // retorna array com tabela de perfil
    // $add => caracter para adicionar no final da descrição
    //       usado para adicionar <br> qdo. precisar no xoopsform....
    global $xoopsDB;
    $retorno=array();
    $sql='select * from '.$xoopsDB->prefix('xmail_tabperfil');
    $result=$xoopsDB->queryf($sql);
    if($result) {
      while ($cat_data = $xoopsDB->fetcharray($result)) {
        if($cat_data['system']!=1) {
      	   $retorno[$cat_data['id_perf']]=$cat_data['descri_perf']."$add" ;
       }
      }
    }
    return $retorno;
   }


  function get_id_from_email($email) {
     // recupera o user_id da tabela xmail_newsletter
     // a partir do email
      global $xoopsDB;
    $sql='select * from '.$xoopsDB->prefix('xmail_newsletter'). " where user_email='$email'";
    $result=$xoopsDB->queryf($sql);

    if($result) {
       $cat_data = $xoopsDB->fetcharray($result);
       return $cat_data['user_id'] ;
    }
    else {
         echo 'erro na query ',$sql;
       return 0;
    }
  }
  
   function exclui_user($user_id) {
     global $xoopsDB;
     $sql='delete from '.$xoopsDB->prefix('xmail_perfil_news').' where user_id="'.$user_id.'"';
     $result=$xoopsDB->queryf($sql);
     if(!$result)
         echo "Err sql : $sql";

   }

   function get_lista_perf($lista_perfil='') {
    global $xoopsDB;
    $retorno="";
    $sql='select * from '.$xoopsDB->prefix('xmail_tabperfil')." where id_perf in ($lista_perfil) " ;
    $result=$xoopsDB->queryf($sql);
    if($result) {
      while ($cat_data = $xoopsDB->fetcharray($result)) {
         $retorno.=$cat_data['descri_perf']." - " ;
      }
    }
    return $retorno;
   
   
   
   }

 } // fecha class

?>


