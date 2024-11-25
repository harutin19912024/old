<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label for="loginform-email" class="field prepend-icon">{input}<label for="username" class="field-icon"><i class="fa fa-user"></i></label></label>',
];

$fieldOptions2 = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label for="loginform-password" class="field prepend-icon">{input}<label for="username" class="field-icon"><i class="fa fa-lock"></i></label></label>',
];
?>



<!-- Begin: Content -->
<section id="content">

    <div class="admin-form theme-info" id="login1">

        <div class="row mb15 table-layout">

            <div class="col-xs-6 text-right va-b pr5">
                <div class="login-links">
                    <a href="<?=\yii\helpers\Url::to(['/admin/auth/login'])?>" class="active" title="Sign In">Sign In</a>
                    <span class="text-white"> | </span>
                    <a href="<?=\yii\helpers\Url::to(['/admin/auth/signup'])?>" class="" title="Register">Register</a>
                </div>

            </div>

        </div>

        <div class="panel panel-info mt10 br-n">

            <!-- end .form-header section -->
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="panel-body bg-light p30">
                    <div class="row">
                        <div class="col-sm-12 pr30">

                                <?= $form
                                    ->field($model, 'email', $fieldOptions1)
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

                                <?= $form
                                    ->field($model, 'password', $fieldOptions2)
                                    ->label(false)
                                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                        </div>
                    </div>
                </div>
                <!-- end .form-body section -->
                <div class="panel-footer clearfix p10 ph15">
                    <?= Html::submitButton('Sign in', ['class' => 'button btn-primary mr10 pull-right', 'name' => 'login-button']) ?>
                </div>
                <!-- end .form-footer section -->
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</section>
<!-- End: Content -->