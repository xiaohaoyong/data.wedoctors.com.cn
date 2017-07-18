<?php

namespace app\controllers;

use app\models\classes\ClassLesson;
use app\models\classes\Lesson;
use app\models\doctor\Account;
use app\models\dynamic\DyComment;
use app\models\dynamic\DyPraise;
use app\models\Helping;
use app\models\User;
use app\models\Users;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\rbac\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class SiteController extends BaseController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {

        $account=Account::find()->sum('money');
        $zhuanjia=Users::find()->where(['type'=>4])->count();
        $hosptail=Helping::find()->where(['totype'=>2])->groupBy('toid')->count();
        $doctor=Helping::find()->where(['totype'=>1])->groupBy('toid')->count();

        $comment=DyComment::find()->groupBy('userid')->count();
        $praise= DyPraise::find()->groupBy('userid')->count();

        $user=Users::find()->where(["!=",'type',0])->count();
        $hudong=round(($comment+$praise)/$user,2)*100;

        //签到总数
        $qiandao=ClassLesson::find()->where(['state'=>1])->groupBy('userid')->count();

        $canyu=round($qiandao/$user,2)*100;

        $time=time();
        //已公布课程数
        $lesson=Lesson::find()->where(['<','datetime',$time])->count();
        $aqiandao=ClassLesson::find()->select([])->where(['state'=>1])->groupBy('userid')->having(['>','count(*)',$lesson])->count();
        $done=round($aqiandao/$user,2)*100;

        $redis=\Yii::$app->rdmp;
        for($i=1;$i<8;$i++){

            $date = date('Ymd', strtotime("- $i day"));
            $login[$date]=$redis->hlen('yimai:log:' . $date);
        }



        return $this->render('index',[
            'money'=>intval($account),
            'zhuanjia'=>$zhuanjia,
            'hosptail'=>$hosptail,
            'doctor'=>$doctor,
            'hudong'=>$hudong,
            'canyu'=>$canyu,
            'done'=>$done,
            'login'=>$login,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        
        if (!\Yii::$app->request->isPost) {
            return $this->renderPartial('login', ['model' => $model]);
        }

        $model->load(\Yii::$app->request->post());
        if(\Yii::$app->request->isPost && \Yii::$app->request->isAjax)
        {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->login()) {
            return $this->goHome();
        }else{
            \Yii::$app->getSession()->setFlash('error', '用户名或密码错误');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return Yii::$app->response->redirect(["/site/login"]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
