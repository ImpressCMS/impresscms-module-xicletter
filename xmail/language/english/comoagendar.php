<style type="text/css">
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
        font-size: 12pt;
		line-height: 110%;
}

h4 {
        font-family: luxi sans,sans-serif;
        font-size: 10pt;
		line-height: 100%;
}

h5 {
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
<a name="Topo"></a>
<h1>Como Agendar</h1>
<hr />
<h2><font color="#FF0000">S�mario das Etapas</font></h2>
<ol>
<h3>
<ul>
<li><b><a href="#a)">Selecionar mensagem e definir destinat�rios</a></b></li>
<li><b><a href="#b)">Enviar a mensagem agendada manualmente.</a></b>
<li><b><a href="#c)">Enviar a mensagem agendada automaticamente.</a></b>
<h4>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="#d)">Usando protocolo  http -(Com ajax p/ n�o ocorrer timeout)</a></b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="#e)">Usando diretamente o PHP ( N�o ocorrer� timeout - indicado para grandes quantidades)</a></b></p>
</h4>
<li><b><a href="#f)">Observa��es Importantes:</b></li>
<li><b><a href="#g)">Para Servidores que limitam o envio de emails por Hora:</a></b>
<li><b><a href="#h)">Para definir um intervalo de envio de emails e n�o sobrecarregr a fila do Servidor de email </a></b>
</ul>
</ol>

<hr />

<h3>Procedimentos para agendar envio de mensagens</h3>
<ol>
<b>Objetivos: </b> O agendamento � interessante, para n�o sobrecarregar o servidor em hor�rios de picos e tamb�m por dispensar a
opera��o do usu�rio de executar lote por lote .<br>
Os erros ocorridos durante este processamento poder� ver ser visto na �rea administrativa do m�dulo, em 'Log de Erros' .<br>
�til tamb�m para Servidores que limitam a quantidade de envio de emails por hora.

<br>
<h4>- <a name="a)">Selecionar mensagem e definir destinat�rios</a></h4>

Primeiro , v� na op��o do Menu Principal - <b> Enviar E-mail ou Mensagens </b> e informe os dados normalmente,
mas no final do formul�rio informe a data e hora para agendamento.<br>
Se n�o informar data, ser� usada a default, a qual ser� a data e hora atual. <br>
Neste caso o sistema ir� informar os n�meros de lotes gerados e exibir link para "Gerenciamento de Lotes" , onde dever� ser acionado o envio dos lotes.<br>

<p align="right"><i><b><a href="#Topo"><font color="#FF0000">Go Top</font></a><font color="#FF0000"></font></font></b></i></p>


<h4>- <a name="b)">Enviar a mensagem agendada manualmente.</a> </h4>

Mas se voc� optou por agendar, as informa��es estar�o guardadas no lote , sendo que poder� ser disparado o envio manualmente,
atrav�z da op��o do Menu Principal - <b> Lotes Pendentes </b> <br>
<br><font color="#FF0000">
Ou voc� pode acionar o script que ficar� em constante execu��o, enquanto a janela estiver aberta.
Para aciona-lo, va na �rea administrativa do m�dulo xmail e clique na aba "Ativar Agendamento".<br>
Ser� aberta outra janela , na qual ficar� verificando periodicamente se ha lotes para serem enviados, usando tecnologia AJAX para n�o ocorrer timeout na p�gina.<br>
Por�m, se for usar a op��o  de enviar X lotes por hora, n�o use esta op��o, utilize o agendamento no Servidor, conforme explicado <a href="#e)">Aqui </a>

</font>

<p align="right"><i><b><a href="#Topo"><font color="#FF0000">Go Top</font></a><font color="#FF0000"></font></font></b></i></p>

<h4>- <a name="c)">Enviar a mensagem agendada  automaticamente.</a></h4>

Para enviar automaticamente, voc� precisar� agendar a execu��o do script (send_agenda.php) no Agendador de Tarefas de uma maquina Windows  ou
no Crontab  do Linux.<br><br>

<p align="right"><i><b><a href="#Topo"><font color="#FF0000">Go Top</font></a><font color="#FF0000"></font></font></b></i></p>

<h4> <a name="d)">Usando protocolo  http - (com ajax para n�o ocorrer timeout)  </a></h4>

<b>Esta��o Windows: </b><br>
Para facilitar , crie um pasta de trabalho, por exemplo:  c:\xmail-agenda<br>
<br>
Usando um editor de texto como por exemplo o Bloco de notas , crie um arquivo chamado xmail-automatico.bat dentro da pasta criada.
Conte�do do xmail-automatico.bat :<br>
C:<br>
cd \xmail-agenda <br>
xmail-automatico.url <br>
<br>
Vamos criar o arquivo  chamado  xmail-automatico.url :<br>
Na �rea de trabalho, clique com o bot�o direito do mouse - novo - atalho<br>
Na linha de comando informe:  http://www.seusitexoops.com.br/modules/xmail/include/send_agenda_ajax.php  .<br>
Clique em Avan�ar e no nome do atalho informe  xmail-automatico  .<br>
Neste momento  foi criado o arquivo xmail-automatico.url<br>
<br>
Copie o arquivo xmail-automatico da �rea de trabalho  para a pasta c:\xmail-agenda <br>
<br>
Agora v� no Painel de controle , procure o �cone Tarefas Agendadas - Adicionar Tarefa Agendada<br>
Localize o arquivo  xmail-automatico.bat  e  defina os hor�rios que desejar.<br>
<br><br>

<b>Para Linux: </b><br>
<br>
- Para quem usa cpanel : <br>
Entre no cpanel 'agendar tarefas' escolha hora dia etc. <br>
<br>
- Para quem tem acesso administrativo ao Servidor, utilize o crontab.<br>
<br>
Em ambos os casos use o comando para executar: <br>
GET  http://seudominio/modules/xmail/include/send_agenda_ajax.php  > /dev/null<br>
<br>
<i>Aten��o :  Respeite as letras mai�sculas e min�sculas do comando acima .</i><br>

<p align="right"><i><b><a href="#Topo"><font color="#FF0000">Go Top</font></a><font color="#FF0000"></font></font></b></i></p>

<h4>  <a name="e)">Usando diretamente o PHP ( N�o ocorrer� timeout - indicado para grandes quantidades) </a></h4>

<b> Servidor Windows </b><br>
Verifique o path  guardado na constante  <b>XOOPS_ROOT_PATH</b>, no  arquivo <b>mainfile.php</b>  e coloque o seu conte�do no comando abaixo<br>
Utilize o agendador de tarefas no  Servidor para executar o script send_agenda.bat , no comando:
XOOPS_ROOT_PATH/modules/xmail/send_agenda.bat <br>
Certifique-se que o comando php  � entendido pelo Servidor , caso contr�rio voc� poder� editar o arquivo
send_agenda.bat e colocar o path completo para o php.exe ser encontrado.<br><br>

<b> Servidor Linux  </b><br>
Verifique o path  guardado na constante  <b>XOOPS_ROOT_PATH</b>, no  arquivo <b>mainfile.php</b>  e coloque o seu conte�do no comando abaixo<br>
Utilize o crontab para executar o script send_agenda.sh  , no comando:<br>
XOOPS_ROOT_PATH/modules/xmail/send_agenda.sh

<p align="right"><i><b><a href="#Topo"><font color="#FF0000">Go Top</font></a><font color="#FF0000"></font></font></b></i></p>

<h4>- <a name="f)">Observa��es Importantes: </a></h4>

O script send_agenda.php  ir�  localizar todos os lotes pendentes cuja data e hora para envio sejam menores do que
data e hora atual.<br>
<br>
Portanto o hor�rio  que realmente ser� executado � o que foi definido no seu gerenciador de tarefas .<br>
<br>
Quando houver um erro e a mensagem n�o for enviada, ela continuar� pendente no lote e tentar� ser enviada na pr�xima execu��o.<br> 
Por�m sua data de agendamento, � atualizada para mais 1 dia, para dar tempo ao administrador verificar.<br>
Dessa forma, n�o ficar�  tentando reenviar,  caso haja execu��es frequentes no dia. <br>
Se desejar, poder� excluir o lote manualmente, no  Menu Principal - <b> Lotes Pendentes</b><br>
<br>
Um tipo de erro comum � :  <i>Perfil de usuarioX  n�o aceita receber email. </i><br>
<br>
Se ocorrer este tipo de erro, o lote fica pendente para que voc� possa intervir e ficar sabendo o ocorrido, permitindo tomar provid�ncias.<br>

<h4>- <a name="g)">Para Servidores que limitam o envio de emails por Hora: </a></h4>
Neste caso defina o �tem dos par�metros: <b><i>Quantos lotes enviar em uma hora </b></i> com a quantidade permitida dividida pela quantidade de emails em cada lote.<br>



<h4>- <a name="h)">Para definir um intervalo de envio de emails e n�o sobrecarregr a fila do Servidor de email </a></h4>
Neste caso defina o �tem dos par�metros: <b><i>(Minutos de intervalo entre o envio de lotes )</b></i> com o valor em minutos que deseja aguardar entre o envio de lotes .<br>
Ent�o, ser� enviado um lote a cada X minutos , verificando tamb�m  a quantidade limite  por hora. <br>
<b>Exemplo:</b>  Se no seu servidor so pode enviar  300 emails  por hora, fa�a o seguinte:<br>
<i>Enviar mensagem de quantas em quantas ? </i> : <b>50</b> <br>
<i>Quantos lotes enviar em uma hora </i> : <b>6 </b>   <br>
<i>Minutos de intervalo entre o envio de lotes.</i>  :<b>5</b>  <br>
<br>
Dessa forma ser� enviado 1 lote de 50 emails  a cada  5 minutos , sendo que em uma hora enviar� apenas  6 lotes.

</ol>
<hr />

<p align="right"><i><b><a href="#Topo"><font color="#FF0000">Go Top</font></a><font color="#FF0000"></font></font></b></i></p>

<br>
</h3>

</div>
