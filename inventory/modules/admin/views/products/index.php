<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Products Table';

$nameOpt = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label class="field prepend-icon">{input}<label class="field-icon"><i class="fa fa-tag"></i></label></label>',
];
$vendorOpt = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label class="field prepend-icon">{input}<label class="field-icon"><i class="fa fa-user"></i></label></label>',
];
$priceOpt = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label class="field prepend-icon">{input}<label class="field-icon"><i class="fa fa-usd"></i></label></label>',
];
$imageOpt = [
    'options' => ['tag' => false],
    'inputTemplate' => '{input}',
];

$this->registerCssFile(
    '@web/js/plugins/colorpicker/css/bootstrap-colorpicker.min.css',
    ['depends' => [\app\assets\AdminAsset::class]]
);
$this->registerCssFile(
    '@web/js/plugins/select2/css/core.css',
    ['depends' => [\app\assets\AdminAsset::class]]
);
?>

<!-- begin: .tray-center -->
<div class="tray tray-center">

    <!-- create new order panel -->
    <div class="panel mb25 mt5">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Add New Product</span>
        </div>
        <div class="panel-body p20 pb10">
            <div class="tab-content pn br-n admin-form">
                <div id="tab1_1" class="tab-pane active">

                    <?php $form = ActiveForm::begin([
                        'action' => ['/admin/products/create'],
                        'id' => 'product-create',
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
                                          <?=$form->field($model, 'img_path',$imageOpt)->fileInput()->label(false) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10 pl15">

                            <div class="col-md-3 pl15">
                                <div class="section row mb15">
                                    <div class="col-xs-12">
                                        <?= $form
                                            ->field($model, 'name', $nameOpt)
                                            ->label(false)
                                            ->textInput(['placeholder' => $model->getAttributeLabel('name'),'class'=>'event-name gui-input br-light light']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 pl15">
                                <div class="section row mb15">
                                    <div class="col-xs-12">
                                        <?= $form
                                            ->field($model, 'vendor_id')
                                            ->label(false)
                                            ->dropDownList($model->getVendorsList(),['placeholder' => $model->getAttributeLabel('vendor_id'),'class'=>'event-name gui-input br-light light select2']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 pl15">
                                <div class="section row mb15">
                                    <div class="col-xs-12">
                                        <?= $form
                                            ->field($model, 'type_id')
                                            ->label(false)
                                            ->dropDownList($model->getTypesList(),['placeholder' => $model->getAttributeLabel('type_id'),'class'=>'event-name gui-input br-light light select2']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 pl15">
                                <div class="section row mb15">
                                    <div class="col-xs-12">
                                        <?= $form
                                            ->field($model, 'price', $priceOpt)
                                            ->label(false)
                                            ->textInput(['placeholder' => $model->getAttributeLabel('price'),'class'=>'event-name gui-input br-light light']) ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-10 pl15">

                                <div class="col-md-3 pl15">
                                    <div class="section row mb15">
                                        <div class="col-xs-12">
                                            <?= $form
                                                ->field($model, 'serial_number', $nameOpt)
                                                ->label(false)
                                                ->textInput(['placeholder' => $model->getAttributeLabel('serial_number'),'class'=>'event-name gui-input br-light light']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 pl15">
                                    <div class="section row mb15">
                                        <div class="col-xs-12">
                                            <?= $form
                                                ->field($model, 'weight', $nameOpt)
                                                ->label(false)
                                                ->textInput(['placeholder' => $model->getAttributeLabel('weight'),'class'=>'event-name gui-input br-light light']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 pl15">
                                    <div class="section row mb15">
                                        <div class="col-xs-12">
                                            <?= $form
                                                ->field($model, 'color', $nameOpt)
                                                ->label(false)
                                                ->textInput(['placeholder' => $model->getAttributeLabel('color'),'class'=>'event-name gui-input br-light light']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 pl15">
                                    <div class="section row mb15">
                                        <div class="col-xs-12">
                                            <?= $form
                                                ->field($model, 'release_date', $nameOpt)
                                                ->label(false)
                                                ->textInput(['placeholder' => $model->getAttributeLabel('release_date'),'class'=>'event-name gui-input br-light light']) ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-10 pl15">
                                <div class="col-md-12">
                                    <?= $form
                                        ->field($model, 'tags')
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('tags'),'class'=>'event-name gui-input br-light light']) ?>
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
        <div class="panel-menu p12 admin-form theme-primary">
            <div class="row">
                <div class="col-md-5">
                    <label class="field select">
                        <select id="filter-category" name="filter-category">
                            <option value="0">Filter by Category</option>
                            <option value="1">Smart Phones</option>
                            <option value="2">Smart Watches</option>
                            <option value="3">Notebooks</option>
                            <option value="4">Desktops</option>
                            <option value="5">Music Players</option>
                        </select>
                        <i class="arrow"></i>
                    </label>
                </div>
                <div class="col-md-5">
                    <label class="field select">
                        <select id="filter-status" name="filter-status">
                            <option value="0">Filter by Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Low Stock</option>
                            <option value="4">Out of Stock</option>
                        </select>
                        <i class="arrow"></i>
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="field select">
                        <select id="bulk-action" name="bulk-action">
                            <option value="0">Actions</option>
                            <option value="1">Edit</option>
                            <option value="2">Delete</option>
                            <option value="3">Active</option>
                            <option value="4">Inactive</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body pn">
            <div class="table-responsive">

                <div class="panel-body pn">
                    <div class="table-responsive">
                        <?php Pjax::begin(); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => [
                                'class' => 'table admin-form theme-warning tc-checkbox-1 fs13',
                                'id' => 'tbl_products'
                            ],
                            'filterRowOptions' => [
                                'role' => "row",
                            ],
                            'rowOptions' => [
                                'role' => "row",
                                'class' => 'odd'
                            ],
                            'summary' => false,
                            'options' => ['class' => 'br-r', 'id' => 'products'],
                            'columns' => [
                                'id',
                                ['attribute' => 'logo',
                                    'format' => 'html',
                                    'label' => Yii::t('app','Image'),
                                    'value' => function ($model) {
                                        $path = 'uploads/products/thumb/' . $model->img_path;
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
$this->registerJsFile(
    '@web/js/plugins/datepicker/js/bootstrap-datetimepicker.js',
    ['depends' => [\app\assets\AdminAsset::class]]
);
$this->registerJsFile(
    '@web/js/plugins/tagsinput/tagsinput.min.js',
    ['depends' => [\app\assets\AdminAsset::class]]
);
$this->registerJsFile(
    '@web/js/plugins/colorpicker/js/bootstrap-colorpicker.min.js',
    ['depends' => [\app\assets\AdminAsset::class]]
);
$this->registerJsFile(
    '@web/js/plugins/select2/select2.min.js',
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
    $('#products-tags').tagsinput({
      tagClass: function(item) {
        return 'label bg-primary light';
      }
    });
    $('#products-release_date').datetimepicker({
			format: 'L'
    });
    $('#products-color').colorpicker();
    $('.select2').select2();
");
?>