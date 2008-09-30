<?php
/**
 * $Id: xoops_version.php,v 1.8 2006/07/11 15:19:21 frankblacksf Exp $
 * Module: tinyeditor
 * Version: v 1.15
 * Author: ralf57
 * tinyeditor-author: frankblack
 * Licence: GNU
 */

$modversion['name'] = _MI_TINYED_NAME;
$modversion['version'] = 1.00;
$modversion['description'] = _MI_TINYED_DESC;
$modversion['credits'] = _MI_TINYED_CRED;
$modversion['author'] = _MI_TINYED_AUTH;
$modversion['license'] = _MI_TINYED_LICENCE;
$modversion['official'] = 0;
$modversion['image'] = "images/tinyeditor.png" ;
$modversion['help'] = "";
$modversion['dirname'] = "tinyeditor";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
	$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
	$modversion['tables'][0] = 'tinyeditor_toolset';
	$modversion['tables'][1] = 'tinyeditor_mimetypes';
	$modversion['tables'][2] = 'tinyeditor_chmods';

// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

$modversion['hasComments'] = 0;
$modversion['hasNotification'] = 0;

// Templates
$modversion['templates'][1]['file'] = 'tinyed_imagemanager.html';
$modversion['templates'][1]['description'] = 'Template for the XOOPS imagemanager-plugin';
$modversion['templates'][2]['file'] = 'tinyed_imagemanager2.html';
$modversion['templates'][2]['description'] = '';

// Config categories
$modversion['configcat'][1]['nameid'] = 'tinyed_settings';
$modversion['configcat'][1]['name'] = '_MI_CAT_TINYEDSETTINGS';
$modversion['configcat'][1]['description'] = '_MI_CAT_TINYEDSETTINGS_DESC';

$modversion['configcat'][2]['nameid'] = 'tinyed_manager';
$modversion['configcat'][2]['name'] = '_MI_CAT_TINYEDMNGR';
$modversion['configcat'][2]['description'] = '_MI_CAT_TINYEDMNGR_DESC';

//Config options

$modversion['config'][1]['name'] = 'tinyedlang';
$modversion['config'][1]['title'] = '_MI_TINYEDLANG';
$modversion['config'][1]['description'] = '_MI_TINYEDLANGDESC';
$modversion['config'][1]['formtype'] = 'textbox';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = "en";
$modversion['config'][1]['category'] = 'tinyed_settings';

$modversion['config'][2]['name'] = 'tinyedcss';
$modversion['config'][2]['title'] = '_MI_TINYEDCSS';
$modversion['config'][2]['description'] = '_MI_TINYEDCSSDESC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = "";
$modversion['config'][2]['category'] = 'tinyed_settings';

$modversion['config'][3]['name'] = 'tinyedforcebr';
$modversion['config'][3]['title'] = '_MI_TINYEDFORCEBR';
$modversion['config'][3]['description'] = '_MI_TINYEDFORCEBRDESC';
$modversion['config'][3]['formtype'] = 'yesno';
$modversion['config'][3]['valuetype'] = 'int';
$modversion['config'][3]['default'] = 0;
$modversion['config'][3]['category'] = 'tinyed_settings';

$modversion['config'][4]['name'] = 'tinyedforcep';
$modversion['config'][4]['title'] = '_MI_TINYEDFORCEP';
$modversion['config'][4]['description'] = '_MI_TINYEDFORCEPDESC';
$modversion['config'][4]['formtype'] = 'yesno';
$modversion['config'][4]['valuetype'] = 'int';
$modversion['config'][4]['default'] = 1;
$modversion['config'][4]['category'] = 'tinyed_settings';

$modversion['config'][5]['name'] = 'tinyedrelurls';
$modversion['config'][5]['title'] = '_MI_TINYEDRELURLS';
$modversion['config'][5]['description'] = '_MI_TINYEDRELURLSDESC';
$modversion['config'][5]['formtype'] = 'yesno';
$modversion['config'][5]['valuetype'] = 'int';
$modversion['config'][5]['default'] = 0;
$modversion['config'][5]['category'] = 'tinyed_settings';

$modversion['config'][6]['name'] = 'tinyedtbloc';
$modversion['config'][6]['title'] = '_MI_TINYEDTBLOC';
$modversion['config'][6]['description'] = '_MI_TINYEDTBLOCDESC';
$modversion['config'][6]['formtype'] = 'select';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = "top";
$modversion['config'][6]['options'] = array('_MI_TINYEDTBLOCBOT' => 'bottom','_MI_TINYEDTBLOCTOP' => 'top');
$modversion['config'][6]['category'] = 'tinyed_settings';

$modversion['config'][7]['name'] = 'tinyedpathloc';
$modversion['config'][7]['title'] = '_MI_TINYEDPATHLOC';
$modversion['config'][7]['description'] = '_MI_TINYEDPATHLOCDESC';
$modversion['config'][7]['formtype'] = 'select';
$modversion['config'][7]['valuetype'] = 'text';
$modversion['config'][7]['default'] = "bottom";
$modversion['config'][7]['options'] = array('_MI_TINYEDPATHLOCBOT' => 'bottom','_MI_TINYEDPATHLOCTOP' => 'top','_MI_TINYEDPATHLOCNO' => 'none');
$modversion['config'][7]['category'] = 'tinyed_settings';

$modversion['config'][8]['name'] = 'tinyedplugdate';
$modversion['config'][8]['title'] = '_MI_TINYEDPLUGDATE';
$modversion['config'][8]['description'] = '_MI_TINYEDPLUGDATEDESC';
$modversion['config'][8]['formtype'] = 'texbox';
$modversion['config'][8]['valuetype'] = 'text';
$modversion['config'][8]['default'] = "%Y-%m-%d";
$modversion['config'][8]['category'] = 'tinyed_settings';

$modversion['config'][9]['name'] = 'tinyedplugtime';
$modversion['config'][9]['title'] = '_MI_TINYEDPLUGTIME';
$modversion['config'][9]['description'] = '_MI_TINYEDPLUGTIMEDESC';
$modversion['config'][9]['formtype'] = 'texbox';
$modversion['config'][9]['valuetype'] = 'text';
$modversion['config'][9]['default'] = "%H:%M:%S";
$modversion['config'][9]['category'] = 'tinyed_settings';

	$modversion['config'][10]['name'] = 'tinyedmgruploads';
	$modversion['config'][10]['title'] = '_MI_TINYEDMGRUPLOADS';
	$modversion['config'][10]['description'] = '_MI_TINYEDMGRUPLOADSDESC';
	$modversion['config'][10]['formtype'] = 'texbox';
	$modversion['config'][10]['valuetype'] = 'text';
	$modversion['config'][10]['default'] = "/uploads";
	$modversion['config'][10]['category'] = 'tinyed_settings';

$modversion['config'][11]['name'] = 'tinyedmgrpersdir';
$modversion['config'][11]['title'] = '_MI_TINYEDMGRPERSDIR';
$modversion['config'][11]['description'] = '_MI_TINYEDMGRPERSDIRDESC';
$modversion['config'][11]['formtype'] = 'yesno';
$modversion['config'][11]['valuetype'] = 'int';
$modversion['config'][11]['default'] = 0;
$modversion['config'][11]['category'] = 'tinyed_settings';

$modversion['config'][12]['name'] = 'tinyedmgrgzip';
$modversion['config'][12]['title'] = '_MI_TINYEDMGRGZIP';
$modversion['config'][12]['description'] = '_MI_TINYEDMGRGZIPDESC';
$modversion['config'][12]['formtype'] = 'yesno';
$modversion['config'][12]['valuetype'] = 'int';
$modversion['config'][12]['default'] = 0;
$modversion['config'][12]['category'] = 'tinyed_settings';

$modversion['config'][13]['name'] = 'tinyedmgrsubdir';
$modversion['config'][13]['title'] = '_MI_TINYEDMGRSUBDIR';
$modversion['config'][13]['description'] = '_MI_TINYEDMGRSUBDIRDESC';
$modversion['config'][13]['formtype'] = 'texbox';
$modversion['config'][13]['valuetype'] = 'text';
$modversion['config'][13]['default'] = "";
$modversion['config'][13]['category'] = 'tinyed_settings';

//configs for xrmanager
$modversion['config'][15]['name'] = 'tinyedmgrimglib';
$modversion['config'][15]['title'] = '_MI_TINYEDMGRIMGLIB';
$modversion['config'][15]['description'] = '_MI_TINYEDMGRIMGLIBDESC';
$modversion['config'][15]['formtype'] = 'select';
$modversion['config'][15]['valuetype'] = 'text';
$modversion['config'][15]['default'] = "GD";
$modversion['config'][15]['options'] = array('_MI_TINYEDMGRIMGLIBGD' => 'GD','_MI_TINYEDMGRIMGLIBIM' => 'IM','_MI_TINYEDMGRIMGLIBNET' => 'NetPBM');
$modversion['config'][15]['category'] = 'tinyed_manager';

$modversion['config'][16]['name'] = 'tinyedmgrimglibpath';
$modversion['config'][16]['title'] = '_MI_TINYEDMGRIMGLIBPATH';
$modversion['config'][16]['description'] = '_MI_TINYEDMGRIMGLIBPATHDESC';
$modversion['config'][16]['formtype'] = 'texbox';
$modversion['config'][16]['valuetype'] = 'text';
$modversion['config'][16]['default'] = "/path/to/IM/or/NetPBM";
$modversion['config'][16]['category'] = 'tinyed_manager';

$modversion['config'][17]['name'] = 'tinyedmgrthuwidth';
$modversion['config'][17]['title'] = '_MI_TINYEDMGRTHUWIDTH';
$modversion['config'][17]['description'] = '_MI_TINYEDMGRTHUWIDTHDESC';
$modversion['config'][17]['formtype'] = 'texbox';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = 100;
$modversion['config'][17]['category'] = 'tinyed_manager';

$modversion['config'][18]['name'] = 'tinyedmgrthuheight';
$modversion['config'][18]['title'] = '_MI_TINYEDMGRTHUHEIGHT';
$modversion['config'][18]['description'] = '_MI_TINYEDMGRTHUHEIGHTDESC';
$modversion['config'][18]['formtype'] = 'texbox';
$modversion['config'][18]['valuetype'] = 'int';
$modversion['config'][18]['default'] = 100;
$modversion['config'][18]['category'] = 'tinyed_manager';

$modversion['config'][19]['name'] = 'tinyedmgrthupref';
$modversion['config'][19]['title'] = '_MI_TINYEDMGRTHUPREF';
$modversion['config'][19]['description'] = '_MI_TINYEDMGRTHUPREFDESC';
$modversion['config'][19]['formtype'] = 'texbox';
$modversion['config'][19]['valuetype'] = 'text';
$modversion['config'][19]['default'] = ".thumb_";
$modversion['config'][19]['category'] = 'tinyed_manager';

$modversion['config'][20]['name'] = 'tinyedmgrthudir';
$modversion['config'][20]['title'] = '_MI_TINYEDMGRTHUDIR';
$modversion['config'][20]['description'] = '_MI_TINYEDMGRTHUDIRDESC';
$modversion['config'][20]['formtype'] = 'texbox';
$modversion['config'][20]['valuetype'] = 'text';
$modversion['config'][20]['default'] = ".thumbs";

$modversion['config'][22]['name'] = 'tinyedmgrdefthumb';
$modversion['config'][22]['title'] = '_MI_TINYEDMGRDEFTHUMB';
$modversion['config'][22]['description'] = '_MI_TINYEDMGRDEFTHUMBDESC';
$modversion['config'][22]['formtype'] = 'texbox';
$modversion['config'][22]['valuetype'] = 'text';
$modversion['config'][22]['default'] = "images/default.gif";
$modversion['config'][22]['category'] = 'tinyed_manager';

$modversion['config'][23]['name'] = 'tinyedmgrtemppref';
$modversion['config'][23]['title'] = '_MI_TINYEDMGRTEMPPREF';
$modversion['config'][23]['description'] = '_MI_TINYEDMGRTEMPREFDESC';
$modversion['config'][23]['formtype'] = 'texbox';
$modversion['config'][23]['valuetype'] = 'text';
$modversion['config'][23]['default'] = ".editor_";
$modversion['config'][23]['category'] = 'tinyed_manager';

$modversion['config'][24]['name'] = 'tinyedthumbcols';
$modversion['config'][24]['title'] = '_MI_TINYEDTHUMBCOLS';
$modversion['config'][24]['description'] = '_MI_TINYEDTHUMBCOLSDESC';
$modversion['config'][24]['formtype'] = 'textbox';
$modversion['config'][24]['valuetype'] = 'int';
$modversion['config'][24]['default'] = 4;
$modversion['config'][24]['category'] = 'tinyed_manager';

$modversion['config'][25]['name'] = 'tinyedmgrspaceorg';
$modversion['config'][25]['title'] = '_MI_TINYEDMGRSPACEORG';
$modversion['config'][25]['description'] = '_MI_TINYEDMGRSPACEORGDESC';
$modversion['config'][25]['formtype'] = 'select';
$modversion['config'][25]['valuetype'] = 'text';
$modversion['config'][25]['default'] = 'none';
$modversion['config'][25]['options'] = array('---------------' => 'none', '_MI_TINYEDMGRSPACEUSER' => 'name', '_MI_TINYEDMGRSPACEDATE' => 'date');
$modversion['config'][25]['category'] = 'tinyed_manager';

$modversion['config'][26]['name'] = 'tinyedtemplates';
$modversion['config'][26]['title'] = '_MI_TINYEDTEMPLATES';
$modversion['config'][26]['description'] = '_MI_TINYEDTEMPLATESDESC';
$modversion['config'][26]['formtype'] = 'textarea';
$modversion['config'][26]['valuetype'] = 'text';
$modversion['config'][26]['default'] = "";
$modversion['config'][26]['category'] = 'tinyed_settings';

$modversion['config'][27]['name'] = 'tinyedmgrftp';
$modversion['config'][27]['title'] = '_MI_TINYEDMGRGFTP';
$modversion['config'][27]['description'] = '_MI_TINYEDMGRGFTPDESC';
$modversion['config'][27]['formtype'] = 'yesno';
$modversion['config'][27]['valuetype'] = 'int';
$modversion['config'][27]['default'] = 0;
$modversion['config'][27]['category'] = 'tinyed_settings';

$modversion['config'][28]['name'] = 'tinygroupoverride';
$modversion['config'][28]['title'] = '_MI_TINYGROUPOVERRIDE';
$modversion['config'][28]['description'] = '_MI_TINYGROUPOVERRIDEDESC';
$modversion['config'][28]['formtype'] = 'textarea';
$modversion['config'][28]['valuetype'] = 'text';
$modversion['config'][28]['default'] = "";
$modversion['config'][28]['category'] = 'tinyed_settings';

$modversion['config'][29]['name'] = 'tinyedmgrunpackzip';
$modversion['config'][29]['title'] = '_MI_TINYEDMGRGUNPACKZIP';
$modversion['config'][29]['description'] = '_MI_TINYEDMGRGUNPACKZIPDESC';
$modversion['config'][29]['formtype'] = 'yesno';
$modversion['config'][29]['valuetype'] = 'int';
$modversion['config'][29]['default'] = 0;
$modversion['config'][29]['category'] = 'tinyed_settings';

?>