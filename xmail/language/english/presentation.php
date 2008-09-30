<?php
include 'style.php';
//echo '
?>
<div id="body">
<h1>Apresentação</h1>
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
<li><b>Trabalha com muita facilidade em editores Visuais</b>
<li><b>Importa cadastros de E-mails para Newsletter (Formato CSV)</b>
<li><b>Exporta cadastros de E-mails para (Formato CSV)</b>
<li><b>Agendamento de Envios customizado</b>
<li><b>Administra o máximo de Envio por Hora do Servidor</b>
</ul>
</ol>

<hr />
<h2><font color="#FF0000">Histórico de Versões Anteriores</font></h2>
<ol>
<h5>

- Xmail é um módulo 100% otimizado e baseado nos códigos do kernel xoops.<br>
- Utiliza smarty.<br>
- Só pode ser utilizado em versões superiores ou iguais a 2.0.13.2 do kernel xoops.<br>
- Muito cuidado aos webmaster ao liberar este módulo para determinados grupos.<br>
<br>
</h5>

<br><b>Objetivo deste módulo.</b><br>

<br>
- Permite cadastrar mensagens para envio posterior, guardando-as em banco de
dados.<br>
Aceita html, smiles, fotos e códigos especiais como :<br>
<br>
{X_UID} retornará o ID do membro<br>
{X_UNAME} retornará o nome do membro<br>
{X_UEMAIL} retornará o email do membro<br>
<br>
- Enviar emails , Mensagem Particular ou o que estiver selecionado no perfil do
usuário.<br>
, selecionando alguns critérios como :<br>
Um único usuário, ou vários usuários selecionados,<br>
Um único grupo ou vários grupos selecionados,<br>
O último login foi após (Formato yyyy-mm-dd, opcional),<br>
O último login foi antes de (Formato yyyy-mm-dd, opcional) ,<br>
O último login foi a mais de X dias atrás (opcional),<br>
O último login foi a menos de X dias atrás (opcional),<br>
Enviar mensagem apenas para membros que aceitam notificações por email
(opcional)<br>
Enviar mensagens apenas para membros inativos (opcional)<br>
Se este item estiver selecionado todas as mensagens, (incluindo as particulares)
serão ignoradas<br>
Data de registro é após (Formato yyyy-mm-dd, opcional),<br>
Data de registro é antes de (Formato yyyy-mm-dd, opcional)<br>
<br>
<br>
- Registra um log das mensagens enviadas, guardando quem recebeu e quando.<br>
<br>
Isto será muito importante para que você possa acompanhar quem recebeu os
avisos.<br>
<br>
- Permite visualizar o log integral ou selecionando-se a mensagem e grupos de
usuários.<br>
<br>
O supervisor do módulo poderá ver log completo.<br>
<br>
O usuário do módulo poderá ver as mensagens que ele cadastrou e recebeu.<br>
<br>
<br>
- <font color="#FF0000"><i><b>IMPORTANTE:</b></i></font> <br>
<br>
Este módulo respeita o perfil do usuário quanto a opção de receber
ou não notificações
por email. Se o usuário selecionou que não deseja receber email, ele não
receberá.
Se nos parâmetros deste módulo estiver selecionado para não verificar esta opção
a mensagem
será encaminha para Caixa de Entrada do usuário como Mensagem Particular, no
caso de se
tentar enviar um email para ele.
Desta forma não se violará as regras de SPAM.<br>
<br>
<br>
<i><b>O que um usuário comum pode fazer ??<br>
</b></i>
<br>
Pode cadastrar mensagem para ser aprovada. ( O webmaster receberá email para
aprova-la).
Mas se o módulo estiver configurado para aprovar automaticamente, não será
necessário
aprovação pelo Webmaster ou Supervisor.<br>
<br>
Pode enviar mensagens após aprovadas.<br>
<br>
Ver log de envio.<br>
<br>
Alterar (quando não enviada e não aprovada ) e excluir somente mensagens
cadastradas por ele.<br>
<br>
<b><i>O que pode fazer o administrador ?<br>
</i></b><br>
Obviamente tudo que o usuário faz .<br>
Cadastrar mensagens, as quais ja entram aprovadas.<br>
Administrar mensagens: Alterar ( se ainda não foi enviada )<br>
Excluir ( se ja foi enviada, irá verificar parâmetros ref. Excluir mensagem,
após x dias que fora enviada )<br>
Aprovar ( O usuário que cadastrou , receberá email informando que ja foi
aprovada)<br>
Desaprovar ( Ficará desativada, não permitindo que seja enviada)<br>
<br>
Em administração - Alterar parâmetros .<br>
<br>
A princípio são 12 parâmetros:<br>
<br>
Excluir mensagem, após x dias que fora enviada :<br>
<br>
(Quando em administração de mensagens, tentar excluir alguma mensagem, se a
mesma foi enviada a
menos de x dias o sistema não permitirá exclui-la. )<br>
<br>
<b><i>Enviar mensagem de quantas em quantas ?<br>
</i></b>
<br>
(Para evitar sobrecarga no servidor , poderá ser definido quantas mensagens
enviar de uma so vez.<br>
<br>
Exemplo: <br>
<br>
Se optou por 50, você escolhe grupos que totalizam 200 usuários.<br>
<br>
Após enviar 50, será apresentado um form para que você autorize continuar. )<br>
<br>
<br>
<i><b>Ordem para exibir mensagens cadastradas:<br>
</b></i><br>
Alfabética do título<br>
Código<br>
Data de envio decrescente<br>
Data de envio crescente<br>
<br>
<br>
<b>Limite por página:<br>
</b><br>
Informar quantas mensagens deseja exitir por página em Administrar mensagens
e Log de envio.<br>
<br>
Aprovar automaticamente :<br>
<br>
Informar Sim ou Não indicando se deseja que as mensagens sejam aprovadas
automaticamente ou não.<br>
Cuidado !! verifique a real necessidade de liberar esta opção.<br>
<br>
<br>
Diretório para upload de arquivos anexos<br>
<br>
Default :<?php echo XOOPS_ROOT_PATH ?>/uploads/xmail/<br>
<br>
Dentro deste diretório, será criado um para cada usuário guardar os arquivos que
vão
anexos nas mensagens. O nome do subdiretório será o mesmo do login.<br>
<br>
Tipo de arquivos permitidos para upload de anexos das mensagens.<br>
<br>
Tamanho máximo do arquivo para upload em bytes.<br>
<br>
Formato de aprensentação de datas, baseado na função date do php.<br>
<br>
Para exibir data do cadastramento e data do último envio.<br>
<br>
Indicar se permitirá inserir arquivos anexos ou não.<br>
<br>
Definir permissão para o diretório de upload, não sendo necessário em Sistemas
Windows.<br>
Default: 0774<br>
<br>
Indicar se o sistema checará as preferências no perfil do usuário de não receber
email.<br>
Se informar sim e o usuário não deseja receber email, nehuma mensagem será
enviada.<br>
Se informa não e o usuário não deseja receber email, será enviado para mensagem
particular.<br>
<br>
<br>
<b><i>Como funciona arquivos anexos ?<br>
</i></b><br>
Somente será aceito, se definido em parâmetros para aceita-los.<br>
<br>
O processo de anexar arquivos é feito em &quot;alterar&quot; , onde haverá um formularío
para
fazer upload do arquivo.<br>
Após upload o arquivo ja ficará vinculado com a mensagem, podendo ser excluído ,
se desejar.<br>
Será exibido ao usuário uma lista de outros arquivos que ja tenham sido enviado
(por upload) através de<br>
outras mensagens, podendo simplesmente anexa-los na mensagem que esta sendo
alterada.<br>
Tudo isso so pode ser feito se a mensagem ainda não foi enviada e antes da
aprovação .<br>
<br>
<i><b>Onde ficam os arquivos anexos ?<br>
</b></i><br>
Fisicamente ficam dentro do diretório definido em parâmetros , onde é criado<br>
subdiretórios para cada usuário. O nome do subdiretório é o login do usuário.<br>
O arquivo é excluído quando exclui-se a mensagem se ele não estiver vinculado a
outra mensagem.<br>
<br>
<br>
<b><i>O que fazer após instalação ?<br>
</i></b>
<br>
Entrar em administração para definir os parâmetros.<br>
<br>
<br>
<i><b>Qual a versão do xoops que deve ser usada ?<br>
</b></i>
<br>
O xoops deve ser versão 2.05 ou superior.<br>
Cuidado se você possuir um release da versão 2.0.5 instavel veja abaixo.<br>
Vá até a linha 342 do arquivo &lt;path_do_xoops&gt;/class/criteria.php<br>
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
Na opção de envio de mensagens , quando seleciona-se um ou mais grupos, sempre
retornará a mensagem<br>
que não foi selecionado usuário.<br>
<br>
<br>
<br>
<font color="#FF0000"><i><b>Para quem estiver atualizando a versão ...<br>
</b></i></font>
<br>
Acretito que todos devem saber, mas é bom lembrar para além de copiar os
arquivos para<br>
diretório xmail, entrar em administração de módulos e solicitar para atualizar.<br>
Pois houve alterações em templates e só serão vistas se fizer isso.<br>
<br>
Como foi eliminado alguns arquivos desnecessários, antes de atualizar seria
melhor<br>
apagar o anterior.<br>
<br>
<b><i><font color="#FF0000">IMPORTANTE:<br>
</font></i></b>
<br>
Para atualizar versão além dos procedimentos acima, deve-se executar o script<br>
&lt;xoops_url&gt;/modules/xmail/upgrade1.0X_to_1.0Y.php para fazer alterações no banco
de dados.<br>
Obs. X refere-se a versão atual<br>
Y refere-se a nova versão<br>
Exemplo: upgrade1.08_to_1.09.php<br>
<br>
<br>
A partir da versão 1.10, para atualizar o módulo , após executar os
procedimentos<br>
normais do xoops, deve-se executar o script &lt;xoops_url&gt;/modules/xmail/upgrade.php,<br>
no qual foi implementado um esquema de atualização do banco de dados
utilizando-se<br>
xml .<br>
<br>
<br>
A equipe Xoopers gostaria de saber sobre suas impressões.<br>
Não deixe de visitar o nosso site em: http://www.xoopstotal.com.br<br>
<br>
<br>
//---------Implementaçòes para versão 2.0<br>
<br>
Procedimentos para atualizar a versão 1.10 para 2.0 :<br>
<br>
-Copiar os arquivos para a pasta xmail<br>
- Atualizar o módulo na Administração.<br>
- Importante: executar o script
<a href="http://seusite/xoops/modules/xmail/upgrade1.10_to_2.0.php">http://seusite/xoops/modules/xmail/upgrade1.10_to_2.0.php</a>
para atualizar as tabelas.<br>
Verificar se a pasta de uploads tem permissão de escrita (chmod 774).<br>
<br>
Veja abaixo as Implementações.<br>
<br>
<br>
<i><b>- Bloco para solicitar ativação de conta.<br>
</b></i><br>
(Para usuários que se cadastraram e não receberam o email para ativar a conta.<br>
Será registrado em log, cada solicitação de ativação, onde o administrador
poderá
acompanhar.)<br>
<br>
<b><i>- Bloco para assinar ou cancelar newsletter.<br>
</i></b><br>
(Aqui não é necessário estar cadastrado no site, basta informar o email e se
desejar,
o perfil. Porém o perfil so será exibido se foi solicitado nos parâmetros.)<br>
<br>
O assinante receberá um email para confirmar a assinatura, evitando o cadastro
de emails
incorretos e garantindo a veracidade da solicitação. )<br>
<br>
<br>
<i><b>Novas opções no menu principal:<br>
</b></i>
<br>
<b><i>- Lotes Pendentes<br>
</i></b><br>
Excluir Lotes Pendentes ou Disparar a continuação do envio.<br>
(Quando disparar envio de emails ou newsletter, que por algum motivo não for
concluído, serão criados lotes de controle para permitir continuar o processo.<br>
O administrador poderá visualizar todos os lotes pendentes de qualquer usuário.<br>
O usuário poderá visualizar somente os lotes por ele disparado.)<br>
<br>
<i><b>- Enviar Newsletter<br>
</b></i><br>
Enviar Newsletter para lista de assinantes .<br>
(Se foi selecionado nos parâmetros, para usar esquemas de perfis, será exibido
a lista de perfis cadastrados, para enviar a newsletter seletivamente.<br>
Pode-se enviar para todos os usuários ou escolher vários perfis ou enviar
somente
para quem não selecionou perfil.)<br>
<br>
<b><i>- Log de Newsletter<br>
</i></b><br>
Consultar newsletter enviadas.<br>
<br>
<br>
Novas opções em parâmetros:<br>
<br>
<i><b>- Permite Editor Visual ? SIM ou NÃO<br>
</b></i>
<br>
- Selecione Editor Visual, spaw ou fck ou htmlarea ou Koivi ou tynymce
se desejar<br>
As classes do editor devem
estar no Kernel do Xoops<br>
<br>
- Deseja usar esquema de perfis na newsletter ? SIM ou NÃO<br>
<br>
--------------------<br>
<br>
Novas Opções na área de administração:<br>
<br>
<b><i>- Gerênciar Ativação<br>
</i></b><br>
( O administrador visualizará as contas não ativadas e quantas vezes tentou
ativar.<br>
Poderá excluir a conta ou ativa-la.<br>
<br>
<i><b>- Gerênciar Newsletter<br>
</b></i><br>
- Detalhes dos Assinantes<br>
(Exibe a lista dos assinantes, onde o administrador poderá excluir.)<br>
<br>
<b><i>- Otimizar BD<br>
</i></b>
<br>
- Importar Usuários para lista de assinantes<br>
(Importa usuários do xoops para o cadastro de assinantes de newsletter.)<br>
<br>
<b><i>- Gerênciar Tabela de Perfis<br>
</i></b><br>
(Incluir ou excluir perfil, o qual o assinante poderá selecionar ao se
cadastrar.<br>
<br>
Exemplos :  </p>

<p>Sexo Masculino, Sexo Feminino, Idade de 12 a 20 anos, Idade de 21 a
29 anos,
Interesse em hardware, Interesse em php...<br>
<br>
A lista de perfis é individual de acordo com as características do site.<br>
<br>
---------------------------------------------------------------------------<br>
Para usar o editor visual, além de seleciona-lo na área de parâmetros, é
necessário
baixar o pacote do (xoopseditor) e coloca-lo na pasta &lt;raiz_do_xoops&gt;/class/ <br>
<br>
Esta versão do xmail acompanha um pacote do xoopseditor.<br>
<br>
Copie a pasta xoopseditor para &lt;raiz_do_xoops&gt;/class/ .<br>
<br>
Editores encontrados no pacote : SPAW Editor - FCKeditor - HtmlArea Editor -
XK_Editor (koivi)<br>
Sendo que FCKeditor e XK_Editor (koivi) funcionam no browser Firefox.<br>
<br>
Para baixar a versão atual XoopsEditor Framework verifique no link abaixo.<br>
<br>
http://dev.xoops.org/modules/xfmod/project/showfiles.php?group_id=1155<br>
<br>
----------------------------------------------------------------------------<br>
Para melhorar a visualização no momento de cadastrar uma mensagem aqui vai uma
sugestão de frankblack de http://www.myxoops.org<br>
<br>
Copie o arquivo que esta na pasta raiz do ...xmail/themeformflat.php para .../&lt;raiz-xoops&gt;/class/xoopsform/themeformflat.php<br>
Abra o arquivo em ...&lt;raiz-xoops&gt;/class/xoopsformloader.php e inclua a linha no
final do arquivo :<br>
<br>
include_once XOOPS_ROOT_PATH.&quot;/class/xoopsform/themeformflat.php&quot;;<br>
<br>
Pronto - isso fará com que o formulário de cadastramento da mensagem, seja
exibido em tabela de uma coluna apenas.<br>
Mostrando o título em cima e o campo em baixo .<br>
----------------------------------------------------------------------------<br>

</ol>
<hr />

<br>
</h3>

</div>
