<?php
/**
 * Created by PhpStorm.
 * User: Harut
 * Date: 01.04.2020
 * Time: 17:01
 */

namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\BaseFileHelper;
use Exception;

/**
 * Component to Resize Image
 *
 *
 */
class ImageComponent extends Component
{

    private $image;
    private $newImage;
    private $image_type;
    private $originalWidht;
    private $originalHeight;

    /**
     * Loading data
     *
     * @param string $filename
     * @return void
     * @throws Exception
     */
    public function load($filename)
    {
        if (!file_exists($filename)) {
            throw new Exception("Image not exist");
        }

        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        $this->originalWidht = $this->getWidth($filename);
        $this->originalHeight = $this->getHeight($filename);
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = ImageCreateFromJPEG($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = ImageCreateFromGIF($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = ImageCreateFromPNG($filename);
        }

        return $this;
    }

    /**
     * Save Image
     *
     * @param string $filename
     * @param string $compression
     * @param string $permissions
     * @return void
     * @throws Exception
     */
    public function save($filename, $compression=100, $permissions=null)
    {
        switch ($this->image_type)
        {
            case IMAGETYPE_JPEG:
            case 'image/jpeg':
                imagejpeg($this->newImage, $filename, $compression);
                break;
            case IMAGETYPE_GIF:
            case 'image/gif':
                imagegif($this->newImage, $filename);
                break;
            case IMAGETYPE_PNG:
            case 'image/png':
                imagepng($this->newImage, $filename);
                break;
        }

        if( $permissions != null) {
            chmod($filename,$permissions);
        }
    }

    /**
     * Get Width
     * @return integer
     */
    public function getWidth($imagePath)
    {
        $imageDetails = getimagesize($imagePath);
        return $imageDetails[0];
    }

    /**
     * Get Height
     * @return integer
     */
    public function getHeight($imagePath)
    {
        $imageDetails = getimagesize($imagePath);
        return $imageDetails[1];
    }

    /**
     *
     * Generate Thumbnail
     *
     * @param string $filename
     * @param string $category
     * @param array $size |  width and height
     * @return void
     * @throws Exception
     */
    public function generateMiniature($filename, $category, $size = [], $viaConsole = false)
    {
        if(empty($filename)) {
            throw new Exception("Filename not set");
        }

        if(empty($size)) {
            throw new Exception("Size not set");
        }

        $filePath = Yii::getAlias("uploads/".$category.'/'.$filename);
        $this->load($filePath);

        $width = $size['width'];
        $height = $size['height'];

        if ($this->originalWidht > $this->originalHeight) {
            $newWidth = $width;
            $newHeight = intval($this->originalHeight * $newWidth / $this->originalWidht);
        } else {
            $newHeight = $height;
            $newWidth = intval($this->originalWidht * $newHeight / $this->originalHeight);
        }

        $destX = intval(($width - $newWidth) / 2);
        $destY = intval(($height - $newHeight) / 2);

        $this->newImage = imagecreatetruecolor($width, $height);
        imagecopyresized($this->newImage, $this->image, $destX, $destY, 0, 0, $newWidth, $newHeight, $this->originalWidht, $this->originalHeight);

        if($viaConsole) {
            $directory = Yii::getAlias("uploads/".$category."/thumb/");
            BaseFileHelper::createDirectory($directory);
        } else {
            $directory = Yii::getAlias("uploads/".$category."/thumb/");
            BaseFileHelper::createDirectory($directory);
        }

        $this->save($directory . $filename);

    }
}
?>