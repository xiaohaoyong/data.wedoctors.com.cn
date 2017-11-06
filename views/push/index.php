<?php
$this->title = "选择推送用户类型";

$list[]=[
    'id'=>'all',
    'value'=>'all',
    'text'=>'全部用户',
    'parent'=>'#',
];

$list[]=[
    'id'=>'subject',
    'value'=>'subject',
    'text'=>'科室',
    'parent'=>'#',
];


$list[]=[
    'id'=>'usertype',
    'value'=>'usertype',
    'text'=>'用户类型',
    'parent'=>'#',
];
$list[]=[
    'id'=>'area',
    'value'=>'area',
    'text'=>'地区',
    'parent'=>'#',
];
$usertype=\app\models\Users::$typeText[0];
foreach($usertype as $k=>$v)
{
    $rs['id']='usertype-'.$k;
    $rs['value']='usertype-'.$k;
    $rs['text']=$v;
    $rs['parent']='usertype';
    $rs["icon"]= "fa fa-check fa-ellipsis-v";
    $list[]=$rs;
    $i++;
}
foreach(\app\models\doctor\Subject::$subject_b as $k=>$v)
{
    $rs['id']='subject-'.$k;
    $rs['value']='subject-'.$k;
    $rs['text']=$v;
    $rs['parent']='subject';
    $rs["icon"]= "fa fa-check fa-ellipsis-v";
    $list[]=$rs;
}
foreach(\app\models\Area::$province as $k=>$v)
{
    $rs['id']='area-'.$k;
    $rs['value']='area-'.$k;
    $rs['text']=$v;
    $rs['parent']='area';
    $list[]=$rs;
    if(\app\models\Area::$city[$k])
    {
        foreach(\app\models\Area::$city[$k] as $ck=>$cv)
        {
            $rs['id']='area-1-'.$ck;
            $rs['value']='area-'.$ck;
            $rs['text']=$cv;
            $rs['parent']='area-'.$k;
            $list[]=$rs;
            if(\app\models\Area::$county[$ck])
            {
                foreach(\app\models\Area::$county[$ck] as $cuk=>$cuv)
                {
                    $rs['id']='area-2-'.$cuk;
                    $rs['value']='area-'.$cuk;
                    $rs['text']=$cuv;
                    $rs['parent']='area-1-'.$ck;
                    $list[]=$rs;
                }
            }
        }
    }
}
//shuffle($data);
echo \app\components\widgets\JstreeWidget::widget(
    [
        'id'=>'jstree',
        'field'=>'childs',
        'action'=>\Yii::$app->urlManager->createUrl(['push/index']),
        'clientOptions'=>[
            'plugins' => ['checkbox'],
            'core' =>
                ['data' =>$list],
        ]
    ]
);
?>
<div id="jstree"></div>