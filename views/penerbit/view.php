<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Penerbit */

$this->title ='Detail Penerbit : '. $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Penerbit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
            
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'nama',
                'alamat:ntext',
                'telepon',
                'email:email',
                [
                        'attribute' => 'jml_penerbit',
                        'value' => function($data) {
                            return $data->getJumlahPenerbit();
                        },
                        
                ],
            ],
        ]) ?>
    </div>
    <div class="box-footer">
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-list"></i> Daftar penerbit', ['index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>

</div>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Daftar Buku <?= $model->nama; ?> </h3>
        <br>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Buku', ['buku/create', 'id_penerbit' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>
        
    <div class="box-body">
        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama Buku</th>
                <th>Tahun Terbit</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>&nbsp;</th>
            </tr>
            <?php $no=1; foreach ($model->listBuku() as $buku): ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= Html::a($buku->nama, ['buku/view', 'id' => $buku->id]);  ?></td>
                <td><?= $buku->tahun_terbit; ?></td>
                <td><?= $buku->penulis->nama ?></td>
                <td><?= $buku->kategori->nama ?></td>
                <td>
                    
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], [
                        'data-toggle' => 'tooltip',
                        'title' => 'Ubah',
                    ]) ?>
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id' => $model->id], [
                        'data-toggle' => 'tooltip',
                        'title' => 'Hapus',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
            <?php $no++; endforeach ?>
        </table>
    </div>
</div>