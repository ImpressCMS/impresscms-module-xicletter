<?php
/*
* $Id: gerencia.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/
$nomenu=1;
include("header.php");

include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");

$op ='';

foreach ($_POST as $k => $v) {
	${$k} = $v;
}

foreach ($_GET as $k => $v) {
	${$k} = $v;
}

if (isset($_GET['op'])) $op=$_GET['op'];
if (isset($_POST['op'])) $op=$_POST['op'];

if ( isset($_POST['post']) ) $op = 'post';
if ( isset($_POST['upload']) ) $op = 'upload';


    $param= new classparam();


if ( $xoopsUser ) {
   // Even the regular user can access, but gets to see only his own messages
 	if ( ! $isadmin and ( $op=='apr' or $op=='apr_exe' or $op=='desapr' )) {
		redirect_header(XOOPS_URL."/",3,_NOPERM);
		exit();
	}
} else {
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}


if($op=='apr')  {
    $result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("xmail_mensage")." where aprovada=0 ORDER BY id_men ");
    if (mysql_num_rows($result) == '0') {
    	//redirect_header(XOOPS_URL."/modules/xmail/submit.php?op=add", '1' , _MD_XMAIL_NOTMENAPROV);
    	redirect_header(XOOPS_URL."/modules/xmail/", '1' , _MD_XMAIL_NOTMENAPROV);
    }
    $totmen= mysql_num_rows($result);
}else {
    $sql="SELECT * FROM ".$xoopsDB->prefix("xmail_mensage");
    if(!$isadmin) {
        $sql.=" where  uid= ".$xoopsUser->getvar('uid');
    }
    
    
    if(empty($ordem)) {
      $ordem=$param->ordem_admin;
    }

       if($ordem=='C')
          $sql.=" ORDER BY id_men ";
       elseif ($ordem=='DN')
          $sql.=" ORDER BY date_envio desc ";
       elseif ($ordem=='DA')
          $sql.=" ORDER BY date_envio ";
       elseif ($ordem=='A')
          $sql.=" ORDER BY title_men ";
       else
          $sql.=" ORDER BY id_men ";  //
          

    $result = $xoopsDB->query($sql);
    if (mysql_num_rows($result) == '0') {
    	//redirect_header(XOOPS_URL."/modules/xmail/submit.php?op=add", '1' , _MD_XMAIL_NOTMEN);
    	redirect_header(XOOPS_URL."/modules/xmail/", '1' , _MD_XMAIL_NOTMEN);
    }
    // calculate total number of messages
    //  that will change once we make the navigation by page
    if(!empty($limite) and $limite>0    ) {
        $sql="SELECT count(id_men) as totmen from  ".$xoopsDB->prefix("xmail_mensage");
        $result2 = $xoopsDB->query($sql);
        $cat_data = $xoopsDB->fetcharray($result2);
        $totmen=$cat_data['totmen'];
    }else {
        $totmen= mysql_num_rows($result);
    }

 }


Global $xoopsUser, $xoopsConfig, $xoopsDB ;


switch($op){

case "exc_exec" :  // execute message deletion

	$result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("xmail_mensage")." WHERE id_men =$id_men");
    if(!$result) {
        redirect_header("gerencia.php",2,_MD_XMAIL_NOTFOUND." ".$id_men);
    }
    $cat_data = $xoopsDB->fetcharray($result);
    $dias_ult_envio=(time()- $cat_data["date_envio"])/60/60/24 ;
    if ($dias_ult_envio > $param->dias_excluir ) {
       //  delete from log
       $result = $xoopsDB->query("delete FROM ".$xoopsDB->prefix("xmail_send_log")." WHERE id_men =$id_men");
       if(!$result) {
          $men_erro=_MD_XMAIL_ERRORLOG;
       } else {
          $men_erro=_MD_XMAIL_LOGDELOK;
       
       }

       //  delete from table
    	$result = $xoopsDB->query("delete FROM ".$xoopsDB->prefix("xmail_mensage")." WHERE id_men = $id_men");
       if(!$result) {
          $men_erro.="<br>"._MD_XMAIL_ERRORSAVINGDB;
       } else {
          $men_erro.="<br>"._MD_XMAIL_SAVEOK;
       }


       // check to see if file deleted from drive and database
       $classfiles= new  classfiles();
       $array_anexos=$classfiles->array_anexos($id_men);
       for ($i=0;$i<count($array_anexos) ;$i++) {
           $classfiles->fileid=$array_anexos[$i]['fileid'];
           if(!$classfiles->excluir($id_men))
              echo "não excluiu o fileid ";
       }
       
       // exclude external files link
       $men_anexo= new men_anexo();
       if(!$men_anexo->excluir($id_men))  {
          $men_erro.="<br>"._MD_XMAIL_ERRANEXOEXC;
       }

      redirect_header("gerencia.php",4,$men_erro);

    } else {
         redirect_header("gerencia.php",2,sprintf(_MD_XMAIL_NOTDELEMEN, $param->dias_excluir) );
    }

     break;

case "exc":  // delete message
	$result = $xoopsDB->query("SELECT id_men, title_men FROM ".$xoopsDB->prefix("xmail_mensage")." WHERE id_men = $id_men");
    if ($result) {
       	list($id_men, $title_men) = $xoopsDB->fetchrow($result);

		echo"<table width='60%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";
        echo "<div class='confirmMsg'>";
        echo "<h4>";
        echo ""._MD_XMAIL_DELETEMEN."</font></h4>$title_men<br /><br />";
        echo "<table><tr><td>";
        echo myTextForm2("gerencia.php?op=exc_exec&id_men=".$id_men , _MD_XMAIL_YES);
        echo "</td><td>";
        echo myTextForm2("gerencia.php?op=default", _MD_XMAIL_NO);
        echo "</td></tr></table>";
        echo "</div><br /><br />";
        echo"</td></tr></table>";

    } else {
        redirect_header("gerencia.php",2,_MD_XMAIL_NOTFOUND." ".$id_men);
    }
    
    
	break;

case "apr_exe":  // execute message approval

    $result = $xoopsDB->queryF("UPDATE ".$xoopsDB->prefix("xmail_mensage")." SET  aprovada=1  where id_men='$id_men'   ");

	if (!$result) {
        redirect_header("gerencia.php",2,_MD_XMAIL_ERRORSAVINGDB);
     }

    // send mail to user letting him know that message was approved
    $result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("xmail_mensage")." where id_men='$id_men' ");
    if (mysql_num_rows($result) == '0') {
    	redirect_header(XOOPS_URL."/modules/xmail/submit.php?op=add", '1' , _MD_XMAIL_NOTFOUND." ".$id_men);
    }
    $cat_data = $xoopsDB->fetcharray($result) ;
    $obj_user = new XoopsUser($cat_data['uid'] );

 	$xoopsMailer =& getMailer();
	$xoopsMailer->setToUsers($obj_user);

	$xoopsMailer->setFromName($xoopsUser->getVar('name'));
	$xoopsMailer->setFromEmail($xoopsUser->getVar('email'));
	$xoopsMailer->setSubject(_MD_XMAIL_YOURMENAPROV);
   	$body = _MD_XMAIL_NOTIFYMSG;
   	$body .= "\n\n"._MD_XMAIL_YOURMENAPROV  ;
   	$body .= "\n"._MD_XMAIL_TITLE.": ".$cat_data['title_men'];
    $body .= "\n"._MD_XMAIL_DATE.": ".formatTimestamp(time(), 'm', $xoopsConfig['default_TZ']);

    $xoopsMailer->setBody($body);

   			$xoopsMailer->useMail();
      		$xoopsMailer->send(true);
			echo $xoopsMailer->getSuccess();
			echo $xoopsMailer->getErrors();

    redirect_header("gerencia.php",2,_MD_XMAIL_SAVEOK );

   break;

case "desapr":  // execute disapproval

    $result = $xoopsDB->queryF("UPDATE ".$xoopsDB->prefix("xmail_mensage")." SET  aprovada=0  where id_men='$id_men'   ");

	if (!$result) {
        redirect_header("gerencia.php",2,_MD_XMAIL_ERRORSAVINGDB);
     }

    redirect_header("gerencia.php",2,_MD_XMAIL_SAVEOK );

   break;

case "post" :  // executar alteração / execute modification

    if($opt=='save') {

    	$myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object
    	Global $xoopsUser, $xoopsConfig;
    	$title_men = $myts->makeTboxData4Save($_POST['title_men']);
    	$subject_men = $myts->makeTareaData4Save($_POST['subject_men']);
    	$body_men= $myts->makeTareaData4Save($_POST['body_men']);
    	$body_men_text= $myts->makeTareaData4Save($_POST['body_men_text']);
    	
    	if($dohtml) {
            $dobr=0 ;
        }else {
            $dobr=1 ;
        }

        $sql="UPDATE ".$xoopsDB->prefix("xmail_mensage")." SET title_men='$title_men', subject_men='$subject_men', body_men='$body_men' ,dohtml='$dohtml' ,dobr=$dobr,is_new='$is_new' ,body_men_text='$body_men_text'  where id_men='$id_men' ";
        $result = $xoopsDB->queryF($sql);

    	if (!$result) {
            redirect_header("gerencia.php",2,_MD_XMAIL_ERRORSAVINGDB .$sql);
         }

        redirect_header("gerencia.php",2,_MD_XMAIL_SAVEOK );

   }else {
          //$body_men2=$myts->displayTarea($body_men,$dohtml);
           $body_men2=$myts->previewTarea($body_men,$dohtml);
           show_preview($subject_men,$body_men2);
           $body_men=$myts->stripSlashesGPC($body_men);
           $body_men_text=$myts->stripSlashesGPC($body_men_text);
   }


case "alt" :
     include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
     if(empty($opt)) {  // indicate it is not a preview

        // find id_men

       $result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("xmail_mensage")." where id_men='$id_men'");
        if (mysql_num_rows($result) == '0') {
        	redirect_header("gerencia.php",2,_MD_XMAIL_NOTFOUND." ".$id_men);
        }

        $cat_data = $xoopsDB->fetcharray($result);
        if($cat_data['date_envio']>0) {
        	redirect_header("gerencia.php",2,_MD_XMAIL_NOTALT." ".$id_men);
        }
        if(!$isadmin and $cat_data['aprovada']) {
        	redirect_header("gerencia.php",2,_MD_XMAIL_NOTALT_FOIAPROV." ".$id_men);
        }
        
       	$title_men = $cat_data['title_men'] ;
        $subject_men = $cat_data['subject_men'] ;
        $body_men = $cat_data['body_men'] ;
        
        
        $dobr=$cat_data['dobr'];
        $dohtml = $cat_data['dohtml'] ;
        $is_new= $cat_data['is_new'] ;
    	$body_men_text = $cat_data['body_men_text'] ;
     }
	
    include_once 'include/storyform.inc.php';
    // form for uploading
    if($param->permite_anexo) {

      // show table with attachement files
       $classfiles= new classfiles() ;
       $classfiles->exibe_anexos($id_men);
       echo "<br> ";
       $classfiles->exibe_files($id_men);

    // teste com form do xoops
     	$uform = new XoopsThemeForm(_MD_XMAIL_UPLOADANEXO, "formupload", xoops_getenv('PHP_SELF'));
        $uform->setExtra("enctype='multipart/form-data'") ;
    	$uform->addElement(new XoopsFormHidden('id_men', $id_men));
        $uform->addElement( new XoopsFormFile("", "anexo1", $param->maxupload));
    	$uform->addElement(new XoopsFormTextArea(_MD_XMAIL_FILEDESCRIPT, 'filedescript', "" , 2, 60));
        $uform->addElement(new XoopsFormButton('', 'upload', "Upload", 'submit'));

        $uform->display();

    }
    break;

case "upload":

      include_once(XOOPS_ROOT_PATH."/modules/xmail/include/uploadfile.php");
      include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
        $upload = new uploadfile('anexo1');
        $upload->setAddExt(0);  // sets not to show file extension
        $upload->maxFilesize = $param->maxupload;
        $upload->loadPostVars();
        $upload->setMode($param->file_mode);
        $upload->stripSpaces=0;
        $dirupload=XOOPS_ROOT_PATH."/".$param->dir_upload;
        if(!is_dir($dirupload)) {
         	$oldumask = umask(0);
           if(!mkdir("$dirupload", octdec($param->file_mode))) {
             redirect_header("gerencia.php",2,_MD_XMAIL_DIRNOTFOUND.$dirupload) ;
           }
   			umask($oldumask);
        }

        $dirupload.="/".$xoopsUser->getVar('uname');
        if(!is_dir($dirupload)) {
         	$oldumask = umask(0);
           if(!mkdir("$dirupload", octdec($param->file_mode))) {
             redirect_header("gerencia.php",2,_MD_XMAIL_DIRNOTFOUND.$dirupload) ;
           }
   			umask($oldumask);
        }
        //  check for file exists and lets the user know if yess
        if(is_file($dirupload."/".$upload->originalName)) {
          redirect_header("gerencia.php?op=alt&id_men=".$id_men,2,_MD_XMAIL_FILEFOUND) ;
        }

   		$distfilename = $upload->doUpload($dirupload."/".$upload->originalName);

        if ($distfilename) {
           $classfiles= new classfiles() ;
           $classfiles->filerealname=$upload->originalName;
           $classfiles->date=time();
           $classfiles->ext=$upload->ext;
           $classfiles->minetype=$upload->minetype;
           $classfiles->filedescript=$filedescript;
           $classfiles->uid=$xoopsUser->getVar('uid');
           $classfiles->dir_upload=$param->dir_upload."/".$xoopsUser->getVar('uname');
           if ($classfiles->incluir() ) {
              $men_anexo= new men_anexo() ;
              $men_anexo->fileid=$xoopsDB->getInsertId();
              $men_anexo->idmen=$id_men;
              if(!$men_anexo->incluir())  {
                 redirect_header("gerencia.php",2,_MD_XMAIL_FALHAMENANEXO ) ;
              }
           }else {
               redirect_header("gerencia.php",2,_MD_XMAIL_FALHAINCFILE.$dirupload) ;
           }

           redirect_header("gerencia.php?op=alt&id_men=".$id_men,2,_MD_XMAIL_UPLOADOK.$dirupload) ;
        }else {
              redirect_header("gerencia.php",2,_MD_XMAIL_FALHAUPLOAD.$dirupload) ;
        }

      break;

case "exc_anexo" :  //  execute delete attachment file
   include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");

   $result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("xmail_mensage")." where id_men='$id_men'");
    if (mysql_num_rows($result) == '0') {
    	redirect_header("gerencia.php",2,_MD_XMAIL_NOTFOUND." ".$id_men);
    }

    $cat_data = $xoopsDB->fetcharray($result);
    if($cat_data['date_envio']>0) {
    	redirect_header("gerencia.php",2,_MD_XMAIL_NOTALT." ".$id_men);
    }

    $classfiles= new classfiles() ;
    $men_anexo= new men_anexo();
    $men_anexo->fileid=$fileid;
    $men_anexo->idmen=$id_men;

    $classfiles->fileid=$fileid;

    if($men_anexo->excluir($id_men,$fileid)) {
       $classfiles->excluir();
    }else {
       redirect_header("gerencia.php?op=alt&id_men=".$id_men,2,_MD_XMAIL_FALHAEXCANEXO) ;
    }
       
    redirect_header("gerencia.php?op=alt&id_men=".$id_men,2,_MD_XMAIL_SAVEOK) ;

     break;

case "anexar" :
    include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
    $men_anexo= new men_anexo();
    $men_anexo->fileid=$fileid;
    $men_anexo->idmen=$id_men;
    if($men_anexo->incluir())
       redirect_header("gerencia.php?op=alt&id_men=".$id_men,2,_MD_XMAIL_SAVEOK) ;
    else
       redirect_header("gerencia.php?op=alt&id_men=".$id_men,2,_MD_XMAIL_FALHAMENANEXO) ;
    
    break;


case "apr":

case "default":
     default:     // show all stored messages

	include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
    $men_p_page=$param->limite_page;
    $userstart = isset($_GET['userstart']) ? intval($_GET['userstart']) : 0;
    $userfim = $userstart+$men_p_page;

 	$usercount = $totmen;
	$nav = new XoopsPageNav($usercount, $men_p_page, $userstart, "userstart", "op=".$op."&ordem=".$ordem);

    if($op=="apr")
    	$xoopsTpl->assign(array('titulo' => _MD_XMAIL_TIT2));
    else {
    	$xoopsTpl->assign(array('titulo' => _MD_XMAIL_TIT1));
        $xoopsTpl->assign(array('totalmen' => _MD_XMAIL_TOTALMEN." ". $totmen));
    }

 	$xoopsOption['template_main'] = 'xmail_mensage.htm';
	$topics = array();

         $count=0;
	     while ($cat_data = $xoopsDB->fetcharray($result)) {
             if($count>=$userstart  and $count<$userfim) {
				$topics['body_men'] = $myts->displayTarea($cat_data['body_men'],$cat_data['dohtml'],1,1,1,$cat_data['dobr']);
				$topics['id_men'] = $cat_data['id_men'];
	        	$topics['datesub']= formatTimestamp($cat_data['datesub'],$param->format_time);
				$topics['subject_men'] = $cat_data['subject_men'];
				// only works for XOOPS 2.0.5
				$topics['poster'] = xoops_getLinkedUnameFromId($cat_data['uid']);
				$topics['title_men'] = $cat_data['title_men'];

                if($isadmin) {
                	if($cat_data['aprovada']=="0") {
                       $topics['opt2'] = 'apr_exe';
                       $topics['aprov']= _MD_XMAIL_APROVAR ;
    				}else {
                       $topics['opt2'] = 'desapr';
                       $topics['aprov']=  _MD_XMAIL_DESAPROV ;
     				}
				} else {
				   $topics['opt2'] = '';
                   $topics['aprov']= '';
				}
				
	        	$topics['date_envio']= (!empty($cat_data['date_envio'])) ?  formatTimestamp($cat_data['date_envio'],$param->format_time) : ""   ;
           		$topics['is_new'] = $cat_data['is_new'];
           		if($cat_data['is_new'])
           			$topics['newsletter']= _MD_XMAIL_NEWSLETTER ;
                else
                  	$topics['newsletter']= "" ;

                // check for attachment files
                $classfiles= new classfiles();
                $arqs=$classfiles->array_anexos($cat_data['id_men']);
                $topics['anexos']="";
                for($i=0;$i<count($arqs);$i++) {
                    if($i>0)  {
                       $topics['anexos'].=" , ";
                    }
                    $topics['anexos'].="   ".($arqs[$i]['filerealname']);
                }
    			$xoopsTpl->append('topics', array(
                           "id_men"      => $cat_data['id_men'],
                           "body_men"    => stripslashes($topics['body_men']),
                           "datesub"     => $topics['datesub'],
                           "poster"      => $topics['poster'],
                           "subject_men" => $topics['subject_men'],
                           "title_men"   => $topics['title_men'],
                           "date_envio"  => $topics['date_envio'],
                           "opt2"        => $topics['opt2'],
                           "aprov"       => $topics['aprov'],
                           "anexos"      => $topics['anexos'],
                           'newsletter'  => $topics['newsletter'] ));

		}
          $count++;
		}
		$xoopsTpl->assign(array(
                   'opt'        => _MD_XMAIL_OPT,
                   'alt'        => _MD_XMAIL_ALT,
                   'exc'        => _MD_XMAIL_EXC,
                   'aprov'      => _MD_XMAIL_APROVAR,
                   'desaprov'   => _MD_XMAIL_DESAPROV,
                   'mensagem'   => _MD_XMAIL_MESAGE ));
        $xoopsTpl->assign(array(
                   'title_men'  => _MD_XMAIL_TITULO,
                   'subject'    => _MD_XMAIL_SUBJECT,
                   'codigo'     => _MD_XMAIL_IDMEN,
                   'usucad'     => _MD_XMAIL_USUCAD,
                   'datacad'    => _MD_XMAIL_DATACAD));
        $xoopsTpl->assign(array(
                   'ultenvio'   => _MD_XMAIL_ULTENVIO));
        $xoopsTpl->assign(array(
                   'limite'     => _MD_XMAIL_LIMITE,
                   'ordem'      => _MD_XMAIL_ORDEM,
                   'dtnova'     => _MD_XMAIL_DTNOVA ,
                   'dtantiga'   => _MD_XMAIL_DTANTIGA ,
                   'enviar'     => _MD_XMAIL_SUBMIT ));
        $xoopsTpl->assign(array(
                   'actionform' => xoops_getenv('PHP_SELF')));
        $xoopsTpl->assign(array(
                   'anexos' => _MD_XMAIL_ANEXOS ));

        if($cat_data['is_new'])
           $xoopsTpl->assign(array('newsletter' => _MD_XMAIL_NEWSLETTER ));
        else
           $xoopsTpl->assign(array('newsletter' => '' ));

        if($op=="apr")
            $xoopsTpl->assign(array('comform' => "N"));
        else
            $xoopsTpl->assign(array('comform' => "S"));

        $xoopsTpl->assign(array('navega' =>  $nav->renderNav(4) ));

	break;
}

include(XOOPS_ROOT_PATH."/footer.php");
?>
