<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/19
 * Time: 16:45
 */
namespace app\assets;
use yii\web\AssetBundle;
class ManyPagesAsset extends AssetBundle
{
    public $css=[
        'metronic/plugins/select2/select2.css',
        'metronic/plugins/select2/plugins-md.css',
        'metronic/plugins/select2/plugins.css',
    ];
    public $js=[
      //  'metronic/plugins/jquery.min.js',
        'metronic/plugins/select2/select2.min.js',
        'metronic/pages/form-wizard.js',



        'metronic/plugins/typeahead/handlebars.min.js',
        'metronic/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js',
        'metronic/plugins/bootstrap-touchspin/bootstrap.touchspin.js',
        'metronic/plugins/typeahead/typeahead.bundle.min.js',
        'metronic/pages/components-form-tools.js',


        'metronic/plugins/jquery-validation/js/jquery.validate.min.js',
        'metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js',
        'metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    ];
}