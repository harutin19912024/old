<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $id
 * @property string $sortname
 * @property string $name
 * @property integer $phonecode
 * @property integer $status
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sortname', 'name', 'phonecode'], 'required'],
            [['phonecode', 'status'], 'integer'],
            [['sortname'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sortname' => Yii::t('app', 'Sortname'),
            'name' => Yii::t('app', 'Name'),
            'phonecode' => Yii::t('app', 'Phonecode'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}