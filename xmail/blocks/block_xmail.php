<?php
function b_xmail_show_ativa($options) {
$bloco = array();
$bloco['title'] = '_MB_XMAIL_TITBLOCO1';
$bloco['content'] = '';
$bloco['content'].= '<table  cellspacing="0">';
$bloco['content'].= "<tr><td><a href='".XOOPS_URL."/modules/xmail/include/xmail_ativa.php'>"._MB_XMAIL_DESCRIBLOCO1."</a></td></tr>";
$bloco['content'].= '</table>';
return $bloco;
}

function b_xmail_edit_ativa($options) {


}

function b_xmail_show_news($options)
{
	global $xoopsModule, $xoopsConfig;
    	$db =& Database::getInstance();
    	$myts =& MyTextSanitizer::getInstance();
    	$block = array();
	$block['lang_tooltip1']=_MB_XMAIL_BTOOLTIP1;
	$block['lang_tooltip2']=_MB_XMAIL_BTOOLTIP2;
	$block['subscr_url']= XOOPS_URL. '/modules/xmail/include/xnews.php?action=subscribe';
	$block['unsubscr_url']= XOOPS_URL. '/modules/xmail/include/xnews.php?action=unsubscribe';
	$block['news_images']=sprintf('%s/modules/xmail/language/%s/', XOOPS_URL,$xoopsConfig['language']);

	$query="SELECT count(user_id) as number FROM ".$db->prefix('xmail_newsletter')." WHERE confirmed='1'";
    	if (!$result = $db->query($query)) {
	        return false;
    	}
    	$arr = $db->fetchArray($result);
    	$block['pepole_subscribed']=$myts->makeTboxData4Show(sprintf(_MB_XMAIL_SUBSCRIBED_PEOPLE,$arr['number']));
	return $block;
}

function b_xmail_edit_news($options) {


}


function b_xmail_ulti_news($options){
	global $xoopsDB,$xoopsTpl ;
$path_javascriptx=XOOPS_URL.'/modules/xmail/javascripts';
$xoopsTpl->assign('xoops_module_header','<script type="text/javascript" src="'.$path_javascriptx.'/xmail_funcoes.js"></script>' . $xoopsTpl->get_template_vars( "xoops_module_header" ));

	$sql=' select id_men, body_men, title_men  from '.$xoopsDB->prefix('xmail_mensage').
	' where is_new order by date_envio desc  limit 5';
	$result=$xoopsDB->queryf($sql);
	$block = array();
	$block['title'] = '_MB_XMAIL_TITBLOCO3';
//$bloco['content'] = '';
//$bloco['content'].= '<table  cellspacing="0">';
//$bloco['content'].= "<tr><td><a href='".XOOPS_URL."/modules/xmail/include/xmail_ativa.php'>"._MB_XMAIL_DESCRIBLOCO1."</a></td></tr>";
//$bloco['content'].= '</table>';
	
	$xoopsurl=XOOPS_URL;
	if($result){
	   while($cat_data=$xoopsDB->fetcharray($result)){		
	   	$block['content']= "<a href='javascript:vermen(".$cat_data['id_men'].","."\"$xoopsurl\"".")'>".$cat_data['title_men']."</a><br>";   	
	   //	$block['content']= "<a href='javascript:vermen(".$cat_data['id_men'].")'>".$cat_data['title_men']."</a><br>";   	
	   }
	}else{
		$block['content']="Erro na sql ";		
	}
	return $block;
	
}
function  b_xmail_edit_ulti_news($options){

	
}

// não usar, não funciona legal, pode haver repetições
// usar o send_agenda_ajax.php
function b_xmail_send_agenda_ajax($options){
global $xoopsTpl;
	$block=array();

//$block['title']=_MB_XMAIL_TITBLOCO4;
$block['title']='';	
$block['content']="<div id='bloco_agenda'  >Em processamento... </div> ";


// IMPLEMENTAR  CHAMADA COM ajax.periodicalupdater p/ send_agenda.php

//  carregar  arquivos javascript p/ ajax
$path_javascript=XOOPS_URL.'/modules/xmail/javascripts/scriptaculous-js-1.7.0';
$xoopsTpl->assign('xoops_module_header','<script type="text/javascript" src="'.$path_javascript.'/lib/prototype.js"></script>
<script type="text/javascript" src="'.$path_javascript.'/src/scriptaculous.js"></script>
	' . $xoopsTpl->get_template_vars( "xoops_module_header" ));
// 

//  instanciar classe  ajax
$script_agenda=XOOPS_URL.'/modules/xmail/include/send_agenda.php';
?> <script type='text/javascript' >
	 new Ajax.Updater('bloco_agenda','<?php echo $script_agenda?>',{method:'post',encoding:'ISO-8859-1'})
 </script>
<?php 
//

return $block;
}
// não usar..
function b_xmail_send_agenda_ajax_edit($options){
	
	
	
}






?>