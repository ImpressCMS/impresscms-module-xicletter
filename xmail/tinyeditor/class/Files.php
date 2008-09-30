<?php 
/**
 * File Utilities.
 * @author $Author: frankblacksf $
 * @version $Id: Files.php,v 1.1 2006/04/08 15:09:32 frankblacksf Exp $
 * @package ImageManager
 */


	if (file_exists('../xrmanager/xrincludes.php')) {
		include_once '../xrmanager/xrincludes.php';
	} else if (file_exists('../xrincludes.php')) {
		include_once '../xrincludes.php';
	} else {
		die('No xrincludes in Files.php');
	}

	if ($moduleConfig['tinyedmgrftp'] == 1) {
		if (!defined('TINY_FTPSERVER') || !defined('TINY_FTPUSER') || !defined('TINY_FTPPASS'))
			include XOOPS_ROOT_PATH.'/modules/tinyeditor/include/ftpconfig.php';
		if (TINY_FTPSERVER == '' || TINY_FTPUSER == '' || TINY_FTPPASS == '')
			exit(_AM_TINYED_STATSMISSFTP);
	}

	include XOOPS_ROOT_PATH.'/modules/tinyeditor/include/tinyperm.php';

	// only users with WYSIWYG and xrmanager rights are allowed to use this file 
	if ($gperm_handler->checkRight('TinyPerm', 3, $groups, $module_id) && $gperm_handler->checkRight('TinyPerm', 17, $groups, $module_id)) {

	define('FILE_ERROR_NO_SOURCE', 100);
	define('FILE_ERROR_COPY_FAILED', 101);
	define('FILE_ERROR_DST_DIR_FAILED', 102);
	define('FILE_COPY_OK', 103);
	define('FILE_RENAME_COPY_FAILED', 104);

/**
 * File Utilities
 * @author $Author: frankblacksf $
 * @version $Id: Files.php,v 1.1 2006/04/08 15:09:32 frankblacksf Exp $
 * @package ImageManager
 * @subpackage files
 */
class Files {
	
	/**
	 * Copy a file from source to destination. If unique == true, then if
	 * the destination exists, it will be renamed by appending an increamenting 
	 * counting number.
	 * @param string $source where the file is from, full path to the files required
	 * @param string $destination_file name of the new file, just the filename
	 * @param string $destination_dir where the files, just the destination dir,
	 * e.g., /www/html/gallery/
	 * @param boolean $unique create unique destination file if true.
	 * @return string the new copied filename, else error if anything goes bad.
	 * FTP-support added by frankblack
	 */
	function copyFile($source, $destination_dir, $destination_file, $unique=true) {
		global $moduleConfig, $groups, $module_id, $xoopsUser;
		if (!(file_exists($source) && is_file($source))) 
			return FILE_ERROR_NO_SOURCE;

		$destination_dir = Files::fixPath($destination_dir);

		if (!is_dir($destination_dir)) 
			return FILE_ERROR_DST_DIR_FAILED;

		$filename = Files::escape($destination_file);

		if ($unique) {
			$dotIndex = strrpos($destination_file, '.');
			$ext = '';
			if (is_int($dotIndex)) {
				$ext = substr($destination_file, $dotIndex);
				$base = substr($destination_file, 0, $dotIndex);
			}
			$counter = 0;
			while (is_file($destination_dir.$filename)) {
				$counter++;
				$filename = $base.'_'.$counter.$ext;
			}
		}

		if ($moduleConfig['tinyedmgrftp'] == 0) {
				if (!copy($source, $destination_dir.$filename))
					return FILE_ERROR_COPY_FAILED;
		} else {
			include_once TINY_ROOT_PATH.'class/ftpclass.php';

			$destination_dir = str_replace(XOOPS_ROOT_PATH.'/', '', $destination_dir);
			$destination_dir = TINY_FTPOPTPATH.$destination_dir;

			$ftp = new ftp();
			if (checkRightTiny('TinyPerm', 18, $groups, $module_id) && !$xoopsUser->isAdmin($module_id))
				$ftp->debug = TRUE;
			$ftp->ftpConnect(TINY_FTPSERVER);
			$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
			$ftp->ftpPut($destination_dir.$filename, $source, 1);
			$ftp->ftpClose();
		}
		
		//verify that it copied, new file must exists
		if (is_file($destination_dir.$filename))
			return $filename;
		else
			return FILE_ERROR_COPY_FAILED;
	}

	/*
	 * Rename a file
	 * Performs basic text sanitize
	 * Added by ralf57
	 * TODO FTP-support added by frankblack
	 */

	function renameFile($source, $path, $oldname, $newname) {	
		if (!(file_exists($source) && is_file($source))) 
			return FILE_ERROR_NO_SOURCE;

		$newname = Files::escape($newname);

		$dotIndex_old = strrpos($oldname, '.');
		$ext_old = '';
		
		if (is_int($dotIndex_old)) {
			$ext_old = substr($oldname, $dotIndex_old);
			$base_old = substr($oldname, 0, $dotIndex_old);
		}
		
		$filename = $newname.$ext_old;

		if ($filename != $oldname) {
			if (!rename($source, $path.$filename))
				return FILE_RENAME_COPY_FAILED;

			//verify that it copied, new file must exists
			if (is_file($path.$filename)) {
				return $filename;
			} else {
				return FILE_ERROR_COPY_FAILED;
			}
		}

	}
	
	/**
 		 * Copy a file, or recursively copy a folder and its contents
 		 * @author      Aidan Lister <aidan@php.net>
 		 * @author      Paul Scott
 		 * @version     1.0.1
 		 * @param       string   $source    Source path
 		 * @param       string   $dest      Destination path
 		 * @return      bool     Returns TRUE on success, FALSE on failure
 		 */

	function copyFolder($source, $dest) {
		global $moduleConfig, $groups, $module_id, $xoopsUser;
		// Simple copy for a file
		if (is_file($source)) {
			if ($moduleConfig['tinyedmgrftp'] == 0) {
					return copy($source, $dest);
			} else {
				include_once TINY_ROOT_PATH.'class/ftpclass.php';
				$source = str_replace('//', '/', $source);
				$dest = str_replace('//', '/', $dest);
				$dest = str_replace(XOOPS_ROOT_PATH.'/', '', $dest);
				$dest = TINY_FTPOPTPATH.$dest;
				
				$ftp = new ftp();
				if (checkRightTiny('TinyPerm', 18, $groups, $module_id) && !$xoopsUser->isAdmin($module_id))
					$ftp->debug = TRUE;
				$ftp->ftpConnect(TINY_FTPSERVER);
				$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
				$ftp->ftpPut($dest, $source, 1);
				$ftp->ftpClose();
			}
		}

		// Make destination directory
		if (!is_dir($dest) && !is_file($source)) {
			if ($moduleConfig['tinyedmgrftp'] == 0) {
				mkdir($dest);
				@chmod($dest, 0777);
			} else {
				include_once TINY_ROOT_PATH.'class/ftpclass.php';
				$dest = str_replace(XOOPS_ROOT_PATH.'/', '', $dest);
				$ftp = new ftp();
				if (checkRightTiny('TinyPerm', 18, $groups, $module_id))
					$ftp->debug = TRUE;
				$ftp->ftpConnect(TINY_FTPSERVER);
				$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
				$ftp->ftpMkdir(TINY_FTPOPTPATH.$dest);
				$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATH.$dest.'');
				$ftp->ftpClose();
			}
		}

		// Loop through the folder
		if (!is_file($source)) {
			$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			// Deep copy directories
			if ($dest !== "$source/$entry") {
				Files::copyFolder("$source/$entry", "$dest/$entry");
			}
		}
		// Clean up
		$dir->close();
		}
		return true;
	}

	/**
	 * Create a new folder.
	 * @param string $newFolder specifiy the full path of the new folder.
	 * @return boolean true if the new folder is created, false otherwise.
	 * FTP-support added by frankblack
	 */
	function createFolder($newFolder) {
		global $moduleConfig, $groups, $module_id, $xoopsUser;

		if ($moduleConfig['tinyedmgrftp'] == 0) {
			@mkdir ($newFolder, 0777);
			return @chmod($newFolder, 0777);
		} else {
			include_once TINY_ROOT_PATH.'class/ftpclass.php';
			$newFolder = str_replace(XOOPS_ROOT_PATH.'/', '', $newFolder);
			$ftp = new ftp();
			if (checkRightTiny('TinyPerm', 18, $groups, $module_id))
				$ftp->debug = TRUE;
			$ftp->ftpConnect(TINY_FTPSERVER);
			$ftp->ftpLogin(TINY_FTPUSER, TINY_FTPPASS);
			$ftp->ftpMkdir(TINY_FTPOPTPATH.$newFolder);
			$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATH.$newFolder.'');
			$ftp->ftpClose();
			return true;	
		}
	}


	/**
	 * Escape the filenames, any non-word characters will be
	 * replaced by an underscore.
	 * @param string $filename the orginal filename
	 * @return string the escaped safe filename
	 */
	function escape($filename) {
		return preg_replace('/[^\w\._]/', '_', $filename);
	}

	/**
	 * Delete a file.
	 * @param string $file file to be deleted
	 * @return boolean true if deleted, false otherwise.
	 */
	function delFile($file) {
		
		if (is_file($file)) {
				return @unlink($file);
		} else {
			return false;
		}
	}

	/**
	 * Delete folder(s), can delete recursively.
	 * @param string $folder the folder to be deleted.
	 * @param boolean $recursive if true, all files and sub-directories
	 * are delete. If false, tries to delete the folder, can throw
	 * error if the directory is not empty.
	 * @return boolean true if deleted.
	 */
	function delFolder($folder, $recursive=false) {

		$deleted = true;
		if ($recursive) {
			$d = dir($folder);
			while (false !== ($entry = $d->read())) {
				if ($entry != '.' && $entry != '..') {
					$obj = Files::fixPath($folder).$entry;
					if (is_file($obj)) {
						$deleted &= Files::delFile($obj);					
					} else if(is_dir($obj)) {
						$deleted &= Files::delFolder($obj, $recursive);
					}		
				}
			}
			$d->close();
		}

		if (is_dir($folder)) 
				$deleted &= @rmdir($folder);
		else
			$deleted &= false;

		return $deleted;
	}

	/**
	 * Append a / to the path if required.
	 * @param string $path the path
	 * @return string path with trailing /
	 */
	function fixPath($path) {
		//append a slash to the path if it doesn't exists.
		if (!(substr($path,-1) == '/'))
			$path .= '/';
		return $path;
	}

	/**
	 * Concat two paths together. Basically $pathA+$pathB
	 * @param string $pathA path one
	 * @param string $pathB path two
	 * @return string a trailing slash combinded path.
	 */
	function makePath($pathA, $pathB) {
		$pathA = Files::fixPath($pathA);
		if (substr($pathB,0,1)=='/')
			$pathB = substr($pathB,1);
		return Files::fixPath($pathA.$pathB);
	}

	/**
	 * Similar to makePath, but the second parameter
	 * is not only a path, it may contain say a file ending.
	 * @param string $pathA the leading path
	 * @param string $pathB the ending path with file
	 * @return string combined file path.
	 */
	function makeFile($pathA, $pathB) {		
		$pathA = Files::fixPath($pathA);
		if (substr($pathB,0,1)=='/')
			$pathB = substr($pathB,1);
		
		return $pathA.$pathB;
	}

	
	/**
	 * Format the file size, limits to Mb.
	 * @param int $size the raw filesize
	 * @return string formated file size.
	 */
	function formatSize($size) {
		if ($size < 1024) 
			return $size.' bytes';	
		else if ($size >= 1024 && $size < 1024*1024) 
			return sprintf('%01.2f',$size/1024.0).' Kb';	
		else
			return sprintf('%01.2f',$size/(1024.0*1024)).' Mb';	
	}
}

	} else {
		die(_NOPERM);
	}
?>