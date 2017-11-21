<?php

namespace backend\controllers;

use Yii;
use backend\models\Box;
use backend\models\BoxTrans;
use backend\models\Person;
use backend\models\UploadFile;
use yii\web\UploadedFile;
use backend\models\BoxSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\AuthAssignment;
use backend\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;

/**
 * BoxController implements the CRUD actions for Box model.
 */
class BoxController extends Controller
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
                        // 'actions' => ['logout', 'index', 'dashboard'],
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


    public function actionUpload(){
        
        $model = new Box();
        
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

                    $boxInfaq = new Box();
                    
                    $boxInfaq->no_box = $dataBox[0][0];
                    $boxInfaq->id_person = $dataBox[0][1];
                    
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
     * Lists all Box models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BoxSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDashboard()
    {
        
        $jumlahBox = Box::find()->count();
        $modelTotalInfaq = BoxTrans::find()->all();
        $modelJumlahInfaq = BoxTrans::find()->where(['month_trans'=>date('m'),'year_trans'=>date('Y')])->all();
        $modelJumlahInfaqYear = BoxTrans::find()->where(['year_trans'=>date('Y')])->all();
        $db = \Yii::$app->db;

        // $_xseries = $db->createCommand("SELECT DISTINCT month_trans as xseries FROM box_trans ORDER BY month_trans ASC")->queryAll();
        // $_nseries = $db->createCommand("SELECT DISTINCT month_trans FROM box_trans")->queryAll();
        // $_xseries_data = array();
        // $data_series =array();
        // $_data = array ();
        // $_data_series = array ();
       
        // foreach ($_xseries as $xs)
        // {
        //     $_xseries_data[] = $xs["xseries"];
        // }
       
        // foreach ($_nseries as $ns)
        // {
        //     array_push($data_series,array("name"=>$ns["month_trans"],));
        // }
       
        // foreach ($data_series as $ds)
        // {
        //     $months = $db->createCommand("SELECT DISTINCT month_trans, SUM(value_trans) as value_trans FROM box_trans WHERE month_trans = '".$ds["name"]."' AND year_trans='".date('Y')."' GROUP BY month_trans, year_trans")->queryAll();
                                   
        //     foreach ($months as $m)
        //     {
        //         $_data_series[] = (int)$m["value_trans"];
        //     }
        //     array_push($_data,array(
        //         'name'=>$ds["name"],
        //         'data'=>$_data_series,
        //     ));
        //     unset($_data_series);
        // }
        

        $_xseries = $db->createCommand("SELECT DISTINCT year_trans as xseries FROM box_trans ORDER BY year_trans ASC")->queryAll();
        $_nseries = $db->createCommand("SELECT DISTINCT month_trans FROM box_trans ORDER BY box_trans.month_trans ASC")->queryAll();
        $_xseries_data = array();
        $data_series =array();
        $_data = array ();
        $_data_series = array ();
       
        foreach ($_xseries as $xs)
        {
            $_xseries_data[] = $xs["xseries"];
        }
       
        foreach ($_nseries as $ns)
        {
            array_push($data_series,array("name"=>$ns["month_trans"],));
        }
       
        foreach ($data_series as $ds)
        {
            $months = $db->createCommand("SELECT SUM(value_trans) as value_trans, month_trans as month_trans, year_trans FROM box_trans WHERE month_trans = '".$ds["name"]."' AND year_trans='".date('Y')."' GROUP BY box_trans.month_trans, year_trans")->queryAll();
                                   
            foreach ($months as $m)
            {
                $_data_series[] = (int)$m["value_trans"];
            }
            if($ds["name"]==1){$bulan='Januari';}elseif($ds["name"]==2){$bulan='Februari';}elseif($ds["name"]==3){$bulan='Maret';}elseif($ds["name"]==4){$bulan='April';}elseif($ds["name"]==5){$bulan='Mei';}elseif($ds["name"]==6){$bulan='Juni';}elseif($ds["name"]==7){$bulan='Juli';}elseif($ds["name"]==8){$bulan='Agustus';}elseif($ds["name"]==9){$bulan='September';}elseif($ds["name"]==19){$bulan='Oktober';}elseif($ds["name"]==11){$bulan='Novmeber';}elseif($ds["name"]==12){$bulan='Desember';}
            array_push($_data,array(
                'name'=>$bulan,
                'data'=>$_data_series,
            ));
            unset($_data_series);
        }


        //data chart per RT per bulan


        $_xseriesRt = $db->createCommand("SELECT DISTINCT month_trans as xseries FROM box_trans ORDER BY month_trans ASC")->queryAll();
        $_nseriesRt = $db->createCommand("SELECT DISTINCT person_tb.rt, max(month_trans) as month_trans FROM person_tb inner join box on person_tb.id_person=box.id_person inner join box_trans on box.id_box=box_trans.id_box GROUP BY person_tb.rt order by person_tb.rt ASC")->queryAll();
        $_xseries_dataRt = array();
        $data_seriesRt =array();
        $_dataRt = array ();
        $_data_seriesRt = array ();
       
        foreach ($_xseriesRt as $xsRt)
        {
            $_xseries_dataRt[] = $xsRt["xseries"];
        }
       
        foreach ($_nseriesRt as $nsRt)
        {
            array_push($data_seriesRt,array("name"=>$nsRt["month_trans"],"rt"=>$nsRt["rt"]));
        }
       
        foreach ($data_seriesRt as $dsRt)
        {
            $monthsRt = $db->createCommand("SELECT SUM(value_trans) as value_trans, month_trans as month_trans, year_trans, max(box.id_person) as id_person, person_tb.rt as rt FROM box_trans inner join box on box_trans.id_box=box.id_box inner join person_tb on box.id_person=person_tb.id_person WHERE person_tb.rt='".$dsRt["rt"]."' AND month_trans = '".date('m')."' AND year_trans='".date('Y')."' GROUP BY person_tb.rt, box_trans.month_trans, year_trans")->queryAll();
                                   
            foreach ($monthsRt as $mRt)
            {
                $_data_seriesRt[] = (int)$mRt["value_trans"];
            }
            // if($dsRt["name"]==1){$bulan='Januari';}elseif($dsRt["name"]==2){$bulan='Februari';}elseif($dsRt["name"]==3){$bulan='Maret';}elseif($dsRt["name"]==4){$bulan='April';}elseif($dsRt["name"]==5){$bulan='Mei';}elseif($dsRt["name"]==6){$bulan='Juni';}elseif($dsRt["name"]==7){$bulan='Juli';}elseif($dsRt["name"]==8){$bulan='Agustus';}elseif($dsRt["name"]==9){$bulan='September';}elseif($dsRt["name"]==19){$bulan='Oktober';}elseif($dsRt["name"]==11){$bulan='Novmeber';}elseif($dsRt["name"]==12){$bulan='Desember';}
            array_push($_dataRt,array(
                'name'=>'RT '.$dsRt["rt"],
                'data'=>$_data_seriesRt,
            ));
            unset($_data_seriesRt);
        }


        $_xseries2 = $db->createCommand("SELECT DISTINCT year_trans as xseries FROM box_trans ORDER BY year_trans ASC")->queryAll();
        $_nseries2 = $db->createCommand("SELECT DISTINCT year_trans FROM box_trans ORDER BY year_trans ASC LIMIT 12")->queryAll();
        $_xseries_data2 = array();
        $data_series2 =array();
        $_data2 = array ();
        $_data_series2 = array ();
       
        foreach ($_xseries2 as $xs2)
        {
            $_xseries_data2[] = $xs2["xseries"];
        }
       
        foreach ($_nseries2 as $ns2)
        {
            array_push($data_series2,array("name"=>$ns2["year_trans"],));
        }
       
        foreach ($data_series2 as $ds2)
        {
            $months2 = $db->createCommand("SELECT SUM(value_trans) as value_trans,  year_trans FROM box_trans WHERE year_trans = '".$ds2["name"]."' GROUP BY year_trans")->queryAll();
                                   
            foreach ($months2 as $m2)
            {
                $_data_series2[] = (int)$m2["value_trans"];
            }
            // if($ds2["name"]==1){$bulan2='Januari';}elseif($ds2["name"]==2){$bulan2='Februari';}elseif($ds2["name"]==3){$bulan2='Maret';}elseif($ds2["name"]==4){$bulan2='April';}elseif($ds2["name"]==5){$bulan2='Mei';}elseif($ds2["name"]==6){$bulan2='Juni';}elseif($ds2["name"]==7){$bulan2='Juli';}elseif($ds2["name"]==8){$bulan2='Agustus';}elseif($ds2["name"]==9){$bulan2='September';}elseif($ds2["name"]==19){$bulan2='Oktober';}elseif($ds2["name"]==11){$bulan2='Novmeber';}elseif($ds2["name"]==12){$bulan2='Desember';}
            array_push($_data2,array(
                'name'=>$ds2["name"],
                'data'=>$_data_series2,
            ));
            unset($_data_series2);
        }

        return $this->render('dashboard', [
            'jumlahBox' => $jumlahBox,
            'totalAllInfaq' => $modelTotalInfaq,
            'modelJumlahInfaq' => $modelJumlahInfaq,
            'modelJumlahInfaqYear' => $modelJumlahInfaqYear,
            'chart_x_axis' => $_xseries_data,
            'chart_x_series' => $_data,
            'chart_x_axis2' => $_xseries_data2,
            'chart_x_series2' => $_data2,
            'chart_x_axisRt' => $_xseries_dataRt,
            'chart_x_seriesRt' => $_dataRt,
            
        ]);
    }

    /**
     * Displays a single Box model.
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
     * Creates a new Box model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Box();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_box]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Box model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_box]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Box model.
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
     * Finds the Box model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Box the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Box::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
