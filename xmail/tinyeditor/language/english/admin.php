<?php
if (!defined('XOOPS_ROOT_PATH')) die("XOOPS root path not defined");

define("_AM_TINYED_INDEX","Main index");
define("_AM_TINYED_HELP","On-line help");
define("_AM_TINYED_MODADMIN"," Admin area");
define("_AM_TINYED_EDITOROPTS","Editor settings");
define("_AM_TINYED_MNGROPTS","Image manager settings");
define("_AM_TINYED_PERMISSIONS","Permissions");
define("_AM_TINYED_TOOLSETS","Toolsets");
define("_AM_TINYED_DBUPDATED","Database was updated");
define("_AM_TINYED_NOTOOLSETYET","<h2>This group has no toolset yet</h2>The values you see are default values. Please edit and submit the form to create a toolset for this group.<br />");
define("_AM_TINYED_GROUPLIST","Group-list");
define("_AM_TINYED_ROW1","<b>Row 1 </b>");
define("_AM_TINYED_ROW2","<b>Row 2 </b>");
define("_AM_TINYED_ROW3","<b>Row 3 </b>");
define("_AM_TINYED_CANUPLOAD", "Allowed to upload files/images <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/ibrowser.gif' alt='ibrowser' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/imanager.gif' alt='imanager' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_CANDELETE", "Allowed to delete files/images <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/ibrowser.gif' alt='ibrowser' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/imanager.gif' alt='imanager' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_CANCREATEDIR", "Allowed to create folders <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/ibrowser.gif' alt='ibrowser' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/imanager.gif' alt='imanager' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_CANDELETEDIR", "Allowed to delete folders <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_DELETENONEMPTYDIR","Allowed to delete non-empty folders <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_USEQUOTA", "Use disk-quota (see toolsets) <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/ibrowser.gif' alt='ibrowser' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/imanager.gif' alt='imanager' />");
define("_AM_TINYED_OVERRIDEUSERDIR", "Override user-dirs for files/images ");
define("_AM_TINYED_CHGEIMGATTRIB", "Change image attributes <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/ibrowser.gif' alt='ibrowser' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/imanager.gif' alt='imanager' />");
define("_AM_TINYED_RENAMEIMG", "Rename images/files <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/ibrowser.gif' alt='ibrowser' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/imanager.gif' alt='imanager' /> <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_RENAMEDIR","Rename directories <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_COPYDIR","Copy directories <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_MOVEDIR","Move directories <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_COPYFILE","Copy image/file <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_MOVEFILE","Move image/file <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_EDITFILE","Edit image/file <img src='".XOOPS_URL."/modules/tinyeditor/admin/images/xrmanager.gif' alt='xrmanager' />");
define("_AM_TINYED_IMGWIDTH", "<b>max. image width</b>");
define("_AM_TINYED_IMGHEIGHT", "<b>max. image height</b>");
define("_AM_TINYED_DISKQUOTA", "<b>Disk quota</b>");
define("_AM_TINYED_CLICKHERE", "Design your toolbars by simply placing the cursor into the textarea and selecting the icons");

define("_AM_TINYED_VALIDELEMENTS", "Valid Elements");
define("_AM_TINYED_EXTVALIDELEMENTS", "Extended Valid Elements");
define("_AM_TINYED_INVALIDELEMENTS", "Invalid Elements");

define("_AM_TINYED_MIMETYPES","Mimetypes");
define("_AM_TINYED_ADDMIMESINSTR","Lowercase, blank separated list of mimetypes allowed for the selected group.<br /><br /><a href=\"http://www.filext.com/\" target=\"_blank\">Find new mimetypes....</a>");
define("_AM_TINYED_DBERROR","An error occurred while updating the database");
define("_AM_TINYED_NOMIMESYET","<strong>No mimetypes yet</strong>");
define("_AM_TINYED_ABOUT", "About");
define("_AM_TINYED_AUTHOR", "Author:");
define("_AM_TINYED_DEVINFOS", "Development Informations");
define("_AM_TINYED_DEVSITE", "Official development @ dev.xoops.org");
define("_AM_TINYED_BUGSREP", "Bugs tracker");
define("_AM_TINYED_RFEREP", "Feature requests tracker");
define("_AM_TINYED_FORUMS", "Discussion/Support forums");

define("_AM_TINYED_COMDEFAULT","Default command-set");
define("_AM_TINYED_COMXDHTML","XOOPS-DHTML-Editor command-set");
define("_AM_TINYED_COMXHTLTRANS","XHTML transitional command-set");
define("_AM_TINYED_COMMANDSETS","Command-Sets");

define("_AM_TINYED_PLUGINUP","Plugin Upload");
define("_AM_TINYED_CHMOD","FTP CHMOD");

define("_AM_TINYED_CHMODSUCC","CHMOD executed successfully!");
define("_AM_TINYED_CHMODFAIL","CHMOD failed!");
define("_AM_TINYED_FTPUSER","FTP user");
define("_AM_TINYED_FTPPASS","FTP password");
define("_AM_TINYED_THEPATH","The path to CHMOD<br /><small>(e.g.: modules/debaser/upload - no starting and no trailing slash!)</small>");
define("_AM_TINYED_FTPCHMOD","CHMOD value<br /><small><b>Octal value! E.g.: 0644</b></small>");
define("_AM_TINYED_NOCHMODONWIN","You can\'t use CHMOD on a Windows Server");
define("_AM_TINYED_HAVE777","Directories or files with CHMOD 777");
define("_AM_TINYEDCOPY","Click here to simply insert the path into the text field");
define("_AM_TINYED_FILENOTEXISTANYMORE","<b> - This file is not existing anymore. Please delete this database entry!</b>");
define("_AM_TINYED_DIRNOTEXISTANYMORE","<b> - This directory is not existing anymore. Please delete this database entry!</b>");
define("_AM_TINYED_SUREDELETECHMOD","Do you really want to delete this entry?");
define("_AM_TINYED_CHMODDELETED","CHMOD entry deleted!");
define("_AM_TINXED_CHMODNOTDELETED","CHMOD entry NOT deleted!");
define("_AM_TINYED_FTPMISSING","There some ftp-informations missing in xoopsroot / modules / tinyeditor / include / ftpconfig.php. Open the file, fill in the missing informations, save the file and write-protect it (Unix: chmod 444).");
define("_AM_TINYED_FTPMISSINGCHMOD","There some ftp-informations missing in xoopsroot / modules / tinyeditor / include / ftpconfigchmod.php. Open the file, fill in the missing informations, save the file and write-protect it (Unix: chmod 444).");
define("_AM_TINYED_NEEDFTP","To use this you need to enable use of FTP in preferences.");

define("_AM_TINYED_CHECKFTP","WARNING: At the moment the plugin directory is writeable. You should change as soon as possible!");

define("_AM_TINYED_UNZIPFAIL","ERROR : ");
define("_AM_TINYED_UNZIPSUCC","File successfully unzipped!");
define("_AM_TINYED_FILE","File:");

define("_AM_TINYED_XRMANAGE", "Allow to use xrmanager");
define("_AM_TINYED_FTPDEBUG", "Use FTP Debug");

// defines for templates-plugin
define("_AM_TINYED_TEMPLATES1","--Select Template--");
define("_AM_TINYED_TEMPLATES2","Upload files:");
define("_AM_TINYED_TEMPLATES3","OK");
define("_AM_TINYED_TEMPLATES4","<br /><font color='red'>*</font>Maximum file length (minus extension) is 30 characters. Anything over that will be cut to only 30 characters. Valid file type(s): ");
define("_AM_TINYED_TEMPLATES5","File uploaded successfully - ");
define("_AM_TINYED_TEMPLATES6"," was not successfully uploaded");
define("_AM_TINYED_TEMPLATES7"," was too big, not uploaded");
define("_AM_TINYED_TEMPLATES8"," had an invalid file extension, not uploaded");
define("_AM_TINYED_TEMPLATES9","Filename or content is missing");
define("_AM_TINYED_TEMPLATES10","Target directory must be selected");
define("_AM_TINYED_TEMPLATES11","Directory ");
define("_AM_TINYED_TEMPLATES12"," not found!");
define("_AM_TINYED_TEMPLATES13","Select folder");
define("_AM_TINYED_TEMPLATES14","Back");
define("_AM_TINYED_TEMPLATES15","Filename, content or directory is missing");
define("_AM_TINYED_TEMPLATES16","File already exists!");
define("_AM_TINYED_TEMPLATES17","Unable to write to file! Folder not selected?");
define("_AM_TINYED_TEMPLATES18","Directory does not exist!");

// defines for informations
define("_AM_TINYED_STATSZLIB","<p><b>Zlib seems to be enabled, so that you can use gzip compression</b></p>");
define("_AM_TINYED_STATSSAFEMODE","<p><b>safe_mode seems to be and ftp support is disabled. If you want to use all functions of tinyeditor, you could turn on ftp support in preferences. Ftp support functions are used at your own risk!</b></p>");
define("_AM_TINYED_STATSMISSFTP","<p style='color:#ff0000;'><b>WARNING: Although you want to use ftp you forgot to add the information to tinyeditor/include/ftpconfig.php</b></p>");
define("_AM_TINYED_STATSNOCOPY","<p style='color:#ff0000;'><b>The php function COPY seems to be disabled. You cannot use all functions unless you use FTP with the module!</p>");
define("_AM_TINYED_STATSNORENAME","<p style='color:#ff0000;'><b>The php function RENAME seems to be disabled. You cannot use all functions unless you use FTP with the module!</p>");
define("_AM_TINYED_STATSNOUNLINK","<p style='color:#ff0000;'><b>The php function UNLINK seems to be disabled. You cannot use all functions unless you use FTP with the module!</p>");
define("_AM_TINYED_ISWRITEFTP1","<p style='color:#ff0000;'><b>WARNING: The tinyeditor/include/ftpconfig.php is writable. You should write-protect this file. chmod 444 on Linux.</b></p>");
define("_AM_TINYED_ISWRITEFTP2","<p style='color:#ff0000;'><b>WARNING: The tinyeditor/include/ftpconfigchmod.php is writable. You should write-protect this file. chmod 444 on Linux.</b></p>");
define("_AM_TINYED_ISWRITEFTP3","<p style='color:#ff0000;'><b>WARNING: The tinyeditor/include/ftpconfigplugin.php is writable. You should write-protect this file. chmod 444 on Linux.</b></p>");

// defines for pluginloader.php
define("_AM_TINYED_PLUGNOPLUG","There is no plugin installed for this language file");
define("_AM_TINYED_PLUGEXIST","Directory already exists!");
define("_AM_TINYED_DIRNOTWRITE","Sorry, but the directories tinyeditor/editor/plugins or tinyeditor/admin/images are not writable!");
?>