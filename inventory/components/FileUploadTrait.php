<?php
/**
 * Created by PhpStorm.
 * User: Harut
 * Date: 01.04.2020
 * Time: 16:43
 */

namespace app\components;

use Yii;
use yii\helpers\BaseFileHelper;

trait FileUploadTrait {

    /**
     * @param $imageFile
     * @param $category
     * @return array|bool
     */
    public function uploadFile($imageFile, $category) {
        $directory = Yii::getAlias("uploads/" . $category);
        BaseFileHelper::createDirectory($directory);
        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '_' . $category . '.' . $imageFile->extension;
            $fileName_return = $fileName;
            $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;
            $imageFile->saveAs($filePath);
            Yii::$app->imagecomponent->generateMiniature($fileName_return, $category, ['width' => 300, 'height' => 400]);

            return $fileName_return;
        }
        return false;
    }
}