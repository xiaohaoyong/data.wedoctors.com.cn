<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/19
 * Time: 16:45
 */
namespace app\assets;
use yii\web\AssetBundle;
use \yii\web\View;
class SearchSelectAsset extends AssetBundle
{
    public $css=[
        'metronic/plugins/jquery-nestable/jquery.nestable.css',
    ];
    public $js=[
        ['metronic/plugins/jquery-1.11.0.min.js', 'position' => View::POS_HEAD],
        'metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'metronic/plugins/jquery-nestable/jquery.nestable.js',
        'metronic/pages/ui-nestable.js',
        'metronic/plugins/bootstrap/js/bootstrap.min.js',
    ];
}