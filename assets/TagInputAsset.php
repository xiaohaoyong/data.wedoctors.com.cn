<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/19
 * Time: 16:45
 */
namespace app\assets;
use yii\web\AssetBundle;
class TagInputAsset extends AssetBundle
{
    public $css=[
       // 'metronic/plugins/jquery-tags-input/jquery.tagsinput.css',
        'metronic/plugins/select2/select2.css',
        'metronic/plugins/select2/plugins-md.css',
        'metronic/plugins/select2/plugins.css',
    ];
    public $js=[
       // 'metronic/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js',
        //'metronic/plugins/bootstrap-touchspin/bootstrap.touchspin.js',
        //'metronic/plugins/typeahead/handlebars.min.js',
        //'metronic/plugins/typeahead/typeahead.bundle.min.js',
        //'metronic/pages/components-form-tools.js',
        //'metronic/plugins/jquery-tags-input/jquery.tagsinput.min.js',

       // 'metronic/layout/scripts/quick-sidebar.js',
      //  'metronic/plugins/jquery-1.11.0.min.js',
        'metronic/pages/form-samples.js',
       // 'metronic/plugins/select2/select2.min.js',


    ];


}