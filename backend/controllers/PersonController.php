<?php

namespace backend\controllers;

use Yii;
use backend\models\Person;
use backend\models\UploadFile;
use yii\web\UploadedFile;
use backend\models\PersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload(){
        
        $model = new Person();
        
        $fileUpload = new UploadFile();

        if(Yii::$app->request->post()){

            $fileUpload->folder='person/';

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


                    $dataPerson = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL, TRUE, FALSE);

                    if($row == 1) {
                        continue;
                    }

                    $person = new Person();
                    
                    $person->name_person = $dataPerson[0][0];
                    $person->zona = $dataPerson[0][1];
                    $person->rt = $dataPerson[0][2];
                    $person->blok = $dataPerson[0][3];
                    $person->no_rumah = $dataPerson[0][4];
                    $person->save(false);                    

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
     * Displays a single Person model.
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_person]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_person]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDownloadPerson()
    {        
        
        $model=Person::find()->all();

        //var_dump($meterNumber);die();

        $objPHPExcel = new \PHPExcel();


        $sheet = 0;

        $objPHPExcel->getProperties()
                    ->setCreator("Property Management Information System")
                    ->setLastModifiedBy('Property Management Information System')
                    ->setTitle("Property Management Information System")
                    ->setSubject("COA")
                    ->setKeywords("COA")
                    ->setCategory("COA");

        $objPHPExcel->setActiveSheetIndex($sheet);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);

        $objPHPExcel->getActiveSheet()->setTitle('COA')
                    ->setCellValue('A1', 'Nama KK')
                    ->setCellValue('B1', 'ID_KK');
                    
                    
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        
        

        $row = 2;

        //var_dump($model);die();

            foreach ($model as $data) {

                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $data->name_person);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $data->id_person);
        
                
                $row++;
            }

            header('Content-Type: application/vnd.ms-excel');
            $filename = "Electric_Prev_".date("d-m-Y-His").".xls";
            header('Content-Disposition: attachment; filename='.$filename .' ');
            header('Cache-Control: max-age=0');

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
       

    }

    /**
     * Deletes an existing Person model.
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
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
