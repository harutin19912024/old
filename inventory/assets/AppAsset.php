<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/frontend';
    public $css = [
        'https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap',
        'https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap',
        'css/font-awesome.min.css',
        'css/nice-select.css',
        'css/nice-select.css',
        'css/owl.carousel.min.css',
        'css/magnific-popup.css',
        'css/slicknav.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.magnific-popup.min.js',
        'js/jquery.slicknav.js',
        'js/owl.carousel.min.js',
        'js/jquery.nice-select.min.js',
        'js/mixitup.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
