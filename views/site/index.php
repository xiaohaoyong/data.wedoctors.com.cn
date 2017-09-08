<?php

/* @var $this yii\web\View */

$this->title = '首页';
\app\assets\IndexAsset::register($this);
?>
<div class="site-index">
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-madison">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$money?> / 6万
                    </div>
                    <div class="desc">
                        帮扶费用总数
                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['account/index'])?>">
                    详情 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$zhuanjia?>
                    </div>
                    <div class="desc">
                        帮扶专家成员数

                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['users/index','user'=>1])?>">
                    详情 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-haze">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$hosptail?>
                    </div>
                    <div class="desc">
                        帮扶医院数
                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['hospital/index'])?>">
                    详情 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple-plum">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$doctor?>
                    </div>
                    <div class="desc">
                        帮扶医生数
                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['users/index'])?>">
                    明细 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$canyu?>%
                    </div>
                    <div class="desc">
                        参与课程数
                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['classes/index'])?>">
                    明细 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat yellow">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$done?>%
                    </div>
                    <div class="desc">
                        课程完成率
                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['classes/index'])?>">
                    明细 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?=$hudong?>%
                    </div>
                    <div class="desc">
                        课程互动率
                    </div>
                </div>
                <a class="more" href="<?=\yii\helpers\Url::to(['classes/index'])?>">
                    明细 <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-sharp hide"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">活跃用户数</span>
                        <span class="caption-helper">每周</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_statistics_loading">
                        <img src="metronic/img/loading.gif" alt="loading"/>
                    </div>
                    <div id="site_statistics_content" class="display-none">
                        <div id="site_statistics" class="chart">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <div class="clearfix">
    </div>
</div>
<?php
foreach($login as $k=>$v)
{
    $visitors.="\n['".$k."',$v],";
}

$jsform="
var visitors = [$visitors];
Index.init();
Index.initCharts(visitors); // init index page's custom scripts

";
$js[]=$jsform;
$this->registerJs(implode("\n",$js));

?>