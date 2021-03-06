<?php
/*
* $Id: include/storyform.inc.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Mar�o 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/
include XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

$arq_editor=XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php";
if(file_exists($arq_editor)){
	include_once($arq_editor);
}
//    $editor_name = !empty($_GET['editor_name'])? $_GET['editor_name']: "";
    
	if(class_exists ('XoopsThemeFormFlat'))
	   $sform = new XoopsThemeFormFlat(_MD_XMAIL_SMNAME, "storyform", xoops_getenv('PHP_SELF')); 	
	else
	   $sform = new XoopsThemeForm(_MD_XMAIL_SMNAME, "storyform", xoops_getenv('PHP_SELF'));

 	$sform->addElement(new XoopsFormText(_MD_XMAIL_TIT, 'title_men', 50, 50, $title_men), true);
    $subject_men_caption = _MD_XMAIL_MAILSUBJECT."<br /><br /><span style='font-size:x-small;font-weight:bold;'>"._MD_XMAIL_MAILTAGS."</span><br /><span style='font-size:x-small;font-weight:normal;'>"._MD_XMAIL_MAILTAGS2."</span>";
    $subject_caption =   _MD_XMAIL_MAILBODY."<br /><br /><span style='font-size:x-small;font-weight:bold;'>"._MD_XMAIL_MAILTAGS."</span><br /><span style='font-size:x-small;font-weight:normal;'>"._MD_XMAIL_MAILTAGS1."<br />"._MD_XMAIL_MAILTAGS2."<br />"._MD_XMAIL_MAILTAGS3."</span>";
	$sform->addElement(new XoopsFormText($subject_men_caption, 'subject_men',  50 ,80,$subject_men), true);

//	$sform->addElement(new XoopsFormDhtmlTextArea($subject_caption, 'body_men', $body_men, 7, 60));
    //  editor visual ou n�o
    $rows = 7;
    $cols = 60;
    $width = '100%';
    $height = '400px';
    $isWysiwyg = false;

    $xmail_form=$param->tipo_editor;


    if($param->allow_html) {

    	$name='body_men';
    	require XOOPS_ROOT_PATH.'/modules/xmail/include/xmail_getWysiwygForm.php';
       
       $isWysiwyg = true;

    } else {
    	$editor = &xmail_getTextareaForm('dhtml', $subject_caption, 'body_men', $body_men, $rows, $cols);
    }
    $sform->addElement($editor, true);
    // solicitar mensagem somente texto para clientes de email que n�o aceitam html
    $sform->addElement(new XoopsFormTextArea(_MD_XMAIL_MENSOTEXTO,'body_men_text',$body_men_text));
    
if($param->allow_html) {
    $sform->addElement(new XoopsFormHidden('dobr', 0));
}else {
    $sform->addElement(new XoopsFormHidden('dobr', 1));
}
    $html_checkbox = new XoopsFormCheckBox('', 'dohtml', $dohtml);
    $html_checkbox->addOption(1, _MD_XMAIL_DOHTML);
    $sform->addElement($html_checkbox);


    $isnew_checkbox = new XoopsFormCheckBox('', 'is_new', $is_new);
    $isnew_checkbox->addOption(1, _MD_XMAIL_NEWSLETTER);
    $sform->addElement($isnew_checkbox);

	$sform->addElement(new XoopsFormHidden('id_men', $id_men));

    $button_tray= new XoopsFormButton('', 'post', _MD_XMAIL_SUBMIT, 'submit');
    $opt_select = new XoopsFormSelect( "", "opt"  );
    if(!$param->allow_html) {
     // definir bot�o submit com preview e save somente se n�o for editor visual
       $opt_select->addOptionArray(array("preview" => _MD_XMAIL_PREVIEW,"save" => _MD_XMAIL_SAVE ));
    } else {
       $opt_select->addOptionArray(array("save" => _MD_XMAIL_SAVE ));
    }

   	$opt_tray = new XoopsFormElementTray("");
	$opt_tray->addElement($opt_select);
	$opt_tray->addElement($button_tray);
    //
    $sform->addElement($opt_tray);

    $sform->display();


?>
