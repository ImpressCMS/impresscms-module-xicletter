<?php
/*
* $Id: admin/param.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

include "admin_header.php";

$admin_mydirname = basename( dirname( dirname( __FILE__ ) ) ) ; // Generalizando o nome do diretório do módulo. - GibaPhp

include_once XOOPS_ROOT_PATH.'/modules/'.$admin_mydirname.'/include/mimetype.php';

$op ='';

//foreach ($_POST as $k => $v) {
//	${$k} = $v;
//}
//if (isset($_GET['op'])) $op=$_GET['op'];
//if (isset($_POST['op'])) $op=$_POST['op'];

if ( isset($_POST['post']) ) $op = 'post';

Global $xoopsDB ;
switch($op){
case "post" :  // executar alteração / execute modification

//	xoops_cp_header();

      $param= new classparam();
      
      $param->dias_excluir=$_POST['dias_excluir'] ;
      $param->envia_xmails=$_POST['envia_xmails'];
      $param->ordem_admin=$_POST['ordem_admin'];
      $param->limite_page=$_POST['limite_page'];
      $param->aprov_auto=$_POST['aprov_auto'];
      $param->dir_upload=$_POST['dir_upload'];
      $param->selmimetype = saveAccess_xmail($_POST['selmimetype']);
      $param->maxupload=$_POST['maxupload'];
      $param->format_time=$_POST['format_time'];
      $param->permite_anexo=$_POST['permite_anexo'];
      $param->file_mode=$_POST['file_mode'];
      $param->veri_mailok=$_POST['veri_mailok'];
      $param->allow_html=$_POST['allow_html'];
      $param->tipo_editor=$_POST['tipo_editor'];
      $param->usa_perf=$_POST['usa_perf'];
      $param->minutos_intervalo=$_POST['minutos_intervalo'];
      $param->lotes_por_hora=$_POST['lotes_por_hora'];


	if (!$param->alterar()) {
        redirect_header("index.php",2,_AM_XMAIL_ERRORSAVINGDB."&nbsp;".$men_erro );
    }
    redirect_header("index.php",2,_AM_XMAIL_SAVEOK );
	break;


case "default":

     default:     // form para alterar parâmetros / form to modify parameters
//     xoops_cp_header();

     include XOOPS_ROOT_PATH."/class/xoopsformloader.php";

     $file_editor=XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php";
     if(file_exists($file_editor)){
     	include_once($file_editor);
     	$editorhandler = new XoopsEditorHandler();
	    $editors = & $editorhandler->getList();

     }else{
     	$editors=array();     	
     }

    $editors['meditor']='Módulo Editor';  // implementado 14/02/06     
     
     
     // instanciar a classe de parametros e se não houve registro, incluir um
     // instantiate parameters class and, if there's no records, add one
     $param= new classparam();

       $dias_excluir=$param->dias_excluir;
       $envia_xmails=$param->envia_xmails;
     

     $ordem_select = new XoopsFormSelect( _AM_XMAIL_ORDEMADMIN  , "ordem_admin" ,$param->ordem_admin );
     $ordem_select->addOptionArray(array('A' => _AM_XMAIL_PARAM1 , 'C' => _AM_XMAIL_PARAM2, 'DN' => _AM_XMAIL_PARAM3,'DA' => _AM_XMAIL_PARAM4 ));

     $sform = new XoopsThemeForm(_AM_XMAIL_FORMPARAM, "storyform", xoops_getenv('PHP_SELF'));

     $sform->addElement(new XoopsFormText(_AM_XMAIL_DIASEXC, 'dias_excluir', 4, 4, $dias_excluir), true);
     $sform->addElement(new XoopsFormText(_AM_XMAIL_ENVIAXMAILS._AM_XMAIL_ENVIAXMAILS2 , 'envia_xmails', 4, 4, $envia_xmails), true);
     $sform->addElement($ordem_select);
     $sform->addElement(new XoopsFormText(_AM_XMAIL_LIMITEPAGE , 'limite_page', 4, 4, $param->limite_page), true);
     $sform->addElement(new XoopsFormRadioYN(_MD_XMAIL_APROVAUTO, 'aprov_auto', $param->aprov_auto , _MD_XMAIL_YES, _MD_XMAIL_NO));
     $sform->addElement(new XoopsFormRadioYN(_AM_XMAIL_PERMITE_ANEXO, 'permite_anexo', $param->permite_anexo , _MD_XMAIL_YES, _MD_XMAIL_NO));

     $dir_tray = new XoopsFormElementTray(_AM_XMAIL_DIRUPLOAD,"<br>");
     //$dir_tray->addElement(new XoopsFormText(sprintf(XOOPS_URL."/"), 'dir_upload', 30, 255, $param->dir_upload), true);
     $dir_tray->addElement(new XoopsFormLabel(XOOPS_ROOT_PATH.'/'.$param->dir_upload));
     $dir_tray->addElement(new XoopsFormHidden('dir_upload',$param->dir_upload));
     $getcorrect = getcorrectpath($param->dir_upload);
     $dir_tray->addElement(new XoopsFormLabel($getcorrect, ''));
     $sform->addElement($dir_tray);

     // até aqui ok
     


	$graph_array =& mimetype::privBuildMimeArray();
	$graph_array=acerta_array($graph_array);

// problema exatamente na linha abaixo
	$indeximage_select = new XoopsFormSelect(_AM_XMAIL_ALLOWMIMETYPES, 'selmimetype', getGroupIda_xmail($param->selmimetype), 20, true);
	$indeximage_select->addOptionArray($graph_array);
	$sform->addElement($indeximage_select);

    $sform->addElement(new XoopsFormText(_AM_XMAIL_MAXUPLOAD , 'maxupload', 10, 10, $param->maxupload), true);
    $sform->addElement(new XoopsFormText(_AM_XMAIL_FORMAT_TIME , 'format_time', 20, 100, $param->format_time), true);
    $sform->addElement(new XoopsFormText(_AM_XMAIL_FILE_MODE , 'file_mode', 4, 4, $param->file_mode), true);
    $sform->addElement(new XoopsFormRadioYN(_AM_XMAIL_VERI_MAILOK."<br />"._AM_XMAIL_VERI_MAILOK2, 'veri_mailok', $param->veri_mailok , _MD_XMAIL_YES, _MD_XMAIL_NO));

    if(count($editors)>0){
      $sform->addElement(new XoopsFormRadioYN(_AM_XMAIL_ALLOWHTML, 'allow_html', $param->allow_html , _MD_XMAIL_YES, _MD_XMAIL_NO));    	
    }else{
	  $sform->addElement(new XoopsFormHidden('allow_html',0));    	
    }
    


    if(count($editors)>0){
	    $select_editor = new XoopsFormSelect(_AM_XMAIL_TIPOEDITOR  , 'tipo_editor', $param->tipo_editor, 4 );
//    $editors = & $editorhandler->getList();
//	$editors['meditor']='Módulo Editor';  // implementado 14/02/06
	    $select_editor->addOptionArray($editors);
//  	$select_editor->addOptionArray(array('spaw' => spaw ,'fck' => fck ,'htmlarea' => htmlarea ,'koivi' => Koivi ,'tinymce' => tynymce)  );
    }else{
    	$select_editor=new XoopsFormLabel(_AM_XMAIL_TIPOEDITOR ,_AM_XMAIL_EDITORVISUAL);
    }

    $sform->addElement($select_editor);
    $sform->addElement(new XoopsFormRadioYN(_AM_XMAIL_USAPERF, 'usa_perf', $param->usa_perf , _MD_XMAIL_YES, _MD_XMAIL_NO));
    //$sform->addElement(new XoopsFormText(_AM_XMAIL_HORAINTERVALO , 'hora_intervalo', 2, 2, $param->hora_intervalo) );
    $sform->addElement(new XoopsFormText(_AM_XMAIL_MINUTOSINTERVALO , 'minutos_intervalo', 2, 2, $param->minutos_intervalo) );
    $sform->addElement(new XoopsFormText(_AM_XMAIL_LOTESPORHORA , 'lotes_por_hora', 3, 3, $param->lotes_por_hora) );
    
    $sform->addElement(new XoopsFormButton('', 'post', _MD_XMAIL_SUBMIT, 'submit'));

    
    
    
    $sform->display();

	break;
}
xoops_cp_footer();
?>

