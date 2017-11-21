<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-index">


        <!-- Main content -->

            <!-- Breadcrumb -->
            
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary"  style="max-height: 154px">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">
                                        <i class="icon-social-dropbox" style="font-size: 60px"></i>
                                    </div>
                                    <h4 class="mb-0"><?php echo $jumlahBox; ?></h4>
                                    <p style="margin-bottom: 0px; margin-top:15px">Total Kotak Infaq Terdistribusi</p>
                                    <p style="margin-top: -7px; font-size: 25px;">AL ISTIQOMAH</p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-warning"  style="max-height: 154px">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">
                                        <i class="icon-wallet" style="font-size: 60px"></i>
                                    </div>
                                    <?php    
                                    $totalInfaqAll = 0;
                                      foreach ($totalAllInfaq as $totalAllInfaq) {
                                        $totalInfaqAll += $totalAllInfaq['value_trans'];
                                      }

                                    if($totalInfaqAll>99999999 && $totalInfaqAll<999999999){
                                          $totalInfaqAll=round($totalInfaqAll,0,3);
                                          $totalInfaqAll='Rp '.substr(number_format($totalInfaqAll,0,',',','),0,4).' Juta';
                                      }
                                      else if($totalInfaqAll>999999999){
                                          $totalInfaqAll=round($totalInfaqAll/1000000000,2);
                                          $totalInfaqAll='Rp '.substr(number_format($totalInfaqAll,0,',',','),0,4).' Milyar';
                                      }else if($totalInfaqAll>999999999999){
                                          $totalInfaqAll=round($totalInfaqAll/1000000000000,2);
                                          $totalInfaqAll='Rp '.substr(number_format($totalInfaqAll,0,',',','),0,4).' Triliun';
                                      }else{
                                        $totalInfaqAll='Rp '.number_format($totalInfaqAll,0,",",".");
                                      }
                                    ?>
                                    <h4 class="mb-0"><?php echo $totalInfaqAll; ?></h4>
                                    <p style="margin-bottom: 0px; margin-top:15px">Total Pendapatan Infaq</p>
                                    <p style="margin-top: -7px; font-size: 23px;">Muslim Vila 1</p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-success"  style="max-height: 154px">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">
                                        <i class="icon-wallet" style="font-size: 60px"></i>
                                    </div>
                                    <?php    
                                    $totalInfaq = 0;
                                      foreach ($modelJumlahInfaq as $modelJumlahInfaq) {
                                        $totalInfaq += $modelJumlahInfaq['value_trans'];
                                      }

                                    if($totalInfaq>99999999 && $totalInfaq<999999999){
                                          $totalInfaq=round($totalInfaq,0,3);
                                          $totalInfaq='Rp '.substr(number_format($totalInfaq,0,',',','),0,4).' Juta';
                                      }
                                      else if($totalInfaq>999999999){
                                          $totalInfaq=round($totalInfaq/1000000000,2);
                                          $totalInfaq='Rp '.substr(number_format($totalInfaq,0,',',','),0,4).' Milyar';
                                      }else if($totalInfaq>999999999999){
                                          $totalInfaq=round($totalInfaq/1000000000000,2);
                                          $totalInfaq='Rp '.substr(number_format($totalInfaq,0,',',','),0,4).' Triliun';
                                      }else{
                                        $totalInfaq='Rp '.number_format($totalInfaq,0,",",".");
                                      }
                                    ?>
                                    <h4 class="mb-0"><?php echo $totalInfaq; ?></h4>
                                    <p style="margin-bottom: 0px; margin-top:15px">Total Pendapatan Infaq</p>
                                    <p style="margin-top: -7px; font-size: 23px;">Bulan Ini, <?php echo date('F Y'); ?></p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-danger"  style="max-height: 154px">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">
                                        <i class="icon-wallet" style="font-size: 60px"></i>
                                    </div>
                                    <?php    
                                    $totalInfaqYear = 0;
                                      foreach ($modelJumlahInfaqYear as $modelJumlahInfaqYear) {
                                        $totalInfaqYear += $modelJumlahInfaqYear['value_trans'];
                                      }

                                    if($totalInfaqYear>99999999 && $totalInfaqYear<999999999){
                                          $totalInfaqYear=round($totalInfaqYear,0,3);
                                          $totalInfaqYear='Rp '.substr(number_format($totalInfaqYear,0,',',','),0,4).' Juta';
                                      }
                                      else if($totalInfaqYear>999999999){
                                          $totalInfaqYear=round($totalInfaqYear/1000000000,2);
                                          $totalInfaqYear='Rp '.substr(number_format($totalInfaqYear,0,',',','),0,4).' Milyar';
                                      }else if($totalInfaqYear>999999999999){
                                          $totalInfaqYear=round($totalInfaqYear/1000000000000,2);
                                          $totalInfaqYear='Rp '.substr(number_format($totalInfaqYear,0,',',','),0,4).' Triliun';
                                      }else{
                                        $totalInfaqYear='Rp '.number_format($totalInfaqYear,0,",",".");
                                      }
                                    ?>
                                    <h4 class="mb-0"><?php echo $totalInfaqYear; ?></h4>
                                    <p style="margin-bottom: 0px; margin-top:15px">Total Pendapatan Infaq</p>
                                    <p style="margin-top: -7px; font-size: 23px;">Tahun Ini, <?php echo date('Y'); ?></p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->


                        <div class="col-md-6">
                        <div class="card">
                                <div class="card-header">
                                    Grafik Berdasarkan RT
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <?php
                                        echo Highcharts::widget([
                                          'scripts' => [
                                              'highcharts-more',   
                                              'modules/exporting', 
                                              // 'themes/grid' 
                                          ],
                                          

                                         'options' => [
                                          'chart'=>[
                                              //'renderTo'=>'chartContainer',
                                              'type'=>'column',
                                           
                                          ],
                                          'title' => ['text' => 'Grafik Infaq Per RT Bulan '.date('F')],
                                          'subtitle'=> ['text'=>'Tahun '.date('Y')],
                                          'xAxis' => [
                                              'categories' => $chart_x_axisRt,
                                              'crosshair' => FALSE,
                                              'dataLabels' => [ 'enabled' => FALSE,],
                                              'labels'=>false

                                          ],
                                          'plotOptions'=> [
                                              'series'=> [
                                                  'borderWidth'=> 0,
                                                  'dataLabels'=> [
                                                      'enabled'=> true,
                                            
                                                  ]
                                              ]
                                          ],
                                          'yAxis' => [
                                              'title' => ['text' => NULL],
                                              
                                          ],
                                          
                                          'credits' => ['enabled' => FALSE],
                                          'dataLabels' => [ 'enabled' => TRUE,],
                                          'series' => $chart_x_seriesRt,
                                      ]
                                      ]);
                                    ?>
                                    </div>
                                 </div>
                              </div>   
                           </div> 
                        </div>

                        <div class="col-md-6">
                        <div class="card">
                                <div class="card-header">
                                    Grafik Total Dalam Satu Tahun
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <?php
                                        echo Highcharts::widget([
                                          'scripts' => [
                                              'highcharts-more',   
                                              'modules/exporting', 
                                              // 'themes/grid' 
                                          ],

                                         'options' => [
                                          'chart'=>[
                                              //'renderTo'=>'chartContainer',
                                              'type'=>'column',
                                           
                                          ],
                                          'title' => ['text' => 'Grafik Infaq Bulanan'],
                                          'subtitle'=> ['text'=>'Tahun '.date('Y')],
                                          'xAxis' => [
                                              'categories' => $chart_x_axis,
                                              'crosshair' => FALSE,
                                              'dataLabels' => [ 'enabled' => FALSE,],

                                          ],
                                          'plotOptions'=> [
                                              'series'=> [
                                                  'borderWidth'=> 0,
                                                  'dataLabels'=> [
                                                      'enabled'=> true,
                                            
                                                  ]
                                              ]
                                          ],
                                          'yAxis' => [
                                              'title' => ['text' => NULL],
                                              
                                          ],
                                          
                                          'credits' => ['enabled' => FALSE],
                                          'dataLabels' => [ 'enabled' => TRUE,],
                                          'series' => $chart_x_series,
                                      ]
                                      ]);
                                    ?>
                                </div>
                              </div>
                            </div>    
                          </div>
                        </div>

                        
<!-- 
                        <div class="col-md-12">
                                    <?php
                                        echo Highcharts::widget([
                                         'options' => [
                                          'chart'=>[
                                              //'renderTo'=>'chartContainer',
                                              'type'=>'column',
                                           
                                          ],
                                          'title' => ['text' => 'Grafik Infaq Tahunan'],
                                          // 'subtitle'=> ['text'=>'Tahun '.date('Y')],
                                          'xAxis' => [
                                              'categories' => $chart_x_axis2,
                                              'crosshair' => FALSE,
                                              'dataLabels' => [ 'enabled' => TRUE,],
                                              'labels'=>false

                                          ],
                                          'plotOptions'=> [
                                              'series'=> [
                                                  'borderWidth'=> 0,
                                                  'dataLabels'=> [
                                                      'enabled'=> true,
                                            
                                                  ]
                                              ]
                                          ],
                                          'yAxis' => [
                                              'title' => ['text' => NULL],
                                              // 'labels'=>false
                                              // 'labels'=> [
                                              //     'formatter'=> this.value
                                              // ]
                                          ],
                                          'credits' => ['enabled' => FALSE],
                                          'dataLabels' => [ 'enabled' => TRUE,],
                                          'series' => $chart_x_series2,
                                      ]
                                      ]);
                                    ?>
                                    
                            
                        </div> -->
                    </div>
                    </div>
                    <!--/.row-->

                    <!--/.card-->

                    
                    <!--/.row-->

                    
                    <!--/.row-->
                </div>

</div>
