<?php

namespace app\controllers;

use app\components\UploadForm;
use app\models\dynamic\Dynamic;
use app\models\InfoImage;
use Yii;
use app\models\article\InfoArticle;
use app\models\article\InfoArticleSearchModel;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * InfoArticleController implements the CRUD actions for InfoArticle model.
 */
class InfoArticleController extends Controller
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
     * Lists all InfoArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoArticleSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InfoArticle model.
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
     * Creates a new InfoArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoArticle();

        $model->loadDefaultValues();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());

            if($model->urls && ($model->model==3 || $model->model==4)){
                $model->content=$model->urls;
            }

            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($model,'image'));
            if($imagesFile) {
                $upload= new UploadForm();
                $upload->imageFiles = $imagesFile;
                $image = $upload->upload();
                $model->image = $image[0];
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);

    }

    public function actionImages($id)
    {

        if(Yii::$app->request->isPost){
            $model=new InfoImage();
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($model,'image'));
             if($imagesFile) {
                 $description=Yii::$app->request->post('description')[$imagesFile[0]->name];
                 $upload = new UploadForm();
                 $upload->imageFiles = $imagesFile;
                 $image = $upload->upload();
                 $model->image = $image[0];
                 $model->artid = $id;
                 $model->description=$description;
                 $model->save();
                 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                 return array(
                     'files'=>array(
                         array(
                             'name'=>$image[0],
                             'size'=>$imagesFile[0]->size,
                             'type'>$imagesFile[0]->type,
                             'url'=>$image[0],
                             'id'=>$model->id,
                             'description'=>$model->description,
                             'thumbnailUrl'=>$image,
                             'deleteUrl'=>Url::to(['info-image/delete','id'=>$model->id]),
                             'deleteType'=>'DELETE'
                         )
                     )
                 );
             }

        }
        if(Yii::$app->request->get('type',0)==2)
        {
            $model=InfoImage::findAll(['artid'=>$id]);
            foreach($model as $k=>$v)
            {
                $imgs['name']=$v->image;
                $imgs['url']=$v->image;
                $imgs['thumbnailUrl']=$v->image;
                $imgs['deleteUrl']=Url::to(['info-image/delete','id'=>$v['id']]);
                $imgs['deleteType']='GET';
                $imgs['id']=$v->id;
                $imgs['description']=$v->description;
                $return['files'][]=$imgs;
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $return;

        }
        return $this->render('images');
    }

    /**
     * Updates an existing InfoArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->urls=$model->content;
        if(Yii::$app->request->isPost){
            //var_dump(Yii::$app->request->post());exit;
            $model->load(Yii::$app->request->post());

            if($model->urls && ($model->model==3 || $model->model==4)){
                $model->content=$model->urls;
            }
            $imagesFile = UploadedFile::getInstancesByName(Html::getInputName($model,'image'));
            if($imagesFile) {
                $upload= new UploadForm();
                $upload->imageFiles = $imagesFile;
                $image = $upload->upload();
                $model->image = $image[0];
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InfoArticle model.
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
     * Finds the InfoArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
