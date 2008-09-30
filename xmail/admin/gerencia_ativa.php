<?php
/*
* $Id: admin/gerencia_ativa.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/
$xoopsOption['pagetype'] = "user";
include("admin_header.php");
//require_once XOOPS_ROOT_PATH."/modules/xmail/include/functions.php";

     $config_handler =& xoops_gethandler('config');
     $xoopsConfigUser =& $config_handler->getConfigsByCat(XOOPS_CONF_USER);

if (isset($_GET['op'])) $op=$_GET['op'];
if (isset($_POST['op'])) $op=$_POST['op'];

if ( isset($_POST['post']) ) $op = 'post';
if ( isset($_POST['upload']) ) $op = 'upload';

$mat_id=$_POST['mat_id'];  // matriz com id dos usuários selecionados
$userstart=$_GET['userstart'];

    $param= new classparam();

switch($op){


case "exc_exec" :  // executar excluir usuário

     break;

case "exc":  // delete usuário

	break;
case "send":  // enviar email de ativaçào

     // usar função  envia_email_ativa......  após testa-la no xmail_ativa.php

     // instanciar xoopsuser para os id passados na matriz $mat_id

     	$added = array();
		foreach ($mat_id  as $to_user) {
			$added[] = new XoopsUser($to_user);
		}
     if(count($added)==0) {
        redirect_header(xoops_getenv('PHP_SELF'),2,_AM_XMAIL_SELUSER);
     }
       envia_email_ativa($added,$xoopsUser->getVar('uid'),$xoopsConfigUser,$xoopsConfig);

   break;


case "default":

    default:     // mostrar todos usuários sem ativação

    //   alterar abaixo   adaptando

   $sql='select count(ativa.id_user) as tentativas ,
       users.uid,uname,
       name,email,
       user_regdate as data_cad ,
       user_from,user_occ
       from '.$xoopsDB->prefix("users").' as users
         left join  '.$xoopsDB->prefix("xmail_ativacao").' as ativa
              on users.uid=ativa.id_user
         where users.level=0
         group by users.uid
         order by user_regdate ';

    $result = $xoopsDB->queryf($sql);
    if(!$result) {
       echo "ERR $sql";
       break;
    }
    if (mysql_num_rows($result) == '0') {
        xoops_result(_AM_XMAIL_NOTUSERDESATIVO );
    } else {

    	include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
        $men_p_page=$param->limite_page;
        $userstart = isset($_GET['userstart']) ? intval($_GET['userstart']) : 0;
        $userfim = $userstart+$men_p_page;

     	$usercount = mysql_num_rows($result);

    	$nav = new XoopsPageNav($usercount, $men_p_page, $userstart, "userstart", "op=default");

    	echo "<form name='ativa' method='post' action='".xoops_getenv('PHP_SELF') ."?op=send'>\n";
    	echo "<table border=1 cellpadding=0 cellspacing=0 width='100%' >\n";
    	echo "	<tr  class='Head' >\n";
        if($xoopsConfigUser['activation_type'] == 0) {
           	echo "		<td  align='center'   >  </td>\n";
        }
    	echo "		<td><b>"._AM_XMAIL_ID." </b></td>\n";
    	echo "		<td><b>"._AM_XMAIL_LOGIN." </b></td>\n";
    	echo "		<td><b>"._AM_XMAIL_NOME." </b></td>\n";
    	echo "		<td><b>"._AM_XMAIL_DATACAD."</b></td>\n";
    	echo "		<td><b>". _AM_XMAIL_QTDTENTAR."</b></td>\n";
    	echo "		<td><b>". _AM_XMAIL_EMAIL."/"._US_WEBSITE   ."</b></td>\n";
    	echo "		<td><b>". _US_LOCATION ."<br>/". _US_OCCUPATION . "</b></td>\n";
    	echo "		<td><b>". _AM_XMAIL_OPT."</b></td>\n";
        echo "	</tr>\n";

        $i=0;
        while ($cat_data = $xoopsDB->fetcharray($result)) {
        	if(($i%2)==0) {
            	echo " <tr class='even' >";
           	}else {
               echo " <tr class='odd' >";
        	}
           if($i>=$userstart  and $i<$userfim) {

               if($xoopsConfigUser['activation_type'] == 0) {
                   	echo "<td align='center'  >
                    <input type='checkbox' name='mat_id[]' value='" . $cat_data['uid']."' ></td>\n";
                }
               	echo "<td   >" .$cat_data['uid'] ."</td>\n";
            	echo "<td   >" .$cat_data['uname'] ."</td>\n";
            	echo "<td>" .$cat_data['name'] ."</td>\n";
            	echo "<td>" .formatTimestamp($cat_data['data_cad'],$param->format_time)."</td>\n";
            	echo "<td>" .$cat_data['tentativas'] ."</td>\n";

                echo "<td>" .$cat_data['email'] ."\n";
                echo "<br>" .$cat_data['url'] ."</td>\n";

                echo "<td>" .$cat_data['user_from'] ." / \n";
    			echo "<br>" .$cat_data['user_occ'] ."</td>\n";

            	echo "<td>
                <a href='".XOOPS_URL."/modules/system/admin.php?fct=users&op=delUser&uid=". $cat_data['uid']."'>" ._AM_XMAIL_EXC. " </a>";
                if($xoopsConfigUser['activation_type'] !=0 ) {
                   echo "<br><a href='".XOOPS_URL."/modules/system/admin.php?fct=users&op=modifyUser&uid=". $cat_data['uid']."'>" ._AM_XMAIL_ATIVAR. " </a></td>\n";
                }
                echo "	</tr>\n";
            }
            $i++;
     	}
        echo "</table>\n";
    	echo "</form> \n";
        if($xoopsConfigUser['activation_type'] == 0) {
        	echo "<p align='center' ><a  href=\"javascript:document.ativa.submit();\">"._AM_XMAIL_ENVIAREMAIL." </a></p>";
        }

        echo "<p align='center' >". $nav->renderNav(4)."</p>";
        }
	break;
}
xoops_cp_footer();

?>
