<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\UserRole;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah User', ['create'], ['class' => 'btn btn-success']) ?>
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

                //'id',
                'username',
                [  
                    'attribute' => 'id_user_role',
                    'value' => function($data)
                    {
                        return $data->userRole->nama;
                    },
                    'filter' => UserRole::getList(),
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
