<?
/**
 * Resize Images on Upload.
 * @author $Author: frankblacksf $
 * @Modified by Ryan Demmer (ryandemmer@webmail.co.za)
 * Almost identical to Thumbnail.php
 * @version $Id: Resize.php,v 1.1 2006/04/08 15:09:32 frankblacksf Exp $
 * @package ImageManager
 */


require_once('Transform.php');

/**
 * Resize on Upload
 * @author $Author: frankblacksf $
 * @Modified by Ryan Demmer (ryandemmer@webmail.co.za)
 * Almost identical to Thumbnail.php 
 * @version $Id: Resize.php,v 1.1 2006/04/08 15:09:32 frankblacksf Exp $
 * @package ImageManager
 * @subpackage Images
 */
class Resize
{
        /**
         * Graphics driver, GD, NetPBM or ImageMagick.
         */
        var $driver;

        /**
         * Thumbnail default width.
         */
        var $width = 300;

        /**
         * Thumbnail default height.
         */
        var $height = 300;

        /**
         * Thumbnail default JPEG quality.
         */
        var $quality = 85;

        /**
         * Thumbnail is proportional
         */
        var $proportional = true;

        /**
         * Default image type is JPEG.
         */
        var $type = 'jpeg';

        /**
         * Create a new Thumbnail instance.
         * @param int $width thumbnail width
         * @param int $height thumbnail height
         */
        function Resize($width=300, $height=300, $quality=85, $type='jpeg')
        {
                $this->driver = Image_Transform::factory(IMAGE_CLASS);
                $this->width = $width;
                $this->height = $height;
                $this->quality = $quality;
                $this->type = $type;
        }

        /**
         * Create a thumbnail.
         * @param string $file the image for the thumbnail
         * @param string $thumbnail if not null, the thumbnail will be saved
         * as this parameter value.
         * @return boolean true if thumbnail is created, false otherwise
         */
        function resizeImage($file, $thumbnail=null, $type, $quality)
        {
                if(!is_file($file))
                        return false;

                //error_log('Creating Thumbs: '.$file);

                $this->driver->load($file);

                if($this->proportional)
                {
                        $width = $this->driver->img_x;
                        $height = $this->driver->img_y;

                        if ($width > $height)
                                $this->height = intval($this->width/$width*$height);
                        else if ($height > $width)
                                $this->width = intval($this->height/$height*$width);
                }

                $this->driver->resize($this->width, $this->height);

                if(is_null($thumbnail))
                        $this->save($file, $type, $quality);
                else
                        $this->save($thumbnail);


                $this->free();

                if(is_file($thumbnail))
                        return true;
                else
                        return false;
        }

        /**
         * Save the thumbnail file.
         * @param string $file file name to be saved as.
         */
        function save($file)
        {
                $this->driver->save($file);
        }

        /**
         * Free up the graphic driver resources.
         */
        function free()
        {
                $this->driver->free();
        }
}


?>