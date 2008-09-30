<?php
// usada como include em storyform.inc.php
//function &xmail_getWysiwygForm($xmail_form, $caption, $name, $value = "", $width = '100%', $height = '400px') {
//    global $xoopsModule,$xoopsUser,  $xoopsConfig, $xoopsDB ,$spaw_dir,$spaw_root,$spaw_base_url ;
    

$editor_name = ! empty($_GET['editor_name'])?$_GET['editor_name'] :   (empty($param->tipo_editor) ? 'dhtml' : $param->tipo_editor)  ;
	if(class_exists('XoopsEditorHandler')){
    	$editorhandler = new XoopsEditorHandler();
	}
    if(is_object($editorhandler)){
       $editors = & $editorhandler->getList();	    	
    }
    
    $editors['meditor']=_MD_XMAIL_MODEDITOR;  // implementado 14/02/06
    $editors['dhtml']='Dhtml';  // implementado 14/02/06
    
    $select_form = new XoopsThemeForm('', 'form_selecteditor', xoops_getenv('PHP_SELF'), 'get');
    $option_select = new XoopsFormSelect('', 'editor_name', $editor_name);
    $option_select->setExtra('onchange="if(this.options[this.selectedIndex].value.length > 0 ){ forms[\'form_selecteditor\'].submit() }"');
    $option_select->addOptionArray($editors);
    $button_tray = new XoopsFormElementTray("Select Editor");
    $button_tray->addElement(new XoopsFormLabel($option_select->render()));
    $button_tray->addElement(new XoopsFormButton('', '', _SUBMIT, "submit"));
    $button_tray->addElement(new XoopsFormHidden('op', $op));
    $button_tray->addElement(new XoopsFormHidden('id_men', $id_men));
    $select_form->addElement($button_tray);
    $select_form->display();

    $options['caption'] = $subject_caption;
    $options['name'] =$name;
//    $options['value'] = $value ;
    $options['value'] = $body_men ;
    $options['rows'] = 25;
    $options['cols'] = 60;
    $options['width'] = $width;
    $options['height'] = $height;


    if($editor_name=='meditor'){
		// verificar se o módulo está instalado
    	$modulo_handler = &xoops_gethandler('module');
    	$modulo = &$modulo_handler->getByDirname('editor');
    	if (is_object($modulo) && $modulo->getVar('isactive'))
    	{
    		include_once XOOPS_ROOT_PATH . "/modules/editor/spaw_control.class.php";
    		$editor_incluido = true;
    	}else{
    		$editor_incluido = false;
    	}
    	if ($editor_incluido)
    	{
    		ob_start();
    		//$editor_classe = new SPAW_Wysiwyg($name,$value, 'br', 'full', 'default');
    		$editor_classe = new SPAW_Wysiwyg($name,$body_men, 'br', 'full', 'default');
    		$editor_classe->show();
    		$editor=new XoopsFormLabel($caption, ob_get_contents());
    		ob_end_clean();
    	}else {
    		//$editor = new XoopsFormDhtmlTextArea($caption, $name, $value);
    		echo "<script>alert('"._MD_XMAIL_MODEDITORNOT."')</script>";
    		$editor = new XoopsFormDhtmlTextArea($caption, $name, $body_men);
    	}
    	
    }elseif ($editor_name=='tinyeditor' ) {
    	// ver se está ativo
    	$modulo_handler = &xoops_gethandler('module');
    	$modulotiny = &$modulo_handler->getByDirname($editor_name);
    	if ( !( is_object($modulotiny) && $modulotiny->getVar('isactive')) ){
    		//echo "<script>alert('"._MD_XMAIL_MODTINYEDITORNOT."')</script>";
			$editor = new XoopsFormDhtmlTextArea($caption, $name, $body_men);
    	}else{
		if ( is_readable(XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php"))	{
			include_once(XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php");
			$editor = new XoopsFormTinyeditorTextArea(array('caption'=>$caption, 'name'=>$name, 'value'=>$body_men, 'width'=>'100%', 'height'=>'400px'));
		}
    	}
    
    }else {
   	
    	//$editor = new XoopsFormDhtmlTextArea($caption, $name, $body_men);
    	
    	//$sample_form->addElement(new XoopsFormEditor(_MD_MESSAGEC, $editor, $editor_configs, $nohtml = false, $onfailure = "textarea"), true);
    	//  testar  
    	//$editor= new XoopsFormEditor($caption , $editor_name, $options, $nohtml = false, $onfailure = "Dhtmltextarea");
    	
       	$editor = & $editorhandler->get($editor_name, $options, "textarea");
	   	if($editor){
    		$editorhandler->setConfig(
    		$editor,
    		array(
    		"filepath" => XOOPS_UPLOAD_PATH.'/'.$xoopsModule->getVar("dirname"),
    		"upload" => true,
    		"extensions" => array("txt", "jpg", "zip")
    		));
    	}
   	
    }
    
    //return $editor ;

//}

?>