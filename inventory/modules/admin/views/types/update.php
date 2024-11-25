<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Types */
/* @var $form yii\widgets\ActiveForm */

$nameOpt = [
    'options' => ['class' => 'section'],
    'template' => '<label for="loginform-email" class="field prepend-icon">{input}<label for="fname" class="field-icon"><i class="fa fa-user"></i></label></label>',
];
?>


<?php $form = ActiveForm::begin([
    'action' => ['/admin/types/update?id='.$model->id],
    'id' => 'type-create',
    'enableAjaxValidation' => true
]); ?>
<div class="section row mbn">
    <div class="col-md-10 pl15">
        <div class="section row mb15">
            <div class="col-xs-12">
                <?= $form
                    ->field($model, 'name', $nameOpt)
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('name'),'class'=>'event-name gui-input br-light light']) ?>
            </div>
        </div>
    </div>
    <div class="col-md-2 pl15">
        <p class="text-right">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</div>
<!-- end section row -->
<?php ActiveForm::end(); ?>
