<?php

namespace app\controllers;

use app\models\dynamic\Dynamic;
use Yii;
use app\models\dynamic\DyApp;
use app\models\dynamic\DyAppSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DyAppController implements the CRUD actions for DyApp model.
 */
class DyAppController extends Controller
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
     * Lists all DyApp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DyAppSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DyApp model.
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
     * Creates a new DyApp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DyApp();
        $dynamic = new Dynamic();
        $model->loadDefaultValues();
        $dynamic->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {

            $dynamic->load(Yii::$app->request->post());
            $dynamic->createtime = time();
            $dynamic->type = 1;
            $dynamic->source = 6;
            $dynamic->save();
            $model->dynamicid=$dynamic->id;
            $model->save();


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dynamic'=>$dynamic,
            ]);
        }
    }

    /**
     * Updates an existing DyApp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dynamic=Dynamic::findOne($model->dynamicid);
        $dynamic=$dynamic?$dynamic:new Dynamic();


        if ($model->load(Yii::$app->request->post())) {
            $dynamic->save();
            $model->dynamicid=$dynamic->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dynamic'=>$dynamic,
            ]);
        }
    }

    /**
     * Deletes an existing DyApp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DyApp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DyApp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DyApp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
