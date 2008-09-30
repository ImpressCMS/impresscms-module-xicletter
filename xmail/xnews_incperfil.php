<?php
 /*
* $Id: include/xnews_incperfil.php
* Module: XMAIL
* Version: v2.0
* Release Date: 30 de junho de 2006
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

 // para ser chamado pelo xnews.php
 
$lista_perfil=implode(',',$_POST['id_perf']);
        while (list ($chave, $valor) = each ($_POST['id_perf'])) {
//             echo " chave: $chave => valor : $valor<br>";
//               $perfil_definido.="$valor - ";
               $sql=' insert into '.$xoopsDB->prefix('xmail_perfil_news').
               " (user_id,id_perf)  values ($user_id,$valor)  " ;
               $result=$xoopsDB->queryf($sql);
               if(!$result) {
                  $men_erro.="<br>"._MD_XMAIL_ERRCADPERF." - ($valor)";
               }
       }
        if(empty($lista_perfil)) {
          $perfil_definido= _MD_XMAIL_PERFNAODEF;
        } else {
            $nomeclass= 'classxmail_tabperfil';
            include XOOPS_ROOT_PATH.'/modules/xmail/include/'."{$nomeclass}.php";
            $classperf = new $nomeclass ;
            $perfil_definido=$classperf->get_lista_perf($lista_perfil);
        }
?>