<?php

include 'header.php';
include_once( XOOPS_ROOT_PATH . "/header.php" );

if($_POST['op']=='send'){
	
$dt_agenda1=$_POST['dt_agenda']['date'];
$dt_agenda2=$_POST['dt_agenda']['time'];

echo $dt_agenda1,  $dt_agenda2;
$dt_agenda=mktime(0,0,0,substr($dt_agenda1,5,2),substr($dt_agenda1,8,2),substr($dt_agenda1,0,4));
$dt_agenda+=$dt_agenda2;

echo "veja apos calculo  $dt_agenda <br>  desconvertendo ";

echo date('d/m/Y h:i',$dt_agenda);


	
	
}

$sform = new XoopsThemeForm('teste' , "mailusers", xoops_getenv('PHP_SELF'));

$sform->addElement(new XoopsFormHidden("op", "send"));
$sform->addElement(new XoopsFormDateTime('Agendar para:','dt_agenda'));   
$sform->addElement(new XoopsFormButton("", "mail_submit", _SEND, "submit"));
$sform->display();
   
include(XOOPS_ROOT_PATH."/footer.php");


 ?>