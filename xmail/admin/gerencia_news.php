<?php
/*
* $Id: admin/gerencia_news.php
* Module: XMAIL
** Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/
include "admin_header.php";
include_once XOOPS_ROOT_PATH."/modules/xmail/grvlog.php";
include_once XOOPS_ROOT_PATH."/class/xoopsmailer.php";

require_once XOOPS_ROOT_PATH."/modules/$admin_mydirname/include/xmail_assinantes.class.php";
    $param= new classparam();

?>
<style>
div.auto_complete{
	width: 350px;
	background: #fff;
}
div.auto_complete ul{
	border:1px solid #888;
	margin:0;
	padding:0;
	width: 100%;
	list-style-type:none;
}
div.auto_complete.ul li{
	margin:0;
	padding:3px;
}	
div.auto_complete ul li.selected{
	background-color: #ffb;
}

div.auto_complete ul strong.highlight {
	color: #800;
	margin:0;
	padding:0;
}

</style>

<?php
    
    
//error_reporting(E_ALL);
if (isset($_POST['action']))
	$action = $_POST['action'];
else if (isset($_GET['action']) && !isset($_POST['action']))
	$action = $_GET['action'];
else
	$action = '';
//$adminURL = XOOPS_URL .'/modules/'.$xoopsModule->dirname().'/admin/index.php';

$adminURL=xoops_getenv('PHP_SELF').'?xmenu='.$_GET['xmenu'].'&xsubmenu='.$_GET['xsubmenu'] ;

switch($action) {
	case 'P':
	$user_id=intval($_POST['user_id']);

	echo "<script language='javascript' >window.location.href='xmail_manut_perfil_news.php?user_id=$user_id&xmenu=".$_GET["xmenu"]."&xsubmenu=".$_GET["xsubmenu"]."' </script>";
	break;
	
	case 'salvar':
	$user_id=intval($_POST['user_id']);
	$obj_ass=new class_assinantes($user_id);
	$obj_ass->setVar('user_name',$_POST['user_name']);
	$obj_ass->setVar('user_nick',$_POST['user_nick']);
	$obj_ass->setVar('user_email',$_POST['user_email']);
	if(!$obj_ass->store()){
		xoops_error(_AM_XMAIL_ERRORSAVINGDB.$obj_ass->getHtmlErrors());
	}else{
		xoops_result(_AM_XMAIL_SAVEOK);
	}
	
	
	
	remUser();
	break;
	case 'A':
	// alterar  cadastro
	$user_id=$_POST['user_id'];
	$obj_ass=new class_assinantes($user_id);
	require '../include/assinantes_form.php';
	$formu->display();

	break;
	case 'import_users':
		importusers();
		break;
	case 'rem_user_conf':
		removeUser();
		break;
	case 'optimize':
		optimizeTable();
		break;
	case 'launch_import':
		launchimport();
		break;
	case 'rem_user':
		remUser();
		break;
	case 'D':
		rem_user_perg();
		break;
	default:
		//xoops_cp_header();
		OpenTable();
		//showHeader();
		CloseTable();
		//xoops_cp_footer();
		break;
}

// Ajout Hervé
function rem_user_perg() {
 	//xoops_cp_header();
		OpenTable();
		//showHeader();
        $msg= sprintf(_AM_XMAIL_CONFDELUSER, $_POST['user_name']. ' - '.$_POST['user_email']);
        xoops_confirm(array('user_name' => $_POST['user_name'],'user_id' => $_POST['user_id'], 'action' => 'rem_user_conf') ,  $PHP_SELF , $msg );

		CloseTable();
		//xoops_cp_footer();
//        break;
}


function launchimport()  // ok
{
	global $xoopsDB, $xoopsUser;
	//xoops_cp_header();
	OpenTable();
	//showHeader();
	$imported=0;

	while ( list($null, $userid) = each($_POST["userslist"]) )	{
			// Search user
			$sqluser = "SELECT name, uname, user_regdate, email, user_mailok FROM ".$xoopsDB->prefix("users")." WHERE uid= $userid";
			$arruser = $xoopsDB->fetchArray($xoopsDB->queryF($sqluser));
			if(trim($arruser['email']!='')) {
				if($arruser['user_mailok']==1)	{	// User accepts emails
              // verificar se o email ja existe na tabela
              $sql='select * from '.$xoopsDB->prefix('xmail_newsletter').' where user_email="'.$arruser['email'].'" ';
              $result=$xoopsDB->queryf($sql);
              if(!$result) {
                 echo "Error query $sql";

              }
              if($xoopsDB->getRowsNum($result)==0) {
					$better_token = md5(uniqid(rand(), 1));
//					$sqlinsert=sprintf("INSERT INTO %s ( user_name, user_nick, user_email, user_host, user_conf, confirmed, user_time) VALUES (%u ,'%s' ,'%s', '%s', '%s', '%s', '1' ,NOW())",$xoopsDB->prefix('xmail_newsletter'),$arruser['name'],$arruser['uname'], $arruser['email'], '',$better_token);
					$sqlinsert= "INSERT INTO ".$xoopsDB->prefix('xmail_newsletter').
                    '( user_name, user_nick, user_email, user_host, user_conf, confirmed, user_time)
                    VALUES ("'.$arruser['name'].'","'.$arruser['uname'].'","'.$arruser['email'].'","","'.$better_token .'",\'1\' ,NOW())' ;

					if (!$resultinsert = $xoopsDB->queryF($sqlinsert))	{
                        echo "veja sql $sqlinsert ";
						printf(_AM_XMAIL_USERSMSG5,$xoopsUser->getUnameFromId($userid));
					}
					else 	{	// User inserted successfully
						printf(_AM_XMAIL_USERSMSG4,$xoopsUser->getUnameFromId($userid));
					}
     		   }
               else {
                	printf(_AM_XMAIL_USERSMSG1,$xoopsUser->getUnameFromId($userid));
				}

			}else {
                	printf(_AM_XMAIL_USERSMSG3,$xoopsUser->getUnameFromId($userid));
			}
    	}
			else	// Empty email adress
			{
				printf(_AM_XMAIL_USERSMSG2,$xoopsUser->getUnameFromId($userid));
			}
 	} // close while
	CloseTable();
	//xoops_cp_footer();
}

// Ajout Hervé
function importusers()  //  ok
{
	global $xoopsDB, $xoopsModule;
	include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
	//xoops_cp_header();
	OpenTable();
	//showHeader();
	
	$sform = new XoopsThemeForm(_AM_XMAIL_IMPORTUSER, "importform",$adminURL);
	$sform->addElement(new XoopsFormSelectUser(_AM_XMAIL_MSGIMPORTUSER, 'userslist',false,'',10,true), true);
	$sform->addElement(new XoopsFormHidden('action', 'launch_import'), false);

	$button_tray = new XoopsFormElementTray('' ,'');
	$submit_btn = new XoopsFormButton('', 'submit', _AM_XMAIL_BNTIMPORTUSEROK, 'submit');
	$button_tray->addElement($submit_btn);
	$cancel_btn = new XoopsFormButton('', 'reset', _AM_XMAIL_BNTIMPORTUSERCANCEL, 'reset');
	$button_tray->addElement($cancel_btn);
	$sform->addElement($button_tray);
	$sform->display();
	
	
	CloseTable();
	//xoops_cp_footer();
}

function removeUser() {  //  ok
	global $xoopsDB;

	$query = "DELETE from  ".$xoopsDB->prefix('xmail_newsletter')." WHERE user_id ='" . $_POST['user_id'] ."'";
	$result = $xoopsDB->queryF($query);
	//xoops_cp_header();
	OpenTable();
	//showHeader();
	if (!$result) {
		printf(_AM_XMAIL_DBERROR, $result, $query);
	}
	printf(_AM_XMAIL_USERREMOVED, $_POST['user_name']);

   // excluir o perfil do assinante...
    include XOOPS_ROOT_PATH.'/modules/xmail/include/classxmail_tabperfil.php' ;
    $classperf= new classxmail_tabperfil();
    $classperf->exclui_user($_POST['user_id']);


	CloseTable();
	//xoops_cp_footer();
}

function optimizeTable() {  //  ok
	global $xoopsDB;
	OpenTable();	
	include(XOOPS_ROOT_PATH.'/modules/xmail/xoops_version.php');
	//$modversion['tables'][0] = "xmail_mensage";
	foreach($modversion['tables'] as $table){	
		$query = "OPTIMIZE TABLE ".$xoopsDB->prefix($table);
		$result = $xoopsDB->queryF($query);
		if (!$result) {
			printf(_AM_XMAIL_DBERROR, $result, $query);
		} else {
			printf(_AM_XMAIL_TABLEOPT, $table);
		}
		echo "<br>";
	}
	
	CloseTable();
	//xoops_cp_footer();
}

function showHeader()
{
	global $xoopsModule, $adminURL;
	print "<center><table width='70%' bgcolor='white' border='1' cols='2' rows='2' cellpadding='2' cellspacing='0'>\n";
	print "<th colspan='2'>"._AM_XMAIL_ADMINMENUNEWS."</th>\n";
	print "<tr>";
	print "<td><a href='$adminURL?action=rem_user'>"._AM_XMAIL_REMOVEUSER."</a></td>\n";
	print "<td><a href='$adminURL?action=optimize'>"._AM_XMAIL_OPTIMDATAB."</a></td>\n";
	print "</tr>";
	print "<td colspan=2><a href='$adminURL?action=import_users'>"._AM_XMAIL_IMPORTUSER ."</a></td>\n";
	print "</table></center><BR>\n";
}


function remUser()  //  ok
{
	global $xoopsDB,$adminURL,$param;
	$query = "select * from ".$xoopsDB->prefix('xmail_newsletter').' as assin';
	if(!empty($_POST['localiza'])){
		$varloc=explode('-',$_POST['localiza']);
		$query.=" where user_id=".$varloc[0];
	}else{
		
		if(isset($_POST['idperf'])){
		  $id_perf=intval( $_POST['idperf']);	
		}else{
		   $id_perf=intval( $_GET['idperf']);	
		}
		
		$_SESSION['idperf']=$id_perf;
		
		if($id_perf>0){
		   $query.=' left join '.$xoopsDB->prefix('xmail_perfil_news').' as perf on assin.user_id =perf.user_id  
		       where  perf.id_perf='.$id_perf;			
		}
	}
	
	
	$result = $xoopsDB->queryF($query);
	//xoops_cp_header();
	OpenTable();
	//showHeader();
	echo "<h4>"._AM_XMAIL_REMOVEUSER."</h4>";
	// form p/ localizar
	echo "<form name='localiza' method='post' action=''> ";
	echo "<b>Localizar Assinante :</b> <input autocomplete='off' type='text' id='localiza'  name='localiza' size=50 value='' /> ";
	
	echo "<div class='auto_complete' id='localiza_auto_complete'> </div>";
	
	$obj_perfil=new XoopsFormSelect(_AM_XMAIL_PERFIL,'idperf',(isset($_POST['idperf']) ?  $_POST['idperf'] : $_GET['idperf'] )   );
	$array_perf=get_array_tab($xoopsDB->prefix('xmail_tabperfil'),'id_perf','descri_perf','',1,1);
//	$array_perf[0]='------------';
	$obj_perfil->addOptionArray($array_perf);
	echo "&nbsp;&nbsp;&nbsp;&nbsp; "._AM_XMAIL_PERFIL .'    '.$obj_perfil->render();
	
	echo " &nbsp;&nbsp;&nbsp;&nbsp;  <input type='submit'  value='enviar' name='envloc' >";
	?> <script type='text/javascript' >
		 new Ajax.Autocompleter('localiza','localiza_auto_complete','xmail_busca_assinantes.php',{tokens:[',','\n']})
		 </script>
    <?php 
	
	echo "</form>";
	
	
	echo "<center><table width='100%' border='1' cellpadding='0' cellspacing='0'>\n";
	echo "<th>"._AM_XMAIL_CONFIRMED."</th>
			<th>"._AM_XMAIL_USERID."</th>
			<th>"._AM_XMAIL_USERNAME."</th>
			<th>"._AM_XMAIL_NICKNAME."</th>
			<th>"._AM_XMAIL_EMAIL."</th>";
	echo "<th>"._AM_XMAIL_HOST."</th>
			<th>"._AM_XMAIL_TIME."</th>
			<th>"._AM_XMAIL_DELETEUSER."</th>
			<th>"._AM_XMAIL_PERFIL."</th>\n
			<th>"._AM_XMAIL_ALT."</th>\n";

//--  inserir  paginação 
	include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
    $men_p_page=$param->limite_page;
    $userstart = isset($_GET['userstart']) ? intval($_GET['userstart']) : 0;
    $userfim = $userstart+$men_p_page;

 	$usercount = $xoopsDB->getRowsNum($result);
	$nav = new XoopsPageNav($usercount, $men_p_page, $userstart, "userstart","menu=".$_GET['menu']."&action=rem_user");

	// -----
	
	
	if (!$result) {
		echo "<tr><td>"._AM_XMAIL_NOTHINGINDB." ?</td></tr>\n";
	} else {
		$count=0;
		while ($arr = $xoopsDB->fetchArray($result)) {
			if($count>=$userstart  and $count<$userfim) {
			$mail = $arr['user_email'];
			if (!$mail)
				$mail = "<font color='red'>"._AM_XMAIL_ERROR."</font>";
			$conf = "";
			if ($arr['confirmed'] == '1')
				$conf = _AM_XMAIL_YES;
			else
				$conf = _AM_XMAIL_NO;
			echo "<tr>\n";
			echo "<td>$conf</td>\n";
			echo "<td>".$arr['user_id']."</td>\n";
			echo "<td>".$arr['user_name']."</td>\n";
			echo "<td>".$arr['user_nick']."</td>\n";
			echo "<td>$mail</td>\n";
			echo "<td>".$arr['user_host']."&nbsp;</td>\n";
			list($year,$month,$day,$hour,$min,$sec)=explode(":", eregi_replace("[' '|-]",":", $arr['user_time']));
			echo "<td >".formatTimestamp(mktime($hour,$min,$sec,$month,$day,$year))."</td>\n";
			echo "<form action='$adminURL' method='post'>\n";
			echo "<input type='hidden' name='user_id' value='" . $arr['user_id']. "'>\n";
			echo "<input type='hidden' name='user_name' value='". $arr['user_name']."'>\n";
			echo "<input type='hidden' name='user_nick' value='". $arr['user_nick']."'>\n";
			echo "<input type='hidden' name='user_email' value='".$arr['user_email']."'>\n";
			echo "<input type='hidden' name='user_host' value='".$arr['user_host']."'>\n";
			echo "<input type='hidden' name='user_conf' value='".$arr['user_conf']."'>\n";
			echo "<input type='hidden' name='user_time' value='".$arr['user_time']."'>\n";
	//		echo "<input type='hidden' name='action' value='rem_user_perg'>\n";
			echo "<input type='hidden' name='confirmed' value='".$arr['confirmed']."'>\n";
			//echo "<td nowrap><input type='submit' name='action' value='"._AM_XMAIL_DELETEUSER."'></td>\n";
			echo "<td nowrap align='center' ><input type='submit' name='action' value='D'></td>\n";
			echo "<td nowrap align='center'  ><input type='submit' name='action' value='P' ></td>\n";
			echo "<td nowrap align='center'  ><input type='submit' name='action' value='A'></td>  \n";
			echo "</form>\n";
			echo "</tr>\n";
			}
			$count++;	
		}
	}
	echo "</table>\n";
	echo $nav->renderNav(4);
	echo "</center>\n";
	CloseTable();

}
	xoops_cp_footer();

	
	
?>
