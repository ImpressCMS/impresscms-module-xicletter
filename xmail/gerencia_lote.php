<?php
/*
* $Id: gerencia_lote.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

$nomenu=1;
$xoopsOption['template_main'] = 'xmail_lote.htm';
include("header.php");
include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
include_once XOOPS_ROOT_PATH."/modules/xmail/grvlog.php";  
$xoopsOption['template_main'] = 'xmail_lote.htm';

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
 

switch($op){

case "exc_exec" :  // executar excluir lote
     include_once(XOOPS_ROOT_PATH."/modules/xmail/include/class_aux_send.php");
     if(!$isadmin) {
        $class_lotep->busca();
        if($class_lotep->user_logado!= $xoopsUser->getvar('uid')) {
           redirect_header(XOOPS_URL."/modules/xmail/", '1' , sprintf(_MD_XMAIL_LOTENOTUSER,$class_lotep->user_logado) );
        }
      }

//     if(!$class_lotef->excluir(1)) {
//        redirect_header("gerencia_lote.php",2,_MD_XMAIL_OPERNOTOK." ".$men_erro);
//     }else {
//        redirect_header("gerencia_lote.php",2,_MD_XMAIL_SAVEOK);
//     }

		if(!isset($lotea) or $lotea==0 ){
		   $lotea=$lote;
		}
		$resultado="";
		$temerro=0;
		for($i=$lote;$i<=$lotea;+$i++){
		    $class_lotef= new  classxmail_aux_send();
     		$class_lotef->lote_solicit=$i;
     		$class_lotep = new classxmail_aux_send_l();
     		$class_lotep->lote_solicit=$i;
		     if(!$class_lotef->excluir(1)) {
		        $resultado.=$men_erro."<br>";
		        $temerro=1;
		     }
		}
			if(!$temerro){
				redirect_header("gerencia_lote.php",2,_MD_XMAIL_SAVEOK);
			}else{
			  xoops_result($resultado);	
			}	
	break;

case "exc":  // delete lote
		if(!isset($lotea) or $lotea==0 ){
		   $lotea=$lote;
		}
	$result = $xoopsDB->query("SELECT  * FROM ".$xoopsDB->prefix("xmail_aux_send_l")." WHERE lote_solicit = $lote");
    if ($result) {
        $cat_data = $xoopsDB->fetcharray($result) ;
    	echo"<table width='60%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";
        echo "<div class='confirmMsg'>";
        echo "<h4>";
        echo ""._MD_XMAIL_CONFEXCLOTE."</h4>$lote a $lotea <br><br/>";
        echo "<table><tr><td align='right'   >";
        echo myTextForm2("gerencia_lote.php?op=exc_exec&lote=".$lote."&lotea=$lotea" , _MD_XMAIL_YES);
        echo "</td><td>";
        echo myTextForm2("gerencia_lote.php?op=default", _MD_XMAIL_NO);
        echo "</td></tr></table>";
        echo "</div><br /><br />";
        echo"</td></tr></table>";
    } else {
        redirect_header("gerencia_lote.php",2,_MD_XMAIL_LOTENOTFOUND." ".$lote);
    }
	break;
case "send":  // enviar mensagens do lote
    include_once(XOOPS_ROOT_PATH."/modules/xmail/include/class_aux_send.php");
    if(!isset($mail_start))
       $mail_start=0;

    if(!isset($dest))
        $dest='';
	    envia_xmails_lote($lote,$dest,$mail_start);
	echo "<br><br><a href='".XOOPS_URL.'/modules/xmail/gerencia_lote.php'."'>"._MD_XMAIL_LOTES_P."</a>";
	    break;

    default:     // show all stored messages

    
    $sql="SELECT pai.*,
          users.uname as solicitante  ,
          mensage.* ,
          count(filho.id_user) as pendente
          FROM ".$xoopsDB->prefix("xmail_aux_send_l").' as pai
          left join  '.$xoopsDB->prefix("xmail_aux_send").' as filho
               on pai.lote_solicit=filho.lote_solicit
          left join  '.$xoopsDB->prefix("xmail_mensage").' as mensage
               on pai.id_men=mensage.id_men
          left join  '.$xoopsDB->prefix("users").' as users
               on pai.user_logado = users.uid '   ;

    if(!$isadmin) {
        $sql.=" where pai.user_logado= ".$xoopsUser->getvar('uid');
    }

    $sql.=' group by filho.lote_solicit ';

    if(empty($ordem)) {
      $ordem='D';
    }

   if($ordem=='D')   // data de solicitação
      $sql.=" ORDER BY dt_solicit ";
   elseif ($ordem=='U')     // usuário
      $sql.=" ORDER BY user_logado  ";


    $result = $xoopsDB->queryf($sql);
    if(!$result) {
       echo "ERR $sql";
       break;
    }
    if (mysql_num_rows($result) == '0') {
    	redirect_header(XOOPS_URL."/modules/xmail/", '1' , _MD_XMAIL_NOTLOTEPEN);
    }

	include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
    $men_p_page=$param->limite_page;
    $userstart = isset($_GET['userstart']) ? intval($_GET['userstart']) : 0;
    $userfim = $userstart+$men_p_page;

 	$usercount = mysql_num_rows($result);
	$nav = new XoopsPageNav($usercount, $men_p_page, $userstart, "userstart", "op=default&ordem=".$ordem);

	$xoopsTpl->assign(array('titulo' => _MD_XMAIL_TIT3));

 	//$xoopsOption['template_main'] = 'xmail_lote.htm';
	$topics = array();

         $count=0;
	     while ($cat_data = $xoopsDB->fetcharray($result)) {
             if($count>=$userstart  and $count<$userfim) {
				//$topics['body_men'] = $myts->displayTarea($cat_data['body_men']);
				$topics['body_men'] = $myts->displayTarea($cat_data['body_men'],$cat_data['dohtml'],1,1,1,$cat_data['dobr']);
				$topics['id_men'] = $cat_data['id_men'];
	        	$topics['datesub']= formatTimestamp($cat_data['datesub'],$param->format_time);
				$topics['subject_men'] = $cat_data['subject_men'];
				// only works for XOOPS 2.0.5
				$topics['poster'] = xoops_getLinkedUnameFromId($cat_data['uid']);
				$topics['title_men'] = $cat_data['title_men'];
	        	$topics['date_envio']= (!empty($cat_data['date_envio'])) ?  formatTimestamp($cat_data['date_envio'],$param->format_time) : ""   ;

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
                           "id_men"            => $cat_data['id_men'],
                           "body_men"          => stripslashes($topics['body_men']),
                           "datesub"           => $topics['datesub'],
                           "poster"            => $topics['poster'],
                           "subject_men"       => $topics['subject_men'],
                           "title_men"         => $topics['title_men'],
                           "date_envio"        => $topics['date_envio'],
                      //     "aprov"             => $topics['aprov'],
                           "anexos"            => $topics['anexos'],
                           "lote_solicit"      => $cat_data['lote_solicit'],
                           "dt_solicit"        => formatTimestamp($cat_data['dt_solicit'],$param->format_time),
                           "user_logado"       => $cat_data['solicitante'],
                           "qtd_pendente"      => $cat_data['pendente'] ,
                           "link_user_logado"  => xoops_getLinkedUnameFromId($cat_data['user_logado']) ,
                           "dt_agenda"         => formatTimestamp($cat_data['dt_agenda'],$param->format_time))) ;


		}
          $count++;
		}
		$xoopsTpl->assign(array(
                   'opt'         => _MD_XMAIL_OPT,
                   'alt'         => _MD_XMAIL_ALT,
                   'exc'         => _MD_XMAIL_EXC,
                   'aprov'       => _MD_XMAIL_APROVAR,
                   'desaprov'    => _MD_XMAIL_DESAPROV,
                   'mensagem'    => _MD_XMAIL_MESAGE ));
        $xoopsTpl->assign(array(
                   'title_men'   => _MD_XMAIL_TITULO,
                   'subject'     => _MD_XMAIL_SUBJECT,
                   'codigo'      => _MD_XMAIL_IDMEN,
                   'usucad'      => _MD_XMAIL_USUCAD,
                   'datacad'     => _MD_XMAIL_DATACAD));
        $xoopsTpl->assign(array(
                   'ultenvio'    => _MD_XMAIL_ULTENVIO));
        $xoopsTpl->assign(array(
                   'limite'      => _MD_XMAIL_LIMITE,
                   'ordem'       => _MD_XMAIL_ORDEM,
                   'dtnova'      => _MD_XMAIL_DTNOVA ,
                   'dtantiga'    => _MD_XMAIL_DTANTIGA ,
                   'enviar'      => _MD_XMAIL_SUBMIT ));
        $xoopsTpl->assign(array(
                   'actionform'  => xoops_getenv('PHP_SELF')));
        $xoopsTpl->assign(array(
                   'anexos'      => _MD_XMAIL_ANEXOS ));
        $xoopsTpl->assign(array(
                   'data_lote'   => _MD_XMAIL_DATE ));
        $xoopsTpl->assign(array(
                   'solicitante' => _MD_XMAIL_SOLICIT ));
        $xoopsTpl->assign(array(
                   'pendente'    => _MD_XMAIL_PENDENTE ));
        $xoopsTpl->assign(array(
                   'lote'        => _MD_XMAIL_LOTE ));
        $xoopsTpl->assign(array('agendado'    => _MD_XMAIL_AGENDADOPARA ));
                   

        if($op=="apr")
	        $xoopsTpl->assign(array('comform' => "N"));
        else
            $xoopsTpl->assign(array('comform' => "S"));

        $xoopsTpl->assign(array('navega' =>  $nav->renderNav(4) ));

        
	break;
}

include(XOOPS_ROOT_PATH."/footer.php");
?>
