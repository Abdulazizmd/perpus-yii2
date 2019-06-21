<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Buku;
use app\models\Anggota;
use app\models\Peminjaman;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <?php if (User::isAdmin() OR User::isPetugas()) {
            echo Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Peminjaman', ['create'], ['class' => 'btn btn-success']);
         } ?>
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
                    'attribute' => 'id_buku',
                    'value' => function($data)
                    {
                        return $data->buku->nama;
                    },
                    'filter'=> Peminjaman::getListBuku(),
                ],
                [  
                    'attribute' => 'id_anggota',
                    'value' => function($data)
                    {
                        return $data->anggota->nama;
                    },
                    'visible' => User::isAdmin() OR User::isPetugas(),
                    'filter'=> Anggota::getList(),
                ],
                'tanggal_pinjam',
                'tanggal_kembali',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'visibleButtons' => [
                        'view'=> User::isAdmin() OR User::isPetugas(),
                        'update'=> User::isAdmin() OR User::isPetugas(),
                        'delete'=> User::isAdmin() OR User::isPetugas(),
                    ],
                    'headerOptions'=>['style'=>'text-align:center; width:100px'],
                    'contentOptions'=>['style'=>'text-align:center'],
                ],
            ],
        ]); ?>
    </div>
</div>
