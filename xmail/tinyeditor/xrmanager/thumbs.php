<?php
/**
 * On the fly Thumbnail generation.
 * Creates thumbnails given by thumbs.php?img=/relative/path/to/image.jpg
 * relative to the base_dir given in config.inc.php
 * @author $Author: frankblacksf $
 * @version $Id: thumbs.php,v 1.2 2006/04/20 16:17:48 frankblacksf Exp $
 * @package ImageManager
 * Modified by ralf57 for TinyEditor 1.0
 */

	include "xrincludes.php";
	if (!defined('XOOPS_ROOT_PATH')) 
		die("XOOPS root path not defined");

	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {

		require_once TINY_ROOT_PATH.'include/config.inc.php';
		require_once TINY_ROOT_PATH.'class/XRManager.php';
		require_once TINY_ROOT_PATH.'class/Thumbnail.php';

		//check for img parameter in the url
		if (!isset($_GET['img'])) exit();

		$manager = new ResourceManager($IMConfig);

		//get the image and the full path to the image
		$image = rawurldecode($_GET['img']);
		$fullpath = Files::makeFile($manager->getBaseDir(),$image);

		//not a file, so exit
		if (!is_file($fullpath))
			exit();

		$imgInfo = @getImageSize($fullpath);

		//Not an image, send default thumbnail
		if (!is_array($imgInfo)) {
			//show the default image, otherwise we quit!
			$default = $manager->getDefaultThumb();
			if ($default) {
				header('Location: '.$default);
				exit();
			}
		}

		//if the image is less than the thumbnail dimensions
		//send the original image as thumbnail
		if ($imgInfo[0] <= $IMConfig['thumbnail_width'] && $imgInfo[1] <= $IMConfig['thumbnail_height']) {
			header('Location: '.$manager->getFileURL($image));
			exit();
		}

		//Check for thumbnails
		//modified by ralf57
		$thumbnail = $manager->getThumbName($fullpath);
		$thumbInfo = @getImageSize($thumbnail);

		if (is_file($thumbnail)) {
			if (($thumbInfo[0] == $this->config['thumbnail_width'] || $thumbInfo[1] == $this->config['thumbnail_height']) && filemtime($thumbnail) >= filemtime($fullpath)) {
				header('Location: '.$manager->getThumbURL($image));
				exit();
			}
		}

		//creating thumbnails

		$thumbnailer = new Thumbnail($IMConfig['thumbnail_width'],$IMConfig['thumbnail_height']);
		$thumbnailer->createThumbnail($fullpath, $thumbnail);

		//Check for NEW thumbnails
		if (is_file($thumbnail)) {
			//send the new thumbnail
			header('Location: '.$manager->getThumbURL($image));
			exit();
		} else {
			//show the default image, otherwise we quit!
			$default = $manager->getDefaultThumb();
			if ($default)
				header('Location: '.$default);
		}
	} else {
		die(_NOPERM);
	}
?>