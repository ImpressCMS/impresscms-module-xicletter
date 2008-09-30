<?php

function iconLookup($mime,$ext) {

	$mimeIcons=array(
			"image"=>"image.jpg",
			"audio"=>"sound.jpg",
			"video"=>"video.jpg",
			"text"=>"document2.gif",
			"text/html"=>"html.jpg",
			"application"=>"binary.jpg",
			"application/pdf"=>"pdf.jpg",
			"application/msword"=>"document2.gif",
			"application/postscript"=>"postscript.jpg",
			"application/rtf"=>"document2.gif",
			"application/vnd.ms-excel"=>"document2.gif",
			"application/vnd.ms-powerpoint"=>"document2.gif",
			"application/x-tar"=>"tar.jpg",
			"application/zip"=>"tar.jpg",
			"application/x-zip"=>"tar.jpg",
			"message"=>"email.jpg",
			"message/html"=>"html.jpg",
			"model"=>"kmplot.jpg",
			"multipart"=>"kmultiple.jpg"
			);
	
	$extIcons=array(
			"pdf"=>"pdf.jpg",
			"ps"=>"postscript.jpg",
			"eps"=>"postscript.jpg",
			"ai"=>"postscript.jpg",
			"ra"=>"real_doc.jpg",
			"rm"=>"real_doc.jpg",
			"ram"=>"real_doc.jpg",
			"wav"=>"sound.jpg",
			"mp3"=>"sound.jpg",
			"ogg"=>"sound.jpg",
			"eml"=>"email.jpg",
			"tar"=>"tar.jpg",
			"zip"=>"tar.jpg",
			"bz2"=>"tar.jpg",
			"tgz"=>"tar.jpg",
			"gz"=>"tar.jpg",
			"rar"=>"tar.jpg",
			"avi"=>"video.jpg",
			"mpg"=>"video.jpg",
			"mpeg"=>"video.jpg",
			"jpg"=>"image.jpg",
			"gif"=>"image.jpg",
			"png"=>"image.jpg",
			"jpeg"=>"image.jpg",
			"nfo"=>"info.jpg",
			"xls"=>"spreadsheet.jpg",
			"csv"=>"spreadsheet.jpg",
			"html"=>"html.jpg",
			"doc"=>"document2.gif",
			"rtf"=>"document2.gif",
			"txt"=>"document2.gif",
			"xla"=>"document2.gif",
			"xlc"=>"document2.gif",
			"xlt"=>"document2.gif",
			"xlw"=>"document2.gif",
			"txt"=>"document2.gif"
			);

	if ( $mime!=null && $mime!="text/plain" ) {
		//Check specific cases
		$mimes=array_keys($mimeIcons);
		if (in_array($mime,$mimes)) {
			return $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."/images/mimes/".$mimeIcons[$mime];
		} else {
			//Check for the generic mime type
			$mimePrefix="text";
			$firstSlash=strpos($mime,"/"); 
			if ($firstSlash!==false) $mimePrefix=substr($mime,0,$firstSlash);
			
			if (in_array($mimePrefix,$mimes)) {
				return $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."/images/mimes/".$mimeIcons[$mimePrefix];
			} else {
				return $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."/images/mimes/empty.jpg";	
			}
		}
	} else {
		$extensions = array_keys($extIcons);
		if (in_array($ext, $extensions)) {
			return XOOPS_URL."/modules/tinyeditor/xrmanager/images/mimes/".$extIcons[$ext];
		} else {
			return XOOPS_URL."/modules/tinyeditor/xrmanager/images/mimes/empty.jpg";
		}
	}
	//return XOOPS_URL."/modules/tinyeditor/xrmanager/images/mimes/empty.jpg";
}

?>