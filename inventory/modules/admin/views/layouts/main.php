<?php
use app\widgets\Alert;
use app\widgets\Menu;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var \yii\web\View $this */
/* @var $content string */

app\assets\AdminAsset::register($this);

$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));
$com = strcmp($currentUrl, "/site/index");
if (!strcmp($currentUrl, '/site/index')) {
    //echo $currentUrl;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,200,300,400,600" rel="stylesheet"
          type="text/css">
    <?php $this->head() ?>
</head>
<body class="dashboard-page sb-l-o sb-r-c">
<?php $this->beginBody() ?>


<!-- End: Theme Settings Pane -->

<!-- Start: Main -->
<div id="main">

    <!-----------------------------------------------------------------+
       ".navbar" Helper Classes:
    -------------------------------------------------------------------+
       * Positioning Classes:
        '.navbar-static-top' - Static top positioned navbar
        '.navbar-static-top' - Fixed top positioned navbar

       * Available Skin Classes:
         .bg-dark    .bg-primary   .bg-success
         .bg-info    .bg-warning   .bg-danger
         .bg-alert   .bg-system
    -------------------------------------------------------------------+
      Example: <header class="navbar navbar-fixed-top bg-primary">
      Results: Fixed top navbar with blue background
    ------------------------------------------------------------------->

    <!-- Start: Header -->
    <header class="navbar navbar-fixed-top">
        <ul class="nav navbar-nav navbar-right">
            <!--li>
                <a href="javascript:;" onclick="sendMessage()">
                    <span class="glyphicons glyphicons-message_out"></span>
                </a>
            </li -->
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
                    <?= Html::img("@web/img/avatars/1.jpg", ["alt" => "avatar", "class" => "mw30 br64 mr15"]) ?>
                    <?php echo Yii::$app->user->identity->username ?>
                    <span class="caret caret-tp hidden-xs"></span>
                </a>
                <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
                    <li class="dropdown-footer">
                        <?php
                        echo Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                '<span class="fa fa-power-off pr5"></span>Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                            )
                            . Html::endForm()
                        ?>

                    </li>
                </ul>
            </li>
        </ul>

    </header>
    <aside id="sidebar_left" class="nano nano-primary affix">
        <!-- Start: Sidebar Left Content -->
        <div class="sidebar-left-content nano-content">

            <!-- Start: Sidebar Header -->
            <header class="sidebar-header">
                <!-- Sidebar Widget - Author (hidden)  -->
                <div class="sidebar-widget author-widget hidden">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="/img/avatars/3.jpg" class="img-responsive">
                        </a>
                        <div class="media-body">
                            <div class="media-links">
                                <a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="pages_login(alt).html">Logout</a>
                            </div>
                            <div class="media-author">Michael Richards</div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Widget - Search (hidden) -->
                <div class="sidebar-widget search-widget hidden">
                    <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                          </span>
                          <input type="text" id="sidebar-search" class="form-control" placeholder="Search...">
                    </div>
                </div>

            </header>
            <!-- End: Sidebar Header -->

            <?php
            echo Menu::widget([
                'options' => ['class' => 'nav sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['/admin/dashboard'], 'icon' => 'shopping-cart', 'active' => $this->context->id == 'admin'],
                    ['label' => 'Products', 'url' => ['/admin/products'], 'icon' => 'tags', 'active' => $this->context->id == 'admin'],
                    ['label' => 'Vendors', 'url' => ['/admin/vendors'], 'icon' => 'tower', 'active' => $this->context->id == 'admin'],
                    ['label' => 'Types', 'url' => ['/admin/types'], 'icon' => 'check', 'active' => $this->context->id == 'admin'],
                    ['label' => 'Users', 'url' => ['/admin/users'], 'icon' => 'user metro-icon', 'active' => $this->context->id == 'admin'],
                ],
            ]);
            ?>
        </div>
    </aside>
    <section id="content_wrapper">
        <!-- Start: Topbar -->
        <header id="topbar">
            <div class="topbar-left">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
            </div>

        </header>
        <!-- End: Topbar -->

        <!-- Begin: Content -->
        <section id="content" class="animated fadeIn">
            <?= Alert::widget() ?>
            <div id="admin-alerts" class="alert-success alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div></div>
            </div>
            <?= $content ?>
        </section>

    </section>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
