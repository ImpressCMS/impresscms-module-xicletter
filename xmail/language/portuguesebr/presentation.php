<?php
include 'style.php';
//echo '
?>
<div id="body">
<h1>Apresenta��o</h1>
<h2><font color="#FF0000">O que � o Xmail ?</font></h2>
<ol>
<h3> Este m�dulo foi originalmente criado para ser o canal de comunica��o entre o Site e seus usu�rios.
Tamb�m � para orgulho de nossa na��o o primeiro m�dulo genuinamente brasileiro apelidado como "<i><font color="#FF0000">The Big One</font></i>"
</ol>
<hr />
<h2><font color="#FF0000">O que H� de Novo ?</font></h2>
<ol>
<h4>
<ul>
<li><b>Controle de Lotes de envio Aprimorado</b></li>
<li><b>Habilidade para utilizar Cron para disparar e-mails e Newsletter</b>
<li><b>Multiplos gerenciadores de Envio de e-mails</b>
<li><b>Controla perfis de Newsletter</b>
<li><b>Trabalha com muita facilidade em editores Visuais</b>
<li><b>Importa cadastros de E-mails para Newsletter (Formato CSV)</b>
<li><b>Exporta cadastros de E-mails para (Formato CSV)</b>
<li><b>Agendamento de Envios customizado</b>
<li><b>Administra o m�ximo de Envio por Hora do Servidor</b>
</ul>
</ol>

<hr />
<h2><font color="#FF0000">Hist�rico de Vers�es Anteriores</font></h2>
<ol>
<h5>

- Xmail � um m�dulo 100% otimizado e baseado nos c�digos do kernel xoops.<br>
- Utiliza smarty.<br>
- S� pode ser utilizado em vers�es superiores ou iguais a 2.0.13.2 do kernel xoops.<br>
- Muito cuidado aos webmaster ao liberar este m�dulo para determinados grupos.<br>
<br>
</h5>

<br><b>Objetivo deste m�dulo.</b><br>

<br>
- Permite cadastrar mensagens para envio posterior, guardando-as em banco de
dados.<br>
Aceita html, smiles, fotos e c�digos especiais como :<br>
<br>
{X_UID} retornar� o ID do membro<br>
{X_UNAME} retornar� o nome do membro<br>
{X_UEMAIL} retornar� o email do membro<br>
<br>
- Enviar emails , Mensagem Particular ou o que estiver selecionado no perfil do
usu�rio.<br>
, selecionando alguns crit�rios como :<br>
Um �nico usu�rio, ou v�rios usu�rios selecionados,<br>
Um �nico grupo ou v�rios grupos selecionados,<br>
O �ltimo login foi ap�s (Formato yyyy-mm-dd, opcional),<br>
O �ltimo login foi antes de (Formato yyyy-mm-dd, opcional) ,<br>
O �ltimo login foi a mais de X dias atr�s (opcional),<br>
O �ltimo login foi a menos de X dias atr�s (opcional),<br>
Enviar mensagem apenas para membros que aceitam notifica��es por email
(opcional)<br>
Enviar mensagens apenas para membros inativos (opcional)<br>
Se este item estiver selecionado todas as mensagens, (incluindo as particulares)
ser�o ignoradas<br>
Data de registro � ap�s (Formato yyyy-mm-dd, opcional),<br>
Data de registro � antes de (Formato yyyy-mm-dd, opcional)<br>
<br>
<br>
- Registra um log das mensagens enviadas, guardando quem recebeu e quando.<br>
<br>
Isto ser� muito importante para que voc� possa acompanhar quem recebeu os
avisos.<br>
<br>
- Permite visualizar o log integral ou selecionando-se a mensagem e grupos de
usu�rios.<br>
<br>
O supervisor do m�dulo poder� ver log completo.<br>
<br>
O usu�rio do m�dulo poder� ver as mensagens que ele cadastrou e recebeu.<br>
<br>
<br>
- <font color="#FF0000"><i><b>IMPORTANTE:</b></i></font> <br>
<br>
Este m�dulo respeita o perfil do usu�rio quanto a op��o de receber
ou n�o notifica��es
por email. Se o usu�rio selecionou que n�o deseja receber email, ele n�o
receber�.
Se nos par�metros deste m�dulo estiver selecionado para n�o verificar esta op��o
a mensagem
ser� encaminha para Caixa de Entrada do usu�rio como Mensagem Particular, no
caso de se
tentar enviar um email para ele.
Desta forma n�o se violar� as regras de SPAM.<br>
<br>
<br>
<i><b>O que um usu�rio comum pode fazer ??<br>
</b></i>
<br>
Pode cadastrar mensagem para ser aprovada. ( O webmaster receber� email para
aprova-la).
Mas se o m�dulo estiver configurado para aprovar automaticamente, n�o ser�
necess�rio
aprova��o pelo Webmaster ou Supervisor.<br>
<br>
Pode enviar mensagens ap�s aprovadas.<br>
<br>
Ver log de envio.<br>
<br>
Alterar (quando n�o enviada e n�o aprovada ) e excluir somente mensagens
cadastradas por ele.<br>
<br>
<b><i>O que pode fazer o administrador ?<br>
</i></b><br>
Obviamente tudo que o usu�rio faz .<br>
Cadastrar mensagens, as quais ja entram aprovadas.<br>
Administrar mensagens: Alterar ( se ainda n�o foi enviada )<br>
Excluir ( se ja foi enviada, ir� verificar par�metros ref. Excluir mensagem,
ap�s x dias que fora enviada )<br>
Aprovar ( O usu�rio que cadastrou , receber� email informando que ja foi
aprovada)<br>
Desaprovar ( Ficar� desativada, n�o permitindo que seja enviada)<br>
<br>
Em administra��o - Alterar par�metros .<br>
<br>
A princ�pio s�o 12 par�metros:<br>
<br>
Excluir mensagem, ap�s x dias que fora enviada :<br>
<br>
(Quando em administra��o de mensagens, tentar excluir alguma mensagem, se a
mesma foi enviada a
menos de x dias o sistema n�o permitir� exclui-la. )<br>
<br>
<b><i>Enviar mensagem de quantas em quantas ?<br>
</i></b>
<br>
(Para evitar sobrecarga no servidor , poder� ser definido quantas mensagens
enviar de uma so vez.<br>
<br>
Exemplo: <br>
<br>
Se optou por 50, voc� escolhe grupos que totalizam 200 usu�rios.<br>
<br>
Ap�s enviar 50, ser� apresentado um form para que voc� autorize continuar. )<br>
<br>
<br>
<i><b>Ordem para exibir mensagens cadastradas:<br>
</b></i><br>
Alfab�tica do t�tulo<br>
C�digo<br>
Data de envio decrescente<br>
Data de envio crescente<br>
<br>
<br>
<b>Limite por p�gina:<br>
</b><br>
Informar quantas mensagens deseja exitir por p�gina em Administrar mensagens
e Log de envio.<br>
<br>
Aprovar automaticamente :<br>
<br>
Informar Sim ou N�o indicando se deseja que as mensagens sejam aprovadas
automaticamente ou n�o.<br>
Cuidado !! verifique a real necessidade de liberar esta op��o.<br>
<br>
<br>
Diret�rio para upload de arquivos anexos<br>
<br>
Default :<?php echo XOOPS_ROOT_PATH ?>/uploads/xmail/<br>
<br>
Dentro deste diret�rio, ser� criado um para cada usu�rio guardar os arquivos que
v�o
anexos nas mensagens. O nome do subdiret�rio ser� o mesmo do login.<br>
<br>
Tipo de arquivos permitidos para upload de anexos das mensagens.<br>
<br>
Tamanho m�ximo do arquivo para upload em bytes.<br>
<br>
Formato de aprensenta��o de datas, baseado na fun��o date do php.<br>
<br>
Para exibir data do cadastramento e data do �ltimo envio.<br>
<br>
Indicar se permitir� inserir arquivos anexos ou n�o.<br>
<br>
Definir permiss�o para o diret�rio de upload, n�o sendo necess�rio em Sistemas
Windows.<br>
Default: 0774<br>
<br>
Indicar se o sistema checar� as prefer�ncias no perfil do usu�rio de n�o receber
email.<br>
Se informar sim e o usu�rio n�o deseja receber email, nehuma mensagem ser�
enviada.<br>
Se informa n�o e o usu�rio n�o deseja receber email, ser� enviado para mensagem
particular.<br>
<br>
<br>
<b><i>Como funciona arquivos anexos ?<br>
</i></b><br>
Somente ser� aceito, se definido em par�metros para aceita-los.<br>
<br>
O processo de anexar arquivos � feito em &quot;alterar&quot; , onde haver� um formular�o
para
fazer upload do arquivo.<br>
Ap�s upload o arquivo ja ficar� vinculado com a mensagem, podendo ser exclu�do ,
se desejar.<br>
Ser� exibido ao usu�rio uma lista de outros arquivos que ja tenham sido enviado
(por upload) atrav�s de<br>
outras mensagens, podendo simplesmente anexa-los na mensagem que esta sendo
alterada.<br>
Tudo isso so pode ser feito se a mensagem ainda n�o foi enviada e antes da
aprova��o .<br>
<br>
<i><b>Onde ficam os arquivos anexos ?<br>
</b></i><br>
Fisicamente ficam dentro do diret�rio definido em par�metros , onde � criado<br>
subdiret�rios para cada usu�rio. O nome do subdiret�rio � o login do usu�rio.<br>
O arquivo � exclu�do quando exclui-se a mensagem se ele n�o estiver vinculado a
outra mensagem.<br>
<br>
<br>
<b><i>O que fazer ap�s instala��o ?<br>
</i></b>
<br>
Entrar em administra��o para definir os par�metros.<br>
<br>
<br>
<i><b>Qual a vers�o do xoops que deve ser usada ?<br>
</b></i>
<br>
O xoops deve ser vers�o 2.05 ou superior.<br>
Cuidado se voc� possuir um release da vers�o 2.0.5 instavel veja abaixo.<br>
V� at� a linha 342 do arquivo &lt;path_do_xoops&gt;/class/criteria.php<br>
Se encontrar a linha abaixo desta forma:<br>
<br>
if ( is_numeric($this-&gt;value) ) { // || strtoupper($this-&gt;operator) == "IN") ???<br>
<br>
Altere a linha para esta:<br>
<br>
if ( is_numeric($this-&gt;value) || strtoupper($this-&gt;operator) == "IN") {<br>
<br>
<br>
<b><i>O que esse bug faz se existir ?<br>
</i></b><br>
Na op��o de envio de mensagens , quando seleciona-se um ou mais grupos, sempre
retornar� a mensagem<br>
que n�o foi selecionado usu�rio.<br>
<br>
<br>
<br>
<font color="#FF0000"><i><b>Para quem estiver atualizando a vers�o ...<br>
</b></i></font>
<br>
Acretito que todos devem saber, mas � bom lembrar para al�m de copiar os
arquivos para<br>
diret�rio xmail, entrar em administra��o de m�dulos e solicitar para atualizar.<br>
Pois houve altera��es em templates e s� ser�o vistas se fizer isso.<br>
<br>
Como foi eliminado alguns arquivos desnecess�rios, antes de atualizar seria
melhor<br>
apagar o anterior.<br>
<br>
<b><i><font color="#FF0000">IMPORTANTE:<br>
</font></i></b>
<br>
Para atualizar vers�o al�m dos procedimentos acima, deve-se executar o script<br>
&lt;xoops_url&gt;/modules/xmail/upgrade1.0X_to_1.0Y.php para fazer altera��es no banco
de dados.<br>
Obs. X refere-se a vers�o atual<br>
Y refere-se a nova vers�o<br>
Exemplo: upgrade1.08_to_1.09.php<br>
<br>
<br>
A partir da vers�o 1.10, para atualizar o m�dulo , ap�s executar os
procedimentos<br>
normais do xoops, deve-se executar o script &lt;xoops_url&gt;/modules/xmail/upgrade.php,<br>
no qual foi implementado um esquema de atualiza��o do banco de dados
utilizando-se<br>
xml .<br>
<br>
<br>
A equipe Xoopers gostaria de saber sobre suas impress�es.<br>
N�o deixe de visitar o nosso site em: http://www.xoopstotal.com.br<br>
<br>
<br>
//---------Implementa��es para vers�o 2.0<br>
<br>
Procedimentos para atualizar a vers�o 1.10 para 2.0 :<br>
<br>
-Copiar os arquivos para a pasta xmail<br>
- Atualizar o m�dulo na Administra��o.<br>
- Importante: executar o script
<a href="http://seusite/xoops/modules/xmail/upgrade1.10_to_2.0.php">http://seusite/xoops/modules/xmail/upgrade1.10_to_2.0.php</a>
para atualizar as tabelas.<br>
Verificar se a pasta de uploads tem permiss�o de escrita (chmod 774).<br>
<br>
Veja abaixo as Implementa��es.<br>
<br>
<br>
<i><b>- Bloco para solicitar ativa��o de conta.<br>
</b></i><br>
(Para usu�rios que se cadastraram e n�o receberam o email para ativar a conta.<br>
Ser� registrado em log, cada solicita��o de ativa��o, onde o administrador
poder�
acompanhar.)<br>
<br>
<b><i>- Bloco para assinar ou cancelar newsletter.<br>
</i></b><br>
(Aqui n�o � necess�rio estar cadastrado no site, basta informar o email e se
desejar,
o perfil. Por�m o perfil so ser� exibido se foi solicitado nos par�metros.)<br>
<br>
O assinante receber� um email para confirmar a assinatura, evitando o cadastro
de emails
incorretos e garantindo a veracidade da solicita��o. )<br>
<br>
<br>
<i><b>Novas op��es no menu principal:<br>
</b></i>
<br>
<b><i>- Lotes Pendentes<br>
</i></b><br>
Excluir Lotes Pendentes ou Disparar a continua��o do envio.<br>
(Quando disparar envio de emails ou newsletter, que por algum motivo n�o for
conclu�do, ser�o criados lotes de controle para permitir continuar o processo.<br>
O administrador poder� visualizar todos os lotes pendentes de qualquer usu�rio.<br>
O usu�rio poder� visualizar somente os lotes por ele disparado.)<br>
<br>
<i><b>- Enviar Newsletter<br>
</b></i><br>
Enviar Newsletter para lista de assinantes .<br>
(Se foi selecionado nos par�metros, para usar esquemas de perfis, ser� exibido
a lista de perfis cadastrados, para enviar a newsletter seletivamente.<br>
Pode-se enviar para todos os usu�rios ou escolher v�rios perfis ou enviar
somente
para quem n�o selecionou perfil.)<br>
<br>
<b><i>- Log de Newsletter<br>
</i></b><br>
Consultar newsletter enviadas.<br>
<br>
<br>
Novas op��es em par�metros:<br>
<br>
<i><b>- Permite Editor Visual ? SIM ou N�O<br>
</b></i>
<br>
- Selecione Editor Visual, spaw ou fck ou htmlarea ou Koivi ou tynymce
se desejar<br>
As classes do editor devem
estar no Kernel do Xoops<br>
<br>
- Deseja usar esquema de perfis na newsletter ? SIM ou N�O<br>
<br>
--------------------<br>
<br>
Novas Op��es na �rea de administra��o:<br>
<br>
<b><i>- Ger�nciar Ativa��o<br>
</i></b><br>
( O administrador visualizar� as contas n�o ativadas e quantas vezes tentou
ativar.<br>
Poder� excluir a conta ou ativa-la.<br>
<br>
<i><b>- Ger�nciar Newsletter<br>
</b></i><br>
- Detalhes dos Assinantes<br>
(Exibe a lista dos assinantes, onde o administrador poder� excluir.)<br>
<br>
<b><i>- Otimizar BD<br>
</i></b>
<br>
- Importar Usu�rios para lista de assinantes<br>
(Importa usu�rios do xoops para o cadastro de assinantes de newsletter.)<br>
<br>
<b><i>- Ger�nciar Tabela de Perfis<br>
</i></b><br>
(Incluir ou excluir perfil, o qual o assinante poder� selecionar ao se
cadastrar.<br>
<br>
Exemplos :  </p>

<p>Sexo Masculino, Sexo Feminino, Idade de 12 a 20 anos, Idade de 21 a
29 anos,
Interesse em hardware, Interesse em php...<br>
<br>
A lista de perfis � individual de acordo com as caracter�sticas do site.<br>
<br>
---------------------------------------------------------------------------<br>
Para usar o editor visual, al�m de seleciona-lo na �rea de par�metros, �
necess�rio
baixar o pacote do (xoopseditor) e coloca-lo na pasta &lt;raiz_do_xoops&gt;/class/ <br>
<br>
Esta vers�o do xmail acompanha um pacote do xoopseditor.<br>
<br>
Copie a pasta xoopseditor para &lt;raiz_do_xoops&gt;/class/ .<br>
<br>
Editores encontrados no pacote : SPAW Editor - FCKeditor - HtmlArea Editor -
XK_Editor (koivi)<br>
Sendo que FCKeditor e XK_Editor (koivi) funcionam no browser Firefox.<br>
<br>
Para baixar a vers�o atual XoopsEditor Framework verifique no link abaixo.<br>
<br>
http://dev.xoops.org/modules/xfmod/project/showfiles.php?group_id=1155<br>
<br>
----------------------------------------------------------------------------<br>
Para melhorar a visualiza��o no momento de cadastrar uma mensagem aqui vai uma
sugest�o de frankblack de http://www.myxoops.org<br>
<br>
Copie o arquivo que esta na pasta raiz do ...xmail/themeformflat.php para .../&lt;raiz-xoops&gt;/class/xoopsform/themeformflat.php<br>
Abra o arquivo em ...&lt;raiz-xoops&gt;/class/xoopsformloader.php e inclua a linha no
final do arquivo :<br>
<br>
include_once XOOPS_ROOT_PATH.&quot;/class/xoopsform/themeformflat.php&quot;;<br>
<br>
Pronto - isso far� com que o formul�rio de cadastramento da mensagem, seja
exibido em tabela de uma coluna apenas.<br>
Mostrando o t�tulo em cima e o campo em baixo .<br>
----------------------------------------------------------------------------<br>

</ol>
<hr />

<br>
</h3>

</div>
