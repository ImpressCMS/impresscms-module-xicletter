<?php

 $link=mysql_connect('localhost','root','claudia');
 if(!$link)
    die('erro de conexÆo'.mysql_error());
 else
     echo 'conexÆo bem sucedida';


?>
