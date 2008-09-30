<?php
include "../../../../../mainfile.php";
	if (!defined('XOOPS_ROOT_PATH')) exit();

//only site users can access this file
if (is_object($xoopsUser)) {

function langDropdown() {
	global $xoopsConfig;
	$easiestml_langs = explode( ',' , EASIESTML_LANGS ) ;
	$langnames = explode( ',' , EASIESTML_LANGNAMES ) ;

	$lang_options = '' ;

	foreach( $easiestml_langs as $l => $lang ) {
		$lang_options .= '<option value="'.$lang.'">'.$langnames[$l].'</option>' ;
	}
           
	$javascript = "onChange=\"document.forms[0].langfield.value = this.value;\"";

	echo "<select name=\"mlanguages\" $javascript style=\"width:200px\">"; ?>
			<option value="" selected>{$lang_insert_mlcontent_sellang}</option>
	<?php echo "".$lang_options."";
	echo "</select>";
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$lang_insert_mlcontent_title}</title>
<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript">
<!--
// created 2005-1-12 by Martin Sadera (sadera@e-d-a.info)
// ported to Xoops CMS by ralf57
    function init() {
        var formObj = document.forms[0];
        formObj.mltext.value  = tinyMCE.getWindowArg('mltext');
        formObj.insert.value = tinyMCE.getLang('lang_' + tinyMCE.getWindowArg('mceDo'));
        window.focus();
    }

    function insertMLC() {
        var formObj = document.forms[0];
        if (window.opener) {
            var mltext = formObj.mltext.value;
	    var selectlang = formObj.langfield.value;
            mltext = tinyMCE.regexpReplace(mltext, "<", "&lt;");
            mltext = tinyMCE.regexpReplace(mltext, ">", "&gt;");
            var html = '['+selectlang+']';
            html += mltext+'[/'+selectlang+']';
            tinyMCE.execCommand("mceInsertContent",true,html);
            top.close();
        }
    }

    function cancelAction() {
        top.close();
    }

//-->
</script>
</head>
<body onload="init();">
    <form onsubmit="insertCD();return false;">
	<input type="hidden" name="langfield" id="langfield" value="" />
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" valign="middle"><table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td class="title">{$lang_insert_mlcontent_subtitle}</td>
                    </tr>
		    <tr>
                        <td class="title"><?php langDropdown(); ?></td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap">
			    
                            <textarea name="mltext" type="text" id="mltext" value="" style="width: 370px;height:200px; vertical-align: middle;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                        	<input type="button" name="insert" value="{$lang_insert_mlcontent_insert}" onclick="insertMLC();" id="insert" />
                        	<input type="button" name="cancel" value="{$lang_insert_mlcontent_cancel}" onclick="cancelAction();" id="cancel" />
                        </td>
                    </tr>
                </table></td>
            </tr>
        </table>
    </form>
</body>
</html><?php
}else{
die(_NOPERM);
}
?>