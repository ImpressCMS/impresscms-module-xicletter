<?php
echo '<style type="text/css">
div#body {
        background: #ffffff;
        color: #000000;
        margin: 0px;
        padding: 0px 20px 20px 20px;
        border: 1px solid;
		line-height: 140%;
}

h1 {
        font-family: luxi sans,sans-serif;
        font-size: 20pt;
}

h2 {
        font-family: sans-serif;
        font-size: 15pt;
		line-height: 140%;
}

h3 {
        font-family: luxi sans,sans-serif;
        font-size: 9pt;
}

img {border: 0px;}

.terminal {
        margin: 5px;
        margin-left: 0px;
        border: 1px inset #000080;
        background-color: #e7e7e7;
        color: #02007f;
        list-style-type: none;
        font-family: monospace;
        font-size: 11px;
        padding: .5em;
        overflow: auto;
		width: 500px;
		height: 100px;
}

.terminal a:link { color: #FFFF00; }
.terminal a:visited { color: #FFFF00; }
</style>

<div id="body">
<h1>Ajuda</h1>
<h2><font color="#FF0000">O que é o Xmail ?</font></h2>
<ol>
<h3> Este módulo foi originalmente criado para ser o canal de comunicação entre o Site e seus usuários.
Também é para orgulho de nossa nação o primeiro módulo genuinamente brasileiro apelidado como "<i><font color="#FF0000">The Big One</font></i>"
</ol>
<hr />
<h2><font color="#FF0000">O que Há de Novo ?</font></h2>
<ol>
<h4>
<ul>
<li><b>Controle de Lotes de envio Aprimorado</b></li>
<li><b>Habilidade para utilizar Cron para disparar e-mails e Newsletter</b>
<li><b>Multiplos gerenciadores de Envio de e-mails</b>
<li><b>Controla perfis de Newsletter</b>
<li><b>Trabalha com muita facilidade em editores Visuais</b> -
<li><b>Importa cadastros de E-mails para Newsletter (Formato CSV)</b> -
<li><b>Exporta cadastros de E-mails para (Formato CSV)</b> -
<li><b>Agendamento de Envios customizado</b> -
<li><b>Administra o máximo de Envio por Hora do Servidor</b> -
</ul>
</ol>

<hr />
<h2><font color="#FF0000">Histórico de Versões Anteriores</font></h2>

<h1>tinyeditor 1.0</h1>
<h2>How to install tinyeditor?</h2>
<p><ol>
<li>Copy the content of "xoopseditor" folder to the root/class/xoopseditor of your Xoops installation or if folder xoopseditor does not exist, copy the complete folder "xoopseditor" to root/class</li>
<li>Copy the folder tinyeditor to root/modules</li>
<li>Install tinyeditor like any other xoops module</li>
<li>Generate the templates for tinyeditor inside the XOOPS templates manager</li>
<li>The following directories need special CHMODs<br />
	<b>CHMOD 777</b><br />
	- tinyeditor / editor / plugins / ibrowser / temp /<br />
	- tinyeditor / editor / plugins / ibrowser / scripts / phpThumb / cache /<br />
	- tinyeditor / editor / plugins / imanager / temp /<br />
	- tinyeditor / editor / plugins / imanager / scripts / phpThumb / cache /<br />
	<b>CHMOD 444</b><br />
	- tinyeditor / editor / plugins / ibrowser / config / config.inc.php<br />
	- tinyeditor / editor / plugins / ibrowser / scripts / phpThumb / phpThumb.config.php<br />
	- tinyeditor / editor / plugins / imanager / config / config.inc.php<br />
	- tinyeditor / editor / plugins / imanager / scripts / phpThumb / phpThumb.config.php<br />
	- tinyeditor / include / config.inc.php
</li>
</ol></p>
<hr />
<h2>Setting up tinyeditor</h2>
<p>First visit the preferences of tinyeditor. There are some settings to be made</p>
<ul>
<li><b>Editor\'s language</b> - Define your language here. This option can be set to any of the language codes according to <a href="http://www.loc.gov/standards/iso639-2/englangn.html">iso639-1 standard</a>. For example: en for English, de for German or fr for French.</li>
<li><b>Editor\'s css</b> - Give the path to the CSS-file that should be used for the contents inside the editor area. If left blank, normally the css of the current theme is used, but there a some flaws. If you are using NON-IE-browser, tinyeditor is not able to parse the correct file, because tinyeditor does not understand the import-tag in styleNN.css. So there will be no values for the CSS-dropdown in tinyeditor. Please do make your own css-file for the editor which holds the most important styles for your site. Not all CSS-instructions in your default-theme are needed for formatting your articles.</li>
<li><b>Force BR elements</b> - This option forces output of BR elements instead of P elements in Internet Explorer.</li>
<li><b>Force P elements</b> - If this option is enabled Mozilla/Firefox will generate P elements on Enter/Return key and BR elements on Shift+Enter/Return. This option is enabled by default.</li>
<li><b>Force relative URLs</b> - Enable this option to to convert absolute URLs to relative URLs. Unfortunately this option does not work 100%. It works well for files to be inserted on the user- and admin-side, but if you want to have it displayed in a module-block which is not displayed within the same module the path to the files is wrong. So you have to rewrite the block-code for this special module. Maybe in the future XOOPS has full support of relative URLs.</li>
<li><b>Invert typing direction</b> - Enable this option to invert type direction from LTR (left-to-right) to RTL (right-to-left).</li>
<li><b>Toolbar location</b> - This option allows you to set the location of the toolbar (top or bottom).</li>
<li><b>Element path location</b> - Set here the location of the elements path (top, bottom or none). You\'ll only see the resize-handle for the editor, when the elements path location is visible.</li>
<li><b>Date format and Time format</b> - Set here the format for the Insert Date/Time plugin according to the following replacement variables<br />
<pre class="terminal">
%y - year as a decimal number without a century (range 00 to 99)
%Y - year as a decimal number including the century
%d - day of the month as a decimal number (range 01 to 31)
%m - month as a decimal number (range 01 to 12)
%D - same as %m/%d/%y
%r - time in a.m. and p.m. notation
%H - hour as a decimal number using a 24-hour clock (range 00 to 23)
%I - hour as a decimal number using a 12-hour clock (range 01 to 12)
%M - minute as a decimal number (range 00-59)
%S - second as a decimal number (range 00-59)
%p - either \'am\' or \'pm\' according to the given time value
%% - a literal \'%\' character</pre></li>
<li><b>Uploads directory</b> - Set the directory for images upload. Note: this directory must be manually created and if on a Unix system, chmoded to 777. Make sure that the upload folder already exists on the server. The upload directory will be used for the plugins ibrowser, imanager and xrmanager.</li>
<li><b>Enable per-user directories</b> - If enabled, each user manages his own uploads folder preventing disk space cluttering. The folders will be named like user_userid.</li>
<li><b>Gzip-Compression</b> - This is important for XOOPS 2.2x-users. Functionality of gzip-compression is STILL broken in XOOPS 2.2x. So turn off gzip-compression in tinyeditor-preferences. Users of the XOOPS 2.0x-series can turn it on. If you are using 2.0x and are not sure if your server supports gzip turn gzip on anyway. tinyeditor will detect if gzip is possible. The fortunate users of the XOOPS 2.0-series will benefit of the gzip-compression. The editor will work up to 70% percent faster. The whole javascript-commandset will be saved into cache-folder of XOOPS. One minor setback: If you enable plugins and add buttons to the editor after the cache-file is already written you have to delete the editor\'s zip-file from the cache-folder. This cache-zip-file will be written anew. Every group will have its own cache-file. Right now IE has problems with gzip when virus guards with on-access scanning are installed. If your IE users are reporting problems you can edit include/initcode to exclude IE users. Look for the lines between \'// START: Use Gzip output compression?\' and \'// END: Use Gzip output compression?\' and remove THERE the comment slashes.</li>
<li><b>Subdirectory</b> - This option has to be set when your XOOPS is working in a subdirectory. Ex.: Instead of http://localhost/ pointing to your homepage, http://localhost/wotever/ is the URL to your homepage. Fill in the name of your subdirectory starting with a slash. There is no need for an ending slash.</li>
</ul>
<h2>Now you finished the preferences and you can on to toolsets! There you can define the toolbars for every group individually.</h2>
<p>First select the group you want to make the toolbars for. Please note, that only for the first THREE groups toolbars are predefined. For other groups the toolbar have to be submitted once!</p>
<ul>
<li><b>Toolbar rows</b> - You have three rows for your tools. Just click the icons to place the tools into the textarea. The order of the textarea is the order where the tools finally appear in the editor. IE and Gecko-browsers have two different approaches: IE places the tools at the beginning of the textarea whereas Gecko-browsers place the tools at the end of the textarea. If you want to define your own order of tools just place the cursor at the position (not inside a word for the tools) where you want the tool to appear and then just click an icon. Do not worry about the blanks that are inside the textarea, these blanks will be trimmed nicely on submission.</li>
<li><b>Max. image width</b> - This is the maximum size for the width of images. This only applies for the plugins iBrowser and iManager. If you don\'t want to use these plugins just leave the value there.</li>
<li><b>Max. image height</b> - This is the maximum size for the height of images. This only applies for the plugins iBrowser and iManager. If you don\'t want to use these plugins just leave the value there.</li>
<li><b>Disk quota</b> - Here you can define how much disk space a user can use for images. This only applies for the plugins iBrowser and iManager. If you don\'t want to use these plugins just leave the value there. If you are now think that you want to have such restriction, just wait until we visited the permissions-page for tinyeditor.</li>
<li><b>Active plugins</b> - Here is a list of the activated plugins. Don\'t touch the entries there! This textarea will always be cleaned on submission. Now you ask why do tinyeditor need this field anyway? Simple! There are two different ways of using the functions of tinyeditor (or better tinyMCE): There are in-built (standard buttons) functions and there are plugins. The plugins need to be stated during initialization of the editor. You don\'t have to care about which button to click, plugins will always be added into this textarea.</li>
<li><b>Valid Elements, Extended Valid Elements and Invalid Elements</b> - With these three fields you are able to define which html-tags are allowed to use inside the editor. The following example is taken from the original tinyMCE-manual which you will find under origdocs. There is a complete explanation on how to set up valid elements, extended elements and invalid elements. <b>Valid elements:</b> This example string tells the editor to remove all elements that are not a "a, strong, div or br" element, convert b elements to strong elements, default target to "_blank" and keep the href, target and align attributes of the elements.<br /><br />
<b>a[href|target=_blank],strong/b,div[align],br</b><br /><br />
Put your definition into their textareas and save it to the database. If you don\'t want to invest more time on this, just leave the fields as they are - a basic instruction set will then be used. If you experience that some html-tags are empty in your html-code, come back here and fill in the missing elements. For your convenience there is a pulldown to insert the standard instruction set or to insert full xhtml-compliance.</li>
</ul>
<h2>Once you defined the toolbars for all your groups, go to permissions!</h2>
<ul>
<li><b>Allowed to upload files</b> - Here you can define which group is allowed to upload images. This applies for the plugins iBrowser and iManager only.</li>
<li><b>Allowed to delete files</b> - Here you can define which group is allowed to delete images. This applies for the plugins iBrowser and iManager only.</li>
<li><b>WYSIWYG</b> - Here you can define which group is allowed to use the WYSIWYG-feature. If unchecked the users will only get the standard DHTML-textarea. Please note that you have to set the permission also for the webmaster-group!!</li>
<li><b>Allowed to create folders</b> - Here you can define which group is allowed to create directories. This applies only for the plugins iBrowser and iManager only.</li>
<li><b>Use quota</b> - Here you can define which group has only limited disk space for image upload (how much disk space was defined in toolsets). Please note that the webmaster-group is NOT automatically included. If you want the webmaster-group to have also limited disk space you have to check there as well. This applies only for the plugins iBrowser and iManager only.</li>
<li><b>Override user-dirs for images</b> - If the user has only limited disk space he can only navigate within his directories. With this permission you are able to override this so this group is allowed to see ALL upload-directories. This permission makes only sense if the use quota permission is used. This applies only for the plugins iBrowser and iManager only.</li>
<li><b>Change image attributes</b> - Here you can define which group is allowed to change image attributes. This applies only for the plugins iBrowser and iManager only.</li>
<li><b>Rename images</b> - Here you can define which group is allowed to rename the images. Please note that this might lead to unexpected results if images are renamed when already used in written articles. This applies only for the plugins iBrowser and iManager only.</li>
</ul>
<p>Now you are ready to work with tinyeditor WHEN the modules you want to use tinyeditor with are ready for tinyeditor. tinyeditor is quite new, so there are not many modules out there who are able to communicate with tinyeditor. So here are some instructions on how to implement the editor:</p>
<ul>
<li>
If you\'re using an "old" version of Xoops (< 2.2) you can still use tinyeditor with your modules<br />
In this case only a few changes to some of your module\'s files are required.<br />
Following is a sample of integration with an old News module:<br />
In your favourite text editor open the file
<pre class="terminal">
XOOPS_ROOT_PATH/modules/news/include/storyform.inc.php
</pre>
about line 35 add the following line
<pre class="terminal">
include_once XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php";
</pre>
Make sure this is the last file to be included<br /><br />
Then move on and replace the lines which render the textareas with
<pre class="terminal">
$sform->addElement(new XoopsFormTinyeditorTextArea(array(\'caption\'=> _NW_THESCOOP, \'name\'=>\'hometext\', \'value\'=>$hometext, \'width\'=>\'100%\', \'height\'=>\'400px\'),true));
</pre>
for the Scoop text and <br />
<pre class="terminal">
$sform->addElement(new XoopsFormTinyeditorTextArea(array(\'caption\'=> _AM_EXTEXT, \'name\'=>\'bodytext\', \'value\'=>$bodytext, \'width\'=>\'100%\', \'height\'=>\'400px\'),false));
</pre>
for the Extended text<br />
That\'s all!
</li>
</ul>
<h3>Unfortunately this is not all!</h3>
<p>Here is a short description of how to make "new" modules work with tinyeditor that were designed for the xoopseditor framework</p>
<p>We take the new news-module as example. Koivi was the first editor that was used for the xoopseditor framework. So lets search for occurrances of koivi to mimic this to make tinyeditor work</p>
<p>Open xoops_version.php and look for this array (may vary):</p>
<pre class="terminal">
array(_MI_NEWS_FORM_DHTML=>\'dhtml\', _MI_NEWS_FORM_COMPACT=>\'textarea\', _MI_NEWS_FORM_SPAW=>\'spaw\', _MI_NEWS_FORM_HTMLAREA=>\'htmlarea\', _MI_NEWS_FORM_KOIVI=>\'koivi\', _MI_NEWS_FORM_FCK=>\'fck\');
</pre>
<p>and change this to:</p>
<pre class="terminal">
array(_MI_NEWS_FORM_DHTML=>\'dhtml\', _MI_NEWS_FORM_COMPACT=>\'textarea\', _MI_NEWS_FORM_SPAW=>\'spaw\', _MI_NEWS_FORM_HTMLAREA=>\'htmlarea\', _MI_NEWS_FORM_KOIVI=>\'koivi\', _MI_NEWS_FORM_FCK=>\'fck\', \'tinyeditor\'=>\'tinyeditor\');
</pre>
<p>Now open include/functions.php and look for:</p>
<pre class="terminal">
	case "koivi":
		if(!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/wysiwyg/formwysiwygtextarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/wysiwyg/formwysiwygtextarea.php");
				$editor = new XoopsFormWysiwygTextArea($caption, $name, $value, \'100%\', \'400px\', \'\');
			}
		} else {
			$editor = new XoopsFormEditor($caption, "koivi", $editor_configs);
		}
		break;
</pre>
<p>After this insert these lines:</p>
<pre class="terminal">
	case "tinyeditor":
			if ( is_readable(XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php");
				$editor = new XoopsFormTinyeditorTextArea(array(\'caption\'=>$caption, \'name\'=>$name, \'value\'=>$value, \'width\'=>\'100%\', \'height\'=>\'400px\'));
			}
		break;
</pre>
<p>Update the news-module and you are done (hopefully). Now you have a good example on how to implement tinyeditor in other modules.</p>
<hr />
<h2>Here is the full list of the <b>plugins</b> explained roughly!</h2>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/advhr/images/advhr.gif" align="absmiddle" alt="" /> <b>Horizontal rule:</b> This plugin allows you to define some more values like width, height and shadow for the horizontal rule.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/themes/advanced/images/image.gif" align="absmiddle" alt="" /> <b>Advanced Image:</b> This is an advanced version of the standard button image. You can set some extra options here. Please note that with this plugin uploads are not possible. To make use of this plugin the standard button needs to be placed too.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/themes/advanced/images/link.gif" align="absmiddle" alt="" /> <b>Advanced link:</b> This is an advanced version of the standard button link. You can set many extra options here. As an extra I included the possibility of adding links from XOOPS modules. Currently links for the modules mylinks, newbb, news and wfdownloads are possible. You\'ll find the extra code for adding XOOPS links inside the plugin advlink in folder plugins. I did not spent much time on these plugins for this plugin. Maybe YOU want to enhance these php scripts for better use?</b>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/emotions/images/emotions.gif" align="absmiddle" alt="" /> <b>Emotions:</b> This plugin queries the XOOPS database for smilies and inserts them into the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/flash/images/flash.gif" align="absmiddle" alt="" /> <b>Flash:</b> Inserts Flash movies. Enter the URL, height and width of the movie and insert it.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/insertdatetime/images/insertdate.gif" align="absmiddle" alt="" /> <b>Insert date:</b> Inserts the current date formatted as defined in preferences.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/insertdatetime/images/inserttime.gif" align="absmiddle" alt="" /> <b>Insert time:</b> Insert the current time formatted as defined in preferences.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/preview/images/preview.gif" align="absmiddle" alt="" /> <b>Preview:</b> With this button you\'ll get a preview of the current content in a popup.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/print/images/print.gif" align="absmiddle" alt="" /> <b>Print:</b> With this button you can print the current content of the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/searchreplace/images/search.gif" align="absmiddle" alt="" /> <b>Search:</b> Search throught the content of the editor for specified words.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/searchreplace/images/replace.gif" align="absmiddle" alt="" /> <b>Replace:</b> Search throught the content of the editor for specified words and replace them.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/table/images/table.gif" align="absmiddle" alt="" /> <b>Table:</b> With this plugin you\'ll have all features to design tables. Once activated you get 11 buttons for designing or editing tables.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/zoom.gif" align="absmiddle" alt="" /> <b>Zoom:</b> With this plugin you can zoom the content of the editor up to 250% (IE only).</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/iespell.gif" align="absmiddle" alt="" /> <b>Spellchecker:</b> With this plugin you can spellcheck the content of the editor (IE only). You need IESPELL (http://www.iespell.com/download.php) to be installed.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/xquote.gif" align="absmiddle" alt="" /> <b>XOOPS-Quote:</b> Highlight text in your editor and make it formatted like a XOOPS-Quote.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/editor/plugins/blockproperties/images/properties.gif" align="absmiddle" alt="" /> <b>Block properties:</b> With this plugin you can set some extra options for block-elements like headings and paragraphs. You have to click inside a block-element to edit its properties.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/xcode.gif" align="absmiddle" alt="" /> <b>XOOPS-Code:</b> Highlight text in your editor and make it formatted like a XOOPS-Code.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/mlcontent.gif" align="absmiddle" alt="" /> <b>ML-Content:</b> This plugin opens where you paste your text and select the language markup. This plugin is to be used with the multilingual hacks of XOOPS.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/pasteword.gif" align="absmiddle" alt="" /> <b>Paste Word:</b> Copy your text from a Word-document to insert it into the editor. The Word-code will be cleaned. There are much more options for this plugin, have a look at the origdocs. There is a small difference between the behaviour of this plugin in IE and Gecko-browsers. Working with IE just copy the text from Word and click the button in the editor. In Gecko-browsers you have to insert the text to the popup, then click Insert to return it to the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/pastetext.gif" align="absmiddle" alt="" /> <b>Paste Text:</b> This plugin returns simple text to the editor. You can preserve linebreaks if you want.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/selectall.gif" align="absmiddle" alt="" /> <b>Select All:</b> With this plugin you can select the complete content of the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/ltr.gif" align="absmiddle" alt="" /> <img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/rtl.gif" align="absmiddle" alt="" /> <b>LTR / RTL:</b> With these plugin you can change the writing direction of a paragraph.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/fullscreen.gif" align="absmiddle" alt="" /> <b>Full Screen:</b> This plugin makes the editor occupy the whole screen. Clicking again on the icon reverts the editor to normal size.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/imanager.gif" align="absmiddle" alt="" /> <b>iManager:</b> This is a full-featured image manager. You can upload files, edit them, add some special effects etc.pp. Although almost perfect, there some things that might cause problems with this plugin: a) In most cases the auto-detection of the document root works fine, but in rare cases it fails. To solve this problem edit the file tinyeditor/editor/plugins/imanager/scripts/phpThumb/phpThumb.config.php and set the document root manually. b) In some cases there will be problems with the GD-library. This happens when there is no GD installed on the server or GD has not the right version number. These problems the plugin can not avoid. If you have problems with GD take the image manager plugin which is the XOOPS image manager wrapped as a plugin.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/ibrowser.gif" align="absmiddle" alt="" /> <b>iBrowser:</b> Nearly the same as iManager, but with less features. Same problems as the iManager-plugin.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/charcount.gif" align="absmiddle" alt="" /> <b>Char counter:</b> Counts the words and characters inside the editor area.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/insertcode.gif" align="absmiddle" alt="" /> <b>Insert Code:</b> Opens a popup where you can paste source-code. Select the programming language. Once done your source code appears nicely formatted inside the editor using the geshi-syntax-highlighter. If you want to use this plugin you have to add some css-classes to the css-file of the editor.</p>
<pre class="terminal">
pre {
border-top: 1px solid #ddd;
border-left: 5px solid #ddd;
border-right: 1px solid #ddd;
border-bottom: 1px solid #ddd;
background-color: #eee;
padding: 2px;
margin: 0;
color: #000066;
}

.css .de1, .css .de2, .html4strict .de1, .html4strict .de2, .javascript .de1, .javascript .de2, .mysql .de1, .mysql .de2, .php .de1, .php .de2, .smarty .de1, .smarty .de2, .sql .de1, .sql .de2, .xml .de1, .xml .de2
{font-family: \'Courier New\', Courier, monospace; font-weight: normal;color: #000020;}
.css .imp, .html4strict .imp, .javascript .imp, .mysql .imp, .php .imp, .smarty .imp, .sql .imp, .xml .imp
{font-weight: bold; color: red;}
.css .kw1, .html4strict .kw1, .javascript .kw1, .mysql .kw1, .php .kw1, .smarty .kw1, .sql .kw1, .xml .kw1
{color: #b1b100;}
.css .kw2, .html4strict .kw2, .javascript .kw2, .mysql .kw2, .php .kw2, .smarty .kw2, .sql .kw2, .xml .kw2
{color: #000000; font-weight: bold;}
.css .kw3, .html4strict .kw3, .javascript .kw3, .mysql .kw3, .php .kw3, .smarty .kw3, .sql .kw3, .xml .kw3
{color: #000066;}
.css .kw4, .html4strict .kw4, .javascript .kw4, .mysql .kw4, .php .kw4, .smarty .kw4, .sql .kw4, .xml .kw4
{color: #f63333;}
.css .co1, .css .co2, .css .coMULTI, .html4strict .co1, .html4strict .co2, .html4strict .coMULTI, .javascript .co1, .javascript .co2, .javascript .coMULTI, .mysql .co1, .mysql .co2, .mysql .coMULTI, .php .co1, .php .co2, .php .coMULTI, .smarty .co1, .smarty .co2, .smarty .coMULTI, .sql .co1, .sql .co2, .sql .coMULTI, .xml .co1, .xml .co2, .xml .coMULTI
{color: #808080; font-style: italic;}
.css .es0, .html4strict .es0, .javascript .es0, .mysql .es0, .php .es0, .smarty .es0, .sql .es0, .xml .es0
{color: #000099; font-weight: bold;}
.css .br0, .html4strict .br0, .javascript .br0, .mysql .br0, .php .br0, .smarty .br0, .sql .br0, .xml .br0
{color: #66cc66;}
.css .st0, .html4strict .st0, .javascript .st0, .mysql .st0, .php .st0, .smarty .st0, .sql .st0, .xml .st0
{color: #ff0000;}
.css .nu0, .html4strict .nu0, .javascript .nu0, .mysql .nu0, .php .nu0, .smarty .nu0, .sql .nu0, .xml .nu0
{color: #cc66cc;}
.php .me1 {color: #006600;}
.php .me2 {color: #006600;}
.php .re0 {color: #0000ff;}

pre ol{margin-left: 0;padding-left: 30px;}

pre .head {font-family: Verdana, Arial, sans-serif;color: #333333;font-weight: bold;background-color: #f0f0ff;border-bottom: 1px solid #d0d0d0;padding: 2px;font-size: 12px;}
pre li, pre li {font-family: \'Courier New\', Courier, monospace; color: black; font-weight: normal; font-style: normal;font: normal normal 95% \'Courier New\', Courier, monospace; color: #003030;}
pre li.li2 {font-weight: bold;font-weight: bold; color: #006060;}
pre .foot {display: none;}
pre a:link {color: #000060;}
pre a:hover {background-color: #f0f000;}
</pre>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/insertdiv.gif" align="absmiddle" alt="" /> <b>Insert DIV:</b> Makes a DIV from your selected text. This plugin comes with tons of features and options.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/custombullet.gif" align="absmiddle" alt="" /> <b>Custom Bullet:</b> Use this plugin to make your own definition lists.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/divselect.gif" align="absmiddle" alt="" /> <b>Div Select:</b> The simple version of the insert div-plugin. Select text and pick up an entry from the dropdown to make a DIV. There are already some dummy-entries inside the dropdown. To adapt it to your needs you have to edit tinyeditor / include / initcode.php. Look for <b>divselect_classes</b>. Add your own entries there. These entries must be also a CSS-class in the css-file of the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/noneditable.gif" align="absmiddle" alt="" /> <b>Non editable:</b> Once activated you can select the style Non editable from the style selector to protect elements against editing.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/ximagemanager.gif" align="absmiddle" alt="" /> <b>XOOPS Image Manager:</b> This is the well-known XOOPS image manager wrapped as a plugin. Meant for those who have problems with iBrowser or iManager.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/contextmenu.gif" align="absmiddle" alt="" /> <b>Context Menu:</b> Gives you some commands to be used in the editor when right-clicking in the editor area or on elements. Please note that although this plugin appears inside the textarea in toolsets, there is no icon in the toolbar of the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/autosave.gif" align="absmiddle" alt="" /> <b>Autosave:</b> The name of this plugin promises more than it is indeed. Once activated this plugin displays a warning when you are not going to save your work. Sometimes unstable. Just in here for completeness. Please note that although this plugin appears inside the textarea in toolsets, there is no icon in the toolbar of the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/inlinepopups.gif" align="absmiddle" alt="" /> <b>Inlinepopups:</b> Nothing in common with generating popups. This will only turn popup-windows into popup-divs. Looks nicer, but has some problems when GZIP is activated. Please note that although this plugin appears inside the textarea in toolsets, there is no icon in the toolbar of the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/xrmanager.gif" align="absmiddle" alt="" /> <b>Simple browser:</b> Very experimental plugin! This is a plugin which plugs into the plugins advlink, advimage and flash. Once activated you are able to browse to files or links on your server. Please note that this plugin uses special folders within your uploads directory. You can only upload or select files with this plugin. The button will NOT appear in the toolbars of the editors. In toolsets you\'ll find the icon for this plugin inside the standard buttons, because I had to find a way to hide this plugin for groups are not allowed to use this plugin.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/keyboard.gif" align="absmiddle" alt="" /> <b>Unicode keyboard:</b> This plugin offers you to write text in foreign charcodes like eastern languages, arabic, hebrew etc. To navigate through the text use the arrows on the keyboard which will be displayed in a popup.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/equation.gif" align="absmiddle" alt="" /> <b>Equation:</b> This plugin will return some equations to the editor.</p>
<p><img src="'.XOOPS_URL.'/modules/tinyeditor/admin/images/pagebreak.gif" align="absmiddle" alt="" /> <b>Pagebreak:</b> Some modules make use of the [pagebreak]-tag to allow multipage-articles.</p>
<hr />
<br>
&nbsp;</font></p>

<li><a href="http://tinymce.moxiecode.com/">Moxiecode\'s crew</a> for building such a great and useful tool</li>
<li><a href="http://www.zhuo.org/htmlarea/docs/index.html">Wei Zhuo</a> for the advanced image manager/editor</li>
<li>Phppp for fixing tinyeditor\'s backward compatibility with Xoops < 2.2</li>
<li>ralf57 for writing tinyeditor on which tinyeditor is based on</li>
<li>All the others who contributed their plugins and help</li>
</ul>
</div>
';
?>
