<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = 'Detail Buku : '. $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Buku'];
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
                'sinopsis:ntext',
                // 'sampul',
                [
                    'attribute' => 'sampul',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->sampul != '') {
                            return Html::img('@web/upload/sampul/' . $model->sampul, ['class' => 'img-responsive', 'style' => 'height:300px']);
                        } else { 
                            return Html::img('@web/upload/no-images.png', ['class' => 'img-responsive', 'style' => 'height:300px']);
                        }
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
