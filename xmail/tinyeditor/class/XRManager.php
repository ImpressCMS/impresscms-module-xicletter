<?php
/**
 * ImageManager, list images, directories, and thumbnails.
 * @author $Author: frankblacksf $
 * @version $Id: XRManager.php,v 1.1 2006/04/08 15:09:32 frankblacksf Exp $
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
			include TINY_ROOT_PATH.'include/ftpconfig.php';
		if (TINY_FTPSERVER == '' || TINY_FTPUSER == '' || TINY_FTPPASS == '')
			exit(_AM_TINYED_STATSMISSFTP);
	}

	include_once TINY_ROOT_PATH.'include/functions.php';

	require_once TINY_ROOT_PATH.'class/Files.php';

	require_once TINY_ROOT_PATH.'class/Transform.php';

	/**
	 * ImageManager Class.
	 * @author $Author: frankblacksf $
	 * @version $Id: XRManager.php,v 1.1 2006/04/08 15:09:32 frankblacksf Exp $
	 */
	class ResourceManager {
		/**
		 * Configuration array.
		 */
		var $config;

		/**
		 * Array of directory information.
		 */
		var $dirs;

		/**
		 * Constructor. Create a new Image Manager instance.
		 * @param array $config configuration array, see config.inc.php
		 */
		function ResourceManager($config) {
			$this->config = $config;
		}

		/**
		 * Get the base directory.
		 * @return string base dir, see config.inc.php
		 */
		function getBaseDir() {
			return $this->config['base_dir'];
		}

		/**
		 * Get the base URL.
		 * @return string base url, see config.inc.php
		 */
		function getBaseURL() {
			return $this->config['base_url'];
		}

		function isValidBase() {
			return is_dir($this->getBaseDir());
		}

		/**
		 * Get the tmp file prefix.
		 * @return string tmp file prefix.
		 */
		function getTmpPrefix() {
			return $this->config['tmp_prefix'];
		}

		/**
		 * Get the sub directories in the base dir.
		 * Each array element contain
		 * the relative path (relative to the base dir) as key and the
		 * full path as value.
		 * @return array of sub directries
		 * <code>array('path name' => 'full directory path', ...)</code>
		 */
		function getDirs() {
			if (is_null($this->dirs)) {
				$dirs = $this->_dirs($this->getBaseDir(),'/');
				ksort($dirs);
				$this->dirs = $dirs;
			}
			return $this->dirs;
		}

        /**
         * Recursively travese the directories to get a list
         * of accessable directories.
         * @param string $base the full path to the current directory
         * @param string $path the relative path name
         * @return array of accessiable sub-directories
         * <code>array('path name' => 'full directory path', ...)</code>
         */
		function _dirs($base, $path) {
			$base = Files::fixPath($base);
			$dirs = array();
			global $xoopsUser, $tiny_persdir, $tiny_mgruploads, $moduleConfig, $groups, $module_id;
			
			if ($this->isValidBase() == false) return $dirs;

			if ($tiny_persdir == 1 && !is_dir(XOOPS_ROOT_PATH.$tiny_mgruploads.'/user_'.$xoopsUser->getVar('uid').'_')) {
				$xuser_name = 'user_'.$xoopsUser->getVar('uid').'_';
				$destpath = $tiny_mgruploads.'/'.$xuser_name;
				if ($moduleConfig['tinyedmgrftp'] == 0) {
					mkdir (XOOPS_ROOT_PATH.$tiny_mgruploads.'/'.$xuser_name, 0777);
					@chmod (XOOPS_ROOT_PATH.$tiny_mgruploads.'/'.$xuser_name, 0777);
				} else {
					include_once TINY_ROOT_PATH.'class/ftpclass.php';
					$ftp = new ftp();
								if (checkRightTiny('TinyPerm', 18, $groups, $module_id) && !$xoopsUser->isAdmin($module_id))
				$ftp->debug = TRUE;
					$ftp->ftpConnect(TINY_FTPSERVER);
					$ftp->ftpLogin(TINY_FTPUSER, TINYFTPPASS);
					$ftp->ftpMkdir(TINY_FTPOPTPATH.$destpath);
					$ftp->ftpSite('CHMOD 0777 '.TINY_FTPOPTPATH.$destpath.'');
					$ftp->ftpClose();
				}
			} else {
				$xuser_name = 'user_'.$xoopsUser->getVar('uid').'_';
			}

			include_once TINY_ROOT_PATH.'include/tinyperm.php';

			$d = @dir($base);

			while (false !== ($entry = $d->read())) {
				// case 1: userdirs and no override
				if (is_dir($base.$entry) && substr($entry,0,1) != '.' && $this->isThumbDir($entry) == false && preg_match("/".$xuser_name."/", $base.$entry) && $tiny_persdir == 1) {
					$relative = Files::fixPath($path.$entry);
					$fullpath = Files::fixPath($base.$entry);
					$dirs[$relative] = $fullpath;
					$dirs = array_merge($dirs, $this->_dirs($fullpath, $relative));
				}
					
				// case 2: userdirs and override
				if (is_dir($base.$entry) && substr($entry,0,1) != '.' && $this->isThumbDir($entry) == false && $tiny_persdir == 1 && checkRightTiny('TinyPerm', 7, $groups, $module_id) == 1) {
					$relative = Files::fixPath($path.$entry);
					$fullpath = Files::fixPath($base.$entry);
					$dirs[$relative] = $fullpath;
					$dirs = array_merge($dirs, $this->_dirs($fullpath, $relative));
				}	
					
				// case 3: no userdirs
				if (is_dir($base.$entry) && substr($entry,0,1) != '.' && $this->isThumbDir($entry) == false && $tiny_persdir == 0 ) {
					$relative = Files::fixPath($path.$entry);
					$fullpath = Files::fixPath($base.$entry);
					$dirs[$relative] = $fullpath;
					$dirs = array_merge($dirs, $this->_dirs($fullpath, $relative));
				}									
					
			}

		$d->close();
		return $dirs;
	}

        /**
         * Get all the files and directories of a relative path.
         * @param string $path relative path to be base path.
         * @return array of file and path information.
         * <code>array(0=>array('relative'=>'fullpath',...), 1=>array('filename'=>fileinfo array(),...)</code>
         * fileinfo array: <code>array('url'=>'full url',
         *                       'relative'=>'relative to base',
         *                        'fullpath'=>'full file path',
         *                        'image'=>imageInfo array() false if not image,
         *                        'stat' => filestat)</code>
         */
        function getFiles($path)
        {
                $files = array();
                $dirs = array();

                if($this->isValidBase() == false)
                        return array($files,$dirs);

                $path = Files::fixPath($path);
                $base = Files::fixPath($this->getBaseDir());
                $fullpath = Files::makePath($base,$path);

                $d = @dir($fullpath);

                while (false !== ($entry = $d->read()))
                {
                        //not a dot file or directory
                        if(substr($entry,0,1) != '.')
                        {
                                if(is_dir($fullpath.$entry)
                                        && $this->isThumbDir($entry) == false)
                                {
                                    $relative = Files::fixPath($path.$entry);
                                    $full = Files::fixPath($fullpath.$entry);
                                    $count = $this->countFiles($full);
                                    $dirs[$relative] = array('fullpath'=>$full,'entry'=>$entry,'count'=>$count);
                                }
                                else if(is_file($fullpath.$entry) && $this->isThumb($entry)==false && $this->isTmpFile($entry) == false)
                                {
									$icon = false;
									$mime = $this->getMIME($fullpath.$entry);
									$ext = strtolower($this->getExtension($entry));

									if ($this->isImage($mime,$ext))
									{
                                        $img = $this->getImageInfo($fullpath.$entry);

                                        if(!(!is_array($img)))
                                        {
                                         	$file['url'] = Files::makePath($this->config['base_url'],$path).$entry;
                                         	$file['relative'] = $path.$entry;
                                         	$file['fullpath'] = $fullpath.$entry;
                                         	$file['image'] = $img;
                                         	$file['stat'] = stat($fullpath.$entry);
                                         	$files[$entry] = $file;
                                        }

									} else {

										$img = array();
										$file['url'] = Files::makePath($this->config['base_url'],$path).$entry;
                                        $file['relative'] = $path.$entry;
                                        $file['fullpath'] = $fullpath.$entry;
										$file['image'] = $img;
										$file['stat'] = stat($fullpath.$entry);
                                        $files[$entry] = $file;

									}
                                }
                        }
                }
                $d->close();
                ksort($dirs);
                ksort($files);

                return array($dirs, $files);
        }

		/**
		 * Count the number of files and directories in a given folder
		 * minus the thumbnail folders and thumbnails.
		 */
		function countFiles($path) {
			$total = 0;

			if (is_dir($path)) {
                        $d = @dir($path);

                        while (false !== ($entry = $d->read()))
                        {
                                if(substr($entry,0,1) != '.'
                                        && $this->isThumbDir($entry) == false
                                        && $this->isTmpFile($entry) == false
                                        && $this->isThumb($entry) == false)
                                {
                                        $total++;
                                }
                        }
                        $d->close();
                }
                return $total;
        }

		/* Added by ralf57
		 * Detect file mime type
		*/

		function getMIME($file) {
			$mime = "text/plain";
			$mimereader1 = '';
			$mimereader2 = '';

			if (class_exists('finfo'))
				$mimereader1 = 1;
			//If mime magic is installed and working
			if (function_exists("mime_content_type"))
				$mimereader2 = 2;

			if ($mimereader1 == 1) {
				$php_version = phpversion();
				if ($php_version >= 5) {
					$fi = new finfo(FILEINFO_MIME);
					$mime = $fi->buffer(file_get_contents($file));
				} else {
					$handle = finfo_open(FILEINFO_MIME);
					$mime = finfo_file($handle,$file);					
				}
			}

			if ($mimereader1 == '' && $mimereader2 == 2)
				$mime = mime_content_type($file);

			if ($mimereader1 == '' && $mimereader2 == '')
				$mime = $this->image2MIME($file);

			return strtolower($mime);
		}

		/* Associate image to mime type
		 * if mime magic is not installed
		*/

		function image2MIME($file) {
			$fh = fopen($file, "r");
			if ($fh) {
				$start4 = fread($fh,4);
				$start3 = substr($start4, 0, 3);

				if ($start4 == "\x89PNG") {
					return "image/png";
				} elseif ($start3 == "GIF") {
					return "image/gif";
				} elseif ($start3 == "\xFF\xD8\xFF") {
					return "image/jpeg";
				} elseif ($start4 == "hsi1") {
					return "image/jpeg";
				} else {
					return false;
				}

			unset($start3);
			unset($start4);
			fclose($fh);
			} else {
				return false;
			}
		}

		/*Auxiliary methods*/

		function isImage($mime,$ext) {
			if (($mime == "image/gif") || ($mime == "image/jpeg") || ($mime == "image/jpg") || ($mime == "image/pjpeg") || ($mime == "image/png") || ($ext == "jpg") || ($ext == "jpeg") || ($ext == "png") || ($ext == "gif") ) {
				return true;
			} else {
				return false;
			}
		}

		function getExtension($entry) {
			//Get Extension
			$ext="";
			$lastpos=strrpos($entry,'.');
			if ($lastpos!==false) $ext=substr($entry,($lastpos+1));
				return strtolower($ext);
		}


		/**
		 * Get image size information.
		 * @param string $file the image file
		 * @return array of getImageSize information,
		 *  false if the file is not an image.
		 */
		function getImageInfo($file) {
                return @getImageSize($file);
		}

        /**
         * Check if the file contains the thumbnail prefix.
         * @param string $file filename to be checked
         * @return true if the file contains the thumbnail prefix, false otherwise.
         */
        function isThumb($file)
        {
                $len = strlen($this->config['thumbnail_prefix']);
                if(substr($file,0,$len)==$this->config['thumbnail_prefix'])
                        return true;
                else
                        return false;
        }

		/**
		 * Check if the given directory is a thumbnail directory.
		 * @param string $entry directory name
		 * @return true if it is a thumbnail directory, false otherwise
		 */
		function isThumbDir($entry) {
			//if (!isset($this->config['thumbnail_dir']))
			if ($this->config['thumbnail_dir'] == false || strlen(trim($this->config['thumbnail_dir'])) == 0)
				return false;
			else
				return ($entry == $this->config['thumbnail_dir']);
		}

        /**
         * Check if the given file is a tmp file.
         * @param string $file file name
         * @return boolean true if it is a tmp file, false otherwise
         */
        function isTmpFile($file)
        {
                $len = strlen($this->config['tmp_prefix']);
                if(substr($file,0,$len)==$this->config['tmp_prefix'])
                        return true;
                else
                        return false;
        }

		/**
		 * For a given image file, get the respective thumbnail filename
		 * no file existence check is done.
		 * @param string $fullpathfile the full path to the image file
		 * @return string of the thumbnail file
		 */
		function getThumbName($fullpathfile) {

			$path_parts = pathinfo($fullpathfile);
			$thumbnail = $this->config['thumbnail_prefix'].$path_parts['basename'];

			if ($this->config['safe_mode'] == true || strlen(trim($this->config['thumbnail_dir'])) == 0) {
				return Files::makeFile($path_parts['dirname'],$thumbnail);
			} else {
				if (strlen(trim($this->config['thumbnail_dir'])) > 0) {
					$path = Files::makePath($path_parts['dirname'],$this->config['thumbnail_dir']);
					if (!is_dir($path))
						Files::createFolder($path);

					return Files::makeFile($path,$thumbnail);
				} else {
					//error_log('ImageManager: Error in creating thumbnail name');
				}
			}
		}

        /**
         * Similar to getThumbName, but returns the URL, base on the
         * given base_url in config.inc.php
         * @param string $relative the relative image file name,
         * relative to the base_dir path
         * @return string the url of the thumbnail
         */
        function getThumbURL($relative)
        {
                $path_parts = pathinfo($relative);
                $thumbnail = $this->config['thumbnail_prefix'].$path_parts['basename'];
                if($path_parts['dirname']=='\\') $path_parts['dirname']='/';

                if($this->config['safe_mode'] == true
                        || strlen(trim($this->config['thumbnail_dir'])) == 0)
                {
                        return Files::makeFile($this->getBaseURL().$path_parts['dirname'],$thumbnail);
                }
                else
                {
                        if(strlen(trim($this->config['thumbnail_dir'])) > 0)
                        {
                                $path = Files::makePath($path_parts['dirname'],$this->config['thumbnail_dir']);
                                $url_path = Files::makePath($this->getBaseURL(), $path);
                                return Files::makeFile($url_path,$thumbnail);
                        }
                        else //should this ever happen?
                        {
                                //error_log('ImageManager: Error in creating thumbnail url');
                        }

                }
        }

        /**
         * Check if the given path is part of the subdirectories
         * under the base_dir.
         * @param string $path the relative path to be checked
         * @return boolean true if the path exists, false otherwise
         */
        function validRelativePath($path)
        {
                $dirs = $this->getDirs();
                if($path == '/')
                        return true;
                //check the path given in the url against the
                //list of paths in the system.
                for($i = 0; $i < count($dirs); $i++)
                {
                        $key = key($dirs);
                        //we found the path
                        if($key == $path)
                                return true;

                        next($dirs);
                }
                return false;
        }

        /**
         * Process uploaded files, assumes the file is in
         * $_FILES['upload'] and $_POST['dir'] is set.
         * The dir must be relative to the base_dir and exists.
         * If 'validate_images' is set to true, only file with
         * image dimensions will be accepted.
         * @return null
         */
        function processUploads()
		{
			if($this->isValidBase() == false)
				return;

			$relative = null;

			if(isset($_POST['dir']))
				$relative = rawurldecode($_POST['dir']);
			else
				return;

			//check for the file, and must have valid relative path
			if(isset($_FILES['upload']) && $this->validRelativePath($relative)) {
				$this->_processFiles($relative, $_FILES['upload']);
			}
		}

		/**
		 * Check if GIF can be edit by GD.
		 * @return int 0 if it is not using the GD library, 1 is GIF is editable, -1 if not editable.
		 */
		function isGDGIFAble() {
			if (IMAGE_CLASS != 'GD')
				return 0;

			if (function_exists('ImageCreateFromGif') && function_exists('imagegif'))
				return 1;
			else
				return -1;
		}

        /**
         * Process upload files. The file must be an
         * uploaded file. If 'validate_images' is set to
         * true, only images will be processed. Any duplicate
         * file will be renamed. See Files::copyFile for details
         * on renaming.
         * @param string $relative the relative path where the file
         * should be copied to.
         * @param array $file the uploaded file from $_FILES
         * @return boolean true if the file was processed successfully,
         * false otherwise
         * Some parts do not apply for ftp, e.g. temporary files
         * Also changed the if-switches to the short version, no need for curly brackets there
         */
        function _processFiles($relative, $file) {
			global $moduleConfig, $xoopsUser, $_FILES;

	$thegroupid = '';

	if (is_object($xoopsUser)) {
		$uid = $xoopsUser->getVar('uid');
		$getthegroupid = $xoopsUser->getGroups($uid);
		if ($moduleConfig['tinygroupoverride'] != '') {
			$split_override_array = explode(" ", $moduleConfig['tinygroupoverride']);
			foreach ($split_override_array as $override_value) {
				$pieces = explode("|", $override_value);
				$group_pointer = array_pop($pieces);
				if (array_intersect($getthegroupid, $pieces)) {
					$thegroupid = $group_pointer;
					break;
				} else {
			$thegroupid = array_slice($getthegroupid, 0, 1);
			$thegroupid = implode(" ", $thegroupid);
			$thegroupid = trim($thegroupid);					
				}
			}
		} else {	
			$thegroupid = array_slice($getthegroupid, 0, 1);
			$thegroupid = implode(" ", $thegroupid);
			$thegroupid = trim($thegroupid);
		}
	} else {
		$thegroupid = 3;
	}

			if ($file['error']!=0)
				return false;

			if (!is_file($file['tmp_name']))
				return false;

			if (!is_uploaded_file($file['tmp_name'])) {
				Files::delFile($file['tmp_name']);
				return false;
			}

			$mimes = getMimeArray($thegroupid);
			$mimeread = $this->getMime($file['tmp_name']);

			if (in_array($mimeread, $mimes) && in_array($_FILES['upload']['type'], $mimes)) {
			
			if ($moduleConfig['tinyedmgrftp'] == 0) {

				// start unzip
				if ($moduleConfig['tinyedmgrunpackzip'] == 1 && (preg_match("/zip/", $mimeread) || preg_match("/compress/", $mimeread))) {
					
					$path = Files::makePath($this->getBaseDir(),$relative);
					$result = Files::copyFile($file['tmp_name'], $path, $file['name']);
					include XOOPS_ROOT_PATH.'/modules/tinyeditor/class/pclzip.lib.php';
					$archive = new PclZip($path.$_FILES['upload']['name']);
					if ($archive->extract(PCLZIP_OPT_PATH, $path) == 0) {
						unlink($path.$_FILES['upload']['name']);
						Files::delFile($file['tmp_name']);
						return false;
						die($archive->errorInfo(true));
					} else {
						unlink($path.$file['name']);
						Files::delFile($file['tmp_name']);
						return true;
					}
					
					// end unzip
				} else {
				//now copy the file
				$path = Files::makePath($this->getBaseDir(),$relative);
				$result = Files::copyFile($file['tmp_name'], $path, $file['name']);

				//no copy error
				if (!is_int($result)) {
					Files::delFile($file['tmp_name']);
					return true;
				}

				//delete tmp files.
				Files::delFile($file['tmp_name']);
				return false;
				
				}
				
			} else {	
				$path = Files::makePath($this->getBaseDir(),$relative);
				// start unzip
				if ($moduleConfig['tinyedmgrunpackzip'] == 1 && (preg_match("/zip/", $mimeread) || preg_match("/compress/", $mimeread))) {

					$result = Files::copyFile($file['tmp_name'], $path, $file['name']);
					
					include XOOPS_ROOT_PATH.'/modules/tinyeditor/class/pclzip.lib.php';
					$archive = new PclZip($path.$file['name']);
					if ($archive->extract(PCLZIP_OPT_PATH, $path) == 0) {
						die('arsch1');
						unlink($path.$_FILES['upload']['name']);
						Files::delFile($file['tmp_name']);
						return false;
						die($archive->errorInfo(true));
					} else {
						unlink($path.$file['name']);
						Files::delFile($file['tmp_name']);
						return true;
					}
					
					// end unzip
				} else {
					$result = Files::copyFile($file['tmp_name'], $path, $file['name']);
					Files::delFile($file['tmp_name']);
					return true;
				}
			}
			
			
			// end
			} else {
				Files::delFile($file['tmp_name']);
				return false;
			}
		}

		/**
		 * Get the URL of the relative file.
		 * basically appends the relative file to the
		 * base_url given in config.inc.php
		 * @param string $relative a file the relative to the base_dir
		 * @return string the URL of the relative file.
		 */
		function getFileURL($relative) {
			return Files::makeFile($this->getBaseURL(),$relative);
		}

		/**
		 * Get the fullpath to a relative file.
		 * @param string $relative the relative file.
		 * @return string the full path, .ie. the base_dir + relative.
		 */
		function getFullPath($relative) {
			return Files::makeFile($this->getBaseDir(),$relative);;
		}

		/**
		 * Get the default thumbnail.
		 * @return string default thumbnail, empty string if
		 * the thumbnail doesn't exist.
		 */
		function getDefaultThumb() {
			if (is_file($this->config['default_thumbnail']))
				return $this->config['default_thumbnail'];
			else
				return '';
		}

        /**
         * Get the thumbnail url to be displayed.
         * If the thumbnail exists, and it is up-to-date
         * the thumbnail url will be returns. If the
         * file is not an image, the appropriate mimetype icon is displayed.
         * If it is an image file, and no thumbnail exists or
         * the thumbnail is out-of-date (i.e. the thumbnail
         * modified time is less than the original file)
         * then a thumbs.php?img=filename.jpg is returned.
         * The thumbs.php url will generate a new thumbnail
         * on the fly. If the image is less than the dimensions
         * of the thumbnails, the image will be display instead.
         * @param string $relative the relative image file.
         * @return string the url of the thumbnail, be it
         * actually thumbnail or a script to generate the
         * thumbnail on the fly.
		 * Modified by ralf57 for TinyEditor
         */
		function getThumbnail($relative) {
			$fullpath = Files::makeFile($this->getBaseDir(),$relative);

			//not a file???
			if(!is_file($fullpath)) 
				return $this->getDefaultThumb();

			$imgInfo = @getImageSize($fullpath);

			//if not an image, load mimetype thumbnail
			//ralf57
			if (!is_array($imgInfo)) {
				$mime = $this->getMIME($fullpath);
				$ext = strtolower($this->getExtension($fullpath));
				$thumbnail = iconLookup($mime,$ext);

				//retrieve the full path to the current mime icon and icon dimensions
				$icon_path = str_replace(XOOPS_URL, XOOPS_ROOT_PATH, $thumbnail);
				$thumbInfo = @getImageSize($icon_path);
				$humpnile = str_replace(XOOPS_ROOT_PATH, XOOPS_URL, $thumbnail);

				return $humpnile."\" height=\"$thumbInfo[1]\" width=\"$thumbInfo[0]";

			}

			//the original image is smaller than thumbnails,
			//so just return the url to the original image.
			if ($imgInfo[0] <= $this->config['thumbnail_width'] && $imgInfo[1] <= $this->config['thumbnail_height'])
				return $this->getFileURL($relative)."\" height=\"$imgInfo[1]\" width=\"$imgInfo[0]";

			//now retrieve thumbnail dimensions
			$thumbnail = $this->getThumbName($fullpath);
			$thumbInfo = @getImageSize($thumbnail);

			// check for thumbnail, if exists and
			// it is up-to-date, return the thumbnail url
			// modified by ralf57 to get thumbs automatically
			// reflect width and height administration settings
			if (is_file($thumbnail)) {
				if (($thumbInfo[0] == $this->config['thumbnail_width'] || $thumbInfo[1] == $this->config['thumbnail_height']) && filemtime($thumbnail) >= filemtime($fullpath)) {
					return $this->getThumbURL($relative)."\" height=\"$thumbInfo[1]\" width=\"$thumbInfo[0]";
				} else {
					return 'thumbs.php?img='.rawurlencode($relative);
					}
			} else {

			//well, no thumbnail was found, so ask the thumbs.php
			//to generate the thumbnail on the fly.
			return 'thumbs.php?img='.rawurlencode($relative);
			}
		}

        /**
         * Delete and specified files.
         * @return boolean true if delete, false otherwise
         */
        function deleteFiles()
        {
                if(isset($_GET['delf']))
                        $this->_delFile(rawurldecode($_GET['delf']));
        }

		/**
         * Rename a specified files.
         * @return boolean true if delete, false otherwise
         */
        function renameFiles()
        {
                if( isset($_GET['file']) && isset($_GET['dir']) && isset($_GET['newname']) )
        		{
					$file = rawurldecode($_GET['file']);
					$dir = rawurldecode($_GET['dir']);
					$newname = rawurldecode($_GET['newname']);

					$file_path = str_replace(XOOPS_URL, XOOPS_ROOT_PATH, $file);
					$filename = basename($file_path);
					$basepath = Files::makePath($this->getBaseDir(), $dir);

					return Files::renameFile($file_path, $basepath, $filename, $newname);

				}

		}

        /**
         * Delete and specified directories.
         * @return boolean true if delete, false otherwise
         */
        function deleteDirs()
        {
                 if(isset($_GET['deld']))
                        return $this->_delDir(rawurldecode($_GET['deld']));
                 else
                         return false;
        }

        /**
         * Delete the relative file, and any thumbnails.
         * @param string $relative the relative file.
         * @return boolean true if deleted, false otherwise.
         */
        function _delFile($relative)
        {
                $fullpath = Files::makeFile($this->getBaseDir(),$relative);

                /*don't check that the file is an image
				deleting extended to other file types
				ralf57*/
                /*if($this->config['validate_images'] == true)
                {
                        if(!is_array($this->getImageInfo($fullpath)))
                                return false; //hmmm not an Image!!???
                }*/

                $thumbnail = $this->getThumbName($fullpath);

                if(Files::delFile($fullpath))
                        return Files::delFile($thumbnail);
                else
                        return false;
        }

		/**
         * Copy or move a file to a directory.
		 * If the directory is the current, the file is cloned with
		 * a similar filename (Ex: "file.txt" is renamed "file_1.txt")
         * @return boolean true if copy is done, false otherwise.
		 * Added by ralf57
         */
		function processCopyFile() {

			if (isset($_GET['file']) && isset($_GET['destDir']) && isset($_GET['fileaction'])) {
				$file = rawurldecode($_GET['file']);
				$destDir = rawurldecode($_GET['destDir']);
				$file_action = $_GET['fileaction'];
				$file_path = str_replace(XOOPS_URL, XOOPS_ROOT_PATH, $file);
				$filename = basename($file);

				$destpath = Files::makePath($this->getBaseDir(), $destDir);

				if (is_dir($file))
					return false;

				if ($file_action == "keeporig")
					return Files::copyFile($file_path, $destpath, $filename, true);
				else
					Files::copyFile($file_path, $destpath, $filename, true);
					return Files::delFile($file_path);
			}
		}

		/**
		 * Copy or move a directory to another directory.
		 * If the directory is the current, the directory is cloned with
		 * a similar name (Ex: "/images/" is renamed "/images_1/")
		 * @return boolean true if copy is done, false otherwise.
		 * Added by ralf57
		 */
		function processCopyFolder() {
			if (isset($_GET['folder']) && isset($_GET['destDir']) && isset($_GET['foldaction'])) {
				$path = rawurldecode($_GET['folder']);
				$destDir = rawurldecode($_GET['destDir']);
				$fold_action = $_GET['foldaction'];
				$fixed_destDir = substr($destDir, 0, -1); //remove last slash*/
				$source = Files::makePath($this->getBaseDir(), $path);
				$destpath = Files::makePath($this->getBaseDir(), $fixed_destDir.$path);

				if (file_exists($destpath))
					return false;

				if ($fold_action == "keeporig") {
					return Files::copyFolder($source, $destpath);
				} else {
					Files::copyFolder($source, $destpath, true);
					return Files::delFolder($source, true);
				}
			}
		}

		/**
		 * Rename a specified directory.
		 * Added by ralf57
		 * @return boolean true if delete, false otherwise
		 */
		function renameFolders() {
			if (isset($_GET['folder']) && isset($_GET['dir']) && isset($_GET['newname'])) {
				$folder = rawurldecode($_GET['folder']); // old name
				$dir = rawurldecode($_GET['dir']); // the current working directory
				$newname = rawurldecode($_GET['newname']); // new name
					$new_name = Files::escape($newname); // basic text sanitize

					$basepath = Files::makePath($this->getBaseDir(), $dir);
					$old_path = Files::makePath($basepath, $folder);
					$new_path = Files::makePath($basepath, $new_name);

					if (file_exists($new_path)) // an existing name cannot be used
					{
						return false;
					} else {
						return rename ($old_path, $new_path);
					}
				}

		}

		/**
		 * Delete directories recursively.
		 * Added deletion of non-empty folders by ralf57
		 * @param string $relative the relative path to be deleted.
		 * @return boolean true if deleted, false otherwise.
		 */
		function _delDir($relative) {
			$fullpath = Files::makePath($this->getBaseDir(),$relative);
			if ($this->config['del_ne_fold'] == 0 && $this->countFiles($fullpath) >= 0)
				return Files::delFolder($fullpath,false); //delete recursively if conditions are met
			else
				return Files::delFolder($fullpath,true);
		}

		/**
		 * Create new directories.
		 * @return boolean true if created, false otherwise.
		 */
		function processNewDir() {

			if (isset($_GET['newDir']) && isset($_GET['dir'])) {
				$newDir = rawurldecode($_GET['newDir']);
				$dir = rawurldecode($_GET['dir']);
				$path = Files::makePath($this->getBaseDir(),$dir);
				$fullpath = Files::makePath($path, Files::escape($newDir));
				if (is_dir($fullpath))
					return false;
					
					return Files::createFolder($fullpath);
			}
		}
	}

?>