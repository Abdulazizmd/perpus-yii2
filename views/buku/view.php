<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = 'Detail Buku : '. $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Buku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?= $model->nama ?></h3>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'nama',
                'tahun_terbit',
                // 'id_penulis',
                [  
                    'attribute' => 'id_penulis',
                    'value' => function($data)
                    {
                        return $data->penulis->nama;
                    }
                ],
                // 'id_penerbit',
                [  
                    'attribute' => 'id_penerbit',
                    'value' => function($data)
                    {
                        return $data->penerbit->nama;
                    }
                ],
                //'id_kategori',
                [  
                    'attribute' => 'id_kategori',
                    'value' => function($data)
                    {
                        return $data->kategori->nama;
                    }
                ],
                [
                    'attribute'=>'sinopsis',
                    'format'=>'raw',
                    'value'=>$model->sinopsis
                ],
                [
                    'attribute' => 'sampul',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->sampul != '') {
                            return Html::img('@web/upload/sampul/' . $model->sampul, ['class' => 'img-responsive', 'style' => 'height:500px']);
                        } else { 
                            return '<div align="center"><h1>Tidak Ada Sampul</h1></div>';
                        }
                    },
                ],
                [
                    'attribute' => 'berkas',
                    'format' => 'raw',
                    'visible' => User::isAdmin() OR User::isPetugas(),
                    'value' => $model->getLinkIconBerkas()
                ],  
            ],
        ]) ?>
    </div>

    <div class="box-footer">
        <?php if (User::isAdmin() OR User::isPetugas()) {
            echo Html::a('<i class="glyphicon glyphicon-pencil"></i> Ubah', ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary',
            ]);
            echo Html::a('<i class="glyphicon glyphicon-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],]);
            echo Html::a('<i class="glyphicon glyphicon-list"></i> Daftar Buku', ['index', 'id' => $model->id], ['class' => 'btn btn-success']);
             } ?>
    </div>
</div>
