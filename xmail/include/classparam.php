<?php
/*
* $Id: include/classparam.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

      //---------------------------------------------------------------------------
      // tabela <prefix_xoops>_xmail_param  deve ter so um registro de parâmetros
      // table <prefix_xoops>_xmail_param must have only record for parameters
      //---------------------------------------------------------------------------

	class classparam {

		var $dias_excluir;
        var $envia_xmails;
        var $totreg;  // total de registros / total records
        var $ordem_admin;
        var $limite_page;
        var $aprov_auto;
        var $dir_upload;
        var $selmimetype;
        var $maxupload;
        var $format_time;
        var $permite_anexo;
        var $file_mode;
        var $veri_mailok;
        var $allow_html;
        var $tipo_editor;
        var $usa_perf;
        var $hora_intervalo;   //  não será usado
        var $minutos_intervalo;
 		var $lotes_por_hora;       

		function classparam() {

            $this->dias_excluir='100' ;
            $this->envia_xmails='50';
            $this->totreg='0';     // atualizado apos busca() / updated after busca() (busca means 'search')
            $this->ordem_admin="A";
            $this->limite_page='10';
            $this->aprov_auto='0';
            //$this->dir_upload="modules/xmail/upload";
            $this->dir_upload="uploads/xmail";
            $this->selmimetype="";
            $this->maxupload=1048576;
            $this->format_time="d-M-Y H:i:s";
            $this->permite_anexo="0";
            $this->file_mode="0774" ;
            $this->veri_mailok='1';
            $this->allow_html=0;
            $this->tipo_editor='';
            $this->usa_perf=0;
            $this->hora_intervalo=0;
            $this->minutos_intervalo=0;
            $this->lotes_por_hora=0;

			if(!$this->busca())
				$this->incluir();
		
		}
		
		function incluir() {
           global $xoopsDB;

            if($this->validar("I")) {
               $this->define_mimetype() ;

            	$sql = "INSERT INTO ".$xoopsDB->prefix("xmail_param")  ;
				$sql.= "(dias_excluir,envia_xmails,ordem_admin,limite_page,aprov_auto,
                   dir_upload,selmimetype,maxupload,format_time,permite_anexo,file_mode,
                   veri_mailok,allow_html,tipo_editor,usa_perf,hora_intervalo,minutos_intervalo,lotes_por_hora)";

				$sql.= " VALUES (";
				$sql.= "'" . $this->dias_excluir . "',";
				$sql.= "'" . $this->envia_xmails . "',";
				$sql.= "'" . $this->ordem_admin . "',";
				$sql.= "'" . $this->limite_page . "',";
				$sql.= "'" . $this->aprov_auto . "',";
				$sql.= "'" . $this->dir_upload . "',";
				$sql.= "'" . $this->selmimetype . "',";
				$sql.= "'" . $this->maxupload . "',";
				$sql.= "'" . $this->format_time . "',";
				$sql.= "'" . $this->permite_anexo."',";
				$sql.= "'" . $this->file_mode."',";
				$sql.= "'" . $this->veri_mailok."',";
				$sql.= "'" . $this->allow_html."',";
				$sql.= "'" . $this->tipo_editor."',";
				$sql.= "'" . $this->usa_perf."',";
				$sql.= "" . $this->hora_intervalo.",";
				$sql.= "" . $this->minutos_intervalo.",";
				$sql.= "" . $this->lotes_por_hora.")";
				
                $result= $xoopsDB->queryF($sql);
		
				if(!$result) {
					return false;
				}
                return  true;
            }
			else {
				return false;
			}


		}

		function validar($opt) {
           global $men_erro;
           //  checar valor de maxupload
           $up_max_filesize=ini_get('upload_max_filesize');
           $up_max_filesize2=intval($up_max_filesize);
           if(strpos(strtoupper($up_max_filesize),"M")>0 ) {
              $up_max_filesize2*=1024*1024;
           }elseif (strpos(strtoupper($up_max_filesize),"KB")>0 ) {
              $up_max_filesize2*=1024;
           }
           if($this->maxupload >$up_max_filesize2) {
              $men_erro=_AM_XMAIL_ERRUPLOAD_MAX;
              return false;
           }
            if($this->allow_html and empty($this->tipo_editor)){
		    	$men_erro=_AM_XMAIL_PARAMNOTDEFEDIT ;
	            return false; 		    	
            }
           
		    $this->hora_intervalo=intval($this->hora_intervalo);
			$this->minutos_intervalo=intval($this->minutos_intervalo);		    		    
		    $this->lotes_por_hora=intval($this->lotes_por_hora);		    		    		    

		    return true;   
    
      	}
		

		function alterar() {
           global $xoopsDB,$men_erro;

            if($this->validar("A")) {
            	$sql = "UPDATE ".$xoopsDB->prefix("xmail_param")  ;
				$sql.= " SET dias_excluir = $this->dias_excluir,
                       envia_xmails=$this->envia_xmails ,
                       ordem_admin='$this->ordem_admin' ,
                       limite_page='$this->limite_page',
                       aprov_auto='$this->aprov_auto',
                       dir_upload='$this->dir_upload' ,
                       selmimetype='$this->selmimetype',
                       maxupload='$this->maxupload',
                       format_time='$this->format_time',
                       permite_anexo='$this->permite_anexo' ,
                       file_mode='$this->file_mode'  ,
                       veri_mailok='$this->veri_mailok',
                       allow_html='$this->allow_html',
                       tipo_editor='$this->tipo_editor',
                       usa_perf='$this->usa_perf'  ,
				       hora_intervalo=$this->hora_intervalo , 
					   minutos_intervalo=$this->minutos_intervalo ,
					   lotes_por_hora=$this->lotes_por_hora  ";
                       
				$result= $xoopsDB->queryF($sql);

				if(!$result) {
					$men_erro=$xoopsDB->error();
					return false;
				}
                return  true;
            }
			else {
				return false;
			}
 		}
		
		function excluir() {
          // não deve excluir
          // shouldn't delete
              ;
		}

  
		function busca() {
            global $xoopsDB;
			$sql = "SELECT * from ".$xoopsDB->prefix("xmail_param")." limit 1" ;

			$result= $xoopsDB->query($sql);
			if(!$result) {
				return false;
			}
			if($xoopsDB->getRowsNum($result)==0){
				return false;
			}

			
			$cat_data = $xoopsDB->fetcharray($result) ;
           $this->dias_excluir=$cat_data["dias_excluir"];
           $this->envia_xmails=$cat_data["envia_xmails"];
           $this->totreg=$xoopsDB->getRowsNum($result);
           $this->ordem_admin=$cat_data["ordem_admin"];
           $this->limite_page=$cat_data["limite_page"];
           $this->aprov_auto=$cat_data["aprov_auto"];
           $this->dir_upload=$cat_data["dir_upload"];
           $this->selmimetype=$cat_data["selmimetype"];
           $this->maxupload=$cat_data["maxupload"];
           $this->format_time=$cat_data["format_time"];
           $this->permite_anexo=$cat_data["permite_anexo"];
           $this->file_mode=$cat_data["file_mode"];
           $this->veri_mailok=$cat_data["veri_mailok"];
           $this->allow_html=$cat_data["allow_html"];
           $this->tipo_editor=$cat_data["tipo_editor"];
           $this->usa_perf=$cat_data["usa_perf"];
		   $this->hora_intervalo=$cat_data["hora_intervalo"];           
		   $this->minutos_intervalo=$cat_data["minutos_intervalo"];           
		   $this->lotes_por_hora=$cat_data["lotes_por_hora"];           
			

           if(empty($this->selmimetype)) {
              $this->define_mimetype() ;
          }
           return  true;
		}


         function define_mimetype() {
        	  $this->selmimetype= 'doc lha lzh pdf gtar swf tar tex texinfo texi zip Zip au XM snd mid midi kar mpga mp2 mp3 aif aiff aifc m3u ram rm rpm ra wav wax bmp gif ief jpeg jpg jpe png tiff tif ico pbm ppm rgb xbm xpm css html htm asc txt rtx rtf mpeg mpg mpe qt mov mxu avi';
         }


		
} // fecha class / close class

?>

