<?php

namespace app\controllers;

use app\models\operate\AdminOperate;
use app\models\operate\Operate;
use app\models\rbac\AuthMenu;
use app\models\rbac\Rbac;

class BaseController extends \yii\web\Controller {

    /**
     * 不需要检测的 [权限节点/动作]
     * @var type
     */
    private $notCheckAccess = ['/rbac/access-error', 'site/index'];

    private $ignore = [
        'site/login', 'site/logout'
    ];

    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);

        $path = \Yii::$app->request->pathInfo;

        if (in_array($path, $this->ignore))
        {
            return true;
        }

        if(\Yii::$app->user->isGuest)
        {
            return $this->redirect(\Yii::$app->user->loginUrl)->send();
        }

        $moduleId = \Yii::$app->controller->module->id === \Yii::$app->id ? '' : \Yii::$app->controller->module->id . '/';
        $controllerId = \Yii::$app->controller->id . '/';
        $actionId = \Yii::$app->controller->action->id;

        $permissionName = $moduleId . $controllerId . $actionId;
        $notCheckAccess = join('|', $this->notCheckAccess);

        // 如果是登录或退出动作
        if (stripos('/site/login|/site/logout', $permissionName) !== false) {
            return true;
        }

        // 不需要检测的 [权限节点/动作]
        if (stripos($notCheckAccess, $permissionName) !== false) {
            return true;
        }

        // 验证是否是超级管理员
        if (\Yii::$app->user->identity->is_admin == 1) {
            return true;
        }

        // 验证权限
        $rbac = new Rbac();
        if (!$rbac->checkAccess(\Yii::$app->user->identity->getId(), $permissionName)) {
            header("Content-type:text/html;charset=utf-8");
            exit("<script>alert('暂无权限');history.back();</script>");
        }

        return true;
    }

    /**
     * 权限错误提示
     * @return type
     */
    public function actionAccessError() {
        $error = '暂无权限，你可以联系管理员.';
        return $this->render('/site/error', ['name' => 'Error', 'message' => $error]);
    }

    public function afterAction($action, $result)
    {
        $actionName = $action->id;
        $controller = $action->controller->id;
        if($actionName != 'index')
        {
            $menu_id = AuthMenu::find()->where(['name' => $controller.'/'.$actionName])->scalar();
            if(!empty($menu_id))
            {
                $operate = Operate::findOne($menu_id);
                if(!empty($operate))
                {
                    $model = new AdminOperate();
                    $model->operate_id = (int) $operate->primaryKey;
                    $model->operate_time = time();
                    $model->admin_id = (int) \Yii::$app->user->identity->getId();
                    $model->save();
                }
            }
        }

        return parent::afterAction($action, $result);
    }
}
