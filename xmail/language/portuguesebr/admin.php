<?php
if (!defined('_AM_XMAIL_NOTMEN')){
define("_AM_XMAIL_NOTMEN","N�o ha mensagens cadastradas ");
define("_AM_XMAIL_NOTMENAPROV","N�o ha mensagens a serem aprovadas ");
define("_AM_XMAIL_TIT1","MENSAGENS CADASTRADAS ");
define("_AM_XMAIL_TIT2","MENSAGENS PARA SEREM APROVADAS ");
define("_AM_XMAIL_MESAGE","Mensagem");
define("_AM_XMAIL_OPT","Op��es");
define("_AM_XMAIL_ALT","Alterar");
define("_AM_XMAIL_EXC","Excluir");
define("_AM_XMAIL_APROV","Aprovar");
define("_AM_XMAIL_DESAPROV","Desaprovar");
define("_AM_XMAIL_TITULO","T�tulo");
define("_AM_XMAIL_SUBJCT","Assunto");
define("_AM_XMAIL_IDMEN","C�digo");
define("_AM_XMAIL_USUCAD","Inclu�da por");
define("_AM_XMAIL_DATACAD","Data Cad.");
define("_AM_XMAIL_ULTENVIO","�ltimo Envio");
define("_AM_XMAIL_NOTFOUND","Mensagem n�o localizada");
define("_AM_XMAIL_ERRORSAVINGDB","Ocorreu um erro: A base de dados n�o foi  atualizada devido a um erro.");
define("_AM_XMAIL_SAVEOK","Dados atualizados com sucesso ");
define("_AM_XMAIL_DELETEMAN","Exclui esta mensagem ?  ");
define("_AM_XMAIL_YES","SIM ");
define("_AM_XMAIL_NO","N�O ");
define("_AM_XMAIL_ERRORPARAM","Erro no cadastro de par�metros ");
define("_AM_XMAIL_ERRORPARAMINC","Erro na inclus�o de registro do  cadastro de par�metros ");
define("_AM_XMAIL_ERRORLOG","Erro no cadastro de log ");
define("_AM_XMAIL_LOGDELOK","Registros de log eliminados com sucesso  ");
define("_AM_XMAIL_FORMPARAM","Altera��o de Par�metros  ");
define("_AM_XMAIL_DIASEXC","Exluir mensagem, ap�s x dias que fora enviada  ");
define("_AM_XMAIL_ENVIAXMAILS","Enviar mensagem de quantas em quantas ? ");

define("_AM_XMAIL_PARAM1","Alfabetica de T�tulo");
define("_AM_XMAIL_PARAM2","C�digo da mensagem");
define("_AM_XMAIL_PARAM3","Data de Envio decrescente");
define("_AM_XMAIL_PARAM4","Data de Envio crescente");
define("_AM_XMAIL_ORDEMADMIN","Ordem para visualizar mensagens");
define("_AM_XMAIL_LIMITEPAGE","Limite de mensagens por p�gina");


// vers�o 1.09

define("_AM_XMAIL_DIRUPLOAD","Diret�rio para upload de arquivos anexos <br> Ser� criado um subdiret�rio para cada usu�rio ");

define("_AM_XMAIL_PATHEXIST","Diret�rio existente !!");
define("_AM_XMAIL_PATHNOTEXIST","Diret�rio n�o existente - Verifique !!");
define("_AM_XMAIL_ALLOWMIMETYPES" ,"Mimetypes permitidos ");

define("_AM_XMAIL_MAXUPLOAD" ,"Tamanho M�X do upload (KB) 1048576 = 1 Meg ");
define("_AM_XMAIL_FORMAT_TIME" ,"Formato de data para exibi��o.<br> Vide fun��o date do php para exemplos:");
define("_AM_XMAIL_PERMITE_ANEXO" ,"Permite anexar arquivos ? ");
define("_AM_XMAIL_FILE_MODE" ,"Configura��o de Permiss�o de Upload de Arquivo");
define("_AM_XMAIL_VERI_MAILOK" ,"Verificar perfil do usu�rio, se aceita receber email ");
define("_AM_XMAIL_ERRUPLOAD_MAX","Valor m�ximo para upload maior do que definido no php.ini");

// vers�o  2.0

define("_AM_XMAIL_NOTUSERDESATIVO","N�o ha usu�rios com conta desativada ");
define("_AM_XMAIL_ID","Id");
define("_AM_XMAIL_LOGIN","Login");
define("_AM_XMAIL_NOME","Nome");
define("_AM_XMAIL_QTDTENTAR","Tentou<br>Ativar");
define("_AM_XMAIL_ENVIAREMAIL","Enviar email");
define("_AM_XMAIL_EMAIL", "Email");
define("_AM_XMAIL_SELUSER", "Selecione os usu�rios ");
define("_AM_XMAIL_ATIVAR", "Ativar");
define("_AM_XMAIL_ALLOWHTML", "Permite Editor Visual ?");
define("_AM_XMAIL_TIPOEDITOR", "Selecione Editor Visual,<br>se desejar<br /><i>As classes do editor devem estar no Kernel do Xoops</i>");

define("_AM_XMAIL_DBERROR", "Ocorreu um erro de banco de dados. Os detalhes est�o abaixo:<br>Resultado: %s<br>Query: %s");
define("_AM_XMAIL_USERREMOVED", "Usu�rio %s foi retirado da lista.");
define("_AM_XMAIL_TABLEOPT", "Tabela %s foi otimizada");
define("_AM_XMAIL_ADMINMENUNEWS", "Administra��o da Newsletter " );
define("_AM_XMAIL_REMOVEUSER", "Detalhes dos Assinantes");
define("_AM_XMAIL_OPTIMDATAB", "Otimizar BD");
define("_AM_XMAIL_NOTHINGINDB", "Nada para mostrar");
define("_AM_XMAIL_CONFIRMED", "Confirmado");
define("_AM_XMAIL_USERID", "ID do usu�rio");
define("_AM_XMAIL_USERNAME", "Nome do usu�rio");
define("_AM_XMAIL_NICKNAME", "Apelido:");
define("_AM_XMAIL_HOST", "IP");
define("_AM_XMAIL_TIME", "Hora");
define("_AM_XMAIL_DELETEUSER", "Delete");
define("_AM_XMAIL_USERSMSG1", "<br>O usu�rio %s j� � assinante do Boletim.");
define("_AM_XMAIL_USERSMSG2", "<br>%s dados n�o foram importados, o campo email est� vazio.");
define("_AM_XMAIL_USERSMSG3", "<br><b>Aviso:</b> %s dados n�o foi importada. Motivo: usu�rio n�o deseja receber email.");
define("_AM_XMAIL_USERSMSG4", "<br>User %s dados importados com sucesso ");
define("_AM_XMAIL_USERSMSG5", "<br>Erro ao incluir usu�rio %s");
define("_AM_XMAIL_IMPORTUSER", "Importar Usu�rios para lista de assinantes ");
define("_AM_XMAIL_MSGIMPORTUSER", "Selecione os usu�rios para importa��o ");
define("_AM_XMAIL_BNTIMPORTUSEROK", "Importar");
define("_AM_XMAIL_BNTIMPORTUSERCANCEL", "Cancelar");
define("_AM_XMAIL_ERROR", "ERRO");
define("_AM_XMAIL_ADMINMENUXMAIL", "Administra��o Xmail " );

define("_AM_XMAIL_ADMENU1","Menu Principal");
define("_AM_XMAIL_ADMENU2","Aprovar mensagens");
define("_AM_XMAIL_ADMENU3","Ver log de envio");
define("_AM_XMAIL_ADMENU4","Ger�nciar Ativa��o");
define("_AM_XMAIL_ADMENU5","Alterar Par�metros");
define("_AM_XMAIL_ADMENU6","Ger�nciar Newsletter");
define("_AM_XMAIL_ADMENU7","Ger�nciar Tabela de Perfis");

define("_AM_XMAIL_ADMPERUSER","Administrar tabela de Perfis de Usu�rios");
define("_AM_XMAIL_ERRBUSCA","Erro na localiza��o do registro ");
define("_AM_XMAIL_DESCRIPERF","Descri��o do Perfil");
define("_AM_XMAIL_INCLUSAO","Inclus�o");
define("_AM_XMAIL_ALTERACAO","Altera��o");
define("_AM_XMAIL_CONFDELUSER","Confirma eliminar o assinante  %s da lista ?");
define("_AM_XMAIL_USAPERF","Deseja usar esquema de perfis  na newsletter ?");


//******  vers�o  2.5 alpha

define("_AM_XMAIL_ADMENU8","Log de Erros");
define("_AM_XMAIL_ADMENU9","Como Agendar Envio?");
define("_AM_XMAIL_EDITORVISUAL","Editores visuais n�o instalado.Veja na pasta docs como instalar. ");  

define("_AM_XMAIL_FORMEXPORT","Exporta��o do cadastro de Assinantes da Newsletter ");  
define("_AM_XMAIL_SELELECIONAR","Selecionar Cadastros :");  
define("_AM_XMAIL_AMBOS","Ambos:");  
define("_AM_XMAIL_CONFIRMADOS","Confirmados:");  
define("_AM_XMAIL_NAOCONFIRMADOS","N�o Confirmados:");  
define("_AM_XMAIL_DELIMITADOR","Delimitador:");  
define("_AM_XMAIL_ARQSUCCESS","Exporta��o de assinantes gerada com sucesso !!<BR> Campos exportados:  Nome, Apelido, Email  ");  
define("_AM_XMAIL_ARQERR","Erro na gera��o do arquivo  ");  

define("_AM_XMAIL_VOLTAR","Voltar");  
define("_AM_XMAIL_ERRCARREGAR","Erro ao carregar o arquivo ");  

define("_AM_XMAIL_AUTHOR","Autora :");

define("_AM_XMAIL_DEVINFOS","Informa��es Sobre o Desenvolvedor");
define("_AM_XMAIL_DEVSITE","Site do Desenvolvedor.:");
define("_AM_XMAIL_BUGSREP","Report Bugs.:");
define("_AM_XMAIL_RFEREP","Feedback and Sugestions.:");
define("_AM_XMAIL_FORUMS","F�rum Support.:");
define("_AM_XMAIL_CHANGELOG","Change Log");


define("_AM_XMAIL_NAOHAREG","N�o ha registros a serem exportados ");
define("_AM_XMAIL_FORMIMPORT","Upload de arquivo para importar cadastro de Assinantes da Newsletter ");
define("_AM_XMAIL_SELARQUP","Localize o arquivo<BR>(extens�o obrigat�rio = txt) : ");
define("_AM_XMAIL_ERRUPLOAD","Erro no envio do arquivo - Verifique se a pasta de uploads  tem permiss�o de escrita ");  
define("_AM_XMAIL_OKUPLOAD","Upload executado com sucesso !! ");  
define("_AM_XMAIL_VALORESMAXUP","Par�metros de configura��o do php.ini : <br>Tamanho m�ximo do arquivo para upload: %s
<br>Tamanho m�ximo para envio de vari�veis POST  %s");  
define("_AM_XMAIL_EXTENSIONINVALID","Extens�o do arquivo inv�lida ");
define("_AM_XMAIL_LAYOUESPERADO","Layout esperado:");
define("_AM_XMAIL_LAYOUPIMPORT","(CSV) 3 campos separados pelo delimitador informado , com a sequ�ncia:<BR> Nome, Apelido , Email <br><b><i>Os cadastros ser�o inseridos na situa��o de confirmados.</b></i> ");
define("_AM_XMAIL_EMAILJAEXISTE","Email ja existe no cadastro ");
define("_AM_XMAIL_IMPORTOK","Importa��o concluida com sucesso . Inseriu  %s  registro(s)  ");
define("_AM_XMAIL_IMPORTNAOHAREG","N�o ha registros a serem importados  ");
define("_AM_XMAIL_IMPORTNAOABRIUARQ","N�o foi poss�vel abrir o arquivo  ");
define("_AM_XMAIL_IMPORTREGERR","Registro incorreto para importa��o:   ");
define("_AM_XMAIL_EMAILREPETIDO","Encontrado email repetido no arquivo de importa��o, considerou-se o primeiro ");
//define("_AM_XMAIL_HORAINTERVALO","Horas de intervalo entre o envio de lotes.<br>�til para Servidores que limitam o envio de emails por hora<br>");
define("_AM_XMAIL_ENVIAXMAILS2","<br><spam style='color:red'>( Quantidade de emails por lote )</i></spam>");
define("_AM_XMAIL_PARAMNOTDEFEDIT","� necess�rio definir o editor visual a ser utilizado  ");




define("_AM_XMAIL_FORMIMPORT2","Upload de arquivo para importar Perfis de Assinantes da Newsletter ");
define("_AM_XMAIL_LAYOUPIMPORT2","(CSV) campos separados pelo delimitador informado.
<br> Sendo o primeiro campo o email ja cadastrado,os demais campos os codigos de perfis ja cadastrados, separados pelo delimitador informado. ");

define("_AM_XMAIL_EMAILNOTFOUND","Email n�o cadastrado ");
define("_AM_XMAIL_PERFILNOTFOUND","Perfil n�o cadastrado ");

define("_AM_XMAIL_CAMPOSEMPTY","H� campos vazios, registro n�o importado ");

define("_AM_XMAIL_MINUTOSINTERVALO","Minutos de intervalo entre o envio de lotes.<br>
�til para n�o sobrecarregar a fila do Servidor de Email, e n�o causar lentid�o. <br>
Op��o usada somente com agendamento , executado pelo script  send_agenda.php  .
");

define("_AM_XMAIL_LOTESPORHORA","Quantos lotes enviar em uma hora .<br>
Informe 0 (zero) para n�o limitar.<br>
�til para Servidores que limitam envio de emails por hora. <br>
Op��o usada somente com agendamento , executado pelo script  send_agenda.php.
");

define("_AM_XMAIL_EMAILNOTVALIDO","Email n�o v�lido");
//-------------------------//

define("_AM_XMAIL_PERFIL","Perfil");
define("_AM_XMAIL_VERI_MAILOK2" ,"Se optar por n�o e o usu�rio  n�o desejar receber emails, ser� enviado p/ private message. <br/>
Se optar por sim e o usu�rio n�o deseja receber emails e foi solicitado somente envio de emails ,nada ser� enviado.<br/>
Por�m ser� gerado mensagem de aviso que o perfil dele n�o aceita receber emails e continuar� pendente no lote.
 ");


define("_AM_XMAIL_NAOHAPERF","N�o h� perfis para este assinante");

define("_AM_XMAIL_ASSINANTES","Assinantes");
//-----------------------------------//
define("_AM_XMAIL_NOTOPENARQ",'N�o foi poss�vel abrir o arquivo');
define("_AM_XMAIL_NOTEXITARQ",'N�o h� arquivo de Erros ');
define("_AM_XMAIL_NOTEXITARQ",'N�o h� arquivo de Erros ');

define("_AM_XMAIL_NOTHAREG",'N�o h� registros cadastrados ');
define("_AM_XMAIL_VERASSINANTES",'Ver Assinantes');


}





?>