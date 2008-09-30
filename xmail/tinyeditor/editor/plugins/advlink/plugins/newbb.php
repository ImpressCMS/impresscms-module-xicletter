<?php

	if (!defined('XOOPS_ROOT_PATH')) exit();

	//newbb-plugin

	$sql = "SELECT * FROM " . $xoopsDB -> prefix("bb_forums") . " ORDER BY cat_id ASC" ;
	$published_array = $xoopsDB -> query($sql);
	$anythingthere = $xoopsDB->getRowsNum($published_array);
	$html = '';
	
		if ($anythingthere >= 1) {
			$javascript = "onchange=\"document.forms[0].href.value = this.value;\"";
			$html .= '<tr>';
			$html .= '<td class="label" valign="top" nowrap="nowrap">{$lang_advlink_insert_link_forums}</td>';			
			$html .= "<td><select name=\"forums\" $javascript style=\"width:300px\"><option value=\"\" selected=\"selected\">{$lang_advlink_insert_link_selforum}</option>";
				while ($published = $xoopsDB -> fetchArray($published_array)) {
					$id = $published['forum_id'];
    				$title = $published['forum_name'];
					$html .= "<option value=\"" . XOOPS_URL . "/modules/newbb/viewforum.php?forum=". $id ."\">". $title ."</option>";
				}
			$html .= "</select></td></tr>";
			return $html;
		} else {
			$html = '';
			return $html;
		}
	
?>