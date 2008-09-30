<?PHP
/*
* $Id: include/xmail_ativa.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Mar�o 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

//  Este script n�o deve ser colocado no diret�rio raiz do xmail ,pois sen�o an�nimos n�o poder�o acessar
//  pois o m�dulo xmail n�o deve ser acessado por an�nimos

$conf_id = $_GET['id'];
if(empty($conf_id) or is_null($conf_id)) {  // indica ser ativa��o de conta

    $xoopsOption['pagetype'] = "user";
    require_once('../../../mainfile.php');
    include_once( XOOPS_ROOT_PATH . "/header.php" );
    require_once XOOPS_ROOT_PATH."/modules/xmail/include/functions.php";

    $myts =& MyTextSanitizer::getInstance();

    $config_handler =& xoops_gethandler('config');
    $xoopsConfigUser =& $config_handler->getConfigsByCat(XOOPS_CONF_USER);

    // carregar arquivos de tradu��o
   	if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php") ) {
		include_once XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php";
	} else {
		if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php") ) {
			include_once XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php";
		}
	}

    $email = isset($_GET['email']) ? trim($_GET['email']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : $email;

    // Se $email for vazio, mostra o form para envio do link
    if ($email == '') {
        include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
       if($xoopsConfigUser['activation_type'] == 0)
          $label= _MD_XMAIL_EMAILATIVA;
       else
          $label= _MD_XMAIL_EMAILATIVA2;
       	$sform = new XoopsThemeForm(_MD_XMAIL_FORMATIVA, "storyform", xoops_getenv('PHP_SELF'));
    	$sform->addElement(new XoopsFormText($label, 'email', 26, 60,''), true);
        $sform->addElement(new XoopsFormButton('', 'post', _MD_XMAIL_SUBMIT, 'submit'));
        $sform->display();

    // Se $email n�o for vazio , vamos fazer uma s�rie de verifica��es antes de enviar
    }else{

        $myts =& MyTextSanitizer::getInstance();
        $member_handler =& xoops_gethandler('member');
        // A linha abaixo retornar� um array com todos os usu�rios que tenham o e-mail citado, no nosso caso ser� apenas $getuser[0]
        $getuser =& $member_handler->getUsers(new Criteria('email', $myts->addSlashes($email)));
        // Se o e-mail n�o existir na base de dados, $getuser ser� vazio...
        if (empty($getuser)) {
            xoops_error(_MD_XMAIL_EMAILNOTCAD);
            include(XOOPS_ROOT_PATH.'/footer.php');

        	exit();
         }
        //Verificando se o usu�rio j� est� ativo...
        if($getuser[0]->isActive()){
            xoops_error(sprintf(_MD_XMAIL_EMAILJACAD, $getuser[0]->getVar('uname'),$getuser[0]->getVar('email')));
            include(XOOPS_ROOT_PATH.'/footer.php');
           	exit();
        }
        // enviando email
        envia_email_ativa($getuser[0],0,$xoopsConfigUser,$xoopsConfig);

        }
        include(XOOPS_ROOT_PATH.'/footer.php');
}else {
    require_once('../../../mainfile.php');
    include_once( XOOPS_ROOT_PATH . "/header.php" );
	$xoopsOption['template_main'] = 'xmail_notice.html';
	include(XOOPS_ROOT_PATH.'/header.php');	// Include the page header

      // carregar arquivos de tradu��o
   	if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php") ) {
		include_once XOOPS_ROOT_PATH."/modules/xmail/language/".$xoopsConfig['language']."/main.php";
	} else {
		if ( file_exists(XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php") ) {
			include_once XOOPS_ROOT_PATH."/modules/xmail/language/english/main.php";
		}
	}

	$xoopsTpl->assign('lang_status', _MD_XMAIL_STATUS);

	$conf_id = $_GET['id'];
	$query = "select * from ".$xoopsDB->prefix('xmail_newsletter')." where user_conf='$conf_id'";
	$result = $xoopsDB->query($query);
	$arr = $xoopsDB->fetchArray($result);
	if ($arr['confirmed'] == '1') {
		$xoopsTpl->assign('en_message',ucfirst($arr['user_name']).', '. _MD_XMAIL_PREVCONFIRM);
	} else {
		$query = "update ".$xoopsDB->prefix('xmail_newsletter')." SET confirmed='1' where user_conf='$conf_id'";
		$result = $xoopsDB->queryF($query);
		$xoopsTpl->assign('en_message', ucfirst($arr['user_name']).', '._MD_XMAIL_CONFIRMASUCCESS . _MD_XMAIL_CONFIRMATION_NUMBER . $conf_id);
	}
	// Include the page footer
	include(XOOPS_ROOT_PATH.'/footer.php');

}

?>
