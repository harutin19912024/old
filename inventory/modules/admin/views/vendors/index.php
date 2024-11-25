<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Vendors Table';

$nameOpt = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label for="loginform-email" class="field prepend-icon">{input}<label for="fname" class="field-icon"><i class="fa fa-user"></i></label></label>',
];
$logoOpt = [
    'options' => ['tag' => false],
    'inputTemplate' => '{input}',
];
?>
<!-- begin: .tray-center -->
<div class="tray tray-center">

    <!-- create new order panel -->
    <div class="panel mb25 mt5">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Add New Vendor</span>
        </div>
        <div class="panel-body p20 pb10">
            <div class="tab-content pn br-n admin-form">
                <div id="tab1_1" class="tab-pane active">

                    <?php $form = ActiveForm::begin([
                        'action' => ['/admin/vendors/create'],
                        'id' => 'vendor-create',
                        'options' => ['enctype' => 'multipart/form-data'],
                        'enableAjaxValidation' => true
                    ]); ?>

                    <div class="section row mbn">
                        <div class="col-md-2">
                            <div class="fileupload fileupload-new admin-form" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail mb20">
                                    <img data-src="holder.js/100%x140" alt="holder">
                                </div>
                                <div class="row">
                                    <div class="col-xs-5">
                                        <span class="button btn-system btn-file btn-block">
                                          <span class="fileupload-new">Select</span>
                                          <span class="fileupload-exists">Change</span>
                                            <?=$form->field($model, 'logo',$logoOpt)->fileInput()->label(false) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 pl15">
                            <div class="section row mb15">
                                <div class="col-xs-12">
                                    <?= $form
                                        ->field($model, 'name', $nameOpt)
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('name'),'class'=>'event-name gui-input br-light light']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section row mbn">
                        <div class="col-md-12 pl15">
                            <p class="text-right">
                                <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
                            </p>
                        </div>
                    </div>
                    <!-- end section row -->
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- recent orders table -->
    <div class="panel">
        <div class="panel-menu admin-form theme-primary">
            <div class="row">
                <div class="col-md-4">
                    <label class="field select">
                        <select id="filter-purchases" name="filter-purchases">
                            <option value="0">Filter by Purchases</option>
                            <option value="1">1-49</option>
                            <option value="2">50-499</option>
                            <option value="1">500-999</option>
                            <option value="2">1000+</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
                <div class="col-md-4">
                    <label class="field select">
                        <select id="filter-group" name="filter-group">
                            <option value="0">Filter by Group</option>
                            <option value="1">Customers</option>
                            <option value="2">Vendors</option>
                            <option value="3">Distributors</option>
                            <option value="4">Employees</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
                <div class="col-md-4">
                    <label class="field select">
                        <select id="filter-status" name="filter-status">
                            <option value="0">Filter by Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Suspended</option>
                            <option value="4">Online</option>
                            <option value="5">Offline</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body pn">
            <div class="table-responsive">
                <?php Pjax::begin(); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => [
                        'class' => 'table admin-form theme-warning tc-checkbox-1 fs13',
                        'id' => 'tbl_vendors'
                    ],
                    'filterRowOptions' => [
                        'role' => "row",
                    ],
                    'rowOptions' => [
                        'role' => "row",
                        'class' => 'odd'
                    ],
                    'summary' => false,
                    'options' => ['class' => 'br-r', 'id' => 'vendors'],
                    'columns' => [
                        'id',
                        ['attribute' => 'logo',
                            'format' => 'html',
                            'label' => Yii::t('app','Logo'),
                            'value' => function ($model) {
                                $path = 'uploads/vendors/thumb/' . $model->logo;
                                return Html::img('/' . $path, ['style' => 'width: 40px !important']);
                            },
                            'filterInputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'Search'
                            ],
                        ],
                        'name',
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>'.Yii::t('app','Delete'), $url, [
                                        'title' => Yii::t('app','Delete'),
                                        'aria-label' => 'Delete',
                                        'data-confirm' => 'Are you sure! You whant delete this item?',
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                        'data-key' => $model->id,
                                        'class' => 'btn btn-danger btn-xs fs12 br2 ml5'
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>'.Yii::t('app','Edit'), $url, [
                                        'title' => Yii::t('app','Edit'),
                                        'aria-label' => 'Edit',
                                        //'data-confirm' => 'Are you sure! You whant delete this item?',
                                        //'data-method' => 'post',
                                        'data-pjax' => '0',
                                        'data-key' => $model->id,
                                        'class' => 'btn btn-info btn-xs fs12 br2 ml5'
                                    ]);
                                },
                            ]
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>

</div>
<!-- end: .tray-center -->
<?php
$this->registerJsFile(
    '@web/js/plugins/holder/holder.min.js',
    ['depends' => [\app\assets\AdminAsset::class]]
);
$this->registerJsFile(
    '@web/js/plugins/fileupload/fileupload.js',
    ['depends' => [\app\assets\AdminAsset::class]]
);
$this->registerJs("
var fileUpload = $('.fileupload-preview');
fileUpload.each(function(i, e) {
        var fileForm = $(e).parents('.fileupload').find('.btn-file > input');
        $(e).on('click', function() {
          fileForm.click();
        });
      });
");
?>