//xmail_funcoes.js

function exibe_esconde(tipo){
   var d = document;
   var compose = d.getElementById('exibe_'+tipo);
   var button=d.getElementById('exibemen_'+tipo);
   
   if (compose.style.display == ""){
	     compose.style.display = "none";
	     button.value='exibe';
   }
   else {
      compose.style.display = "";
      button.value='esconde';
      
   }
}



function vermen(id_men,xoopsurl) {
	openWithSelfMain(xoopsurl+'/modules/xmail/vermen.php?id_men='+id_men,"Info",400,350);

}