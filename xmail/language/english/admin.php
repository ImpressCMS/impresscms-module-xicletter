<?php
if (!defined('_AM_XMAIL_NOTMEN')){
define("_AM_XMAIL_NOTMEN","Não ha mensagens cadastradas ");
define("_AM_XMAIL_NOTMENAPROV","Não ha mensagens a serem aprovadas ");
define("_AM_XMAIL_TIT1","MENSAGENS CADASTRADAS ");
define("_AM_XMAIL_TIT2","MENSAGENS PARA SEREM APROVADAS ");
define("_AM_XMAIL_MESAGE","Mensagem");
define("_AM_XMAIL_OPT","Opções");
define("_AM_XMAIL_ALT","Alterar");
define("_AM_XMAIL_EXC","Excluir");
define("_AM_XMAIL_APROV","Aprovar");
define("_AM_XMAIL_DESAPROV","Desaprovar");
define("_AM_XMAIL_TITULO","Título");
define("_AM_XMAIL_SUBJCT","Assunto");
define("_AM_XMAIL_IDMEN","Código");
define("_AM_XMAIL_USUCAD","Incluída por");
define("_AM_XMAIL_DATACAD","Data Cad.");
define("_AM_XMAIL_ULTENVIO","Último Envio");
define("_AM_XMAIL_NOTFOUND","Mensagem não localizada");
define("_AM_XMAIL_ERRORSAVINGDB","Ocorreu um erro: A base de dados não foi  atualizada devido a um erro.");
define("_AM_XMAIL_SAVEOK","Dados atualizados com sucesso ");
define("_AM_XMAIL_DELETEMAN","Exclui esta mensagem ?  ");
define("_AM_XMAIL_YES","SIM ");
define("_AM_XMAIL_NO","NÃO ");
define("_AM_XMAIL_ERRORPARAM","Erro no cadastro de parâmetros ");
define("_AM_XMAIL_ERRORPARAMINC","Erro na inclusão de registro do  cadastro de parâmetros ");
define("_AM_XMAIL_ERRORLOG","Erro no cadastro de log ");
define("_AM_XMAIL_LOGDELOK","Registros de log eliminados com sucesso  ");
define("_AM_XMAIL_FORMPARAM","Alteração de Parâmetros  ");
define("_AM_XMAIL_DIASEXC","Exluir mensagem, após x dias que fora enviada  ");
define("_AM_XMAIL_ENVIAXMAILS","Enviar mensagem de quantas em quantas ? ");

define("_AM_XMAIL_PARAM1","Alfabetica de Título");
define("_AM_XMAIL_PARAM2","Código da mensagem");
define("_AM_XMAIL_PARAM3","Data de Envio decrescente");
define("_AM_XMAIL_PARAM4","Data de Envio crescente");
define("_AM_XMAIL_ORDEMADMIN","Ordem para visualizar mensagens");
define("_AM_XMAIL_LIMITEPAGE","Limite de mensagens por página");


// versão 1.09

define("_AM_XMAIL_DIRUPLOAD","Diretório para upload de arquivos anexos <br> Será criado um subdiretório para cada usuário ");

define("_AM_XMAIL_PATHEXIST","Diretório existente !!");
define("_AM_XMAIL_PATHNOTEXIST","Diretório não existente - Verifique !!");
define("_AM_XMAIL_ALLOWMIMETYPES" ,"Mimetypes permitidos ");

define("_AM_XMAIL_MAXUPLOAD" ,"Tamanho MÁX do upload (KB) 1048576 = 1 Meg ");
define("_AM_XMAIL_FORMAT_TIME" ,"Formato de data para exibição.<br> Vide função date do php para exemplos:");
define("_AM_XMAIL_PERMITE_ANEXO" ,"Permite anexar arquivos ? ");
define("_AM_XMAIL_FILE_MODE" ,"Configuração de Permissão de Upload de Arquivo");
define("_AM_XMAIL_VERI_MAILOK" ,"Verificar perfil do usuário, se aceita receber email ");
define("_AM_XMAIL_ERRUPLOAD_MAX","Valor máximo para upload maior do que definido no php.ini");

// versão  2.0

define("_AM_XMAIL_NOTUSERDESATIVO","Não ha usuários com conta desativada ");
define("_AM_XMAIL_ID","Id");
define("_AM_XMAIL_LOGIN","Login");
define("_AM_XMAIL_NOME","Nome");
define("_AM_XMAIL_QTDTENTAR","Tentou<br>Ativar");
define("_AM_XMAIL_ENVIAREMAIL","Enviar email");
define("_AM_XMAIL_EMAIL", "Email");
define("_AM_XMAIL_SELUSER", "Selecione os usuários ");
define("_AM_XMAIL_ATIVAR", "Ativar");
define("_AM_XMAIL_ALLOWHTML", "Permite Editor Visual ?");
define("_AM_XMAIL_TIPOEDITOR", "Selecione Editor Visual,<br>se desejar<br /><i>As classes do editor devem estar no Kernel do Xoops</i>");

define("_AM_XMAIL_DBERROR", "Ocorreu um erro de banco de dados. Os detalhes estão abaixo:<br>Resultado: %s<br>Query: %s");
define("_AM_XMAIL_USERREMOVED", "Usuário %s foi retirado da lista.");
define("_AM_XMAIL_TABLEOPT", "Tabela %s foi otimizada");
define("_AM_XMAIL_ADMINMENUNEWS", "Administração da Newsletter " );
define("_AM_XMAIL_REMOVEUSER", "Detalhes dos Assinantes");
define("_AM_XMAIL_OPTIMDATAB", "Otimizar BD");
define("_AM_XMAIL_NOTHINGINDB", "Nada para mostrar");
define("_AM_XMAIL_CONFIRMED", "Confirmado");
define("_AM_XMAIL_USERID", "ID do usuário");
define("_AM_XMAIL_USERNAME", "Nome do usuário");
define("_AM_XMAIL_NICKNAME", "Apelido:");
define("_AM_XMAIL_HOST", "IP");
define("_AM_XMAIL_TIME", "Hora");
define("_AM_XMAIL_DELETEUSER", "Delete");
define("_AM_XMAIL_USERSMSG1", "<br>O usuário %s já é assinante do Boletim.");
define("_AM_XMAIL_USERSMSG2", "<br>%s dados não foram importados, o campo email está vazio.");
define("_AM_XMAIL_USERSMSG3", "<br><b>Aviso:</b> %s dados não foi importada. Motivo: usuário não deseja receber email.");
define("_AM_XMAIL_USERSMSG4", "<br>User %s dados importados com sucesso ");
define("_AM_XMAIL_USERSMSG5", "<br>Erro ao incluir usuário %s");
define("_AM_XMAIL_IMPORTUSER", "Importar Usuários para lista de assinantes ");
define("_AM_XMAIL_MSGIMPORTUSER", "Selecione os usuários para importação ");
define("_AM_XMAIL_BNTIMPORTUSEROK", "Importar");
define("_AM_XMAIL_BNTIMPORTUSERCANCEL", "Cancelar");
define("_AM_XMAIL_ERROR", "ERRO");
define("_AM_XMAIL_ADMINMENUXMAIL", "Administração Xmail " );

define("_AM_XMAIL_ADMENU1","Menu Principal");
define("_AM_XMAIL_ADMENU2","Aprovar mensagens");
define("_AM_XMAIL_ADMENU3","Ver log de envio");
define("_AM_XMAIL_ADMENU4","Gerênciar Ativação");
define("_AM_XMAIL_ADMENU5","Alterar Parâmetros");
define("_AM_XMAIL_ADMENU6","Gerênciar Newsletter");
define("_AM_XMAIL_ADMENU7","Gerênciar Tabela de Perfis");

define("_AM_XMAIL_ADMPERUSER","Administrar tabela de Perfis de Usuários");
define("_AM_XMAIL_ERRBUSCA","Erro na localização do registro ");
define("_AM_XMAIL_DESCRIPERF","Descrição do Perfil");
define("_AM_XMAIL_INCLUSAO","Inclusão");
define("_AM_XMAIL_ALTERACAO","Alteração");
define("_AM_XMAIL_CONFDELUSER","Confirma eliminar o assinante  %s da lista ?");
define("_AM_XMAIL_USAPERF","Deseja usar esquema de perfis  na newsletter ?");


//******  versão  2.5 alpha

define("_AM_XMAIL_ADMENU8","Log de Erros");
define("_AM_XMAIL_ADMENU9","Como Agendar Envio?");
define("_AM_XMAIL_EDITORVISUAL","Editores visuais não instalado.Veja na pasta docs como instalar. ");  

define("_AM_XMAIL_FORMEXPORT","Exportação do cadastro de Assinantes da Newsletter ");  
define("_AM_XMAIL_SELELECIONAR","Selecionar Cadastros :");  
define("_AM_XMAIL_AMBOS","Ambos:");  
define("_AM_XMAIL_CONFIRMADOS","Confirmados:");  
define("_AM_XMAIL_NAOCONFIRMADOS","Não Confirmados:");  
define("_AM_XMAIL_DELIMITADOR","Delimitador:");  
define("_AM_XMAIL_ARQSUCCESS","Exportação de assinantes gerada com sucesso !!<BR> Campos exportados:  Nome, Apelido, Email  ");  
define("_AM_XMAIL_ARQERR","Erro na geração do arquivo  ");  

define("_AM_XMAIL_VOLTAR","Voltar");  
define("_AM_XMAIL_ERRCARREGAR","Erro ao carregar o arquivo ");  

define("_AM_XMAIL_AUTHOR","Autora :");

define("_AM_XMAIL_DEVINFOS","Informações Sobre o Desenvolvedor");
define("_AM_XMAIL_DEVSITE","Site do Desenvolvedor.:");
define("_AM_XMAIL_BUGSREP","Report Bugs.:");
define("_AM_XMAIL_RFEREP","Feedback and Sugestions.:");
define("_AM_XMAIL_FORUMS","Fórum Support.:");
define("_AM_XMAIL_CHANGELOG","Change Log");


define("_AM_XMAIL_NAOHAREG","Não ha registros a serem exportados ");
define("_AM_XMAIL_FORMIMPORT","Upload de arquivo para importar cadastro de Assinantes da Newsletter ");
define("_AM_XMAIL_SELARQUP","Localize o arquivo<BR>(extensão obrigatório = txt) : ");
define("_AM_XMAIL_ERRUPLOAD","Erro no envio do arquivo - Verifique se a pasta de uploads  tem permissão de escrita ");  
define("_AM_XMAIL_OKUPLOAD","Upload executado com sucesso !! ");  
define("_AM_XMAIL_VALORESMAXUP","Parâmetros de configuração do php.ini : <br>Tamanho máximo do arquivo para upload: %s
<br>Tamanho máximo para envio de variáveis POST  %s");  
define("_AM_XMAIL_EXTENSIONINVALID","Extensão do arquivo inválida ");
define("_AM_XMAIL_LAYOUESPERADO","Layout esperado:");
define("_AM_XMAIL_LAYOUPIMPORT","(CSV) 3 campos separados pelo delimitador informado , com a sequência:<BR> Nome, Apelido , Email <br><b><i>Os cadastros serão inseridos na situação de confirmados.</b></i> ");
define("_AM_XMAIL_EMAILJAEXISTE","Email ja existe no cadastro ");
define("_AM_XMAIL_IMPORTOK","Importação concluida com sucesso . Inseriu  %s  registro(s)  ");
define("_AM_XMAIL_IMPORTNAOHAREG","Não ha registros a serem importados  ");
define("_AM_XMAIL_IMPORTNAOABRIUARQ","Não foi possível abrir o arquivo  ");
define("_AM_XMAIL_IMPORTREGERR","Registro incorreto para importação:   ");
define("_AM_XMAIL_EMAILREPETIDO","Encontrado email repetido no arquivo de importação, considerou-se o primeiro ");
//define("_AM_XMAIL_HORAINTERVALO","Horas de intervalo entre o envio de lotes.<br>Útil para Servidores que limitam o envio de emails por hora<br>");
define("_AM_XMAIL_ENVIAXMAILS2","<br><spam style='color:red'>( Quantidade de emails por lote )</i></spam>");
define("_AM_XMAIL_PARAMNOTDEFEDIT","É necessário definir o editor visual a ser utilizado  ");




define("_AM_XMAIL_FORMIMPORT2","Upload de arquivo para importar Perfis de Assinantes da Newsletter ");
define("_AM_XMAIL_LAYOUPIMPORT2","(CSV) campos separados pelo delimitador informado.
<br> Sendo o primeiro campo o email ja cadastrado,os demais campos os codigos de perfis ja cadastrados, separados pelo delimitador informado. ");

define("_AM_XMAIL_EMAILNOTFOUND","Email não cadastrado ");
define("_AM_XMAIL_PERFILNOTFOUND","Perfil não cadastrado ");

define("_AM_XMAIL_CAMPOSEMPTY","Há campos vazios, registro não importado ");

define("_AM_XMAIL_MINUTOSINTERVALO","Minutos de intervalo entre o envio de lotes.<br>
Útil para não sobrecarregar a fila do Servidor de Email, e não causar lentidão. <br>
Opção usada somente com agendamento , executado pelo script  send_agenda.php  .
");

define("_AM_XMAIL_LOTESPORHORA","Quantos lotes enviar em uma hora .<br>
Informe 0 (zero) para não limitar.<br>
Útil para Servidores que limitam envio de emails por hora. <br>
Opção usada somente com agendamento , executado pelo script  send_agenda.php.
");

define("_AM_XMAIL_EMAILNOTVALIDO","Email não válido");
//-------------------------//

define("_AM_XMAIL_PERFIL","Perfil");
define("_AM_XMAIL_VERI_MAILOK2" ,"Se optar por não e o usuário  não desejar receber emails, será enviado p/ private message. <br/>
Se optar por sim e o usuário não deseja receber emails e foi solicitado somente envio de emails ,nada será enviado.<br/>
Porém será gerado mensagem de aviso que o perfil dele não aceita receber emails e continuará pendente no lote.
 ");


define("_AM_XMAIL_NAOHAPERF","Não há perfis para este assinante");

define("_AM_XMAIL_ASSINANTES","Assinantes");
//-----------------------------------//
define("_AM_XMAIL_NOTOPENARQ",'Não foi possível abrir o arquivo');
define("_AM_XMAIL_NOTEXITARQ",'Não há arquivo de Erros ');
define("_AM_XMAIL_NOTEXITARQ",'Não há arquivo de Erros ');

define("_AM_XMAIL_NOTHAREG",'Não há registros cadastrados ');
define("_AM_XMAIL_VERASSINANTES",'Ver Assinantes');


}





?>