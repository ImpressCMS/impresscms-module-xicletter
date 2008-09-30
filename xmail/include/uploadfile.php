<?php
/*
* $Id: uploadfile.php
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

// File Upload Class
// By Haruki Setoyama   http://harux.net   haruki@harux.net
// License: GPL2 or later
// $Id: uploadfile.php,v 1.1 2006/02/17 20:37:33 claudia Exp $

include_once XOOPS_ROOT_PATH.'/modules/xmail/include/mimetype.php';


mt_srand((double) microtime() * 1000000);

class UploadFile {

        var $fieldName;
        var $fileName;
        var $filesize;
        var $minetype;
        var $originalName;
        var $ext;
        var $allowedMinetype;
        var $bannedMinetype;
        var $maxImageWidth;
        var $maxImageHight;
        var $maxFilesize;       // Byte
        var $mode;              // file mode of Unix Style
        var $stripSpaces;       // 0 or 1
        var $bannedChars;
        var $addExt;     // 0 or 1

        var $errormsg;
        var $error;

// constructor

        function UploadFile ($fieldName="uploadfile") {
                $this->fieldName = "uploadfile";
                //$this->allowedMinetype = array();
                //$this->bannedMinetype = array();
                $this->maxImageWidth = 0;
                $this->maxImageHight = 0;
                $this->maxFilesize = 0;
                $this->addExt = 1;
                $this->mode = "";
                $this->stripSpaces = 1;
                $this->bannedChars = "";
                if (is_array($fieldName)) {
                        foreach($fieldName as $key => $value) {
                                $this->$key = $value;
                        }
                } else {
                        $this->fieldName = $fieldName;
                }
                $this->error=0;
        }

// set
        function setAllowedMinetype($value){
                $this->allowedMinetype = $value;
        }

        function setMaxImageWidth($value){
                $this->maxImageWidth = $value;
        }

        function setMaxImageHight($value){
                $this->maxImageHight = $value;
        }

        function setMaxFilesize($value){
                $this->maxFilesize = $value;
        }

        function setAddExt($value){
                $this->addExt = $value;
        }

        function setMode($value){
                $this->mode = $value;
        }

// load HTTP_POST_FILES
        function loadPostVars() {

                global $HTTP_POST_FILES;

                if (!isset($HTTP_POST_FILES[$this->fieldName]))
                    return false;
                    
                $this->fileName = $HTTP_POST_FILES[$this->fieldName]['tmp_name'];
                $this->filesize = $HTTP_POST_FILES[$this->fieldName]['size'];
                $this->error = $HTTP_POST_FILES[$this->fieldName]['error'];
                if($this->error==1) {
                   $this->errormsg=_MD_XMAIL_ERRORUPLOA1;
                }
                if($this->error==2) {
                   $this->errormsg=sprintf(_MD_XMAIL_ERRORUPLOA2,$this->maxFilesize );
                }

                 if($this->error==3) {
                   $this->errormsg=_MD_XMAIL_ERRORUPLOA3;
                }

                 if($this->error==4) {
                   $this->errormsg=_MD_XMAIL_ERRORUPLOA4;
                }

                
                $mimetype = new mimetype();
      			$this->minetype = $mimetype->getType($HTTP_POST_FILES[$this->fieldName]['name']);
				//$this->minetype = $HTTP_POST_FILES[$this->fieldName]['type'];
                $this->originalName = $HTTP_POST_FILES[$this->fieldName]['name'];
                //echo $this->fileName."<br />".$this->filesize."<br />".$this->minetype."<br />".$this->originalName;
                $tmparr = explode(".", $this->originalName);
                array_shift($tmparr);
                $ret = array();
                foreach($tmparr as $arr) {
                        if (!preg_match("/\W/",$arr)) {
                                array_push($ret,$arr);
                        }
                }
                $this->ext = implode(".",$ret);

                return true;
        }

// get
        function getFileName() {
                return $this->fileName;
        }

        function getFilesize() {
                return $this->filesize;
        }

        function getMinetype() {
                return $this->minetype;
        }

        function getOriginalName() {
                return $this->originalName;
        }

        function getExt() {
                return $this->ext;
        }

// read file contents

        function readFile(){
                if (!is_readable($this->fileName)) return false;
                return file($this->fileName);
        }

// check

        function isAllowedImageSize() {
                
				if ( $this->maxImageWidth == 0 || $this->maxImageHight == 0) return true;
                $size = GetImageSize($this->fileName);
                
				if ( $size[0] > $this->maxImageWidth) return false;
                if ( $size[1] > $this->maxImageHight) return false;
                return true;
        }

        function isAllowedFileSize() {
                if ( $this->maxFilesize == 0) return true;
                if ( $this->filesize > $this->maxFilesize) return false;
                return true;
        }

        function isAllowedMineType(){
                				
        global $param;
			
			$mimetype = new mimetype();
		
			//foreach(explode(" ", $wfsConfig['selmimetype']) as $type)
				
				foreach(explode(" ", $param->selmimetype) as $type)
				if ($this->minetype == $mimetype->privFindType($type))
					return TRUE;												
				return false;

		}

        function isAllowedChars($distfilename) {
                if ( empty($this->allowedChars) ) return true;
                if ( preg_match("/".$this->allowedChars."/", $distfilename)) return false;
                return true;
        }

		// HTML
        function formStart($action="./", $name="", $extra="") {
                $ret= "<form enctype='multipart/form-data' method='post'";
                $ret.= " action='".$action."'";
                if(!empty($name)) $ret.= " name='".$name."'"." id='".$name."'";
                if(!empty($extra)) $ret.= " ".$extra;
                $ret.= ">";
                return $ret;
        }

        function formMax() {
                if(empty($this->maxFilesize)) return "";
                return "<input type='hidden' name='MAX_FILE_SIZE' value='".$this->maxFilesize."'>";
        }

        function formField() {
                return "<input type='file' name='".$this->fieldName."' id='".$this->fieldName."'>";
        }

        function formSubmit($value="UPLOAD", $name="", $extra=""){
                $ret= "<br /><input type='submit' value='".$value."'";
                if(!empty($name)) $ret.= " name='".$name."' id='".$name."'";
                if(!empty($extra)) $ret.= " ".$extra;
                $ret.= ">";
                return $ret;
        }

        function formEnd(){
                return "</form>";
        }

// upload

        function doUpload($distfilename) {
				Global $param;

				$this->setAllowedMinetype(array($param->selmimetype));
				
                if(!empty($this->errormsg)){
                    echo "<script>alert('$this->errormsg')</script>";
                    return false;
                }
				if (empty($this->fileName)) {
                    $men_erro=_MD_XMAIL_NOTFILENAME;
                    echo "<script>alert($men_erro)</script>";
                    return false;
                }
                if (!$this->isAllowedImageSize()) {
                    $men_erro=_MD_XMAIL_NOTSIZEIMAGE;
                    echo "<script>alert($men_erro)</script>";
                    return false;
                }

                if (!$this->isAllowedMineType()) {
                    $men_erro=_MD_XMAIL_FILENOTALLOW;
                    echo "<script>alert('$men_erro')</script>";
                    return false;
                }

                if (!empty($this->ext) && $this->addExt) $distfilename .= ".".$this->ext;
                if ($this->stripSpaces) $distfilename = preg_replace("/\s/","",$distfilename);
                if (!move_uploaded_file($this->fileName,$distfilename))  {
                    $men_erro=sprintf(_MD_XMAIL_FALHAMOVED,$distfilename);
                    echo "<script>alert('$men_erro')</script>";
                    return false;
                }
                				
				if (!empty($this->mode) && is_numeric($this->mode)) chmod($distfilename, octdec($this->mode)) ;
                    $this->fileName = $distfilename;

                return $distfilename;
        }

        function doUploadToRandumFile($distpath, $prefix="") {
                if (!is_dir($distpath) && !is_writable($distpath)) return false;
                if (!empty($this->ext) && $this->addExt) {
                        $ext = ".".$this->ext;
                } else {
                        $ext = "";
                }
                for($i=0; $i<10; $i++) {
                        $distfilename = $distpath."/".$prefix.mt_rand(100000,999999);
                        if (!file_exists($distfilename.$ext)) {
                                touch($distfilename.$ext);
                                return $this->doUpload($distfilename);
                        }
                }
                return false;
        }

        function doUploadImage($distpath, $filename="", $exti = "0") {
                											
				Global $wfsConfig, $xoopsModule;
						
				//if (!$this->isAllowedMineType()) return false;										
                //if (is_file($distpath."/".$this->originalName)) return false;
				if (empty($filename)) $filename = $this->originalName;
                $ext ="";
                
                $this->setAddExt($exti);
                return $this->doUpload($distpath."/".$filename.$ext);
        }
}

?>
