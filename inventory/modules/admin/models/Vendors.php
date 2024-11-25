<?php

namespace app\modules\admin\models;

use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class Vendors extends \app\models\Vendors
{
    /**
     * Logo File upload
     *
     * @var UploadedFile
     */
    public $logoFile;

    public function getDataProvider()
    {
        $query = self::find(); //find query

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function prepareLogoFile()
    {
        $this->logoFile = UploadedFile::getInstance($this, 'logo');
    }
}