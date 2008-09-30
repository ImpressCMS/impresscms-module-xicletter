<?php
/**
 * $Id: about.php,v 1.0 2006/10/11 GibaPhp
 * Credits for idea and code - frankblacksf
 * Module: Example
 * Version: v 0.1
 * Release Date: 12 Out 2006
 * Author: GibaPhp
 * Licence: GNU
 */

include "admin_header.php";
$module_handler = &xoops_gethandler('module');
$versioninfo = &$module_handler->get($xoopsModule->getVar('mid'));
echo "<br />";
echo "<fieldset>";
echo "<img src='" . XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/" . $versioninfo->getInfo('image') . "' alt='' hspace='0' vspace='0' align='left' style='margin-right: 10px;'/></a>";
echo "<div style='margin-top: 10px; color: #33538e; margin-bottom: 4px; font-size: 18px; line-height: 18px; font-weight: bold; display: block;'>" . $versioninfo->getInfo('name') . " version " . $versioninfo->getInfo('version') . "</div>";
if ($versioninfo->getInfo('author_realname') != '') {
    $author_name = $versioninfo->getInfo('author') . " (" . $versioninfo->getInfo('author_realname') . ")";
} else {
    $author_name = $versioninfo->getInfo('author');
}
echo "<div style = 'line-height: 16px; font-weight: bold; display: block;'>" . _MI_XMAIL_AUTHOR_DESC . " " . $author_name. "</div>";
echo "<div style = 'line-height: 16px; display: block;'>" . $versioninfo->getInfo('license') . "</div>\n";
echo "</fieldset>";

$devsite           = $versioninfo->getInfo('dev-site');
$siteauthor        = $versioninfo->getInfo('site-author');
$devsupport        = $versioninfo->getInfo('support');
$devreportbugs     = $versioninfo->getInfo('report-bugs');
$devreportfeatures = $versioninfo->getInfo('report-features');
$devnewversion     = $versioninfo->getInfo('new-version');
$devqascheckin     = $versioninfo->getInfo('qas-check-in');
$devdependences    = $versioninfo->getInfo('dependences');
$devcompatible     = $versioninfo->getInfo('compatible');

echo "<br />\n";
// Module Development information
echo "<fieldset><legend>[" . _MI_XMAIL_DEVINFOS . "]</legend>";
echo "<table width='100%' cellspacing=1 cellpadding=1 border=0>";
echo "<tr'>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEVSITE_DESC."</i></font> <a href=\"".$devsite."\"><span>"._MI_XMAIL_DEVSITE_NAME."</span></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEVSITE_AUTHOR_DESC."</i></font> <a href=\"".$siteauthor."\"><span>"._MI_XMAIL_DEVSITEAUTHOR_NAME."</span></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEVREPORT_BUGS_DESC."</i></font> <a href=\"".$devsupport."\"><span>"._MI_XMAIL_DEVREPORT_BUGS_NAME."</span></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEVREPORT_FEATURES_DESC."</i></font> <a href=\"".$devreportbugs."\"><span>"._MI_XMAIL_DEVREPORT_FEATURES_NAME."</span></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEVNEW_VERSION_DESC."</i></font> <a href=\"".$devnewversion."\"><span>"._MI_XMAIL_DEVNEW_VERSION_NAME."</span></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEVQAS_CHECK_DESC."</i></font> <a href=\"".$devqascheckin."\"><span>"._MI_XMAIL_DEVQAS_CHECK_NAME."</span></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEV_DEPENDENCES_DESC."</i></font> <b>".$devdependences."</b> &nbsp;"._MI_XMAIL_DEV_DEPENDENCES_NAME."</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='even' align='left'> <font face='Courier New'><i>"._MI_XMAIL_DEV_COMPATIBLE_DESC."</i></font> <b>".$devcompatible."</b> &nbsp;"._MI_XMAIL_DEV_COMPATIBLE_NAME."</td>";
echo "</tr>";
echo "</table></fieldset>";
echo "<br />\n";

//Changelog
echo "<fieldset><legend>[". _MI_XMAIL_CHANGELOG ."]</legend>
<table width='100%' cellspacing=1 cellpadding=1 border=0>

<h2>Version 2.5</h2>
<ul>

<li><i><font color='#FF0000'>Log erros while sent messages</font></i></li>
<blockquote>
     [pt_BR]-> Na área administrativa é possível ver os erros que ocorreram durante o envio das mensagens.
     Seja por agendamento automático ou manual. Também é possível editar a lista de erros, para limpa-la, após tomar conhecimento do ocorrido.<br>
     <br>
     Um tipo de erro comum :<br>
        Perfil de fulano não aceita receber email
</blockquote>

<li><i><font color='#FF0000'>Extra field text in message sent</font></i></li>
<blockquote>
     [pt_BR]-> Foi incluso nesta versão um campo para informar a mensagem no formato somente texto, para ser exibida
em clientes de email que não aceitam HTML .
</blockquote>
<li><i><font color='#FF0000'>Messages sent inbox (PM)</font></i></li>
<blockquote>
     [pt_BR]-> Mensagens que serão enviadas para 'Caixa de Entrada (mensagens particular)' , deve ser editada usando o editor  'Dhtml', pois caso seja
usado html, não será visualizada corretamente pelo usuário. O xoops não  prevê o suporte de html nesta parte do sistema.
</blockquote>


<li><i><font color='#FF0000'>Anonimus users can add newsletter</font></i></li>
<blockquote>
    [en]-> Anonimus users can/cannot add themselfs to newsletter.
</blockquote>
<blockquote>
    [pt_BR]-> Usuários anônimos podem ou não serem adicionados para a newsletter.
</blockquote>


<li><i><font color='#FF0000'>Import user xoops for list newsletter</font></i></li>
<blockquote>
    [en]-> Now Import users xoops for contacts lists newsletter. Select users for import.
</blockquote>
<blockquote>
    [pt_BR]-> Agora importa usuários do xoops para a lista de newsletter.
</blockquote>
<li><i><font color='#FF0000'>Import contacts lists CSV</font></i></li>
<blockquote>
    [en]-> Now  Import contacts from lists newsletter + csv(outlook/excell/... friendly) - Predefined fields (name, nick, primary Email)
</blockquote>
<blockquote>
    [pt_BR]-> Agora importa contatos para a listagem de newsletter em formato CSV (outlook/excell, etc...) - Predefinidos campos (nome, apelido e e-mail)<br>
    Os cadastros serão inseridos na situação de confirmados.<br>
    No campo ip, será inserido string 'import'. Dessa forma será possível diferenciar os cadastros que foram importados
    dos que se cadastraram originalmente.<br>
    A lista dos assinantes pode ser visualizada na área administrativa em 'Assinantes da Newsletter'<br>
</blockquote>
<li><i><font color='#FF0000'>Export contacts lists in format CSV</font></i></li>
<blockquote>
    [en]-> Now Export contacts from lists newsletter + csv(outlook/excell/... friendly)
</blockquote>
<blockquote>
    [pt_BR]-> Agora Exporta contatos da sua listagem de newsletter para o formato CSV (outlook/excell, etc...)
</blockquote>

<li><i><font color='#FF0000'>keeping contacts lists</font></i></li>
<blockquote>
    [en]-> Now a tool for keeping contacts lists (supported by a custom fields ability, and custom made groups/lists - not xoops groups).
</blockquote>
<blockquote>
    [pt_BR]-> Uma ferramenta para manter as listas de contatos (suportadas por uma abilidade feita sob encomenda dos campos), e pelo funciona independente aos grupos do xoops.
</blockquote>

<li><i><font color='#FF0000'>Allowed to delete messages</font></i></li>
<blockquote>
</blockquote>
<li><i><font color='#FF0000'>Allowed to use editor WYSIWYG</font></i></li>
<blockquote>
     [pt_BR]-> Pode ser usado o módulo  tinyeditor  (inserir  link)    ou  editor  (inserir  link) , os quais foram testados nesse ambiente.<br>
     Quanto ao pacote mencionado acima (XoopsEditor Framework)  funcionou bem com o PHP4.<br>
     Obs. O módulo  editor  não funciona com o debug  ativado.<br>
</blockquote>

<li><i><font color='#FF0000'>Allowed to create attach file in message private or no</font></i></li>
<blockquote>
</blockquote>
<li><a title='Sugestão de alterações' href='http://www.xoopstotal.com.br/modules/newbb/viewtopic.php?topic_id=6290&viewmode=flat&order=ASC&type=&mode=0&start=0'>
<i><font color='#FF0000'>Sugestão de Alterações para a nova versão</font></i></a></li>
<blockquote>
</blockquote>
<li><i><font color='#FF0000'>New Features</font></i></li>
<blockquote>
    [en]-> Anonimus users can/cannot add themselfs to newsletter.<br>
    Sending Emails in sessions (packets) with the ability to choose no. of emails at one session - not booging shared servers , maybe even choosing how many users from a domain will get email from the mailinglist at a time interval.<br>
    Html and text emails in the same time, with wysiwyg support (xoops wysiwyg class)<br>
    Ability to send to groups and/or individuals.<br>
    Function for not sending duplicated emails if user is in more then one group.

</blockquote>
<blockquote>
    [pt_BR]-> Anonimus users can/cannot add themselfs to newsletter.<br>
    Sending Emails in sessions (packets) with the ability to choose no. of emails at one session - not booging shared servers , maybe even choosing how many users from a domain will get email from the mailinglist at a time interval.<br>
    Html and text emails in the same time, with wysiwyg support (xoops wysiwyg class)<br>
    Ability to send to groups and/or individuals.<br>
    Function for not sending duplicated emails if user is in more then one group.<br>
</blockquote>

<br>
<hr />
<br>
<h2>Version 2.0</h2>
<li><i><font color='#FF0000'>Vide diretório Docs do Xmail</font></i></li>
<ul>
<hr />
<br>
<h2>Version 1.5</h2>
<li><i><font color='#FF0000'>Vide diretório Docs do Xmail</font></i></li>
<ul>
<hr />
<br>
<h2>Version 1.10</h2>
<li><i><font color='#FF0000'>Vide diretório Docs do Xmail</font></i></li>
<br>
<hr />
<ul>
<h2>Version 1.0</h2>
<li><i><font color='#FF0000'>Vide diretório Docs do Xmail</font></i></li>
<br>
<hr />
<ul>
<br>
</table></fieldset>
";
xoops_cp_footer();
?>
