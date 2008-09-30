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
<h3> Neste setor você irá encontrar todos os manuais de orientação para uma correta utilização deste módulo.
</ol>
<hr />
<h2><font color="#FF0000">O que temos Aqui ?</font></h2>
<ol>
<h4>
<ul>
<li><b>Como agendar envio de mensagens e newsletter</b></li>
<li><b>Ajuda para uma correta utilização deste módulo</b>
<li><b>Sobre detalhes dos desenvolvedores e colaboradores</b>
<li><b>Histórico da versão atual e anteriores</b>
</ul>
</ol>
<hr />

<blockquote>
</blockquote>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
 <tr>
  <td>
    <img src="'.$ImgUrlDoc.'/xmail_001.gif" align="left" alt="Menu Xoops" />
    <p align="justify">Xmail é um sistema de integração entre o site e seus
    usuários. <br>
    <br>
    Permite anúncios para todos os usuários ou apenas para alguns grupos.<br>
    <br>
    Controla o envio em lotes e agora também o agendamento para diversos
    períodos. <br>
    <br>
    Você pode criar mensagens com arquivos em anexo, ótimo para fazer uma
    distribuição de sistemas e documentações em geral. Procura avaliar os
    usuários que ainda não esteja confirmado no sistema e cria reenvios de
    ativações. <br>
    <br>
    Agora contando com gerenciador de newsletter permite a utilização de
    editores visual e controle de perfis de usuários para a leitura de
    newsletter. <br>
    <br>
    No caso de newsletter, o usuário não precisa estar cadastrado no site para
    fazer uso da newsletter, pode simplesmente utilizar o bloco de assinatura
    para poder receber novas edições, resenhas, informativos e conteúdos que
    desejar criar. <br>
    <br>
    Neste simples manual você irá aprender a maioria das informações básicas
    para um correto funcionamento e operação deste módulo. </p>
  </td>
 </tr>
</table>

<hr />

<img src="'.$ImgUrlDoc.'/xmail_002.gif" width="750" height="344" alt="Menu Principal" />
<br>
<p align="justify">Neste setor você já irá encontrar algumas novidades como o menu em 3D e suas configurações.
   Também poderá acompanhar no desenrolar desta documentação e irá perceber que este menu possui sub-menus
   dependendo do local onde você estiver.</p>
<br>

<hr />

<i><b><font color="#FF0000" size="5">Apresentação</font></b></i><br>
<br>
Você pode ver as principais novidades encontradas nesta nova versão. Basicamente todas foram originadas
por sugestões dos usuários durante o último período. Esperamos que faça bom uso deste sistema e que
continue a dar suas sugestões para melhoria.
<br>
<hr />
<br>
<i><b><font color="#FF0000" size="5">Alterando Parametros</font></b></i>
<br>
<br>
Após a instalação deste módulo este é o <b>primeiro</b> setor obrigatório a ser configurado.
Se isto não for feito imediatamente após a instalação, muitos setores do módulo não irão funcionar
de acordo com o esperado.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_003.gif" " title="Excluir mensagens após X dias" align="absmiddle" alt="Excluir mensagens após X dias" />
 O padrão na instalação é de 100 dias. Você irá colocar a quantidade de dias para a exclusão desta
 mensagem após o seu envio. Desta forma o sistema não permitirá excluir mensagens cuja data do último envio for menor que X dias .<br>
 Este procedimento não é automático, serve apenas para evitar excluir mensagens por engano.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_004.gif" " title="Enviar mensagens com lotes de X em X" align="absmiddle" alt="Enviar mensagens em lotes" />
  Este número irá definir a quantidade de destinatários em cada lote.
  Usado em conjunto com a opção de dar pausar de segundos entre um lote e outro.<br>
  E também limitar um determinado número de lotes por hora, para Servidores com restrição 
  de envios por hora. 
  
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_005.gif" " title="Ordem para visualização das mensagens" align="absmiddle" alt="Ordem de visualização" />
  Escolha a ordem padrão que irá ser apresentada as mensagens enviadas ou a enviar.
  Clicando no select, você poderá optar por ordem alfabética da descrição da mensagem,
  Código da mensagem (bom para mostrar últimas e primeiras), Data de envio mais recente e Data de envio mais antigo.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_006.gif" " title="Limite de mensagens por página" align="absmiddle" alt="Limite de mensagens" />
  Define o número de mensagens a ser exibida em cada página , na gerência de mensagens ou no log de envios.

<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_007.gif" " title="Aprovar Mensagens Automaticamente" align="absmiddle" alt="Aprovar mensagens" />
  O nomal é usar este parametro como não. Se deixar como sim, todos que tenham acesso ao setor de cadastro do Xmail
  irão ter suas mensagens aprovadas automaticamente. Se você é o admin do site, suas mensagens serão aprovadas
  imediatamente e não dependerá deste parametro. Se quiser utilizar este setor com aprovação automática,
  considere a possibilidade da criação de um novo grupo especial para isto e inclua uma quantidade muito
  seletiva para usar este módulo. Muito cuidado com acesso a SPAMMERS se isto ficar liberado a todos os usuários
  registrados do site. Se deixar aprovação automática, use por sua conta e risco.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_008.gif" " title="Permite anexar arquivos" align="absmiddle" alt="Permitir anexar arquivos" />
  Isto é muito útil e está presente já a um bom tempo e foi pouco explorado ainda. Se você permitir o anexo em mensagens,
  poderá enviar seus documentos como arquivos anexados, ex:<br>
  -Manuais.<br>
  -Arquivos Excell.<br>
  -Arquivo powerpoint.<br>
  -Novos programas desenvolvidos.<br>
  Mesmo que você esteja apenas enviando mensagens particulares (PM) ele irá permitir estes anexos.
  Quando um arquivo é anexado ele cria um local no nome do usuário para armazer o arquivo após o upload e fica disponivel
  sempre neste endereço particular do usuário. Se souber usar este recurso com cuidado, poderá ter uma área especial de
  arquivos para os usuários que podem enviar conteúdos para o site.
  Estes arquivos em anexo não serão excluidos após a expiração das mensagens, para fazer isto você deverá entrar manualmente
  no diretório de uploads deste módulo e dentro da pasta com o nome do usuário e remover o arquivo fisicamente do diretório.
  Se ainda tiver dúvidas de como irá utilizar isto em suas mensagens, envie suas dúvidas para o nosso site de suporte ao módulo.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_009.gif" " title="Uploades de arquivos" align="absmiddle" alt="Uploads de arquivos" />
  O padrão para os arquivos de uploads para seus arquivos anexados em mensagens é normalmente <b>xoops/uploads/xmail</b> e
  deve possuir as permissões se linux 774 ou se for windows (permitir leitura e gravação).
  Agora voce poderá alterar para o diretório padrão de uploads do xoops e criar diretório especial para o seu
  trabalho conforme a figura abaixo:<br>
  <img src="'.$ImgUrlDoc.'/xmail_010.gif" " align="absmiddle" title="Diretório de Uploads para seus arqivos de mensagens" alt="Diretório de Uploads " />
  Desta forma em vez de enviar os arquivos de uploads para dentro do módulo Xmail, irá enviar para o diretório padronizado
  e ainda em um local especial somente para este módulo.
<br>
<br>
<pre class="terminal-mini">
<img src="'.$ImgUrlDoc.'/xmail_011.gif" " title="MimeTypes permitidos " align="absmiddle" alt="MimeTypes permitidos" />
</pre>
  Este parametro afeta diretamente os envios de arquivos anexados em suas mensagens.
  Somente os arquivos que estiverem marcados neste local poderão ser submetidos via uploads.
  Caso voce queira usar outros tipos de arquivos sem passar por estas permissões, utilize links externos
  com os arquivos já em local remoto e utilize um link padrão da web para este anexo.
  Este parametro somente afeta o upload de arquivos e não o acesso para os arquivos quando já foram enviados
  anteriormente. Muito cuidado para não liberar extensões perigosas e que permitam acesso a scripts
  não autorizados. Se liberar este tipo de arquivo, utilize por sua conta e risco.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_012.gif" " title="Tamanho máximo para Uploads de arquivos " align="absmiddle" alt="Tamanho máximo de arquivos " />
  Para que você tenha um controle total sobre os arquivos que serão enviados para o seu site, este setor
  foi criado. Você poderá definir um tamanho dem bytes para isto, mas não poderá ultrapassar ao padrão
  que foi definido em seu php.ini. Se você não tem acesso a esta informação em seu servidor,
  só poderá utilizar o tamanho que já está previamente definido em seu arquivo de configurações php.ini,
  mas poderá definir tamanhos menores se desejar.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_013.gif" " title="Permissões para Uploads " align="absmiddle" alt="Permissões para uploads " />
  Ajuste as permissões se o seu servidor for linux para que os arquivos possam ser enviados para o seu site.
  Para maiores detalhes sobre as permissões de arquivos, não deixe de visitar o setor: <b>link de permissões vai aqui xxxxxxxxxxx</b>
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_014.gif" " title="Formato de exibição de datas " align="absmiddle" alt="Formato de exibição de datas " />
 Para maiores detalhes sobre o que deve ser colocado aqui para o seu idioma, veja este link para maiores detalhes: <a href="http://br.php.net/manual/pt_BR/function.date.php">Aqui </a>
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_015.gif" " title="Verificar o perfil de usuário se aceita receber e-mails " align="absmiddle" alt="Verifica perfil de usuário " />
Se optar por não e o usuário não desejar receber emails, será enviado p/ private message.<br>
Se optar por sim e o usuário não deseja receber emails e foi solicitado somente envio de emails ,nada será enviado.<br>
Porém será gerado mensagem de aviso que o perfil dele não aceita receber emails e continuará pendente no lote.<br>
Desta forma você ficará sabendo que ele não recebeu, devido o seu perfil e poderá excluir do lote, após tomar conhecimento.
 
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_016.gif" " title="Permite editor Visual " align="absmiddle" alt="Permite Editor Visual " />
  Você poderá optar pelo trabalho com editores visuais escolhendo a opção SIM. Caso você faça isto, será obrigatório
  a definição de um editor visual como default obrigatóriamente. Enquanto não fizer isto, seus parametros não serão
  gravados corretamente em sua confirmação.
<br>
<br>
<pre class="terminal-mini">
<img src="'.$ImgUrlDoc.'/xmail_017.gif" " title=" " align="absmiddle" alt=" " />
</pre>
 <font color="#FF0000">Você poderá escolher entre 5 editores visuais de sua preferencia. As opções de texto plano e DHTML também estão
 presentes. Neste momento as opções de editores funcionam corretamente para o TinyEditor, mas estamos trabalhando
 para o funcionamento dos outros editores também. Até o release final deste módulo deveremos ter as outras
 opções de editores funcionando novamente.</font><br>
 De qualquer forma, neste momento temos o tinyeditor e o editor padrão DHTML do xoops funcionando.
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_018.gif" " title="Permitir utilização de perfis para Newsletter " align="absmiddle" alt=" " />
 Marcando esta opção com sim irá permitir a utilização de diversos perfis de newsletter. Este perfis serão detalhados em
 outra etapa deste manual, mas como uma preliminar serviria para você sub-dividir em pseudo-categorias de conteúdo, ex:<br>
 - Xoops<br>
 - Modulos<br>
 - Temas<br>
 - Anúncios de novas versões<br>
 - Segurança<br>
 Estes perfis não tem nada haver com os grupos do xoops ou categorias de conteúdo seja do news ou outro setor do site.
 Ele foi concebido para utilização da newsletter especialmente.<br>
 Se você deixar esta opção com NÃO, todos os usuários cadastrados nas tabelas de newsletter irão receber todos
 materiais gerados pelo site sem distinção <font color="#FF0000">(Não recomendado)</font>.
 
<br>
<br>
<img src="'.$ImgUrlDoc.'/xmail_019.gif" " title="Hora de intervalo entre os envios " align="absmiddle" alt="Hora de intervalo " />
 Se houver a necessidade de controle para horários e quantidade de envios de e-mails em teu site, você irá desejar
 configurar esta área para que o sistema Xmail controle os intervalos em horas para o envio de suas mensagens ou materiais.
 Um exemplo seria a configuração de 4 em 4 horas para os envios. Em caso de dúvida para este item, favor incluir
 as suas dúvidas no site de suporte a este módulo.
<br>
<br>
<hr />
<br>
<i><b><font color="#FF0000" size="5">Aprovar Mensagens</font></b></i>
<br>
<br>
 Neste setor você irá visualiar todas as mensagens que ainda não foram aprovadas para envio.
 Caso exista alguma mensagem pendente você será direcionado a área de usuário e poderá tomar algumas atitudes
 para a aprovação. Vamos e estas opções.<br>
<pre class="terminal">
<img src="'.$ImgUrlDoc.'/xmail_020.gif" " title="Aprovando mensagens " align="absmiddle" alt="Aprovando mensagens " />
</pre>
<br>
Voce poderá escolher por Aprovar, Alterar ou excluir este novo envio.
<pre class="terminal">
<img src="'.$ImgUrlDoc.'/xmail_021.gif" " title="Alterando Mensagem " align="absmiddle" alt="Alterando mensagens " />
</pre>
<br>

</div>


';
?>
