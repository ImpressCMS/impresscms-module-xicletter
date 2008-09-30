<?php
/*
* $Id: include/manut.class.php
* Module: xmail
* Version:
* Release Date: novembro de 2007
*/

### =============================================================
### Developer: Fábio Egas e Fernando Santos
### Copyright: Mastop InfoDigital © 2003-2007
### -------------------------------------------------------------
### Classe MÃE
### =============================================================

### Implementações:  Claudia A. V. Callegari


include_once XOOPS_ROOT_PATH."/class/xoopsobject.php";
if (!class_exists('manut_class')) {
	class manut_class extends XoopsObject
	{
		var $db;
		var $tabela;
		var $id;
		var $total=0;
		var $afetadas=0;
		//Implementação Claudia
		var $id_is_string=0;  // 0(não)  ou 1(sim)  Indica que o campo do id é string

		// construtor da classe
		function manut_class()
		{
			// Não usado diretamente
		}

		function store()
		{
			if ( !$this->cleanVars() ) {
				return false;
			}

			// trecho inserido por Claudia
			if(!$this->validar()){
				//$this->setErrors("Erro na validação:<br />");
				return false;
			}

			if(method_exists($this,'atualiza_log')){
				if(!$this->atualiza_log()){
					$this->setErrors('Erro na atualização do log');
					return false;
				}
			}else {
				//echo 'não existe o metodo atualiza_log'	;
			}
			//  fim do trecho



			$myts =& MyTextSanitizer::getInstance();
			foreach ( $this->cleanVars as $k=>$v ) {
				$indices[] = $k;
				$valores[] = $v;
				//$$k = $v;
			}
			if (is_null($this->getVar($this->id)) || $this->getVar($this->id) == 0) {
				$sql = "INSERT INTO ".$this->tabela." (";
				$sql .= implode(",", $indices);
				$sql .= ") VALUES (";
				for ($i = 0; $i<count($valores); $i++){
					if(!is_int($valores[$i])){
						$sql .= $this->db->quoteString($valores[$i]);
					}else{
						$sql .= $valores[$i];
					}
					if ($i != (count($valores)-1)) {
						$sql .= ",";
					}
				}
				$sql .= ")";
			}else {
				$sql ="UPDATE ".$this->tabela." SET ";
				for ($i = 1; $i<count($valores); $i++){
					$sql .= $indices[$i]."=";
					if(!is_int($valores[$i])){
						$sql .= $this->db->quoteString($valores[$i]);
					}else{
						$sql .= $valores[$i];
					}
					if ($i != (count($valores)-1)) {
						$sql .= ",";
					}
				}
				//$sql .= " WHERE ".$this->id." = ".$this->getVar($this->id);
				// implementação Claudia
				$sql .= " WHERE ".$this->id." = ";
				if($this->id_is_string){
					$sql.="'".$this->getVar($this->id)."'";
				}else{
					$sql.=$this->getVar($this->id);
				}





			}
			//echo $sql;
			$result = $this->db->query($sql);
			$this->afetadas = $this->db->getAffectedRows();
			if (!$result) {
				$this->setErrors("Erro ao gravar dados na Base de Dados. <br />".$this->db->error());
				return false;
			}
			if (is_null($this->getVar($this->id)) || $this->getVar($this->id) == 0) {
				$this->setVar($this->id, $this->db->getInsertId());
				return $this->db->getInsertId();
			}
			return $this->getVar($this->id);
		}

		function atualizaTodos($campo, $valor, $criterio = null)
		{
			$set_clause = is_numeric($valor) ? $campo.' = '.$valor : $campo.' = '.$this->db->quoteString($valor);
			$sql = 'UPDATE '.$this->tabela.' SET '.$set_clause;
			if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
				$sql .= ' '.$criterio->renderWhere();
			}
			if (!$result = $this->db->query($sql)) {
				return false;
			}
			return true;
		}

		function delete()
		{
			$sql = sprintf("DELETE FROM %s WHERE ".$this->id." = %u", $this->tabela, $this->getVar($this->id));
			if ( !$this->db->query($sql) ) {
				return false;
			}
			$this->afetadas = $this->db->getAffectedRows();
			return true;
		}

		function deletaTodos($criterio = null)
		{
			$sql = 'DELETE FROM '.$this->tabela;
			if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
				$sql .= ' '.$criterio->renderWhere();
			}
			if (!$result = $this->db->query($sql)) {
				return false;
			}
			$this->afetadas = $this->db->getAffectedRows();
			return true;
		}

		function load($id)
		{
			$sql = "SELECT * FROM ".$this->tabela." WHERE ".$this->id."=".$id." LIMIT 1";
			$myrow = $this->db->fetchArray($this->db->query($sql));
			if (is_array($myrow) && count($myrow) > 0) {
				$this->assignVars($myrow);
				return true;
			}else{
				return false;
			}
		}

		function pegaTudo($criterio=null, $objeto=true, $join = null)
		{
			$ret = array();
			$limit = $start = 0;
			$classe = get_class($this);
			if ( !$objeto ) {
				$sql = 'SELECT '.$this->id.' FROM '.$this->tabela;
				if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
					$sql .= ' '.$criterio->renderWhere();
					if ($criterio->getSort() != '') {
						$sql .= ' ORDER BY '.$criterio->getSort().' '.$criterio->getOrder();
					}
					$limit = $criterio->getLimit();
					$start = $criterio->getStart();
				}
				$result = $this->db->query($sql, $limit, $start);
				$this->total = $this->db->getRowsNum($result);
				if ($this->total > 0){
					while ( $myrow = $this->db->fetchArray($result) ) {
						$ret[] = $myrow[$this->id];
					}
					return $ret;
				}else{
					return false;
				}
			} else {
				$sql = 'SELECT '.$this->tabela.'.* FROM '.$this->tabela.((!empty($join))? " ".$join : "");
				if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
					$sql .= ' '.$criterio->renderWhere();
					if ($criterio->getSort() != '') {
						$sql .= ' ORDER BY '.$criterio->getSort().' '.$criterio->getOrder();
					}
					$limit = $criterio->getLimit();
					$start = $criterio->getStart();
				}
				$result = $this->db->query($sql, $limit, $start);
				$this->total = $this->db->getRowsNum($result);
				if ($this->total > 0){
					while ( $myrow = $this->db->fetchArray($result) ) {
						$ret[] = new $classe($myrow);
					}
					return $ret;
				}else{
					return false;
				}
			}
		}


		function contar($criterio=null){
			$sql = 'SELECT COUNT(*) FROM '.$this->tabela;
			if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
				$sql .= ' '.$criterio->renderWhere();
			}
			$result = $this->db->query($sql);
			if (!$result) {
				return 0;
			}
			list($count) = $this->db->fetchRow($result);
			return $count;
		}

		function soma($criterio=null, $campo){
			$sql = 'SELECT SUM('.$campo.') FROM '.$this->tabela;
			if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
				$sql .= ' '.$criterio->renderWhere();
			}
			$result = $this->db->query($sql);
			if (!$result) {
				return 0;
			}
			list($soma) = $this->db->fetchRow($result);
			return $soma;
		}

		// Retorna a paginação pronta
		function paginar($link, $criterio=null, $precrit_url=null){
			$ret = '';
			$order = 'ASC';
			$sort = $this->id;
			if (isset($criterio) && is_subclass_of($criterio, 'criteriaelement')) {
				$limit = $criterio->getLimit();
				$start = $criterio->getStart();
				if ($criterio->getSort() != '') {
					$order = $criterio->getOrder();
					$sort = $criterio->getSort();
				}
			}else{
				$limit = 15;
				$start = 0;
			}
			$todos = $this->contar($criterio);
			$total = ($todos % $limit == 0) ? ($todos/$limit) : intval($todos/$limit)+1;
			$pg = ($start) ? intval($start/$limit)+1 : 1;
			$ret.= (!empty($_GET['busca'])) ? "<input type=button value='"._ALL."' onclick=\"document.location= '".$_SERVER['PHP_SELF']."?limit=".$limit."&order=".$order."&sort=".$sort."&op=".$GLOBALS["op"].$precrit_url."'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			for($i=1;$i<=($total);$i++ )
			{
				$start = $limit * ($i-1);
				if($i == $pg){
					$ret .=  "<span style='font-weight: bold; color: #CF0000; font-size: 15px;'> $i </span>";
				}elseif(($pg - 10) > $i){
					if (!isset($pg1)) {
						$ret .= ("<A HREF='".$link."&start=".$start."'>1</a>. . .");
						$pg1 = true;
					}
					continue;
				}elseif ($i < ($pg + 10)){
					$ret .= (" <A HREF='".$link."&start=".$start."'>".$i."</a> ");
				}else{
					$ret .= (". . . <A HREF='".$link."&start=".(($todos % $limit == 0) ? $todos - $limit : $todos-($todos % $limit))."'>".$total."</a>");
					break;
				}
				if( $i!=$total ){
					$ret .= ("|");
				}
			}
			return $ret;
		}
		//  funções abaixo  inseridas  por Claudia
		/**
	 * Inserida por Claudia A. V. Callegari
	 *  
	 * @param   $antes get_object_vars($objeto) objeto convertido em array
	 * @param  $depois get_object_vars($this)   objeto convertido em array
	 * @param  $lista_campos  array com lista de campos da tabela (deveria ser o titulo do campo )
	 * @return string com a lista do que alterou
	 */

		function veri_alter($antes,$depois,$lista_campos) {

			for($i=0;$i<=count($lista_campos);$i++) {
				//         $vr_antes=trim($antes[$lista_campos[$i]['campo']]);
				//         $vr_depois=trim($depois[$lista_campos[$i]['campo']]);
				$vr_antes=stripslashes(trim($antes['vars'][$lista_campos[$i]['campo']]['value']  ));
				$vr_depois=stripslashes(trim($depois['cleanVars'][$lista_campos[$i]['campo']]));


				if($vr_antes!=$vr_depois)
				$obs.="\n ".$lista_campos[$i]['descri']." alterou de :$vr_antes para: $vr_depois";
			}

			// inserido as duas linhas abaixo, para não dar erro quando tem apóstrole no conteúdo
			$obs=stripslashes($obs);
			$obs=addslashes($obs);

			return $obs ;
		}



		/**
 * Verificar se o valor $x é inteiro ou não
 *
 * @param unknown_type $x
 * @return unknown
 */

		function myIsInt($x) {
			return ( is_numeric ($x ) ?  intval(0+$x ) ==  $x  :  false );
		}


		/**
 *  verificar valores digitados em forms
 *  $par=1, checa o valor , retornando falso ou verdadeiro
 *  $par=2 , checa o valor  e retorna o valor corrigido
 *
 * @param unknown_type $valor
 * @param unknown_type $par
 * @param unknown_type $men
 * @return unknown
 */

		function checa_val($valor,$par=1) {

			if (((substr_count($valor,".")>0 and  substr_count($valor,",")>0))  or
			(substr_count($valor,".")>1) or  (substr_count($valor,",")>1)  ) {
				if($par==1)
				return false;

			}
			$valor= str_replace(",",".",$valor);
			if(!is_numeric($valor)) {
				return false;
			}

			if($par==1)
			return true;
			else
			return $valor;
		}
		/**
  * converte data no formato YYYY-MM-AA  para formato unixtime
  *
  * @param string  $data
  * @return int  - data formato unixtime
  */

		function data2u($data){

			$a= ereg('([0-9]{4})([-.\/])([0-9]{2})([-.\/])([0-9]{2})',$data,$datadiv);
			if(!$a) {
				return false;
			}
			$dia=$datadiv[5]; $mes=$datadiv[3] ; $ano=$datadiv[1];
			if(checkdate($mes,$dia,$ano)){
				$data2=mktime(0,0,0,$mes,$dia,$ano);
				return $data2;
			}else{
				return false;
			}



		}



	}
}