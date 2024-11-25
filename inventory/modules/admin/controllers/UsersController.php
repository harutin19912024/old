<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserSearch;
use app\modules\admin\models\User;
/**
 * Dashboard controller for the `modules` admin
 */
class UsersController extends Controller
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
        $searchModel = new UserSearch();
        $model = new User();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

}

