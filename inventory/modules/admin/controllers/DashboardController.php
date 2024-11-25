<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Products;
use app\modules\admin\models\User;

/**
 * Dashboard controller for the `modules` admin
 */
class DashboardController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [];
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $usersCount = User::find()->where(['role'=>User::ROLE_USER])->count();
        $typesPercentage = Products::getItemTypesPercentage();
        $dashboardInfo = array_merge(Products::getDashboardInfo(),['usersCount'=>$usersCount],['typesPercentage'=>$typesPercentage]);
        return $this->render('index',$dashboardInfo);
    }

}

