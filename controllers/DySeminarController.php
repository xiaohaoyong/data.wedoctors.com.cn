<?php

namespace app\controllers;

use app\commands\helper\Html;
use app\components\UploadForm;
use app\models\dynamic\Dyimgs;
use app\models\dynamic\Dynamic;
use app\models\Subscription;
use Yii;
use app\models\dynamic\DySeminar;
use app\models\dynamic\DySeminarSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DySeminarController implements the CRUD actions for DySeminar model.
 */
class DySeminarController extends Controller
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
    public function actions()
    {
        return [
            'Kupload' => [
                'class' => 'pjkui\kindeditor\KindEditorAction',
            ]
        ];
    }
    /**
     * Lists all DySeminar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DySeminarSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DySeminar model.
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
     * Creates a new DySeminar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DySeminar();
        $dynamic=new Dynamic();
        $subscription = new Subscription();
        $dynamicImage=new Dyimgs();

        if($model->load(Yii::$app->request->post())) {

            $model->userid=intval($model->userid)?$model->userid:0;

            $subscription->load(Yii::$app->request->post());
            $dynamic->createtime = time();
            $dynamic->type = 1;
            $dynamic->source = 4;
            $dynamic->userid = $subscription->id;
            $dynamic->save();


            $model->dynamicid=$dynamic->id;

            $dynamicImage->load(Yii::$app->request->post());

            //上传图片
            $upload= new UploadForm();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($dynamicImage,'src'));
            $upload->imageFiles=$imagesFile;
            $image=$upload->upload();
            $dynamicImage->dynamicid=$dynamic->id;
            $dynamicImage->src=$image[0];
            $dynamicImage->save();


            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->dynamicid]);
            }
        }



        return $this->render('create', [
            'subscription'=>$subscription,
            'dynamicImage'=>$dynamicImage,

            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DySeminar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dynamic=Dynamic::findOne($id);
        $dynamic=$dynamic?$dynamic:new Dynamic();

        $dynamicImage=Dyimgs::findOne(['dynamicid'=>$id]);
        $dynamicImage=$dynamicImage?$dynamicImage:new Dyimgs();

        $subscription = Subscription::findOne($dynamic->userid);
        $subscription=$subscription?$subscription:new Subscription();

        if($model->load(Yii::$app->request->post())) {
            $subscription->load(Yii::$app->request->post());
            $dynamic->userid=$subscription->id;
            $dynamic->save();
            $model->save();

            //上传图片
            $upload= new UploadForm();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($dynamicImage,'src'));
            $upload->imageFiles=$imagesFile;
            $image=$upload->upload();
            $dynamicImage->dynamicid=$dynamic->id;
            $dynamicImage->src=$image[0];
            $dynamicImage->save();


            return $this->redirect(['view', 'id' => $model->dynamicid]);

        }
        return $this->render('update', [
            'subscription'=>$subscription,
            'dynamicImage'=>$dynamicImage,

            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DySeminar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Dynamic::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the DySeminar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DySeminar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DySeminar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
