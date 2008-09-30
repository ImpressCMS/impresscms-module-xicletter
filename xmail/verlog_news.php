<?php
/*
* $Id: verlog_news.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/


if($_POST['op']=='send')
   $nomenu=1;
 
include("header.php");
include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
Global $xoopsUser, $xoopsDB, $xoopsConfig, $myts;

$op ='';

foreach ($_POST as $k => $v) {
	${$k} = $v;
}

foreach ($_GET as $k => $v) {
	${$k} = $v;
}

if (isset($_GET['op'])) $op=$_GET['op'];
if (isset($_POST['op'])) $op=$_POST['op'];

$PHP_SELF = $_SERVER["PHP_SELF"];


    $param= new classparam();
  
 switch($op){

    case "send":

    $sql="SELECT new.user_nick,user_name,log.id_user,log.id_men,log.dt_envio,mensage.title_men,mensage.subject_men,mensage.body_men,mensage.date_envio,mensage.uid,mensage.dobr,mensage.dohtml
      FROM ".$xoopsDB->prefix("xmail_send_log")." as log  ";
    $sql.=" left join ".$xoopsDB->prefix('xmail_newsletter').' as new on log.id_user=new.user_id ';
    $sql.=" left join ".$xoopsDB->prefix("xmail_mensage")." as mensage  on mensage.id_men=log.id_men ";
    //$where="  mensage.is_new=1";
    $where=" log.is_user_news     ";
   
    
    if (!empty($_POST['id_men'])) {
        if(!empty($where)) {
           $where.=" and  ";
        }
        $where.=" log.id_men='$id_men'";
    }
    if(!$isadmin) {
       if(!empty($where)) {
           $where.=" and  ";
        }
        $where.=" ( mensage.uid='".$xoopsUser->getVar('uid')."' or  log.id_user='".$xoopsUser->getVar('uid')."')";
    }

    $sql.= (!empty($where)) ? " where ".$where : "" ;
    $sql2=$sql ; // $sql2 capturada aqui antes da clausula order by para não dar erro

    $sql.=" order by dt_envio desc ";

    $result = $xoopsDB->query($sql);
    if(!$result)
       echo " erro na sql ".$sql;
    
    if (mysql_num_rows($result) == '0') {
    	redirect_header("index.php", '1' , _MD_XMAIL_NOTMENLOG);
    	exit();
    }

    // paginação
  	include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
    $men_p_page=$param->limite_page;
    $userstart = isset($_GET['userstart']) ? intval($_GET['userstart']) : 0;
    $userfim = $userstart+$men_p_page;

    $sql2=$sql2." group by dt_envio order by dt_envio ";
    $result2 = $xoopsDB->query($sql2);


 	$usercount = mysql_num_rows($result2);

	$nav = new XoopsPageNav($usercount, $men_p_page, $userstart, "userstart", "op=send&id_men=".$id_men."&lista_user=".$lista_user);


   	$xoopsTpl->assign(array('titulo' => _MD_XMAIL_TITLOGNEW));

 	$xoopsOption['template_main'] = 'xmail_verlog.htm';
	$topics = array();

        $chave="";
        $primeiro=true;

         $count=0;

          while ($cat_data = $xoopsDB->fetcharray($result)) {

             if( $cat_data['dt_envio'].$cat_data['id_men'] != $chave) {
                if(!$primeiro) {
                   if($count>=$userstart  and $count<$userfim) {
                       $xoopsTpl->append('topics', array("id_men" => $topics['id_men'], "body_men" => $topics['body_men'],
                        "users" => $topics['users'], "subject_men" => $topics['subject_men'], "title_men" => $topics['title_men'],
                         "date_envio" => $topics['date_envio'], "anexos" => $topics['anexos'] ));
                       $count++;
                   }else {
                       $count++;
                   }
                }else {
                    $primeiro=false;
                }
				$topics['id_men'] = $cat_data['id_men'];
				$topics['title_men'] = $cat_data['title_men'];
				$topics['body_men'] =  $myts->displayTarea($cat_data['body_men'],$cat_data['dohtml'],1,1,1,$cat_data['dobr']);
				$topics['subject_men'] = $cat_data['subject_men'];
	        	$topics['date_envio']= (!empty($cat_data['dt_envio'])) ?  formatTimestamp($cat_data['dt_envio'],$param->format_time) : ""   ;
                $topics['users'] = $cat_data['user_nick'];
                  // verificar arquivos arquivos
                $classfiles= new classfiles();
                $arqs=$classfiles->array_anexos($cat_data['id_men']);
                $topics['anexos']="";
                for($i=0;$i<count($arqs);$i++) {
                    if($i>0)  {
                       $topics['anexos'].=" , ";
                    }
                    $topics['anexos'].="   ".($arqs[$i]['filerealname']);
                }

              }else {
        		$topics['users'].= "<br>".$cat_data['user_nick'];
              }
              $chave=$cat_data['dt_envio'].$cat_data['id_men'];
		}
        if($count>=$userstart  and $count<$userfim) {
           $xoopsTpl->append('topics', array("id_men" => $topics['id_men'], "body_men" => $topics['body_men'], "users" => $topics['users'], "subject_men" => $topics['subject_men'], "title_men" => $topics['title_men'], "date_envio" => $topics['date_envio'] , "anexos" => $topics['anexos'] ));
        }

		$xoopsTpl->assign(array('envto' => _MD_XMAIL_ENVTO, 'mensagem' => _MD_XMAIL_MESAGE ));
        $xoopsTpl->assign(array('title_men' => _MD_XMAIL_TITULO,'subject' => _MD_XMAIL_SUBJECT, 'codigo' => _MD_XMAIL_IDMEN,  'datacad' => _MD_XMAIL_DATACAD));
        $xoopsTpl->assign(array('ultenvio' => _MD_XMAIL_ULTENVIO));
        $xoopsTpl->assign(array('anexos' => _MD_XMAIL_ANEXOS ));
        
        $xoopsTpl->assign(array('navega' =>  $nav->renderNav(4) ));
	break;

    default:  // solicitar form pedindo dados para consulta / request a form that gets input for a query

        
    $result = $xoopsDB->queryF("SELECT * FROM ".$xoopsDB->prefix("xmail_send_log")." limit 1  ");
    if (mysql_num_rows($result) == '0') {
    	redirect_header("index.php", '1' , _MD_XMAIL_NOTMENSEND) ;
    }

	$sform = new XoopsThemeForm(_MD_XMAIL_FORMVERLOG, "mailusers", xoops_getenv('PHP_SELF'));

     $men_select = new XoopsFormSelect( _MD_XMAIL_SELMEN, "id_men"  );
     $sql="select id_men,title_men from ".$xoopsDB->prefix("xmail_mensage") ;
     if($isadmin) {
        $sql.=" where aprovada=1 ";
     } else {
        $sql.=" where aprovada=1  and uid=".$xoopsUser->getVar('uid') ;
     }
     $sql.=' and is_new=1 ';
     $sql.=" order by id_men desc ";
     
     $result = $xoopsDB->query($sql);
     $array_men=array();
     $array_men['']='---------';
     while ($cat_data = $xoopsDB->fetcharray($result)) {
        $array_men[$cat_data['id_men']]=$cat_data['title_men'];
     }
     $men_select->addOptionArray($array_men);
     $sform->addElement($men_select);
     $op_hidden = new XoopsFormHidden("op", "send");
     $submit_button = new XoopsFormButton("", "mail_submit", _SEND, "submit");

        $sform->addElement($op_hidden);
        $sform->addElement($submit_button);
		$sform->display();

}		
include(XOOPS_ROOT_PATH."/footer.php");
?>

