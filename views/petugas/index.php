<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PetugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Petugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Petugas', ['create'], ['class' => 'btn btn-success']) ?>
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
                'alamat',
                'telepon',
                'email:email',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions'=>['style'=>'text-align:center; width:100px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
            ],
        ]); ?>
    </div>
</div>
