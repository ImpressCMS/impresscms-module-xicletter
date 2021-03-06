tinyMCE.importPluginLanguagePack('mlcontent');

function TinyMCE_mlcontent_getControlHTML(control_name) {
    switch (control_name) {
        case "mlcontent":
        var cmd = 'tinyMCE.execInstanceCommand(\'{$editor_id}\',\'mceMlcontent\');return false;';
            return '<a href="javascript:' + cmd + '" onclick="' + cmd + '" class="mceButtonNormal" onmouseover="tinyMCE.switchClass(this,\'mceButtonNormal\');" onmouseout="tinyMCE.switchClass(this);" onmousedown="tinyMCE.switchClass(this,\'mceButtonSelected\');"><img id="{$editor_id}_mlcontent" src="{$pluginurl}/images/mlcontent.gif" title="{$lang_insert_mlcontent_desc}" alt="{$lang_insert_mlcontent_desc}" width="20" height="20" /></a>';
    }
    return "";
}

function TinyMCE_mlcontent_execCommand(editor_id, element, command, user_interface, value) {
    switch (command) {
        case "mceMlcontent":
            var template = new Array();
            template['file']   = '../../plugins/mlcontent/mlcontent.php';
            template['width']  = 400;
            template['height'] = 300;
            var mltext = "";
            tinyMCE.openWindow(template, {editor_id : editor_id, mltext : mltext, mceDo : 'insert'});
       return true;
   }
   return false;
}