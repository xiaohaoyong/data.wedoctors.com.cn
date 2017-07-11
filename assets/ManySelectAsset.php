<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/19
 * Time: 16:45
 */
namespace app\assets;
use yii\web\AssetBundle;
class ManySelectAsset extends AssetBundle
{
    public $css=[
        'metronic/plugins/select2/select2.css',
        'metronic/plugins/select2/plugins-md.css',
        'metronic/plugins/select2/plugins.css',
    ];
    public $js=[
        'metronic/plugins/bootstrap/js/bootstrap.min.js',
        'metronic/pages/components-dropdowns.js',
        'metronic/plugins/select2/select2.min.js',
    ];
}