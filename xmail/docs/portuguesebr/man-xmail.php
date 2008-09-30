<?php
include 'style.php';
echo '<style>
<!--
 p.MsoNormal
	{mso-style-parent:"";
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
table.MsoTableGrid
	{border:1.0pt solid windowtext;
	font-size:10.0pt;
	font-family:"Times New Roman"}
-->
</style>';
$ImgUrlDoc = XOOPS_URL.'/modules/'.$admin_mydirname.'/docs/'.$xoopsConfig['language'].'/images';
//echo $ImgUrlDoc."<br />";

echo '<div id="body">

<h2><font color="#FF0000">Manual Xmail</font></h2>
<ol>
<h3> Neste setor voc� ir� encontrar todos os manuais de orienta��o para uma correta utiliza��o deste m�dulo.
</ol>
<hr />
<h2><font color="#FF0000">O que temos Aqui ?</font></h2>
<ol>
<h4>
<ul>
<li><b>Como agendar envio de mensagens e newsletter</b></li>
<li><b>Ajuda para uma correta utiliza��o deste m�dulo</b>
<li><b>Sobre detalhes dos desenvolvedores e colaboradores</b>
<li><b>Hist�rico da vers�o atual e anteriores</b>
</ul>
</ol>
<hr />

<blockquote>
</blockquote>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
 <tr>
  <td>
    <img src="'.$ImgUrlDoc.'/xmail_001.gif" align="left" alt="Menu Xoops" />
    <p align="justify">Xmail � um sistema de integra��o entre o site e seus
    usu�rios. <br>
    <br>
    Permite an�ncios para todos os usu�rios ou apenas para alguns grupos.<br>
    <br>
    Controla o envio em lotes e agora tamb�m o agendamento para diversos
    per�odos. <br>
    <br>
    Voc� pode criar mensagens com arquivos em anexo, �timo para fazer uma
    distribui��o de sistemas e documenta��es em geral. Procura avaliar os
    usu�rios que ainda n�o esteja confirmado no sistema e cria reenvios de
    ativa��es. <br>
    <br>
    Agora contando com gerenciador de newsletter permite a utiliza��o de
    editores visual e controle de perfis de usu�rios para a leitura de
    newsletter. <br>
    <br>
    No caso de newsletter, o usu�rio n�o precisa estar cadastrado no site para
    fazer uso da newsletter, pode simplesmente utilizar o bloco de assinatura
    para poder receber novas edi��es, resenhas, informativos e conte�dos que
    desejar criar. <br>
    <br>
    Neste simples manual voc� ir� aprender a maioria das informa��es b�sicas
    para um correto funcionamento e opera��o deste m�dulo. </p>
  </td>
 </tr>
</table>

<hr />

<img src="'.$ImgUrlDoc.'/xmail_002.gif" width="750" height="344" alt="Menu Principal" />
<br>
<p align="justify">Neste setor voc� j� ir� encontrar algumas novidades como o menu em 3D e suas configura��es.
   Tamb�m poder� acompanhar no desenrolar desta documenta��o e ir� perceber que este menu possui sub-menus
   dependendo do local onde voc� estiver.</p>
<br>

<hr />

<i><b><font color="#FF0000" size="5">Apresenta��o</font></b></i><br>
<br>
Voc� pode ver as principais novidades encontradas nesta nova vers�o. Basicamente todas foram originadas
por sugest�es dos usu�rios durante o �ltimo per�odo. Esperamos que fa�a bom uso deste sistema e que
continue a dar suas sugest�es para melhoria.
<br>
<hr />
<br>
<i><b><font color="#FF0000" size="5">Alterando Parametros</font></b></i>
<br>
<br>
Ap�s a instala��o deste m�dulo este � o <b>primeiro</b> setor obrigat�rio a ser configurado.
Se isto n�o for feito imediatamente ap�s a instala��o, muitos setores do m�dulo n�o ir�o funcionar
de acordo com o esperado.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_003.gif" " title="Excluir mensagens ap�s X dias" align="absmiddle" alt="Excluir mensagens ap�s X dias" />
 O padr�o na instala��o � de 100 dias. Voc� ir� colocar a quantidade de dias para a exclus�o desta
 mensagem ap�s o seu envio. Desta forma o sistema n�o permitir� excluir mensagens cuja data do �ltimo envio for menor que X dias .<br>
 Este procedimento n�o � autom�tico, serve apenas para evitar excluir mensagens por engano.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_004.gif" " title="Enviar mensagens com lotes de X em X" align="absmiddle" alt="Enviar mensagens em lotes" />
  Este n�mero ir� definir a quantidade de destinat�rios em cada lote.
  Usado em conjunto com a op��o de dar pausar de segundos entre um lote e outro.<br>
  E tamb�m limitar um determinado n�mero de lotes por hora, para Servidores com restri��o 
  de envios por hora. 
  
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_005.gif" " title="Ordem para visualiza��o das mensagens" align="absmiddle" alt="Ordem de visualiza��o" />
  Escolha a ordem padr�o que ir� ser apresentada as mensagens enviadas ou a enviar.
  Clicando no select, voc� poder� optar por ordem alfab�tica da descri��o da mensagem,
  C�digo da mensagem (bom para mostrar �ltimas e primeiras), Data de envio mais recente e Data de envio mais antigo.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_006.gif" " title="Limite de mensagens por p�gina" align="absmiddle" alt="Limite de mensagens" />
  Define o n�mero de mensagens a ser exibida em cada p�gina , na ger�ncia de mensagens ou no log de envios.

<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_007.gif" " title="Aprovar Mensagens Automaticamente" align="absmiddle" alt="Aprovar mensagens" />
  O nomal � usar este parametro como n�o. Se deixar como sim, todos que tenham acesso ao setor de cadastro do Xmail
  ir�o ter suas mensagens aprovadas automaticamente. Se voc� � o admin do site, suas mensagens ser�o aprovadas
  imediatamente e n�o depender� deste parametro. Se quiser utilizar este setor com aprova��o autom�tica,
  considere a possibilidade da cria��o de um novo grupo especial para isto e inclua uma quantidade muito
  seletiva para usar este m�dulo. Muito cuidado com acesso a SPAMMERS se isto ficar liberado a todos os usu�rios
  registrados do site. Se deixar aprova��o autom�tica, use por sua conta e risco.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_008.gif" " title="Permite anexar arquivos" align="absmiddle" alt="Permitir anexar arquivos" />
  Isto � muito �til e est� presente j� a um bom tempo e foi pouco explorado ainda. Se voc� permitir o anexo em mensagens,
  poder� enviar seus documentos como arquivos anexados, ex:<br>
  -Manuais.<br>
  -Arquivos Excell.<br>
  -Arquivo powerpoint.<br>
  -Novos programas desenvolvidos.<br>
  Mesmo que voc� esteja apenas enviando mensagens particulares (PM) ele ir� permitir estes anexos.
  Quando um arquivo � anexado ele cria um local no nome do usu�rio para armazer o arquivo ap�s o upload e fica disponivel
  sempre neste endere�o particular do usu�rio. Se souber usar este recurso com cuidado, poder� ter uma �rea especial de
  arquivos para os usu�rios que podem enviar conte�dos para o site.
  Estes arquivos em anexo n�o ser�o excluidos ap�s a expira��o das mensagens, para fazer isto voc� dever� entrar manualmente
  no diret�rio de uploads deste m�dulo e dentro da pasta com o nome do usu�rio e remover o arquivo fisicamente do diret�rio.
  Se ainda tiver d�vidas de como ir� utilizar isto em suas mensagens, envie suas d�vidas para o nosso site de suporte ao m�dulo.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_009.gif" " title="Uploades de arquivos" align="absmiddle" alt="Uploads de arquivos" />
  O padr�o para os arquivos de uploads para seus arquivos anexados em mensagens � normalmente <b>xoops/uploads/xmail</b> e
  deve possuir as permiss�es se linux 774 ou se for windows (permitir leitura e grava��o).
  Agora voce poder� alterar para o diret�rio padr�o de uploads do xoops e criar diret�rio especial para o seu
  trabalho conforme a figura abaixo:<br>
  <img src="'.$ImgUrlDoc.'/xmail_010.gif" " align="absmiddle" title="Diret�rio de Uploads para seus arqivos de mensagens" alt="Diret�rio de Uploads " />
  Desta forma em vez de enviar os arquivos de uploads para dentro do m�dulo Xmail, ir� enviar para o diret�rio padronizado
  e ainda em um local especial somente para este m�dulo.
<br>
<br>
<pre class="terminal-mini">
<img src="'.$ImgUrlDoc.'/xmail_011.gif" " title="MimeTypes permitidos " align="absmiddle" alt="MimeTypes permitidos" />
</pre>
  Este parametro afeta diretamente os envios de arquivos anexados em suas mensagens.
  Somente os arquivos que estiverem marcados neste local poder�o ser submetidos via uploads.
  Caso voce queira usar outros tipos de arquivos sem passar por estas permiss�es, utilize links externos
  com os arquivos j� em local remoto e utilize um link padr�o da web para este anexo.
  Este parametro somente afeta o upload de arquivos e n�o o acesso para os arquivos quando j� foram enviados
  anteriormente. Muito cuidado para n�o liberar extens�es perigosas e que permitam acesso a scripts
  n�o autorizados. Se liberar este tipo de arquivo, utilize por sua conta e risco.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_012.gif" " title="Tamanho m�ximo para Uploads de arquivos " align="absmiddle" alt="Tamanho m�ximo de arquivos " />
  Para que voc� tenha um controle total sobre os arquivos que ser�o enviados para o seu site, este setor
  foi criado. Voc� poder� definir um tamanho dem bytes para isto, mas n�o poder� ultrapassar ao padr�o
  que foi definido em seu php.ini. Se voc� n�o tem acesso a esta informa��o em seu servidor,
  s� poder� utilizar o tamanho que j� est� previamente definido em seu arquivo de configura��es php.ini,
  mas poder� definir tamanhos menores se desejar.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_013.gif" " title="Permiss�es para Uploads " align="absmiddle" alt="Permiss�es para uploads " />
  Ajuste as permiss�es se o seu servidor for linux para que os arquivos possam ser enviados para o seu site.
  Para maiores detalhes sobre as permiss�es de arquivos, n�o deixe de visitar o setor: <b>link de permiss�es vai aqui xxxxxxxxxxx</b>
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_014.gif" " title="Formato de exibi��o de datas " align="absmiddle" alt="Formato de exibi��o de datas " />
 Para maiores detalhes sobre o que deve ser colocado aqui para o seu idioma, veja este link para maiores detalhes: <a href="http://br.php.net/manual/pt_BR/function.date.php">Aqui </a>
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_015.gif" " title="Verificar o perfil de usu�rio se aceita receber e-mails " align="absmiddle" alt="Verifica perfil de usu�rio " />
Se optar por n�o e o usu�rio n�o desejar receber emails, ser� enviado p/ private message.<br>
Se optar por sim e o usu�rio n�o deseja receber emails e foi solicitado somente envio de emails ,nada ser� enviado.<br>
Por�m ser� gerado mensagem de aviso que o perfil dele n�o aceita receber emails e continuar� pendente no lote.<br>
Desta forma voc� ficar� sabendo que ele n�o recebeu, devido o seu perfil e poder� excluir do lote, ap�s tomar conhecimento.
 
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_016.gif" " title="Permite editor Visual " align="absmiddle" alt="Permite Editor Visual " />
  Voc� poder� optar pelo trabalho com editores visuais escolhendo a op��o SIM. Caso voc� fa�a isto, ser� obrigat�rio
  a defini��o de um editor visual como default obrigat�riamente. Enquanto n�o fizer isto, seus parametros n�o ser�o
  gravados corretamente em sua confirma��o.
<br>
<br>
<pre class="terminal-mini">
<img src="'.$ImgUrlDoc.'/xmail_017.gif" " title=" " align="absmiddle" alt=" " />
</pre>
 <font color="#FF0000">Voc� poder� escolher entre 5 editores visuais de sua preferencia. As op��es de texto plano e DHTML tamb�m est�o
 presentes. Neste momento as op��es de editores funcionam corretamente para o TinyEditor, mas estamos trabalhando
 para o funcionamento dos outros editores tamb�m. At� o release final deste m�dulo deveremos ter as outras
 op��es de editores funcionando novamente.</font><br>
 De qualquer forma, neste momento temos o tinyeditor e o editor padr�o DHTML do xoops funcionando.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_018.gif" " title="Permitir utiliza��o de perfis para Newsletter " align="absmiddle" alt=" " />
 Marcando esta op��o com sim ir� permitir a utiliza��o de diversos perfis de newsletter. Este perfis ser�o detalhados em
 outra etapa deste manual, mas como uma preliminar serviria para voc� sub-dividir em pseudo-categorias de conte�do, ex:<br>
 - Xoops<br>
 - Modulos<br>
 - Temas<br>
 - An�ncios de novas vers�es<br>
 - Seguran�a<br>
 Estes perfis n�o tem nada haver com os grupos do xoops ou categorias de conte�do seja do news ou outro setor do site.
 Ele foi concebido para utiliza��o da newsletter especialmente.<br>
 Se voc� deixar esta op��o com N�O, todos os usu�rios cadastrados nas tabelas de newsletter ir�o receber todos
 materiais gerados pelo site sem distin��o <font color="#FF0000">(N�o recomendado)</font>.
 
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_019.gif" " title="Hora de intervalo entre os envios " align="absmiddle" alt="Hora de intervalo " />
 Se houver a necessidade de controle para hor�rios e quantidade de envios de e-mails em teu site, voc� ir� desejar
 configurar esta �rea para que o sistema Xmail controle os intervalos em horas para o envio de suas mensagens ou materiais.
 Um exemplo seria a configura��o de 4 em 4 horas para os envios. Em caso de d�vida para este item, favor incluir
 as suas d�vidas no site de suporte a este m�dulo.
<br>
<br>
<hr />
<br>
<i><b><font color="#FF0000" size="5">Aprovar Mensagens</font></b></i>
<br>
<br>
 Neste setor voc� ir� visualiar todas as mensagens que ainda n�o foram aprovadas para envio.
 Caso exista alguma mensagem pendente voc� ser� direcionado a �rea de usu�rio e poder� tomar algumas atitudes
 para a aprova��o. Vamos e estas op��es.<br>
<pre class="terminal">
<img src="'.$ImgUrlDoc.'/xmail_020.gif" " title="Aprovando mensagens " align="absmiddle" alt="Aprovando mensagens " />
</pre>
<br>
Voce poder� escolher por Aprovar, Alterar ou excluir este novo envio.
<pre class="terminal">
<img src="'.$ImgUrlDoc.'/xmail_021.gif" " title="Alterando Mensagem " align="absmiddle" alt="Alterando mensagens " />
</pre>
<br>

</div>


';
?>
