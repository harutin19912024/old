<?php
/**
 * Created by PhpStorm.
 * User: Harut
 * Date: 01.04.2020
 * Time: 14:32
 */

namespace app\components;

use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

trait PostValidationTrait {

    /**
     * @param $model
     * @param $formId
     */
    private function validateTypePost($model, $formId) {
        if (Yii::$app->request->isAjax && Yii::$app->request->post('ajax') == $formId) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model)); exit();
        }
    }
}