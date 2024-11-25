<?php

namespace app\modules\admin\models;

use yii\data\ActiveDataProvider;

class Products extends \app\models\Products
{
    /**
     * @return ActiveDataProvider
     */
    public function getDataProvider()
    {
        $query = self::find(); //find query

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * Get Sum of all products prices
     * @return mixed
     */
    public static function getSumOfProductsPrice()
    {
        $query = (new \yii\db\Query())->from(self::tableName());
        return $query->sum('price');
    }

    /**
     *  Get Sum of products price , average item price and types count
     *
     * @return array
     */
    public static function getDashboardInfo()
    {
        $productsCount = self::find()->count();
        $productsPriceSum = self::getSumOfProductsPrice();
        $typesCount = Types::find()->count();

        $averageItemPrice = 0;
        if($productsCount > 0) {
            $averageItemPrice = round($productsPriceSum / $productsCount, 2);
        }

        return ['productsCount'=>$productsCount, 'averageItemPrice'=>$averageItemPrice, 'typesCount'=>$typesCount];
    }

    /**
     * @return string
     */
    public static function getItemTypesPercentage()
    {
        $productsCount = self::find()->count();
        $types = (new \yii\db\Query())->select('types.name, COUNT(*) as count')->from(self::tableName())
            ->join('LEFT JOIN', Types::tableName(), Types::tableName() . '.id = ' . self::tableName() . '.type_id')->groupBy('type_id')->all();

        $typesPercentage = '';
        foreach ($types as $type) {
            $typesPercentage .= "['".$type['name']."',".round(($type['count'] / $productsCount) * 100, 2)."],";
        }
        //['Firefox', 35.0],
        return $typesPercentage;
    }

}