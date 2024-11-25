<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendors".
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property string|null $created_date
 *
 * @property Product[] $products
 */
class Vendors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_date'], 'safe'],
            [['name'], 'string', 'max' => 50],

            // logo upload rules
            ['logo', 'required', 'when' => function($model, $attribute) {
                return !\Yii::$app->request->isAjax;
            },  'on' => 'uploadLogo'],
            ['logo', 'file', 'extensions' => array('img', 'jpg', 'png'), 'on' => ['uploadLogo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'logo' => 'Logo',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['vendor_id' => 'id']);
    }
}
