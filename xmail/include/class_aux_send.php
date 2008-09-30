<?php
/*
* $Id: include/class_aux_send.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/


 /*
 Script gerado automaticamente pelo /gera-manutencao/gera-manutencao.php versão 1.0
* autor: Claudia Antonini Vitiello Callegari   claudia@foxbrasil.com.br 
* Data: 17/01/2005 12:42:31
* classxmail_aux_send.php 
 
*/ 
 
//   alterar  conforme necessidade montar integrigade referencial entre as 2 tabelas
//  de forma que quando eliminou todos detalhes de um lote,  eliminar o cabeçalho do lote

// montar função para selecionar os itens com junção das duas tabelas

// incluir linhas detalhes conforme $this->array_users...

class classxmail_aux_send_l{   // registro de cabeçalho do lote
   var $lote_solicit;
   var $id_men;
   var $user_logado;
   var $dt_solicit;
   var $email_conf;
   var $mail_fromname;
   var $mail_fromemail;
   var $mail_send_to;
   var $array_users;  // matriz com os usuários a serem inclusos na outra classe  classxmail_aux_send
   var $is_new;
   var $dt_agenda;

   function  classxmail_aux_send_l() {
      $this->lote_solicit='';
      $this->id_men;
      $this->user_logado='';
      $this->dt_solicit;
      $this->email_conf='';
      $this->mail_fromname='';
      $this->mail_fromemail='';
      $this->mail_send_to='';
      $this->array_users='';
      $this->is_new=0;
      $this->dt_agenda=0;

   }  // fecha function principal
   function  incluir() {
      global  $xoopsDB,$men_erro ;
      if($this->validar("I")) {
         $sql = "INSERT INTO ".$xoopsDB->prefix("xmail_aux_send_l");
         $sql.="(lote_solicit,id_men,user_logado,dt_solicit,email_conf,mail_fromname,mail_fromemail,mail_send_to,is_new,dt_agenda)";
         $sql.=" VALUES (";
         $sql.= "'". $this->lote_solicit."',";
         $sql.= "'". $this->id_men."',";
         $sql.= "'". $this->user_logado."',";
         $sql.= "'". time() ."',";
         $sql.= "'". $this->email_conf."',";
         $sql.= "'". $this->mail_fromname."',";
         $sql.= "'". $this->mail_fromemail."',";
         $sql.= "'". $this->mail_send_to."',";
         $sql.= "'". $this->is_new."',";
         $sql.= "'". $this->dt_agenda."')";
         
                  
         $result= $xoopsDB->queryF($sql);
         if(!$result) {
           	return false;
         }
         // incluir linhas detalhes conforme $this->array_users...
         $tem_err=0;
//          if(count($this->array_users)>0) {
//             $obj_filho=new  classxmail_aux_send();
//             for($i=0;$i<count($this->array_users);$i++) {
//                $obj_filho->lote_solicit=$this->lote_solicit;
//                $obj_filho->id_user=$this->array_users[$i];
//                if(!$obj_filho->incluir()) {
//                   $men_erro.=sprintf(_MD_XMAIL_ERRINCLOTEUSER, $obj_filho->id_user,$obj_filho->lote_solicit)."<br>";
//                   $tem_err=1;
//                }
//             }
//
//          }

		// inserir todos filhos em uma so query para otimizar
          if(count($this->array_users)>0) {
             $obj_filho=new  classxmail_aux_send();
			 $obj_filho->lote_solicit=$this->lote_solicit;
             if(!$obj_filho->incluir_array($this->array_users)){
			     $men_erro.=sprintf(_MD_XMAIL_ERRINCLOTEUSER, 'array',$obj_filho->lote_solicit)."<br>";
                 $tem_err=1;
             }
          }


         if($tem_err)
            return false;
         else
            return true;
            
      }else {
         return false;

      } // fecha if validar
   } // fecha function incluir
   function validar($opt) {
      global $men_erro;
      // inserir codigo para validar campos...
	  // validar $this->mail_fromemail
		if($this->id_men==0){
	  	 $men_erro= _MD_XMAIL_SELMEN; 
	  	 return false;	  	
		}
	  
	  
	  
	  if(!xmail_valida_email($this->mail_fromemail)){
	  	 $men_erro=sprintf(_MD_XMAIL_EMAILINVALIDO,$this->mail_fromemail );
	  	 return false;	  	
	  }
      return true;
   }  // fecha function validar

   function  excluir() {
      global  $xoopsDB, $men_erro , $_GET ;
      // esta função será chamada automaticamente , quando se solicitar excluir todos os ítens

         $sql = "DELETE FROM  ".$xoopsDB->prefix("xmail_aux_send_l");
         $sql.= " where lote_solicit='$this->lote_solicit' ";
          $result= $xoopsDB->queryF($sql);
         if(!$result) {
          	return false;
         }
         return true;
   } // fecha function excluir


   function  busca() {
      global  $xoopsDB  ;
         $sql = "SELECT * FROM  ".$xoopsDB->prefix("xmail_aux_send_l");
         $sql.= " where lote_solicit='$this->lote_solicit' ";
          $result= $xoopsDB->queryF($sql);
         if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
          	return false;
         }
         $cat_data = $xoopsDB->fetcharray($result) ;
         $this->id_men=$cat_data["id_men"];
         $this->user_logado=$cat_data["user_logado"];
         $this->dt_solicit=$cat_data["dt_solicit"];
         $this->email_conf=$cat_data["email_conf"];
         $this->mail_fromname=$cat_data["mail_fromname"];
         $this->mail_fromemail=$cat_data["mail_fromemail"];
         $this->mail_send_to=$cat_data["mail_send_to"];
         $this->is_new =$cat_data["is_new"];
         // pegar array de usuários
         $sql=' select * from '.$xoopsDB->prefix("xmail_aux_send");
         $sql.= " where lote_solicit='$this->lote_solicit' ";
         $result= $xoopsDB->queryF($sql);
         if(!$result  ) {
          	return false;
         }
         if($xoopsDB->getRowsNum($result)>0) {
            while( $cat_data = $xoopsDB->fetcharray($result) ) {
               $this->array_users[]=$cat_data['id_user'] ;
            }
         }
         return true;
   } // fecha function busca

   
   function set_agenda($time){
   	global  $xoopsDB,$men_erro ;
   	$sql='update '.$xoopsDB->prefix("xmail_aux_send_l")." set dt_agenda=$time";
    $sql.= " where lote_solicit='$this->lote_solicit' ";
    $result= $xoopsDB->queryF($sql);
    if(!$result) {
		$men_erro=$xoopsDB->error();
    	return false;
    }
    return true;
   	
   }
   
   
   
   
   
   
   
 }// fecha class



class classxmail_aux_send{   // registros de detalhes do lote
   var $id_user;
   var $lote_solicit;

   function  classxmail_aux_send() { 
      $this->id_user='';
      $this->lote_solicit='';

   }  // fecha function principal   
   function  incluir() { 
      global  $xoopsDB,$men_erro ; 
      if($this->validar("I")) { 
         $sql = "INSERT INTO ".$xoopsDB->prefix("xmail_aux_send");
         $sql.="(id_user,lote_solicit)";
         $sql.=" VALUES (";
         $sql.= "'". $this->id_user."',";
         $sql.= "'". $this->lote_solicit."')";
         $result= $xoopsDB->queryF($sql);
         if(!$result) {
          	return false;
         }
         return true;
      }else {
         return false;
      } // fecha if validar
   } // fecha function incluir   

   
   	function incluir_array($array_users){
   		global $xoopsDB,$men_erro;
   		$totusers=count($array_users);
   		if($totusers>0){
			$sql = "INSERT INTO ".$xoopsDB->prefix("xmail_aux_send");
         	$sql.="(id_user,lote_solicit)";
         	$sql.=" VALUES ";			
   			$values='';
   			for($i=0;$i<$totusers;$i++){
   				if($i>0) $values.=',';
   				$values.='('.$array_users[$i].','.$this->lote_solicit.')';
   			}
			$sql.=$values;
	        $result= $xoopsDB->queryF($sql);
    	    if(!$result) {
				$men_erro=$xoopsDB->error();	
    	     	return false;
         	}
         	return true;
   		}

   	}
   
   
   
   
   
   
   
   
   function validar($opt) {
      global $men_erro;
      // inserir codigo para validar campos...

      return true;
   }  // fecha function validar 


   function  excluir($opt=0,$array_users=array()) {
      global  $xoopsDB, $men_erro , $_GET ; 
      // $opt -> 0 ou  1  indica se excluirá todos do lote  ou so 1 item
      //         1 excluirá todos  0 não excluirá todos
      // $array_users =>  array com id dos users a ser excluído do lote $this->lote_solicit
      // se $opt==0  e $array_users for enviado, excluirá todos users do array

         $sql = "DELETE FROM  ".$xoopsDB->prefix("xmail_aux_send");
         if($opt==0) {
            if(count($array_users)==0) {
              $sql.= " where id_user='$this->id_user'  and lote_solicit='$this->lote_solicit' ";
            } else {
               $lista_users=implode(',',$array_users);
               $lista_users='('.$lista_users.')';
               $sql.= " where id_user in $lista_users  and lote_solicit='$this->lote_solicit' ";
            }

         }else {
            $sql.= " where lote_solicit='$this->lote_solicit' ";
         }
         $result= $xoopsDB->queryF($sql);

         if(!$result) {
         	$men_erro=$xoopsDB->error();
          	return false;
         }

         // verficar se não ha mais filhos  ou se ($opt==1 excluir todos filhos ) e excluir o pai também
         $sql= 'select * from '. $xoopsDB->prefix("xmail_aux_send")." where lote_solicit='$this->lote_solicit' ";
         $result= $xoopsDB->queryF($sql);

         if(!$result  ) {
            $men_erro=sprintf(_MD_XMAIL_ERRHEAD.' x', $this->lote_solicit);
            return false;
         }
         if($xoopsDB->getRowsNum($result)==0  or $opt==1 ) {
            $objlote= new classxmail_aux_send_l();
            $objlote->lote_solicit=$this->lote_solicit;
            if(!$objlote->excluir()) {
                $men_erro=sprintf(_MD_XMAIL_ERRHEAD, $this->lote_solicit);
                return false;
            }

         }

         return true;

      } // fecha if validar
   } // fecha function excluir  

   function  busca() { 
      global  $xoopsDB  ; 
         $sql = "SELECT * FROM  ".$xoopsDB->prefix("xmail_aux_send");
         $sql.= " where id_user='$this->id_user' ";
          $result= $xoopsDB->queryF($sql);
         if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
          	return false;
         }
         $cat_data = $xoopsDB->fetcharray($result) ;
         $this->id_user=$cat_data["id_user"];
         $this->lote_solicit=$cat_data["lote_solicit"];
         return true;

   } // fecha function busca  

?>