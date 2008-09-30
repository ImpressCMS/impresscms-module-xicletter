<?php

	if (!defined('XOOPS_ROOT_PATH')) exit();

	//wf-downloads-plugin

	$sql = "SELECT * FROM " . $xoopsDB -> prefix("wfdownloads_downloads") . " WHERE published > 0 AND expired = 0 AND offline = 0 ORDER BY lid DESC" ;
	$published_array = $xoopsDB -> query($sql);
	$wfdownloadsthere = $xoopsDB->getRowsNum($published_array);
	$html = '';
	
		if ($wfdownloadsthere >= 1) {
			$javascript = "onchange=\"document.forms[0].href.value = this.value;\"";
			$html .= "<tr>";
			$html .= "<td class='label' valign='top' nowrap='nowrap'>{$lang_advlink_insert_link_downs}</td>";
			$html .= "<td><select name='downloads' $javascript style='width:300px'><option value='' selected='selected'>{$lang_advlink_insert_link_selfile}</option>";
				while ($published = $xoopsDB -> fetchArray($published_array)) {
					$lid = $published['lid'];
    				$cid = $published['cid'];
    				$title = $published['title'];
					$html .= "<option value='" . XOOPS_URL . "/modules/wfdownloads/visit.php?cid=". $cid ."&amp;lid=". $lid." '>". $title ."</option>";
				}
			$html .= "</select></td>";
			$html .= "</tr>";
			return $html;
		} else {
			$html = '';
			return $html;
		}
	
?>