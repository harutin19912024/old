<?php

namespace app\modules\admin;

use app\modules\admin\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;
use yii\helpers\ArrayHelper;
/**
 * modules module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::class,
                ],
                'except' => ['auth/*'],
                'rules' => [
                    [
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ]
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->identityClass = User::class;
        // custom initialization code goes here
    }
}
