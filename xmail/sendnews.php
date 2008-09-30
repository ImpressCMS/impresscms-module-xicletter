<?php
/*
* $Id: sendnews.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/
include("header.php");
include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
include_once(XOOPS_ROOT_PATH."/modules/xmail/include/class_aux_send.php");

include_once XOOPS_ROOT_PATH."/modules/xmail/grvlog.php";  
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

include_once( XOOPS_ROOT_PATH . "/header.php" );

?>
<?php
//set_time_limit(0);
include_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";
$param= new classparam();
$usa_perf=$param->usa_perf;


$nomeclass= 'classxmail_tabperfil';
include XOOPS_ROOT_PATH.'/modules/xmail/include/'."{$nomeclass}.php";
$classperf = new $nomeclass ;



switch($op){

	case "send":

	if($id_men==0){
		xoops_error(_MD_XMAIL_SELMEN);
		break;
	}
	
	if(empty($dest)) {
		// quando não vazio indica que foi chamado pela func. envia_xmails  em continuação
		// $dest not being empty indicates that it was called by the envia_xmails function
		if ( $op == "send" && !empty($_POST['mail_send_to']) ) {

			$added_id = array();
			// resgatar os usuarios para newsletter
			$sql='select confirmed,perf.id_perf,news.user_id from '.$xoopsDB->prefix('xmail_newsletter').' as news' .
			' left join '.$xoopsDB->prefix('xmail_perfil_news').' as perf on perf.user_id= news.user_id  '.
			' where confirmed=1 ';

			if(isset($_POST['perfil'])) {
				if(is_array($_POST['perfil'])){
				  $tabperf=implode(',',$_POST['perfil']) ;	
				}else{
				  $tabperf=$_POST['perfil'];								
				}
				
				$sql.="  and  perf.id_perf in ($tabperf) ";
			}

			$sql.=' group by news.user_id';
			//echo $sql;
			//var_dump($_POST['perfil']);
			$result=$xoopsDB->queryf($sql);
			if(!$result) {
				echo "<div class='errorMsg' >"._MD_XMAIL_ERRCADNEW . " </div> ";
				break;
			}

			while ($cat_data=$xoopsDB->fetcharray($result)) {
				$added_id[]=$cat_data['user_id'];
			}

			// verificar se vai enviar para quem não selecionou perfil

			if( isset($_POST['perfil']) and  $_POST['sem_perf']==1  ) {
				$sql2='select confirmed,perf.id_perf,news.user_id from '.$xoopsDB->prefix('xmail_newsletter').' as news' .
				' left join '.$xoopsDB->prefix('xmail_perfil_news').' as perf on perf.user_id= news.user_id  '.
				' where confirmed=1 and  isnull(perf.id_perf)
                group by news.user_id';
				$result2=$xoopsDB->queryf($sql2);
				if(!$result2) {
					echo "<div class='errorMsg' >"._MD_XMAIL_ERRCADNEW . " </div> ";
					break;
				}
				while ($cat_data=$xoopsDB->fetcharray($result2)) {
					$added_id[]=$cat_data['user_id'];
				}
			}

			if(count($added_id)==0){
				echo "<div class='errorMsg' >"._MD_XMAIL_NOTSEL. " </div> ";
				break;
			}

			$dest=implode(',',$added_id);

			// gerar nro. de lote
			// gravar as mensagens no xmail_aux_send
			// após chamar  função envia_xmails passando nro. do lote

			$dt_agenda1=$_POST['dt_agenda']['date'];
			$dt_agenda2=$_POST['dt_agenda']['time'];
			$dt_agenda=mktime(0,0,0,substr($dt_agenda1,5,2),substr($dt_agenda1,8,2),substr($dt_agenda1,0,4));
			$dt_agenda+=$dt_agenda2;

			
			$array_itens=array();
			$tot_added=count($added_id);
			$i3=0;
			for($i=0;$i<$tot_added;){
				for($i2=0;($i2<$param->envia_xmails and $i<$tot_added ) ; $i2++){
					$array_itens[$i3][]=$added_id[$i];
					$i++;
				}
				$i3++;
			}
			$tot_lotesger=$i3-1;	
			$erros='';
			
			$lote1=0;
			for($i=0;$i<=$tot_lotesger;$i++){
				$lote=get_novo_lote();
				if($lote1==0)  $lote1=$lote;
				$class_aux_send_l=new classxmail_aux_send_l();

				$class_aux_send_l->lote_solicit=$lote;
				$class_aux_send_l->id_men=$id_men;
				$class_aux_send_l->user_logado=$xoopsUser->getVar('uid');
				$class_aux_send_l->email_conf=$email_conf;
				$class_aux_send_l->mail_fromname=$mail_fromname;
				$class_aux_send_l->mail_fromemail=$mail_fromemail;
				$class_aux_send_l->mail_send_to= implode(',',$mail_send_to); // transf. array em string
				//$class_aux_send_l->array_users=$added_id;
				$class_aux_send_l->array_users=$array_itens[$i];
				$class_aux_send_l->is_new=1;
				$class_aux_send_l->dt_agenda=$dt_agenda;

				if(!$class_aux_send_l->incluir()) {
					$erros.="<br>".$men_erro ;
					
				}
			}
			if(!empty($erros)) {
				echo "<div class='errorMsg' >"._MD_XMAIL_ERRINCLOTE.$erros. " </div> ";
				break;
			}
		
		}
	}

	if($dt_agenda<=(time()+(10*60)) ){
		// envia_xmails_lote($lote,$dest,$mail_start);
		xoops_result(sprintf(_MD_XMAIL_LOTEGERADOS,$lote1,$lote));		
	}else {
		xoops_result(sprintf(_MD_XMAIL_MEN_AGENDADO,date('d/m/Y H:i',$dt_agenda))._MD_XMAIL_MEN_APOS_AGENDAMENTO );
		echo "<p align='center'><a href='index.php'>Voltar</a></p> ";
	}

	break;


	case "form":

	default:
	include_once XOOPS_ROOT_PATH.'/class/pagenav.php';

	$sql="SELECT * FROM ".$xoopsDB->prefix("xmail_mensage").' where is_new=1';
	if(!$isadmin) {
		$sql.=" and uid='".$xoopsUser->getVar('uid')."'";
	}

	$result = $xoopsDB->queryF($sql);
	if (mysql_num_rows($result) == '0') {
		redirect_header("submit.php", '1' , _MD_XMAIL_NOTMEN);
	}

	$sql= "SELECT * FROM ".$xoopsDB->prefix("xmail_mensage")." where aprovada=1 and is_new=1  ";
	if(!$isadmin) {
		$sql.=" and uid='".$xoopsUser->getVar('uid')."'";
	}
	$sql.=' order by id_men desc  ';
	$result = $xoopsDB->queryF($sql);
	if (mysql_num_rows($result) == '0') {
		redirect_header("index.php", '1' , _MD_XMAIL_NOTHAMENAPROV);
	}


	$sform = new XoopsThemeForm(_MD_XMAIL_SENDNEWS, "mailusers", xoops_getenv('PHP_SELF'));


	$men_select = new XoopsFormSelect( _MD_XMAIL_NEWSLETTER, "id_men"  );

	$array_men=array();
	$array_men['']='---------';
	while ($cat_data = $xoopsDB->fetcharray($result)) {
		$array_men[$cat_data['id_men']]=$cat_data['title_men'];
	}
	$xoopsurl=XOOPS_URL;
	$men_select->addOptionArray($array_men);
	$men_select->setExtra("onchange=vermen(this.value,\"$xoopsurl\")");
	$sform->addElement($men_select);

	
	
	
	$fname_text = new XoopsFormText(_MD_XMAIL_MAILFNAME, "mail_fromname", 30, 255, $xoopsConfig['sitename']);
	$fromemail = !empty($xoopsConfig['adminmail']) ? $xoopsConfig['adminmail'] : $xoopsUser->getVar("email", "E");
	$femail_text = new XoopsFormText(_MD_XMAIL_MAILFMAIL, "mail_fromemail", 30, 255, $fromemail);

	$start_hidden = new XoopsFormHidden("mail_start", 0);
	$op_hidden = new XoopsFormHidden("op", "send");
	$mail_hidden = new XoopsFormHidden("mail_send_to", "mail");
	$submit_button = new XoopsFormButton("", "mail_submit", _SEND, "submit");

	$sform->addElement($fname_text);
	$sform->addElement($femail_text);
	$sform->addElement($to_checkbox);
	$sform->addElement(new XoopsFormText(_MD_XMAIL_MAILCONFIRM, "email_conf ", 30, 255,'') );
	$sform->addElement($op_hidden);
	$sform->addElement($mail_hidden);
	$sform->addElement($start_hidden);

	if($usa_perf) {
		$tab_perf=$classperf->get_tab_perf("<br>");
		$check_perfil= new  XoopsFormCheckBox(_MD_XMAIL_SELPERF, 'perfil' );
		$check_perfil->addOptionArray($tab_perf);
		$sform->addElement($check_perfil);
		$sform->addElement(new XoopsFormRadioYN( _MD_XMAIL_SEMPERF, 'sem_perf', '', _MD_XMAIL_YES, _MD_XMAIL_NO));

	}
	$sform->addElement(new XoopsFormDateTime(_MD_XMAIL_DT_AGENDA, "dt_agenda"));
	
	
	$sform->addElement($submit_button);
	$sform->display();

	break;


}
include(XOOPS_ROOT_PATH."/footer.php");
?>

