<?php
/**
 * include/hack_form_forn.php
 */

require_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';

// Título do Form
$formu = new XoopsThemeForm(_AM_XMAIL_ALT.'  '._AM_XMAIL_ASSINANTES,'form_ass','');

$formu->addElement(new XoopsFormLabel(_AM_XMAIL_ID,$obj_ass->getVar('user_id')));
$formu->addElement(new XoopsFormText(_AM_XMAIL_USERNAME,'user_name',60,60,$obj_ass->getVar('user_name')),1);
$formu->addElement(new XoopsFormText(_AM_XMAIL_LOGIN,'user_nick',25,25,$obj_ass->getVar('user_nick')),1);
$formu->addElement(new XoopsFormText(_AM_XMAIL_EMAIL,'user_email',60,60,$obj_ass->getVar('user_email')),1);

$formu->addElement(new XoopsFormHidden('idperf', $_SESSION['idperf']));
$formu->addElement(new XoopsFormHidden('action', 'salvar'));
$formu->addElement(new XoopsFormHidden('user_id', $obj_ass->getVar('user_id')));
// </ campos ocultos > 


$envia_tray = new XoopsFormElementTray("");
$envia = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
$voltar = new XoopsFormButton('', 'reset', 'Voltar');
//$voltar->setExtra("onclick=\"document.location= '".XOOPS_URL."/modules/$mydirname/admin/".xoops_getenv('PHP_SELF'). "?op=listar'\"");
$voltar->setExtra("onclick=\"document.location= '$adminURL&action=rem_user&idperf=".$_SESSION['idperf']."'\"");



$envia_tray->addElement($envia);
$envia_tray->addElement($voltar);
$formu->addElement($envia_tray);

?>