<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Search model -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="logo">
                <a href="<?=Url::to(['site/index'])?>"><img src="/frontend/img/logo.png" alt=""></a>
            </div>
            <div class="header-right">
                <img src="/frontend/img/icons/search.png" alt="" class="search-trigger">
                <img src="/frontend/img/icons/man.png" alt="">
                <a href="#">
                    <img src="/frontend/img/icons/bag.png" alt="">
                    <span>2</span>
                </a>
            </div>
            <div class="user-access">
                <?php  if(Yii::$app->user->isGuest): ?>
                    <a href="<?=Url::to(['/site/signup'])?>">Register</a>
                    <a href="<?=Url::to(['/site/login'])?>" class="in">Sign in</a>
                <?php else:?>
                    <?=Html::beginForm(['/site/logout'], 'post')?>
                    <?=Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )?>
                    <?=Html::endForm()?>
                <?php endif;?>
            </div>
            <nav class="main-menu mobile-menu">
                <ul>
                    <li><a class="active" href="<?=Url::to(['site/index'])?>">Home</a></li>
                    <li><a href="<?=Url::to(['site/about'])?>">About</a></li>
                    <li><a href="<?=Url::to(['site/contact'])?>">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Header Info Begin -->
<div class="header-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="header-item">
                    <img src="/frontend/img/icons/delivery.png" alt="">
                    <p>Free shipping on orders over $30 in USA</p>
                </div>
            </div>
            <div class="col-md-4 text-left text-lg-center">
                <div class="header-item">
                    <img src="/frontend/img/icons/voucher.png" alt="">
                    <p>20% Student Discount</p>
                </div>
            </div>
            <div class="col-md-4 text-left text-xl-right">
                <div class="header-item">
                    <img src="/frontend/img/icons/sales.png" alt="">
                    <p>30% off on dresses. Use code: 30OFF</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Info End -->

<?= $content ?>

<!-- Footer Section Begin -->
<footer class="footer-section spad">
    <div class="container">
        <div class="newslatter-form">
            <div class="row">
                <div class="col-lg-12">
                    <form action="#">
                        <input type="text" placeholder="Your email address">
                        <button type="submit">Subscribe to our newsletter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="social-links-warp">
        <div class="container">
            <div class="social-links">
                <a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
                <a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
                <a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
                <a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
                <a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
                <a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
            </div>
        </div>

        <div class="container text-center pt-5">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy; Harut <?= date('Y') ?>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>


    </div>
</footer>
<!-- Footer Section End -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
