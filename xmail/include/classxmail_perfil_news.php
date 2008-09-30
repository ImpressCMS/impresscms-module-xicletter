<?php
/*
* $Id: include/classxmail_perfil_news.php
* Module: XMAIL
* Version: v2.5
* Release Date: 06 Julho  2007
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/
 
class classxmail_perfil_news{
   var $user_id;
   var $id_perf;

   function  classxmail_perfil_news() { 
      $this->user_id='';
      $this->id_perf='';

   }  // fecha function principal   
   function  incluir() { 
      global  $xoopsDB,$men_erro ; 
      if($this->validar("I")) { 
         $sql = "INSERT INTO ".$xoopsDB->prefix("xmail_perfil_news");
         $sql.="(user_id,id_perf)";
         $sql.=" VALUES (";
         $sql.= "'". $this->user_id."',";
         $sql.= "'". $this->id_perf."')";
         $result= $xoopsDB->queryF($sql);
         if(!$result) {
            $men_erro=$xoopsDB->error();
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
         $sql = "UPDATE ".$xoopsDB->prefix("xmail_perfil_news")." SET  " ;
         $sql.= "user_id='$this->user_id',";
         $sql.= "id_perf='$this->id_perf'"; 
         $sql.= " where user_id='$this->user_id' "; 
          $result= $xoopsDB->queryF($sql);
         if(!$result) {
            $men_erro=$xoopsDB->error();
          	return false;
         }
         return true;
      }else {
         return false;

      } // fecha if validar   
   } // fecha function alterar 
   function  excluir() { 
      global  $xoopsDB, $men_erro  ; 
      if($this->validar("E")) { 
         $sql = "DELETE FROM  ".$xoopsDB->prefix("xmail_perfil_news");
         $sql.= " where user_id='$this->user_id'  and id_perf=$this->id_perf   "; 
          $result= $xoopsDB->queryF($sql);
         if(!$result) {
            $men_erro=$xoopsDB->error();
          	return false;
         }
         return true;
      }else {
         return false;

      } // fecha if validar   
   } // fecha function excluir  
   function  busca() { 
      global  $xoopsDB  ; 
         $sql = "SELECT * FROM  ".$xoopsDB->prefix("xmail_perfil_news");
         $sql.= " where user_id='$this->user_id' "; 
          $result= $xoopsDB->queryF($sql);
         if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
          	return false;
         }
         $cat_data = $xoopsDB->fetcharray($result) ;
         $this->user_id=$cat_data["user_id"];
         $this->id_perf=$cat_data["id_perf"];
         return true;

   } // fecha function busca  
   function  selecionar() { 
      global  $xoopsDB   ; 
      $PHP_SELF=$_SERVER["PHP_SELF"];
      $sql = "SELECT perf.descri_perf,news.user_name,tab.user_id,tab.id_perf FROM  ".$xoopsDB->prefix("xmail_perfil_news").' as tab 
      left join '.$xoopsDB->prefix('xmail_newsletter').' as news on news.user_id=tab.user_id 
      left join '.$xoopsDB->prefix('xmail_tabperfil').' as perf on perf.id_perf=tab.id_perf 
      where tab.user_id='.$this->user_id;
      
       $result= $xoopsDB->queryF($sql);
      if(!$result ) {
         xoops_error('Error: '.$xoopsDB->error());
         return ;
      }

       
       if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
         xoops_error(_AM_XMAIL_NAOHAPERF.' id:'.$_GET['user_id']);
      }
      else   {
         echo "<table border='1' rules='cols' cellpadding='0' cellspacing='0' align='center'>";
         echo "	<tr class='head'> ";
         $reg_p_page=30;
         if(!isset($_GET['regstart'])) {
            if(!isset($_SESSION[$PHP_SELF]['regstart'])) {
               $regstart=0;
            }else {
               $regstart=$_SESSION[$PHP_SELF]['regstart'];
            }
         }else {
            $regstart=$_GET['regstart'];
         }
         $_SESSION[$PHP_SELF]['regstart']=$regstart;
         $regfim = $regstart+$reg_p_page;
         $totreg = $xoopsDB->getRowsNum($result);
         $arg=elimina_parm("regstart");    
         $nav = new XoopsPageNav($totreg, $reg_p_page, $regstart, "regstart", $arg);
         echo "<td align=center >"._AM_XMAIL_ID ."</td>";
         echo "<td align=center >"._AM_XMAIL_ASSINANTES."</td>";
         echo "<td align=center > "._AM_XMAIL_ID.'.'._AM_XMAIL_PERFIL."</td>";
         echo "<td align=center > "._AM_XMAIL_PERFIL." </td>";
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
            echo "<td >".$cat_data['user_id']."</td>";
            echo "<td >".$cat_data['user_name']."</td>";
            echo "<td >".$cat_data['id_perf']."</td>";
            echo "<td >".$cat_data['descri_perf']."</td>";
            

            //echo "<td align='center'>  <a href=\"$PHP_SELF?opt=A&user_id=".$cat_data['user_id']. "\"><img src='".XOOPS_URL."/modules/xmail/images/Alterar.bmp' border='0'>       </a>&nbsp;";
            echo "<td align='center'>";
            echo " <a  href=\"$PHP_SELF?opt=E&user_id=".$cat_data['user_id']."&id_perf=".$cat_data['id_perf']."  \"> <img src='".XOOPS_URL."/modules/xmail/images/RECYFULL.BMP' border='0'>      </a>";
            echo "  </td>";
            echo "  </tr>";
            } // fecha if da paginação  
            $i++;
         }
         echo "</table>";
         echo "<p align='center' >".$nav->renderNav(4)." </p>"; 
         }
         if(isset($_POST['user_id'])){
         	$userid=$_POST['user_id'];
         }else{
         	$userid=$_GET['user_id'];
         }
         echo "<p  align='center' class='footer' ><a href=\"$PHP_SELF?opt=I&user_id=".$userid."\"> Incluir</a>";
   } // fecha function selecionar  
 }// fecha class 
?>