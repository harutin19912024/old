<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Types Table';

$nameOpt = [
        'options' => ['class' => 'section'],
        'inputTemplate' => '<label for="loginform-email" class="field prepend-icon">{input}<label for="fname" class="field-icon"><i class="fa fa-user"></i></label></label>',
];
?>
<!-- begin: .tray-center -->
<div class="tray tray-center">

    <!-- create new order panel -->
    <div class="panel mb25 mt5">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Add New Type</span>
        </div>
        <div class="panel-body p20 pb10">
            <div class="tab-content pn br-n admin-form">
                <div id="type-form-content" class="tab-pane active">
                    <?php $form = ActiveForm::begin([
                        'action' => ['/admin/types/create'],
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
        <div class="panel-body pn">
            <div class="table-responsive">
                <?php Pjax::begin([
                    'id' => 'type-form-content',  // response goes in this element
                    'enablePushState' => false,
                    'enableReplaceState' => false
                ]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => [
                        'class' => 'table admin-form theme-warning tc-checkbox-1 fs13',
                        'id' => 'tbl_types'
                    ],
                    'filterRowOptions' => [
                        'role' => "row",
                    ],
                    'rowOptions' => [
                        'role' => "row",
                        'class' => 'odd'
                    ],
                    'summary' => false,
                    'options' => ['class' => 'br-r', 'id' => 'types'],
                    'columns' => [
                        'id',
                        'name',
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>'.Yii::t('app','Delete'), false, [
                                        'title' => Yii::t('app','Delete'),
                                        'aria-label' => 'Delete',
                                        'data-pjax' => 1,
                                        'delete-url' => $url,
                                        'pjax-container' => 'tbl_types',
                                        'class' => 'pjax-delete-link btn btn-danger btn-xs fs12 br2 ml5',
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>'.Yii::t('app','Edit'), $url, [
                                        'title' => Yii::t('app','Edit'),
                                        'aria-label' => 'Edit',
                                        'data-method' => 'post',
                                        'data-pjax' => true,
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
$this->registerJs("
     $(document).on('ready pjax:success', function() {
         $('.pjax-delete-link').on('click', function(e) {
             e.preventDefault();
             var deleteUrl = $(this).attr('delete-url');
             var pjaxContainer = $(this).attr('pjax-container');
             var result = confirm('Delete this item, are you sure?');                                
             if(result) {
                 $.ajax({
                     url: deleteUrl,
                     type: 'post',
                     error: function(xhr, status, error) {
                         alert('There was an error with your request.' + xhr.responseText);
                     }
                 }).done(function(data) {
                     $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
                 });
             }
         });

     });
 ");
?>