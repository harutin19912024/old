<?php
/**
 * Created by PhpStorm.
 * User: Harut
 * Date: 31.03.2020
 * Time: 10:20
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * AdminLte asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
        'css/skin/default_skin/css/theme.css',
        'css/admin-forms.css',
    ];

    public $js = [
        'js/jquery-ui.min.js',
        'js/utility/utility.js',
        'js/demo/demo.js',
        'js/plugins/moment/moment.min.js',
        'js/main.js',
        'js/custom.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
