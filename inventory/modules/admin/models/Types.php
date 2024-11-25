<?php

namespace app\modules\admin\models;

use yii\data\ActiveDataProvider;

class Types extends \app\models\Types
{
    public function getDataProvider( ) {
        $query = self::find(); //find query

        return new ActiveDataProvider([
            'query' => $query,
        ]);

    }
}