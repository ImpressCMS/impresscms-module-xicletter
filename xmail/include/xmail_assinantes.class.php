<?php
/*
* $Id: include/xmail_assinantes.class.php
* Module: XMAIL
** Version: v2.52
* Release Date: 16 de novembro de 2007
* Author: Claudia Antonini Vitiello Callegari   Gilberto G. de Oliveira (Giba) 
* License: GNU
*/

require_once(XOOPS_ROOT_PATH."/modules/$admin_mydirname/include/manut.class.php");
class class_assinantes extends manut_class
{
	function class_assinantes($id=null){
		$this->db =& Database::getInstance();
		$this->tabela = $this->db->prefix('xmail_newsletter');
		$this->id = "user_id";
		$this->initVar("user_id", XOBJ_DTYPE_INT, null, false);
		$this->initVar("user_name", XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("user_nick", XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("user_email", XOBJ_DTYPE_EMAIL, null, false);
		$this->initVar("user_conf", XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("confirmed", XOBJ_DTYPE_INT, null, false);
		$this->initVar("user_time", XOBJ_DTYPE_INT, null, false);
		$this->initVar("user_host", XOBJ_DTYPE_TXTBOX, null, false);

		if ( !empty($id) ) {
			if ( is_array($id) ) {
				$this->assignVars($id);
			} else {
				$this->load(intval($id));
			}
		}
	}

	function validar(){
		return true;
	}

}