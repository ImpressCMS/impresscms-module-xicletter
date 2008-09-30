<?php

	if (!defined('XOOPS_ROOT_PATH')) exit();

	//mylinks-plugin
	$sql = "SELECT * FROM " . $xoopsDB -> prefix("mylinks_links") . " WHERE status = 1 ORDER BY lid DESC" ;
	$published_array = $xoopsDB -> query($sql);
	$anythingthere = $xoopsDB->getRowsNum($published_array);
	$html = '';
	
		if ($anythingthere >= 1) {

		$javascript = "onchange=\"document.forms[0].href.value = this.value;\"";
		$html .= "<tr class='mylinks'>";
		$html .= "<td class='label' valign='top' nowrap='nowrap'>{$lang_advlink_insert_link_links}</td>";
		$html .= "<td><select name='links' $javascript style='width:300px'><option value='' selected='selected'>{$lang_advlink_link_sellink}</option>";
			while ($published = $xoopsDB->fetchArray($published_array)) {
				$url = $published['url'];
    			$title = $published['title'];
				$html .= "<option value='".$url."'>". $title ."</option>";
			}
		$html .= "</select></td>";
		$html .= "</tr>";
		return $html;
		} else {
			$html = '';
			return $html;
		}

?>