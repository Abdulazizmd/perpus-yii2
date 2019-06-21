<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRole */

$this->title = 'Update User Role: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-primary">
	<div class="box-header">
    	<h1 class="box-title">Form Update User Role</h1>
	</div>
	<div class ="box-body">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
