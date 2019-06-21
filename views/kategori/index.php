<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kategori;
use app\models\Buku;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>  
<div class="box box-primary">
  <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Kategori', ['create'], ['class' => 'btn btn-success']) ?>
  </div>   
  <div class="box-body">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
          [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions'=>['style'=>'text-align:center; width:30px'],
            'contentOptions'=>['style'=>'text-align:center'],
          ],
          [
            'attribute' => 'nama',
          ],
          [
            'attribute' => 'jml_buku',
            'value' => function($data) {
                return $data->getJumlahBuku();
            },
            'contentOptions' => ['style' => 'text-align:center'],
            'headerOptions' => ['style' => 'text-align:center; width:100px']
          ],
          [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions'=>['style'=>'text-align:center; width:100px'],
            'contentOptions'=>['style'=>'text-align:center'],
          ],
      ],
    ]); ?>
  </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <?= Highcharts::widget([
            'options' => [
                'credits' => false,
                'title' => ['text' => 'Jumlah Buku'],
                'exporting' => ['enabled' => true],
                'xAxis' => [
                    'categories' => Kategori::getNama(),
                ],
                'yAxis' =>[
                    'title' => ['text' => 'Jumlah'],
                ],
                'plotOptions' => [
                    'pie' => [
                        'cursor' => 'pointer',
                    ],
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'Buku',
                        'data' => Kategori::getGrafikList(),
                    ],
                ],
            ],
        ]);?>
    </div>
</div>