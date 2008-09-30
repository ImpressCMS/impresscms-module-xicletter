<?php
// $Id: convert.php,v 1.1 2006/03/23 20:26:01 claudia Exp $

class WfsConvert {

        function TextPlane($text) {
                $text = preg_replace("/[\s\t\n]{2,}/", " ", $text);
                return $text;
        }

        function TextHtml($text) {
                $text = preg_replace("/[\s\t\n]{2,}/", " ", $text);
                return $text;
        
        }
        
        function stripSpaces($text) {
                $ret = preg_replace("/[\s\t\n]{2,}/", " ", $text);
                return $ret;
        }

        function filenameForWin($text){
                return $text;
        }


}?>
