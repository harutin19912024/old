<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use app\modules\admin\models\SignupForm;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'auth';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }


    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                \Yii::$app->user->login($model->user);

                return $this->redirect(['/admin/dashboard']);
            }

            \Yii::$app->session->setFlash('error', 'Incorrect email or password');

            return $this->refresh();
        }

        \Yii::$app->user->setReturnUrl(Url::current());

        return $this->render('login', ['model' => $model]);
    }

    public function actionSignUp()
    {
        $model = new SignupForm();
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

}
