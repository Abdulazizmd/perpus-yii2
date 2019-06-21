<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Penulis;
use app\models\Kategori;
use app\models\Penerbit;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Buku';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Buku', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-print"></i> Export to Excel', ['excel'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-print"></i> Export to Word', ['word'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-print"></i> Export to PDF', ['pdf'], ['class' => 'btn btn-warning']) ?>
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
                [
                    'attribute'=>'tahun_terbit',
                    'label' => 'Tahun<br/>Terbit',
                    'encodeLabel' =>false,
                    'headerOptions'=>['style'=>'text-align:center; width:80px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
                // 'id_penulis',
                [  
                    'attribute' => 'id_penulis',
                    'value' => function($data)
                    {
                        return @$data->penulis->nama;
                    },
                    'filter'=> Penulis::getList(),
                    'headerOptions'=>['style'=>'text-align:center; width:80px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
                // 'id_penerbit',
                [  
                    'attribute' => 'id_penerbit',
                    'value' => function($data)
                    {
                        return @$data->penulis->nama;
                    },
                    'filter'=> Penerbit::getList(),
                    'headerOptions'=>['style'=>'text-align:center; width:80px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
                //'id_kategori',
                [  
                    'attribute' => 'id_kategori',
                    'value' => function($data)
                    {
                        return @$data->kategori->nama;
                    },
                    'filter'=> Kategori::getList(),
                    'headerOptions'=>['style'=>'text-align:center; width:80px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],            
                //'sinopsis:ntext',
                [
                    'attribute' => 'sampul',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getImageKecilSampul();
                    },
                    'headerOptions'=>['style'=>'text-align:center; width:120px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
                [
                    'attribute' => 'berkas',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getLinkIconBerkas();
                    },
                    'headerOptions'=>['style'=>'text-align:center; width:100px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions'=>['style'=>'text-align:center; width:80px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
            ],
        ]); ?>
    </div>
</div>
