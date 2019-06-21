<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title ='Detail Peminjaman : '. $model->buku->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?= $model->buku->nama ?></h3>
    </div>

    <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [  
                'attribute' => 'id_buku',
                'value' => function($data)
                {
                    return $data->buku->nama;
                }
            ],
            [  
                'attribute' => 'id_anggota',
                'value' => function($data)
                {
                    return $data->anggota->nama;
                }
            ],
            'tanggal_pinjam',
            'tanggal_kembali',
        ],
    ]) ?>
    </div>
    <div class="box-footer">
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-list"></i> Daftar Peminjaman', ['index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>

</div>
