<?php
//if (!defined('_MI_XMAIL_ADM_INDEX')){
define("_MI_XMAIL_ADM_INDEX","Menu Principal");
define("_MI_XMAIL_ADM_APPROVE_MSG","Aprovar mensagens");
define("_MI_XMAIL_ADMENU3","Ver log de envio");
define("_MI_XMAIL_ADM_ACTIVATION_USER","Ger. Ativa��o");
define("_MI_XMAIL_ADM_PREFERENCES","Par�metros");
define("_MI_XMAIL_ADM_NEWSLETTER","NewsLetters");

define("_MI_XMAIL_NAME","Xmail"); // Sistema de e-mails.
define("_MI_XMAIL_DESC","Gerenciamento de envio de mensagens e emails  para usu�rios cadastrados ");
define("_MI_XMAIL_SMNAME1","Cadastrar Mensagens");
define("_MI_XMAIL_SMNAME2","Administrar Mensagens");

// vers�o 2.0

define("_MI_XMAIL_BLOCK1", 'Ativa��o') ;
define("_MI_XMAIL_DESCRIBLOCK1","Solicitar Ativa��o");
define("_MI_XMAIL_BLOCK2", 'Newsletter ') ;
define("_MI_XMAIL_DESCRIBLOCK2","Newsletter - assinar ou cancelar");

define("_MI_XMAIL_ADMENU4","Manager Activations");
define("_MI_XMAIL_ADMENU7","Admin Perfis");

// vers�o 2.5

define("_MI_XMAIL_ADMENU8"             ,"Log de Erros");
define("_MI_XMAIL_ADMENU9"             ,"Como Agendar Envio?");

define("_MI_XMAIL_ASSINANEWS"          ,"Assinantes");
define("_MI_XMAIL_OTIMIZADB"           ,"Otimizar DB");
define("_MI_XMAIL_IMPORTUSERTONEWS"    ,"Importar Usu�rios");

define("_MI_XMAIL_ADMENU10"            ,"Exportar Assinantes");
define("_MI_XMAIL_ADMENU11"            ,"Importar Assinantes");

define("_MI_XMAIL_ADMENU12"            ,"Importar Perfis de Assinantes");

define("_MI_XMAIL_HELPFILE"            ,"Help");
define("_MI_XMAIL_ABOUT"               ,"About");
define("_MI_XMAIL_BLOCK3"              ,"�ltimas Newsletters") ;
define("_MI_XMAIL_DESCRIBLOCK3"        ,"Link com as �ltimas newsletters enviadas");
define("_MI_XMAIL_MAIN_NEWSLETTER"     ,"Main");
define("_MI_XMAIL_DOCS"                ,"Documenta��o");
define("_MI_XMAIL_CREDITS"             ,"Credits");
define("_MI_XMAIL_HISTORIC"            ,"Historic");
define("_MI_XMAIL_MANUAL"              ,"Manual");
##########################################################################################
## Menu Generic Utils                                                                   ##
##########################################################################################
define("_MI_XMAIL_INDEX"                       ,"Main");
define("_MI_XMAIL_ADMENU_MYBLOCKSADMIN"        ,"blocks/Groups - Permissions");
define("_MI_XMAIL_ADMENU_MYTPLSADMIN"          ,"Templates");
define("_MI_XMAIL_UPDATE_MODULE"               ,"Update Module");
define("_MI_XMAIL_UTILS"                       ,"Utilitars");
define("_MI_XMAIL_FALHOU_LANG_DOCS"            ,"Not found file <b>docs.php</b> in directory of your language");
define("_MI_XMAIL_FALHOU_LANG_HISTORIC"        ,"Not found file <b>historic.php</b> in directory of your language");
define("_MI_XMAIL_FALHOU_LANG_PRESENTATION"    ,"N�o encontrou o arquivo <b>presentation.php</b> no seu diret�rio de language");
define("_MI_XMAIL_FALHOU_LANG_UTILS_INDEX"     ,"N�o encontrou o arquivo <b>utils_index.php</b> no seu diret�rio de language");
define("_MI_XMAIL_FALHOU_LANG_COMO_AGENDAR"    ,"Not found file <b>comoagendar.php</b> in directory of your language");
define("_MI_XMAIL_FALHOU_LANG_HELPFILE"        ,"N�o encontrou o arquivo <b>helpfile.php</b> no seu diret�rio de language");
define("_MI_XMAIL_FALHOU_LANG_MODINFO"         ,"N�o encontrou o arquivo <b>modinfo.php</b> no seu diret�rio de language - ERRO GRAVE");
define("_MI_XMAIL_FALHOU_LANG_ADMIN_NEWSLETTER","N�o encontrou o arquivo <b>admin_newsletter.php</b> no seu diret�rio de language");
define("_MI_XMAIL_FALHOU_LANG_MANXMAIL","Not found file <b>man-xmail.php</b> in directory docs into your language");
define("_MI_XMAIL_ADMIN_MAIN"                  ,"Menu Principal");

##########################################################################################
## Const. Xoops_Version and Menu, about, index, etc...                                  ##
##########################################################################################
define("_MI_XMAIL_AUTHOR_DESC"     ,"Autora :");                                          // Info Screen.
define("_MI_XMAIL_AUTHOR_REALNAME" ,"Seu Nome Completo Aqui");                           // Your name complete (no obrigat�rio)
define("_MI_XMAIL_SITE_AUTHOR"     ,"Url do site do Author") ;                           // URL do site do autor. Nem sempre ser� o mesmo do local de desenvolvimento.
define("_MI_XMAIL_DEV_SITE"        ,"http://www.xoopstotal.com.br");                     // Endere�o do site de desenvolvimento.
define("_MI_XMAIL_SUPPORT"         ,"Url do site de suporte ao m�dulo");                 // URL site de suporte ou f�rum de suporte. - No futuro web-service para agendar suporte.
define("_MI_XMAIL_REPORT_BUGS"     ,"Url para reportas bugs");                           // URL de site ou f�rum para reportar bugs.
define("_MI_XMAIL_REPORT_FEATURES" ,"Url para reportas sugest�es");                      // URL de site ou f�rum para enviar sugest�es de melhorias.
define("_MI_XMAIL_NEW_VERSION"     ,"Url para verificar novas vers�es");                 // URL de site ou download para nova vers�o.
define("_MI_XMAIL_QAS_CHECK_PASSED","Url para ver p�gina de testes QAS");                // URL de P�gina para os testes realizados com esta vers�o.
define("_MI_XMAIL_DEPENDENCES"     ,"Xoops 2.0.15 ou maior, XtDevObjects vers�o 1.0");   // Quais as dependencias que este m�dulo possui, exemplo, FrameWork, SmartObjects, XtDevObjects, etc..
define("_MI_XMAIL_COMPATIBLE"      ,"Xoops 2.0*, XoopsCube 2.0*, Code-Plus Alfa 0.2");   // Quais as vers�es que este m�dulo � comp�tivel.
define("_MI_XMAIL_DIRNAME"         ,"xmail");                                            // Alterar aqui para o nome do diret�rio onde o m�dulo ser� instalado. Cuidado aqui caso n�o exista a tradu��o em sua lingua.

// Info General

// Info Dev
define("_MI_XMAIL_DEVREPORT_FEATURES_DESC","Send new Features.......: ");
define("_MI_XMAIL_DEVSITE_DESC"           ,"Site de Desenvolvimento.: ");
define("_MI_XMAIL_DEVSITE_AUTHOR_DESC"    ,"Site do Author..........: ");
define("_MI_XMAIL_DEVREPORT_BUGS_DESC"    ,"Send Report Bugs........: ");
define("_MI_XMAIL_DEVNEW_VERSION_DESC"    ,"Check New Version.......: ");
define("_MI_XMAIL_DEVQAS_CHECK_DESC"      ,"Site QAS Test...........: ");
define("_MI_XMAIL_DEV_DEPENDENCES_DESC"   ,"Module Dependences......: ");
define("_MI_XMAIL_DEV_COMPATIBLE_DESC"    ,"Compatible with.........: ");

define("_MI_XMAIL_DEVINFOS"               ,"Informa��es do Desenvolvedor ");
define("_MI_XMAIL_DEVSITE_NAME"           ,"XoopsTotal - A comunidade diferente");
define("_MI_XMAIL_DEVSITEAUTHOR_NAME"     ,"Nome do site do Author, Slogan inclusive :-)");
define("_MI_XMAIL_DEVREPORT_BUGS_NAME"    ,"Reportar Bugs");
define("_MI_XMAIL_DEVREPORT_FEATURES_NAME","Site for send new features and Sugestions");
define("_MI_XMAIL_DEVNEW_VERSION_NAME"    ,"Site New version Check-in");
define("_MI_XMAIL_DEVQAS_CHECK_NAME"      ,"QAS Chek-in tests module result");
define("_MI_XMAIL_DEV_DEPENDENCES_NAME"   ,"");
define("_MI_XMAIL_DEV_COMPATIBLE_NAME"    ,"");

// Info Change Log
define("_MI_XMAIL_CHANGELOG"              ,"Info Change Log ");

// Utils - Optimize
define("_MI_XMAIL_DBERROR"                ,"Tabela do banco de dados Falhou");
define("_MI_XMAIL_TABLEOPT"               ,"Tabela Otimizada com Sucesso");

//}


define("_MI_XMAIL_BLOCK4"              ,"Agendamento  Xmail") ;
define("_MI_XMAIL_DESCRIBLOCK4"        ,"Dispara envios de emails agendados");


define("_MI_XMAIL_ATIVARAGENDA","Ativar Agendamento") ;




?>

