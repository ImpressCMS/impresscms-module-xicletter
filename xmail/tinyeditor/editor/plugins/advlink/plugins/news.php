<?php

	if (!defined('XOOPS_ROOT_PATH')) exit();

	//news-plugin
	if (file_exists(XOOPS_ROOT_PATH . "/modules/news/class/class.newsstory.php") && class_exists('NewsStory')) {
		include_once XOOPS_ROOT_PATH . "/modules/news/class/class.newsstory.php";
		$html1 = '';
		$html2 = '';
		
		$storyarray = NewsStory :: getAllPublished(10, 0, false, 0, 1 );
		$javascript1 = "onchange=\"document.forms[0].href.value = this.value;\"";
		$html1 .= '<tr>';
		$html1 .= '<td class="label" valign="top" nowrap="nowrap">{$lang_advlink_insert_link_news}</td>';
		$html1 .= "<td><select name=\"stories\" $javascript1 style=\"width:300px\"><option value=\"\" selected=\"\">{$lang_advlink_insert_link_selstory}</option>";
			foreach( $storyarray as $eachstory ) {
				$html1 .= "<option value=\"" . XOOPS_URL . "/modules/news/article.php?storyid=". $eachstory -> storyid() ." \">" . $eachstory -> title() . "</option>";
			}
		$html1 .= "</select></td></tr>";
		return $html1;

		$sql = "SELECT * FROM " . $xoopsDB -> prefix("topics") . " ORDER BY topic_id DESC" ;
		$published_array = $xoopsDB -> query($sql);
		$javascript2 = "onchange=\"document.forms[0].href.value = this.value;\"";
		$html2 .= '<tr>';
		$html2 .= '<td class="label" valign="top" nowrap="nowrap"></td>';
		$html2 .= "<td><select name=\"topics\" $javascript2 style=\"width:300px\"><option value=\"\" selected=\"selected\">{$lang_advlink_insert_link_seltopic}</option>";
			while ($published = $xoopsDB -> fetchArray($published_array)) {
				$id = $published['topic_id'];
    			$title = $published['topic_title'];
				$html2 .= "<option value=\"" . XOOPS_URL . "/modules/news/index.php?storytopic=". $id ." \">". $title ."</option>";
			}
		$html2 .= "</select></td></tr>";
		return $html2;
	} else {
		$html = '';
		return $html;
	}

?>