<?php

namespace backend\controllers;

use Yii;
use backend\models\BoxTrans;
use backend\models\BoxTransSearch;
use backend\models\Box;
use backend\models\UploadFile;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;

/**
 * BoxTransController implements the CRUD actions for BoxTrans model.
 */
class BoxTransController extends Controller
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
     * Lists all BoxTrans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BoxTransSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $queryBulanan = BoxTrans::find()->where(['month_trans'=>date('m')]);
        $totalInfaqBulanan = $queryBulanan->sum('value_trans');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalInfaqBulanan' => $totalInfaqBulanan,
        ]);
    }


    public function actionBulanan()
    {
        $searchModel = new BoxTransSearch();
        $dataProvider = $searchModel->searchbulanan(Yii::$app->request->queryParams);
        $queryBulanan = BoxTrans::find()->where(['year_trans'=>date('Y')]);
        $totalInfaqTahunan = $queryBulanan->sum('value_trans');

        return $this->render('bulanan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalInfaqTahunan' => $totalInfaqTahunan,
        ]);
    }


    public function actionTahunan()
    {
        $searchModel = new BoxTransSearch();
        $dataProvider = $searchModel->searchtahunan(Yii::$app->request->queryParams);
        $queryAll = BoxTrans::find();
        $totalInfaqAll = $queryAll->sum('value_trans');

        return $this->render('tahunan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalInfaqAll' => $totalInfaqAll,
        ]);
    }


    public function actionUpload(){
        
        $model = new BoxTrans();
        
        $fileUpload = new UploadFile();

        if(Yii::$app->request->post()){

            $fileUpload->folder='box/';

            $file = $fileUpload->uploadFile();


                if(!empty($file) && $fileUpload->validate()) {

                $path = $fileUpload->getFileUpload();
                $filexx = $file->saveAs($path);

                //Yii::$app->session->setFlash('success', 'File '.$file->name.' has been successfully uploaded');

                try{

                    $inputFileType = \PHPExcel_IOFactory::identify($path);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($path);

                }catch(Exception $e)
                {
                    die('Error');
                }

                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for($row = 1; $row <= $highestRow; $row++) {


                    $dataBox = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL, TRUE, FALSE);

                    if($row == 1) {
                        continue;
                    }

                    $boxInfaq = new BoxTrans();
                    
                    $nobox = $dataBox[0][0];
                    $dataPerson = Box::find()->where(['no_box'=>$nobox])->one();
                    $boxInfaq->id_box = $dataPerson->id_box;
                    $boxInfaq->id_person = $dataPerson->id_person;
                    $boxInfaq->value_trans = $dataBox[0][1];
                    $boxInfaq->month_trans = $dataBox[0][2];
                    $boxInfaq->year_trans = $dataBox[0][3];
                    
                    $boxInfaq->save(false);                    

                    //$meterNumber = array($electricity, $water);

                }

              Yii::$app->session->setFlash('success', 'File '.$file->name.' has been successfully uploaded');

            } else {
                Yii::$app->session->setFlash('error', 'There is no file to upload');
            }

            
            Yii::$app->session->setFlash('success', 'File '.$file->name.' has been successfully uploaded');

            return $this->redirect(['index']);


        }else{
            return $this->render('upload',[
                'model'=>$model
            ]);        
        }
        
    }

    /**
     * Displays a single BoxTrans model.
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
     * Creates a new BoxTrans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BoxTrans();
        $modelKotak = Box::find()
        ->select(['id_box as value','no_box as label'])
        ->asArray()
        ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_trans]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelKotak' => $modelKotak,
            ]);
        }
    }

    /**
     * Updates an existing BoxTrans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_trans]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BoxTrans model.
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
     * Finds the BoxTrans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BoxTrans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BoxTrans::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
