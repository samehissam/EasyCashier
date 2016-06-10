<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
     public $css = [
        'css/site.css',
        'css/bootstrap-timepicker.min.css',
    ];
    public $js = [


        'js/jquery.PrintArea.js',
        'js/main.js',
       // 'js/jquery.js',
        'js/bootstrap-timepicker.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'yii\web\JqueryAsset',
       'Zelenin\yii\SemanticUI\assets\SemanticUICSSAsset',
        'frontend\assets\FontAwesomeAsset',
    ];
}
