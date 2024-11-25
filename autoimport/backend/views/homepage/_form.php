<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Language;

/* @var $this yii\web\View */
/* @var $model backend\models\Sitesettings */
/* @var $form yii\widgets\ActiveForm */

$languages = Language::find()->asArray()->all();
if (!$model->isNewRecord) {
    $formId = 'homepageUpdate';
    $action = '/homepage/update?id=' . $model->id;
} else {
    $formId = 'homepageCreate';
    $action = '/homepage/create';
}
?>
<div class="repairs-form">
    <?= Html::a(Yii::t('app', 'Back to settings list'), ['/site/index'], ['class'=>'btn btn-primary mb15']) ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false" data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><?php echo ($model->isNewRecord)? Yii::t('app','Add New Home Page Settings'): Yii::t('app','Update Home Page Settings')?></span>
            <span style="float: left;" class="panel-controls"><a href="#" class="panel-control-loader"></a><a href="#" style="margin-left: 5px" class="panel-control-collapse"></a></span>
            <ul class="nav panel-tabs-border panel-tabs">

                <?php  if(!$model->isNewRecord){
                    foreach($languages as $value): ?>
                        <li class="<?php if($value['is_default']){$defoultId =$value['id']; echo 'active';}?>">
                            <a href="#tab_<?php echo $value['id']?>"  data-toggle="tab" onclick="editHomePageTr(<?php echo $value['id'];?>,<?php echo $model->id; ?>,<?php echo $value['is_default']; ?>)" >
                                <span class="flag-xs flag-<?php echo $value['short_code']?>"></span>
                            </a>
                        </li>
                    <?php endforeach;
                }
                ?>
            </ul>
        </div>
        <div class="panel-body"  style="display: block;">
            <div class="tab-content pn br-n admin-form">
                <div class="tab-pane" id="tr_homepage"></div>

                <div class="tab-pane active" id="tab_<?php echo $defoultId;?>">
                    <?php $form = ActiveForm::begin([
                        'action' => [$action],
                        'id' => $formId,
                    ]); ?>
					<input type="hidden" value="<?=$model->path?>" name="imagePath">
                    <div class="tab-content row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'title', ['template' => '{label}<div class="">{input}{error}</div>'])
                                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Title')])->label(false) ?>
                        </div>
						
                    </div>
					<div class="tab-content row">
						<div class="col-md-12">
						<label for="customer-name" class="field prepend-icon"><?=Yii::t('app', 'Description')?></label>
						<?=
                                    $form->field($model, 'description')
                                    ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Description')])->label(false)
                            ?>
						</div>
					</div>
					<div class="tab-content row">
						<div class="col-md-12 pt15">
								<label><?=Yii::t('app','Image Size');?>:(265x125)</label>
								<?=
										$form->field($model, 'path', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
										->fileInput(
												[
													'multiple' => false,
													'accept' => 'image/*',
													'onchange' => 'showMyImage(this, -1)',
													'class' => 'inputfile inputfile-6',
													'data-multiple-caption' => "{count} files selected",
										])->label('<span></span> <strong class="btn btn-primary btn-file"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Brows…</strong>', ['class' => ''])
								?>

                        </div>
					</div>
					<div class="section row">
                        <div class="hidden" id="defaultimg">
                            <input type="radio" id="def_img_part_-1" name="defaultImage" value=""
                                   class="hidden"/>
                        </div>
                        <div class="col-md-12 pt15" id="selectedFiles_-1">

                        </div>
                    </div>
                    <?php if (!$model->isNewRecord): ?>
                        <div class="col-md-6 pl15 pull-right">
                            <div class="gallery-page sb-l-o sb-r-c onload-check">
                                <div class="">
                                    <div id="mix-container">
                                        <div class="fail-message">
                                            <span><?php echo Yii::t('app', 'No images were found for the selected product') ?></span>
                                        </div>

                                        <?php if (!empty($model->path)) : ?>
                                                <div style="display: inline-block;"
                                                     class="mix label1 folder1"
                                                     id="image_<?php echo $model->id ?>">
                                                    <span class="close remove">
                                                        <i class="fa fa-close icon-close-slider"></i>
                                                    </span>
                                                    <div class="panel p6 pbn">
                                                        <div class="of-h">
                                                            <?php
                                                            echo Html::img('/uploads/images/homepage/' . $model->id . '/' . $model->path, [
                                                                'class' => 'img-responsive',
                                                                'title' => $model->title,
                                                                'alt' => '',
                                                            ])
                                                            ?>
                                                            <div class="row table-layout change_image"
                                                                 data-key="<?php echo $model->id ?>" product-id="<?= $model->id ?>">
                                                                <input type="hidden" value="slider" id="category">
                                                                <div class="col-xs-8 va-m pln">
                                                                    <h6><?= $model->title . '.jpg' ?></h6>
                                                                </div>
                                                                <div
                                                                    class="col-xs-4 text-right va-m prn">
                                                                    <span
                                                                        class="fa fa-eye-slash fs12 text-muted"></span>
                                                                    <span
                                                                        class="fa fa-circle fs10 text-info ml10"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                        <div class="gap"></div>
                                        <div class="gap"></div>
                                        <div class="gap"></div>
                                        <div class="gap"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="form-group col-md-12">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                            [
                                'class' => $model->isNewRecord ? 'btn btn-sm btn-primary pull-right ' : 'btn btn-sm btn-success pull-right',
                                'id' => $formId,
                                'type' => 'button'
                            ]) ?>
                        <?php if (!$model->isNewRecord) {
                            echo Html::a(Yii::t('app', 'Reset'), Url::to('/' . Yii::$app->language . '/brand/index', true), ['class' => 'btn btn-default btn-sm ph25 reste-button pull-right']);
                        } ?>
                    </div>
                        <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>