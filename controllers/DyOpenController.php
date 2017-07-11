<?php

namespace app\controllers;

use app\commands\helper\Html;
use app\components\upload\UploadFile;
use app\components\UploadForm;
use app\models\dynamic\Dyimgs;
use app\models\dynamic\Dynamic;
use Yii;
use app\models\dynamic\DyOpen;
use app\models\dynamic\DyOpenSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DyOpenController implements the CRUD actions for DyOpen model.
 */
class DyOpenController extends Controller
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
     * Lists all DyOpen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DyOpenSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DyOpen model.
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
     * Creates a new DyOpen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DyOpen();
        $dynamic = new Dynamic();
        $dynamicImage=new Dyimgs();
        $params=$model->load(Yii::$app->request->post());
        if($params){



            //生成内容主体
            $dynamic->load(Yii::$app->request->post());
            $dynamic->createtime = time();
            $dynamic->type = 1;
            $dynamic->source = 5;
            $dynamic->save();


            $dynamicImage->load(Yii::$app->request->post());

            //上传图片
            $upload= new UploadForm();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($dynamicImage,'src'));
            $upload->imageFiles=$imagesFile;
            $image=$upload->upload();
            $dynamicImage->dynamicid=$dynamic->id;
            $dynamicImage->src=$image[0];
            $dynamicImage->save();

            $model->dynamicid=$dynamic->id;
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->dynamicid]);
            }
        }
        return $this->render('create', [
            'dynamicImage'=>$dynamicImage,
            'dynamic'=>$dynamic,
            'model' => $model,
        ]);

    }
    /**
     * Creates a new DyOpen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTest()
    {
        $model = new DyOpen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dynamicid]);
        } else {
            return $this->renderPartial('testcreate', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing DyOpen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dynamic=Dynamic::findOne($id);
        $dynamicImage=Dyimgs::findOne(['dynamicid'=>$id]);
        $dynamicImage=$dynamicImage?$dynamicImage:new Dyimgs();
        $params=$model->load(Yii::$app->request->post());
        if($params){
            $dynamic->load(Yii::$app->request->post());
            $dynamic->save();

            $upload= new UploadForm();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($dynamicImage,'src'));
            $upload->imageFiles=$imagesFile;
            $image=$upload->upload();
            $dynamicImage->src=$image[0];
            $dynamicImage->save();

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->dynamicid]);
            }
        }

        return $this->render('update', [
            'dynamicImage'=>$dynamicImage,
            'dynamic'=>$dynamic,
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing DyOpen model.
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
     * Finds the DyOpen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DyOpen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DyOpen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
