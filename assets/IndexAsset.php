<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 17/7/11
 * Time: 下午1:45
 */

namespace app\assets;


use yii\web\AssetBundle;

class IndexAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'metronic/layout/scripts/index.js?t=123123',
        'metronic/plugins/flot/jquery.flot.min.js',
        'metronic/plugins/flot/jquery.flot.resize.min.js',
        'metronic/plugins/flot/jquery.flot.categories.min.js',


    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
} 