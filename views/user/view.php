<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title ='Detail User : '. $model->userRole->nama;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
            
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'username',
                //'password',
                //'id_anggota',
                //'id_petugas',
                //'id_user_role',
                [  
                    'attribute' => 'id_user_role',
                    'value' => function($data)
                    {
                        return $data->userRole->nama;
                    }
                ],
                //'status',
            ],
        ]) ?>
    </div>
    <div class ="box-footer">
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-list"></i> Daftar User', ['index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>
</div>
