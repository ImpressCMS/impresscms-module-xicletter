<?php

 $link=mysql_connect('localhost','root','claudia');
 if(!$link)
    die('erro de conex�o'.mysql_error());
 else
     echo 'conex�o bem sucedida';


?>
