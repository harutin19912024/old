<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int|null $vendor_id
 * @property int|null $type_id
 * @property string $serial_number
 * @property float $price
 * @property float|null $weight
 * @property string|null $color
 * @property string|null $tags
 * @property string|null $img_path
 * @property string|null $release_date
 * @property string|null $created_date
 *
 * @property Types $type
 * @property Vendors $vendor
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'serial_number', 'price'], 'required'],
            [['vendor_id', 'type_id'], 'integer'],
            [['price', 'weight'], 'number'],
            [['release_date', 'created_date'], 'safe'],
            [['name', 'serial_number', 'color'], 'string', 'max' => 50],
            [['tags', 'img_path'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::class, 'targetAttribute' => ['type_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendors::class, 'targetAttribute' => ['vendor_id' => 'id']],
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
            'vendor_id' => 'Vendor',
            'type_id' => 'Type',
            'serial_number' => 'Serial Number',
            'price' => 'Price',
            'weight' => 'Weight',
            'color' => 'Color',
            'tags' => 'Tags',
            'img_path' => 'Img Path',
            'release_date' => 'Release Date',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::class, ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Vendor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendors::class, ['id' => 'vendor_id']);
    }

    /**
     * @return array
     */
    public function getVendorsList() {
        $vendors = Vendors::find()->all();
        return ArrayHelper::map($vendors, 'id', 'name');
    }

    /**
     * @return array
     */
    public function getTypesList() {
        $types = Types::find()->all();
        return ArrayHelper::map($types, 'id', 'name');
    }

    /**
     * @return mixed
     */
    public static function getListOfLastAddedProducts() {
        return self::find()->orderBy(['id'=>SORT_ASC])->limit(4);
    }
}
