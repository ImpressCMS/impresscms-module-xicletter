<?php
/*
* $Id: menu.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* Credits Complements: RpLima / Eyekeeper
* License: GNU
*/

$i=1;

$adminmenu[$i]['title'] = _MI_XMAIL_ADM_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_ADM_PREFERENCES;
$adminmenu[$i]['link'] = "admin/param.php";
$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_ADM_APPROVE_MSG;
$adminmenu[$i]['link'] = "admin/xmail_aprovar.php";
$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_ADM_ACTIVATION_USER;
$adminmenu[$i]['link'] = "admin/gerencia_ativa.php";

$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_ADM_NEWSLETTER;
$adminmenu[$i]['link'] = "admin/admin_newsletter.php";

$adminmenu[$i]['sub'][0]['title'] = _MI_XMAIL_MAIN_NEWSLETTER;
$adminmenu[$i]['sub'][0]['link']  = "admin/admin_newsletter.php";

$adminmenu[$i]['sub'][1]['title']=_MI_XMAIL_ASSINANEWS;
$adminmenu[$i]['sub'][1]['link']="admin/gerencia_news.php?action=rem_user";

$adminmenu[$i]['sub'][2]['title']=_MI_XMAIL_IMPORTUSERTONEWS;
$adminmenu[$i]['sub'][2]['link']="admin/gerencia_news.php?action=import_users";

$adminmenu[$i]['sub'][3]['title'] = _MI_XMAIL_ADMENU7;
$adminmenu[$i]['sub'][3]['link']  = "admin/manut_xmail_tabperfil.php";

$adminmenu[$i]['sub'][5]['title'] = _MI_XMAIL_ADMENU10;
$adminmenu[$i]['sub'][5]['link']  = "admin/xmail_exporta_assinantes.php";

$adminmenu[$i]['sub'][6]['title'] = _MI_XMAIL_ADMENU11;
$adminmenu[$i]['sub'][6]['link']  = "admin/xmail_importa_assinantes.php";

$adminmenu[$i]['sub'][7]['title'] = _MI_XMAIL_ADMENU12;
$adminmenu[$i]['sub'][7]['link']  = "admin/xmail_importa_assinantes_perf.php";


$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_ADMENU8;
$adminmenu[$i]['link'] = "admin/adm_log_error.php";

$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_UTILS;
$adminmenu[$i]['link'] = "admin/utils.php";

$adminmenu[$i]['sub'][0]['title'] = _MI_XMAIL_INDEX;
$adminmenu[$i]['sub'][0]['link']  = "admin/utils.php";

$adminmenu[$i]['sub'][1]['title'] = _MI_XMAIL_ADMENU_MYBLOCKSADMIN;
$adminmenu[$i]['sub'][1]['link']  = "admin/myblocksadmin.php";

$adminmenu[$i]['sub'][2]['title'] = _MI_XMAIL_ADMENU_MYTPLSADMIN;
$adminmenu[$i]['sub'][2]['link']  = "admin/mytplsadmin.php";

$adminmenu[$i]['sub'][3]['title'] = _MI_XMAIL_OTIMIZADB;
$adminmenu[$i]['sub'][3]['link']  = "admin/gerencia_news.php?action=optimize";

$adminmenu[$i]['sub'][4]['title'] = _MI_XMAIL_UPDATE_MODULE;
$adminmenu[$i]['sub'][4]['link']  = "updatemod.php";

$i++;
$adminmenu[$i]['title'] = _MI_XMAIL_DOCS;
$adminmenu[$i]['link'] = "admin/docs.php";

$adminmenu[$i]['sub'][0]['title'] = _MI_XMAIL_INDEX;
$adminmenu[$i]['sub'][0]['link']  = "admin/docs.php";

$adminmenu[$i]['sub'][1]['title'] = _MI_XMAIL_ADMENU9;
$adminmenu[$i]['sub'][1]['link']  = "admin/xmail_comoagendar.php";

$adminmenu[$i]['sub'][2]['title'] = _MI_XMAIL_HELPFILE;
$adminmenu[$i]['sub'][2]['link']  = "admin/helpfile.php";

$adminmenu[$i]['sub'][3]['title'] = _MI_XMAIL_ABOUT;
$adminmenu[$i]['sub'][3]['link']  = "admin/about.php";

$adminmenu[$i]['sub'][4]['title'] = _MI_XMAIL_CREDITS;
$adminmenu[$i]['sub'][4]['link']  = "admin/credits.php";

$adminmenu[$i]['sub'][5]['title'] = _MI_XMAIL_HISTORIC;
$adminmenu[$i]['sub'][5]['link']  = "admin/historic.php";

$adminmenu[$i]['sub'][6]['title'] = _MI_XMAIL_MANUAL;
$adminmenu[$i]['sub'][6]['link']  = "admin/man-xmail.php";


$i++;
$adminmenu[$i]['title'] =_MI_XMAIL_ATIVARAGENDA;
$adminmenu[$i]['link'] = "admin/ativa_send_agenda_ajax.php";

