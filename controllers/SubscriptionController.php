<?php

namespace app\controllers;

use app\components\helper\HuanxinHelper;
use app\components\helper\HuanxinUserHelper;
use app\components\UploadForm;
use app\models\UserInfo;
use app\models\Users;
use Yii;
use app\models\Subscription;
use app\models\SubscriptionSearchModel;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\User;

/**
 * SubscriptionController implements the CRUD actions for Subscription model.
 */
class SubscriptionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Subscription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubscriptionSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subscription model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Subscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subscription();
        $model->loadDefaultValues();

        $params=Yii::$app->request->post();
        if($params){
            $model->load($params);
            $model->addtime=time();
            $user=new Users();
            $user->loadDefaultValues();
            $user->type=$model->type;
            $user->state=1;
            $user->createtime=time();

            //上传图片
            $upload= new UploadForm();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($model,'img'));
            $upload->imageFiles=$imagesFile;
            $image=$upload->upload();
            $model->img=$image[0];

            if($user->save()) {
                $userinfo = new UserInfo();
                $userinfo->userid = $user->id;
                $userinfo->name = $model->name;
                $userinfo->loadDefaultValues();
                $userinfo->avatar=$image[0];
                $model->id=$user->id;
                if($userinfo->save() && $model->save()){
                  return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    print_r($userinfo->errors);
                    print_r($model->errors);
                    exit;
                }
            }else{
                print_r($user->errors);exit;
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $params=Yii::$app->request->post();
        if($params){
            $model->load($params);
            $model->addtime=time();
            $user=Users::findOne($id);
            $user->type=$model->type;

            //上传图片
            $upload= new UploadForm();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($model,'img'));


            if($imagesFile) {
                $upload->imageFiles = $imagesFile;
                $image = $upload->upload();
                $model->img = $image[0];
            }
            if($user->save()) {
                $userinfo = UserInfo::findOne($id);
                $userinfo->userid = $user->id;
                $userinfo->name = $model->name;
                $userinfo->loadDefaultValues();
                if($image[0]) {
                    $userinfo->avatar = $image[0];
                }
                $userinfo->phone=$user->id;
                $model->save();
                $userinfo->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                print_r($user->errors);exit;
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Users::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Subscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subscription::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
