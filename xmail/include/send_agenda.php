<?php
/*
* $Id: includes/send_agenda.php
* Module: XMAIL
* Version: v2.0
* Release Date: 26 de junho  de 2006
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba)
* License: GNU
*/

//  Para ser executado a partir de agendador de tarefas
// Montar de forma que não precise autenticar o usuário, mas deverá autenticar o ip
// que solicitou a tarefa.

// $_SERVER["REMOTE_ADDR"]	127.0.0.1


//  Este script não deve ser colocado no diretório raiz do xmail,caso contrário não será executado sem user logado
//  pois o módulo xmail não deve ser acessado por anônimos

error_reporting(E_ALL);
$xoopsOption['pagetype'] = "user";
// tentar forçar  para  não usar classe  xoopsmysqldatabaseproxy (class/database/databasefactory.php)
// common.php forçar para não definir XOOPS_DB_CHKREF  o qual poderia tambem chamar classe xoopsmysqldatabaseproxy
//  if (!defined('XOOPS_XMLRPC')) {
//        define('XOOPS_DB_CHKREF', 1);
// Mas qual problema de usar essa classe ?
// Ocorre que ao usa-la a funcão $xoopsDB->query so executa sql de select e se houver
// necessidade de incluir private message  não acontece, pois em  kernel/privmessage.php
// força o uso do query ao invez do queryf. Como ela é chamada pela xoopsmailer.php,
// não quero alterar kernel para funcionar. Dessa forma para resolver, foi usado as 2
// linhas abaixo para contornar

define('XOOPS_XMLRPC', 1);
$_SERVER['REQUEST_METHOD']='POST' ;
//
require_once('../../../mainfile.php');
include_once( XOOPS_ROOT_PATH . "/header.php" );
// definir charset p/ ajax
header("Content-Type: text/html;  charset=ISO-8859-1",true) ;
ob_end_flush();

$config_handler =& xoops_gethandler('config');
$xoopsConfigUser =& $config_handler->getConfigsByCat(XOOPS_CONF_USER);

// carregar arquivos de tradução
if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php") ) {
	include_once XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php";
} else {
	if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php") ) {
		include_once XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php";
	}
}


$inicio=time();

include_once XOOPS_ROOT_PATH."/modules/xmail/include/functions.php";
include_once XOOPS_ROOT_PATH."/modules/xmail/include/classparam.php";

include_once(XOOPS_ROOT_PATH."/modules/xmail/include/classfiles.php");
include_once(XOOPS_ROOT_PATH."/modules/xmail/include/class_aux_send.php");

include_once XOOPS_ROOT_PATH."/modules/xmail/grvlog.php";

//$arqlog=XOOPS_ROOT_PATH."/modules/xmail/upload/xmail_erros.log";

$param= new classparam();

$arqlog=XOOPS_ROOT_PATH."/".$param->dir_upload."/xmail_erros.log";

// SErvidores com safe_mod ativado , não aceita alterar set_time_limit
//set_time_limit(0);

$param= new classparam();


$sql='select * from '.$xoopsDB->prefix('xmail_aux_send_l').' where dt_agenda<='.time();
$result=$xoopsDB->queryf($sql);
if(!$result){
	xoops_error( 'erro na sql '	,$sql.' - '.$xoopsDB->error());

}else {
	if($xoopsDB->getRowsNum($result)>0){
		$time_inicio=time();
		$time_intervalo=(60*60);  // 1 hora
		$qtd_lote_env=0;  // qtd. de lotes enviados

		while($cat_data=$xoopsDB->fetcharray($result)){
			$xoopsUser =& $member_handler->getUser($cat_data['user_logado']);
        	if (!is_object($xoopsUser)) {
        		echo "não instanciou xoopsuser \n";
        	}
			$lote=$cat_data['lote_solicit'];

			envia_xmails_lote($lote);
			$qtd_lote_env++;

			// verificar qtdos minutos deve aguardar , antes de disparar o proximo lote..
			if($param->minutos_intervalo>0){
				echo "aguardando ".$param->minutos_intervalo."  minuto(s) ....";
				sleep($param->minutos_intervalo*60);
			}

			// se ha restrição de envios por hora,  calcular espera....
			if($param->lotes_por_hora>0  and  $qtd_lote_env==$param->lotes_por_hora  ){
				// verificar quanto esperar para disparar o proximo lote
				$time_atual=time();
				$tempo_de_sobra=$time_intervalo-($time_atual-$time_inicio);
				if($tempo_de_sobra>0){
					echo "aguardando ".$tempo_de_sobra." segundos.... ";
					sleep($tempo_de_sobra);   // aguardar o tempo restante
				}else {
					// acabou tempo,  resetar os valores
				}
				// ressetar valores
				$time_inicio=time();
				$qtd_lote_env=0;

			}

		}// FECHA WHILE
	}else{
		xoops_result(_MD_XMAIL_NAO_MEN_AGENDADA);
	}
	xoops_result("Início :".date('d/m/y H:i:s',$inicio).' Fim: '.date('d/m/y H:i:s') );
}


//include(XOOPS_ROOT_PATH."/footer.php");
?>