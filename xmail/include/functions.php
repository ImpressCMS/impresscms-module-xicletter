<?php
/*
* $Id: include/functions.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

$IconArray = array(

     "css.gif"		  => "css",
     //"ico.gif"		  => "ico",
     "doc.gif"		  => "doc",
     "html.gif"       => "html htm shtml htm",
     "pdf.gif"        => "pdf",
     "txt.gif"        => "conf sh shar csh ksh tcl cgi",
     "php.gif"        => "php php4 php3 phtml phps",
     "js.gif"         => "js",
     "sql.gif"        => "sql",
     "pl.gif"         => "pl",
     "gif.gif"     	  => "gif",
     "png.gif"     	  => "png",
     "bmp.gif"     	  => "bmp",
     "jpg.gif"        => "jpeg jpe jpg",
     "c.gif"          => "c cpp",
     "rar.gif" 	  	  => "rar",
     "zip.gif" 	  	  => "zip tar gz tgz z ace arj cab bz2",
     "mid.gif"        => "mid kar",
     "wav.gif"        => "wav",
     "wax.gif"        => "wax",
     "xm.gif"         => "xm",
     "ram.gif"        => "ram",
     "mpg.gif"        => "mp1 mp2 mp3 wma",
     "mp3.gif"        => "mpeg mpg mov avi rm",
     "exe.gif"     	  => "exe com dll bin dat rpm deb",
     "txt.gif"        => "txt ini xml xsl ini inf cfg log nfo ico",
);


    function envia_xmails($mail_subject,$mail_body,$dest='',$mail_start=0,$mail_fromname='',$mail_fromemail='',$mail_send_to='' ,$id_men=0,$grvlog=1,$lote,$email_conf='',$is_new=0) {
          global $xoopsUser,$xoopsDB;
          // $grvlog=1  indica para gravar na tabela de log xmail_send_log
          // $grvlog=1  indication for logging in table xmail_send_log
          // is_new=1   indica que é uma newsletter. Necessário para resgatar dados dos
          //            usuários a partir da tabela xmail_newsletter
          //            echo "<pre>";
          //            var_dump($dest);
          //            echo "</pre>";
          //            return;
          //
          
//          $arqlog=XOOPS_ROOT_PATH."/modules/xmail/upload/xmail_erros.log";
          $dt_envio=time();
          if(empty($mail_send_to)) {
            redirect_header("index.php?op=form",2,_MD_XMAIL_ERRMAILSEND);
          }
   	      if (empty($dest) ) {
            redirect_header("index.php?op=form",2,_MD_XMAIL_NOTSEL);
          }

          if(empty($mail_subject) or empty($mail_body) ) {
              if($id_men>0) {
                // localizar mensagem / find message
                $result = $xoopsDB->query("SELECT subject_men, body_men ,dohtml ,dobr,body_men_text  FROM ".$xoopsDB->prefix("xmail_mensage")." where id_men=".$id_men );
                if($result) {
                    $query_data = mysql_fetch_array($result, MYSQL_ASSOC);
                    $mail_subject = $query_data["subject_men"] ;
                    $mail_body =stripslashes($query_data["body_men"]) ;
                } else  {
                      redirect_header("index.php?op=form",2,_MD_XMAIL_ERRCADMEN);
                }
              }else  {
                   if(empty($mail_subject) or empty($mail_body) )
                      redirect_header("index.php?op=form",2,_MD_XMAIL_ERRMENNOTSEL);
              }
          }


          if(empty($mail_fromname)) {
              $mail_fromname=$xoopsUser->getVar('email');
          }

          if(empty($mail_fromemail)) {
              $mail_fromemail=$xoopsUser->getVar('email');
          }

          if(!is_array($dest)) {
             $dest=explode(",",$dest);
          }

         
		$added = array();
		$added_id = array();

		//  pegar de parametros  xmail_param / get parameters xmail_param
        $param= new classparam();
   
        $arqlog=XOOPS_ROOT_PATH."/".$param->dir_upload."/xmail_erros.log";  
           
           
        $quant_envia=$param->envia_xmails;
		// para saber se a execução é via http  ou  linha de comando 
        $browser=(isset($_SERVER['HTTP_USER_AGENT']) ? 1 : '') ;
		//echo ' veja browser  ',$browser;
        if(!$is_new) {
	//		$mail_end = ($added_count > ($mail_start + $quant_envia)) ? ($mail_start + $quant_envia) : $added_count;
        	
        	foreach ($dest  as $to_user) {
    			if ( !in_array($to_user, $added_id) ) {
    				$added[] = new XoopsUser($to_user);
    				$added_id[] = $to_user;
    			}
    		}
   			$total_reg=count($added);
		    
   			
   			//if(empty($browser)) {
   				// indica que está executando php pela linha de comando e deve enviar todo o lote
   				//$mail_end=$total_reg;
   			//}else{
   			 //  $mail_end = ($total_reg > ($mail_start + $quant_envia)) ? ($mail_start + $quant_envia) : $total_reg;
   			//}

			$mail_end = ($total_reg > ($mail_start + $quant_envia)) ? ($mail_start + $quant_envia) : $total_reg;   			
   			
        }else {
		   // montar objeto xoopsuser com dados da tabela xmail_newsletter
           
		   $lista_id=implode(',',$dest);
		   $sql='select * from  '.$xoopsDB->prefix('xmail_newsletter')." where confirmed=1 and user_id in($lista_id)  " ;
           $result=$xoopsDB->queryf($sql);
           if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
               redirect_header(XOOPS_URL."/modules/xmail/index.php",2,_MD_XMAIL_NOTASSIN.' '._MD_XMAIL_LOTE.$lote);
           }else {
               //include_once 'grvlog.php';  
				$total_reg=$xoopsDB->getRowsNum($result);
//		        if(empty($browser)) {
//   					// indica que está executando php pela linha de comando e deve enviar todo o lote
//   					$mail_end=$total_reg;
//		        }else{
//		        	$mail_end = ($total_reg > ($mail_start + $quant_envia)) ? ($mail_start + $quant_envia) : $total_reg;
//		        }
	           	  
               $mail_end = ($total_reg > ($mail_start + $quant_envia)) ? ($mail_start + $quant_envia) : $total_reg;

               $i=0;
               while ($cat_data = $xoopsDB->fetcharray($result)){ ;
				
//				grvlog('upload/testecla.txt',$cat_data['user_name']."\n");
				if($i >= $mail_start and  $i < $mail_end){				

                $added_id[]=$cat_data['user_id'];
                $user_obj= new XoopsUser();
                $user_obj->assignVar('uid', $cat_data['user_id']);
                $user_obj->assignVar('name', $cat_data['user_name']);
                $user_obj->assignVar('uname',$cat_data['user_nick'] );
                $user_obj->assignVar('email',$cat_data['user_email']);
                $added[] =$user_obj;
                }else {
					$added[] ='';            	
                }	
                $i++;
              }
           }
		}
        $added_count = count($added);

       
		if ( $added_count > 0 ) {
	//		$mail_end = ($added_count > ($mail_start + $quant_envia)) ? ($mail_start + $quant_envia) : $added_count;
			$myts =& MyTextSanitizer::getInstance();
			$xoopsMailer =& getMailer();

			$xoopsMailer->setFromName($myts->oopsStripSlashesGPC($mail_fromname));
 			$xoopsMailer->setFromEmail($myts->oopsStripSlashesGPC($mail_fromemail));
			$xoopsMailer->setSubject($myts->oopsStripSlashesGPC($mail_subject));

            //$xoopsMailer->multimailer->ContentType="text/html";
            $xoopsMailer->multimailer->IsHTML(1) ;
			// setar o return-path (versões da phpmailer anteriores a 1.70  não setavam..)
	        // 14/06/07  inserido escapeshellcmd  devido vulnerabilidade da classe phpmailer.
	        // conforme relatado:  http://larholm.com/2007/06/11/phpmailer-0day-remote-execution/
			$xoopsMailer->multimailer->Sender=escapeshellcmd($myts->oopsStripSlashesGPC($mail_fromemail));
						            
            // texto alternativo para quem não aceita  html
            $xoopsMailer->multimailer->AltBody=$query_data['body_men_text'] ;           
            
            $xoopsMailer->multimailer->ConfirmReadingTo=$email_conf;

            $email_to_pm=array();  // guardar os id de usuarios que receberão pm ao invez de mail
            // anexar arquivos
            $classfiles= new classfiles();
            $arqs=$classfiles->array_anexos($id_men);
            for($i=0;$i<count($arqs);$i++) {
                $xoopsMailer->multimailer->AddAttachment($arqs[$i]['file']);
            }
            
                $array_mail=array(); // usuários que receberão email
                $array_pm=array();   // usuários que receberão mensagem particular

        	for ( $i = $mail_start; $i < $mail_end; $i++) {
                $objuser= $added[$i];

              	if( (in_array("pref", $mail_send_to) and $objuser->getVar('notify_method')==2) or
                    (!in_array("pref", $mail_send_to) and  in_array("mail", $mail_send_to)) or $is_new    ) {
                    if($param->veri_mailok==0) {
                       if($objuser->getVar('user_mailok')) {
                           $array_mail[]=$added[$i];
                      }else {
                           // enviar para mensagem particular
                            $array_pm[]=$added[$i];
                            $email_to_pm[]=$added_id[$i];
               				$xoopsMailer->errors[] = sprintf(_MD_XMAIL_NOTMAILOK,$objuser->getVar('uname') );
                       }
                    }else{
						if($objuser->getVar('user_mailok')) {
                           $array_mail[]=$added[$i];
                        }else {
                        	$xoopsMailer->errors[] = sprintf(_MD_XMAIL_NOTMAILOK2,$objuser->getVar('uname') );
                        }

                    }
                }
                if( (in_array("pref", $mail_send_to) and $objuser->getVar('notify_method')==1) or
                    (!in_array("pref", $mail_send_to) and  in_array("pm", $mail_send_to))    ) {

                     if(!in_array($added_id[$i],$email_to_pm)) {
                       $array_pm[]=$added[$i];
                       
                     }
                }
               	if( (in_array("pref", $mail_send_to) and $objuser->getVar('notify_method')==0)){
       				$xoopsMailer->errors[] = sprintf(_MD_XMAIL_NOTDEFPREF,$objuser->getVar('uname') );
               	}
            }

                if(count($array_mail)>0) {

               		$xoopsMailer->toUsers = array();
                    for ( $i = 0; $i < count($array_mail); $i++) {
                       	$xoopsMailer->setToUsers($array_mail[$i]);
        			}

                	$xoopsMailer->setBody($myts->displayTarea($mail_body,$query_data["dohtml"],1,1,1,$query_data['dobr']  ));
    				$xoopsMailer->isMail=true;
                    $xoopsMailer->isPM=false;
        			$xoopsMailer->send(true);
                }
                
                if(count($array_pm)>0) {
                    $mail_body=inc_anexos_pm($mail_body,$arqs);
                    $xoopsMailer->toUsers = array();

        			for ( $i = 0; $i < count($array_pm); $i++) {
                        $objuser= $array_pm[$i];
                       	$xoopsMailer->setToUsers($objuser);
        			}

                	$xoopsMailer->setBody($mail_body);
    				$xoopsMailer->isMail=false;
                    $xoopsMailer->isPM=true;
        			$xoopsMailer->send(true);
                }
               	echo $xoopsMailer->getSuccess();
               	$erros_encontrados= $xoopsMailer->getErrors();
               	echo $erros_encontrados;
				// guardar erros em arquivo tipo texto de log
				if( !empty($erros_encontrados))   {
				grvlog($arqlog,
    "\nEm ".date('d/m/Y H:i')." Módulo Xmail -  rotina :".$_SERVER['SCRIPT_FILENAME']."\n".
    "Lote:$lote  Cod.Mensagem :$id_men - Erros encontrados: ".$erros_encontrados);     	
				}
           	
               	
               	$lista_users=array();
                for($i=0;$i<count($xoopsMailer->toUsers);$i++) {
                $obj_user=$xoopsMailer->toUsers[$i];

                if(trecho_in_array($obj_user->getVar('uname'),$xoopsMailer->success)) {
                    $sql=  "INSERT INTO  ".$xoopsDB->prefix("xmail_send_log")." (id_user,id_men,dt_envio,is_user_news)
                     values ('".$obj_user->getVar('uid')."','".$id_men."','".$dt_envio."',$is_new)";
                    $result = $xoopsDB->queryf( $sql) ;
                    if(!$result) {
                         echo "<div class='errorMsg' >"._MD_XMAIL_ERRGRVLOG. "$sql  </div> ";
                         grvlog($arqlog,"\n"._MD_XMAIL_ERRGRVLOG.$sql );
                    } else {
                      // montar array com usuários para eliminar dos lotes
                      $lista_users[]=$obj_user->getVar('uid');
                    }

                 }else  {

                 }

            } // fecha for / close for
            // eliminar da tabela de lote
            if(count($lista_users)>0) {
               $obj_lote= new  classxmail_aux_send();
               $obj_lote->lote_solicit=$lote;
               if(!$obj_lote->excluir(0,$lista_users)){
                  echo "<div class='errorMsg' >".sprintf(_MD_XMAIL_ERREXCUSER,$lote.' - '.$men_erro)." </div> ";
                  grvlog($arqlog,"\n".sprintf(_MD_XMAIL_ERREXCUSER,$lote.' - '.$men_erro));
               }
            }
            //mudar data de agendamento do lote para mais 1 dia, para dar tempo de
               // verificar os que não foram enviados e não entrar em loop
               $obj_lote_pai=new classxmail_aux_send_l();
               $obj_lote_pai->lote_solicit=$lote;
               if(!$obj_lote_pai->set_agenda(time()+(60*60*24))){
                  echo "<div class='errorMsg' >".sprintf(_MD_XMAIL_ERRSETAGENDA,$lote.' - '.$men_erro)." </div> ";
                  grvlog($arqlog,"\n".sprintf(_MD_XMAIL_ERRSETAGENDA,$lote.' - '.$men_erro));
              	
               }

            //  fim da gravação do log / end of logging

            // atualizar no cadastro da mensagem data de envio
            // update sent date in message record
            if(count($xoopsMailer->success)>0) {
                $result = $xoopsDB->queryf("UPDATE ".$xoopsDB->prefix("xmail_mensage")." set date_envio='$dt_envio' where id_men='$id_men'");
                if(!$result) {
                     echo "<div class='errorMsg' >"._MD_XMAIL_ERRDTENV." </div> ";
                     grvlog($arqlog,"\n"._MD_XMAIL_ERRDTENV.' - '.$xoopsDB->error());
                }

            }
			
            if(!empty($browser) ) {
			if (  $added_count > $mail_end ) {
				if(ereg('send_agenda.php',xoops_getenv('PHP_SELF'))){
					// indica que é envio agendado, não deve solicitar formulário
					//$url=xoops_getenv('PHP_SELF').'?mail_start='.$mail_end;
					$url=xoops_getenv('PHP_SELF');
					echo "<script>window.location.href='$url'</script>";					
				}else{
					$form = new XoopsThemeForm(_MD_XMAIL_SENDTO, "mailusers",$_SERVER['PHP_SELF'] );
					$submit_button = new XoopsFormButton("", "mail_submit", _MD_XMAIL_NEXT , 'submit' );
					$sent_label = new XoopsFormLabel(_MD_XMAIL_ENVIADO, sprintf(_MD_XMAIL_SENTNUM, $mail_start+1, $mail_end, $added_count));
					$start_hidden = new XoopsFormHidden("mail_start", $mail_end);
					$lote_hidden = new XoopsFormHidden("lote", $lote);
					$op_hidden = new XoopsFormHidden("op", "send");
					$dest_hidden= new XoopsFormHidden("dest", implode(',',$dest));
					$form->addElement($sent_label);
					$form->addElement($start_hidden);
					$form->addElement($lote_hidden);
					$form->addElement($dest_hidden);
					$form->addElement($op_hidden);
					$form->addElement($submit_button);
					$form->display();

				}
    			
			} else {
				echo "<h4>"._MD_XMAIL_SENDCOMP."</h4>";
			}
            }else{
            	// não deve ser rechamado, pois estará sendo executado em loop 
            	// O que pode falhar, seria criar lotes com um X nro.e agendar  e depois
            	// antes de disparar os lotes alterar os parâmetros com um nro. menor.
            	// os ítens restantes ficariam pendentes até a próxima chamada.
            	
            	//$script =$_SERVER['argv'][0];				
            	//echo ' vou rechamar veja script ',$script;
            	//$path=dirname($script);
				//exec("php -f  $script >>$path/log_agendamento.txt    ");           	
            }
       } else {
              	echo "<h4>".MD_XMAIL_NOTSEL."</h4>";
       }


}

 function inc_anexos_pm($mail_body,$arqs) {
    if(count($arqs)>0) {
       $mail_body.="\n\n" ;
       $mail_body.="[img align=left]".XOOPS_URL."/modules/xmail/images/icon/download.gif [/img] "._MD_XMAIL_ANEXOS."\n";
        for($i=0;$i<count($arqs);$i++) {
             $mail_body.="\n[url=".XOOPS_URL."/modules/xmail/download.php?fileid=".$arqs[$i]['fileid']."]".$arqs[$i]['filerealname']."[/url]";
        }
     }
    return $mail_body;
 }


function xmaillinks(){
    global $isadmin;
    echo "<table width='100%' border='0' cellspacing='1' cellpadding='2' class = outer>";
    echo "<tr><th class = 'bg3' colspan = '3'  >" . _MD_XMAIL_HEADLINK . "</th></tr>";
    echo "<tr>";
    echo " <td class = 'even'><a href='index.php?op=form'>" . _MD_XMAIL_ENV . "</a></td>";
    echo " <td class = 'odd'>" . _MD_XMAIL_ENV2. "</td>";
    echo "</tr>";

    echo "<tr>";
    echo " <td width='24%' class = 'even'><a href='gerencia.php'>" . _MD_XMAIL_ADM . "</a></td>";
    echo " <td class = 'odd'>" . _MD_XMAIL_ADM2. "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td class = 'even'><a href='./submit.php?op=add'>" . _MD_XMAIL_CAD . "</a></td>";
    echo "<td class = 'odd'>" . _MD_XMAIL_CAD2 . "</td>";
    echo "</tr>";

    if($isadmin) {
        echo "<tr>";
        echo "<td class = 'even'><a href='gerencia.php?op=apr'>" . _MD_XMAIL_APROV . "</a></td>";
        echo "<td class = 'odd'>" . _MD_XMAIL_APROV2 . "</td>";
        echo "</tr>";
    }
    

    echo "<tr>";
    echo "<td class = 'even'><a href='verlog.php'>" . _MD_XMAIL_LOG . "</a></td>";
    echo "<td class = 'odd'>" . _MD_XMAIL_LOG2 . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td class = 'even'><a href='gerencia_lote.php'>" ._MD_XMAIL_LOTES_P . "</a></td>";
    echo "<td class = 'odd'>" . _MD_XMAIL_LOTES_P2 . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td class = 'even'><a href='sendnews.php'>" ._MD_XMAIL_SENDNEWS. "</a></td>";
    echo "<td class = 'odd'>" . _MD_XMAIL_SENDNEWS2  . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td class = 'even'><a href='verlog_news.php'>" ._MD_XMAIL_LOGNEWS. "</a></td>";
    echo "<td class = 'odd'>" . _MD_XMAIL_LOGNEWS2  . "</td>";
    echo "</tr>";

    echo "</table>";
}

function myTextForm2($url , $value)
{
	return '<form action="'.$url.'" method="post"><input type="submit" value="'.$value.'" /></form>';
}


function trecho_in_array($var,$array_var) {
 // verifica se $var esta em algum trecho dentro da matriz $array_var
 // checks whether $var is present inside the array $array_var
    $retorno=false;
    for($i=0;$i<count($array_var);$i++) {
        if(substr_count($array_var[$i],$var) >0)
           return true ;
    }
    return $retorno ;
    }



function getcorrectpath($path){
if(file_exists(XOOPS_ROOT_PATH."/".$path)) {
        $ret = "      "._AM_XMAIL_PATHEXIST." ";
        }else{
    $ret = "      "._AM_XMAIL_PATHNOTEXIST." ";
        }
return $ret;
}

 function acerta_array($mat="" )  {
   if (!is_array($mat)) {
      return false;
   } else {
   $mat_key=array_keys($mat);
   for ($i=0;$i<count($mat);$i++) {
        $mat[$mat_key[$i]]="(".$mat_key[$i].") ".$mat[$mat_key[$i]];
   }
   return $mat;

   }
}

function get_icon($file)        ## Get the icon from the filename
{
 global $IconArray;

 reset($IconArray);

 $extension = strtolower(substr(strrchr($file, "."),1));

 if ($extension == "")
  return "unknown.gif";

 while (list($icon, $types) = each($IconArray))
  foreach (explode(" ", $types) as $type)
   if ($extension == $type)
    return $icon;

 return "unknown.gif";
}


function PrettySize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ("%01.2f",$size/$mb) . " MB";
    }
    elseif ( $size >= 1024 ) {
        $mysize = sprintf ("%01.2f",$size/1024) . " KB";
    }
    else {
        $mysize = sprintf(_MD_XMAIL_NUMBYTES,$size);
    }
    return $mysize;
}


function show_preview($subject_men,$body_men)  {

           echo "<table  border='1'  bgcolor='ffffff'  > "  ;
           echo "<tr><td style='color: #000000' ><b>$subject_men </b> </td></tr> ";

           echo "<tr><td>   </td></tr> ";
           echo "<tr><td style='color: #000000' >". $body_men." </td></tr> ";

 }


function getGroupIda_xmail($grps) {
	$ret = array();

	if (!is_array($grps)) {
		$ret = explode(" ", $grps);
	}
	return $ret;
}

function saveAccess_xmail($grps) {
	if ( is_array($grps) ) { $grps = implode(" ", $grps); }
	return($grps);
}


// nova versão 2.0

function get_novo_lote() {
   global $xoopsDB;
   $sql='select max(lote_solicit) as lote from '.$xoopsDB->prefix('xmail_aux_send_l') ;
   $result=$xoopsDB->queryf($sql);
   if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
    	return false;
   }
   $cat_data = $xoopsDB->fetcharray($result) ;
   return $cat_data['lote']+1;

}

function envia_xmails_lote($lote,$dest='',$mail_start=0) {
   // resgatar os dados gravados no lote $lote
   // $dest -> lista de usuários separados por vírgula, se não for informado, deverá resgatar
   // todos do lote
   global $xoopsDB;
   $class_l= new classxmail_aux_send_l() ;
   $class_l->lote_solicit=$lote;
   $class_l->busca();
   $mail_send_to=explode(',',$class_l->mail_send_to);
   if(empty($dest)){
      $dest=implode(",",$class_l->array_users);
   }
        
   envia_xmails('','',$dest,$mail_start,$class_l->mail_fromname,$class_l->mail_fromemail,$mail_send_to,$class_l->id_men,1,$lote,$class_l->email_conf,$class_l->is_new);
 }

function envia_email_ativa($touser,$user_logado ,$xoopsConfigUser,$xoopsConfig) {
    //Enviando email de ativação de conta
// $touser => objeto xoopsuser do usuario destinatário, pode ser array com vários objetos

     if(is_array($touser)) {
       	foreach ($touser  as $user) {
            envia_email_ativa($user,$user_logado ,$xoopsConfigUser,$xoopsConfig);
       }// fecha foreach
       return;
     }


    require_once(XOOPS_ROOT_PATH.'/modules/xmail/include/class_ativacao.php');
    $classativa= new Xmail_ativacao();

    $classativa->dt_envio=time();
    $classativa->user_logado=$user_logado;
    $classativa->activation_type= $xoopsConfigUser['activation_type'] ;

    $tentativas=$classativa->get_tentativas();

    $xoopsMailer =& getMailer();
    $xoopsMailer->useMail();
    $xoopsMailer->setTemplateDir(XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/mail_template/");

	if ($xoopsConfigUser['activation_type'] == 0) {

        $xoopsMailer->setTemplate('register.tpl');
        $xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
        $xoopsMailer->assign('ADMINMAIL', $xoopsConfig['adminmail']);
        $xoopsMailer->assign('SITEURL', XOOPS_URL."/");
        $xoopsMailer->assign('TENTATIVAS', $tentativas);
        $xoopsMailer->setToUsers($touser);
        $xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
        $xoopsMailer->setFromName($xoopsConfig['sitename']);
        $xoopsMailer->setSubject(sprintf(_US_USERKEYFOR, $touser->getVar("uname")   ));

        	if ( !$xoopsMailer->send(true) ) {
                xoops_error($xoopsMailer->getErrors());
                return;
           	} else {
                xoops_result(sprintf(_MD_XMAIL_REENVIO_OK,$touser->getVar("uname")));
                if(!$classativa->incluir($touser)) {
                   xoops_error(_MD_XMAIL_ERRORSAVINGDB ."<br>".$men_erro);
                }
                return;
        	}
    } elseif ($xoopsConfigUser['activation_type'] == 2) {
   			$xoopsMailer->setTemplate('adminactivate.tpl');
    			$xoopsMailer->assign('USERNAME',$touser->getVar('uname') );
    			$xoopsMailer->assign('USEREMAIL',$touser->getVar('email')  );
    			$xoopsMailer->assign('USERACTLINK', XOOPS_URL.'/user.php?op=actv&id='.$touser->getVar('uid').'&actkey='.$touser->getVar('actkey'));
    			$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
    			$xoopsMailer->assign('ADMINMAIL', $xoopsConfig['adminmail']);
    			$xoopsMailer->assign('SITEURL', XOOPS_URL."/");
                $xoopsMailer->assign('TENTATIVAS', $tentativas);
    			$member_handler =& xoops_gethandler('member');
    			$xoopsMailer->setToGroups($member_handler->getGroup($xoopsConfigUser['activation_group']));
    			$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
    			$xoopsMailer->setFromName($xoopsConfig['sitename']);
    			$xoopsMailer->setSubject(sprintf(_US_USERKEYFOR,$touser->getVar("uname")));

    			if ( !$xoopsMailer->send(true) ) {
                    xoops_error($xoopsMailer->getErrors()."<br>". sprintf(_MD_XMAIL_ERRENVIOLINK, _MD_XMAIL_ADMIN ));
                    return;
    			} else {
                    xoops_result(sprintf(_MD_XMAIL_REENVIO_OK,_MD_XMAIL_ADMIN));
                    if(!$classativa->incluir($touser)) {
                       xoops_error(_MD_XMAIL_ERRORSAVINGDB ."<br>".$men_erro);
                    }
                   return;
    			}
     }
 }



function &xmail_getTextareaForm($xmail_form, $caption, $name, $value = "", $rows = 25, $cols = 60)
{
	switch(strtolower($xmail_form)){
		case "textarea":
			$form = new XoopsFormTextArea($caption, $name, $value, $rows, $cols);
			break;
		case "dhtml":
		default:
			$form = new XoopsFormDhtmlTextArea($caption, $name, $value, $rows, $cols);
			break;
	}

	return $form;
}

/**
 * Calcular qtd de emails no lote $lote
 *
 * @param int  $lote
 */
function calc_emails_nolote($lote){
	global $xoopsDB;
	$sql='select count(id_user) as tot  from '.$xoopsDB->prefix('xmail_aux_send').
	' where lote_solicit='.$lote.'  group by lote_solicit';
	$result=$xoopsDB->queryf($sql);
	if(!$result or $xoopsDB->getRowsNum($result)==0 ) {
		return 0;	
	}
	$cat_data = $xoopsDB->fetcharray($result);
	return $cat_data['tot'];
	
}


/**
 * Validar email sintaticamente e domínio 
 *
 * @param string  $email
 * @param bool  $dns  true verifica dns  ou  false  não verifica
 */

function xmail_valida_email($email,$dns=false){
// carrega arquivo  do pacote do PEAR 
require_once XOOPS_ROOT_PATH.'/modules/xmail/include/Validate.php';

list($userName, $mailDomain) = split("@", $email); 
$valido=Validate::email($email) ;// validar so sintaxe

if($valido and $dns){
	if(function_exists('checkdnsrr')) {	
		$valido=Validate::email($email,true) ;// validar sintaxe e domínio
	}else{	
	    $valido=xmail_myCheckDNSRR($mailDomain);	
	}
}
return $valido;
	
}

function xmail_myCheckDNSRR($hostName, $recType = '')
{
 if(!empty($hostName)) {
   if( $recType == '' ) $recType = "MX";
   exec("nslookup -type=$recType $hostName", $result);
   // check each line to find the one that starts with the host
   // name. If it exists then the function succeeded.
   foreach ($result as $line) {
     if(eregi("^$hostName",$line)) {
       return true;
     }
   }
   // otherwise there was no mail handler for the domain
   return false;
 }
 return false;
}    



function elimina_parm($param) {
 // Eliminar $param de  ($_SERVER['argv'])
 // retorna uma string
 // útil para gerar string em barra de navegação
   global $_SERVER;

   $linha='';
	$linha.=$_SERVER['QUERY_STRING'];
  

   $arg2=explode("&",$linha );
   for($i=0;$i<count($arg2);$i++) {
   	if(ereg("^$param",$arg2[$i]))  {
   		array_splice($arg2, $i ,1);
   		$i=0;
   	}
   }
 return implode("&",$arg2);

 }

 /**
     // function get_array_tab
     // retornar array para adicionar em select de form
     // $table = tabela a ser pesquisada
     // $id =  id do campo
     // $descri = descric?o
     // $where =  clausula where do select
     // $todos -> se =1 ter? ?ndice =0 e legenda ='todos'
     // $mostra_id -> se =1 , a legenda conter? o id + descri??o ($id+$descri)
	// $orderd -> 1 ordenar pela descri??o  0 = ordenar pelo id
     
*/

 
   function get_array_tab($table,$id,$descri,$where='',$todos=0,$mostra_id=0,$orderd=1) {
     global $xoopsDB;
            $sql = "SELECT $id,$descri  FROM ".$table;
            if(!empty($where)) {
               $sql.=' where '.$where;
            }
            $sql.=' order by ';
            if ($orderd)
                $sql.= $descri;
            else 
                $sql.= $id ;

            $result= $xoopsDB->queryf($sql);

            if(!$result) {
                $matriz[0]='Erro na sql ';
                 echo $sql ;
            } else {
        		if($todos)
            		$matriz[0]=_ALL;
            		
            	if($xoopsDB->getRowsNum($result)>0) {
                    while($cat_data=$xoopsDB->fetcharray($result)) {
                        if($mostra_id)
                    	   $matriz[$cat_data[$id]]=$cat_data[$id] .'-'.$cat_data[$descri];
                    	else
                    	   $matriz[$cat_data[$id]]=$cat_data[$descri];
                    	
                    }
                } else {
                    $matriz[0]="não ha registros";
                }
            }
            
            return $matriz;
    }


?>
