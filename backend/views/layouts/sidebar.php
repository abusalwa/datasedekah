<nav class="sidebar-nav">                
<?php
                    echo \yii\widgets\Menu::widget([
                      'items' => [
                        [
                          'label'=>'Home', 
                          'options'=>['class'=>'nav-item'],
                          'url'=>['box/dashboard'], 
                          'template' => '<a href="{url}" class="nav-link">
                            <i class="fa fa-home"></i>
                            {label}
                          </a>'],

                        [
                          'label' => 'DATA KOTAK INFAQ', 
                          'options' => ['class' => 'nav-title']
                        ],                        

                        [
                          'label' => 'Data Master',
                          'options' => ['class' => 'nav-item nav-dropdown'],
                          'template' => '<a href="#" class="nav-link nav-dropdown-toggle text-success">
                            <i class="icon-layers text-success"></i>
                            {label}
                          </a>',
                          'items' => [
                              [
                                'label'=>'Data Kepala Keluarga', 
                                'url'=>['person/index'],
                                'options'=>['class'=>'nav-item'],
                                'template' => '<a href="{url}" class="nav-link">
                                  <i class="icon-user"></i>
                                  {label}
                                </a>'
                                
                              ],
                              [
                                'label'=>'Data Kotak Infaq', 
                                'url'=>['box/index'],
                                'options'=>['class'=>'nav-item'],
                                'template' => '<a href="{url}" class="nav-link">
                                  <i class="icon-drawer"></i>
                                  {label}
                                </a>'
                                
                              ],
                              
                            ]
                          ],

                          [
                          'label' => 'Data Transaksi',
                          'options' => ['class' => 'nav-item nav-dropdown'],
                          'template' => '<a href="#" class="nav-link nav-dropdown-toggle text-primary">
                            <i class="icon-briefcase text-primary"></i>
                            {label}
                          </a>',
                          'items' => [
                              [
                                'label'=>'Pendapatan', 
                                'url'=>['box-trans/index'],
                                'options'=>['class'=>'nav-item'],
                                'template' => '<a href="{url}" class="nav-link">
                                  <i class="icon-wallet"></i>
                                  {label}
                                </a>'
                                
                              ],
                              [
                                'label'=>'Pendapatan Bulanan', 
                                'url'=>['box-trans/bulanan'],
                                'options'=>['class'=>'nav-item'],
                                'template' => '<a href="{url}" class="nav-link">
                                  <i class="icon-wallet"></i>
                                  {label}
                                </a>'
                                
                              ],
                              [
                                'label'=>'Pendapatan Tahunan', 
                                'url'=>['box-trans/tahunan'],
                                'options'=>['class'=>'nav-item'],
                                'template' => '<a href="{url}" class="nav-link">
                                  <i class="icon-wallet"></i>
                                  {label}
                                </a>'
                                
                              ],
                              
                            ]
                          ],
                          
                          [
                            'label'=>'Logout', 
                            'url'=>['site/logout'], 
                            'options'=>['class'=>'nav-item'],
                            'template' => '<a href="{url}" data-method="post" class="nav-link text-danger"><i class="fa fa-power-off text-danger"></i>{label}</a>'
                          ]
                        ],
                        'options'=>['class'=>'nav'],
                        'submenuTemplate' => '<ul class="nav-dropdown-items">{items}</ul>',
                      ]);

                    ?>
                
</nav>