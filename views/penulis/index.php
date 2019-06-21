<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use app\models\Penulis;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenulisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Penulis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Penulis', ['create'], ['class' => 'btn btn-success']) ?>
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

                // 'id',
                'nama',
                'alamat:ntext',
                'telepon',
                'email:email',
                [
                        'attribute' => 'jml_penulis',
                        'value' => function($data) {
                            return $data->getJumlahPenulis();
                        },
                        'contentOptions' => ['style' => 'text-align:center']
                        
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
                    'categories' => Penulis::getNama(),
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
                        'data' => Penulis::getGrafikList(),
                    ],
                ],
            ],
        ]);?>
    </div>
</div>