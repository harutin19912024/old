<?php
use yii\helpers\Html;
use app\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

app\assets\AdminAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="external-page sb-l-c sb-r-c">
<?php $this->beginBody() ?>

<!-- Start: Main -->
<div id="main" class="animated fadeIn">

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

        <!-- begin canvas animation bg -->
        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>

        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
    <!-- End: Content-Wrapper -->

</div>
<!-- End: Main -->

<!-- BEGIN: PAGE SCRIPTS -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
