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


    $xoopsOption['pagetype'] = "user";
    require_once('../../../mainfile.php');
    include_once( XOOPS_ROOT_PATH . "/header.php" );
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

$arqlog=XOOPS_ROOT_PATH."/modules/xmail/upload/xmail_erros.log";
//include_once( XOOPS_ROOT_PATH . "/header.php" );

set_time_limit(0);

$param= new classparam();


$sql='select * from '.$xoopsDB->prefix('xmail_aux_send_l').' where dt_agenda<='.time();
$result=$xoopsDB->queryf($sql);
if(!$result){
	xoops_error( 'erro na sql '	,$sql.' - '.$xoopsDB->error());
	
}else {
	if($xoopsDB->getRowsNum($result)>0){
	$time_inicio=time();       
	$qtd_enviado=0;	
	$time_intervalo=($param->hora_intervalo*60*60);
	
	while($cat_data=$xoopsDB->fetcharray($result)){
		$lote=$cat_data['lote_solicit'];
	
	  if(!isset($_GET['mail_start']))
          $mail_start=0;
      else 
      	  $mail_start=$_GET['mail_start'];


     if(!isset($dest))
        $dest='';

    
    $qtd_no_lote=calc_emails_nolote($lote);            
    $qtd_ainda_pode_enviar=$param->envia_xmails-$qtd_enviado;
    
    if( $param->hora_intervalo>0 and  $qtd_no_lote>$param->envia_xmails ) {
	   grvlog($arqlog,"\nEm ".date('d/m/Y H:i')." Módulo Xmail - :".$_SERVER['SCRIPT_FILENAME']."\n".sprintf(_MD_XMAIL_QTDLOTEMAIOR,$lote));    
	}
    
    if( $param->hora_intervalo==0 or   $qtd_no_lote<=$qtd_ainda_pode_enviar  ){
    	envia_xmails_lote($lote,$dest,$mail_start);
        $qtd_enviado=$qtd_enviado+$qtd_no_lote;
    }

	// se ha restrição de envios por hora,  calcular espera....
    if($param->hora_intervalo>0){
    	// verificar quanto esperar para disparar o proximo lote
    	$time_atual=time();
    	$tempo_de_sobra=$time_intervalo- ($time_atual-$time_inicio);
    	if($tempo_de_sobra>0){
    		// verificar se ja estourou o limite de quant.
    		$qtd_ainda_pode_enviar=$param->envia_xmails-$qtd_enviado;
    		if($qtd_ainda_pode_enviar<=0){
				sleep($tempo_de_sobra);   // aguardar o tempo restante
				// resetar valores
				$time_inicio=time();       
				$qtd_enviado=0;	
    		}
    	}else {
			// acabou tempo,  resetar os valores
    		$time_inicio=time();       
			$qtd_enviado=0;	
    	}
    }
    
	}// FECHA WHILE 	
	}else{
		xoops_result(_MD_XMAIL_NAO_MEN_AGENDADA);
	}
	xoops_result("Início :".date('d/m/y H:i:s',$inicio).' Fim: '.date('d/m/y H:i:s') );
}


//include(XOOPS_ROOT_PATH."/footer.php");
?>