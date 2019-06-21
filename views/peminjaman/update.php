<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = 'Update Peminjaman: ' . $model->buku->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->buku->nama, 'url' => ['view', 'id' => $model->buku->nama]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-primary">
	<div class="box-header">
    	<h1 class="box-title">Form Edit Peminjaman</h1>
	</div>
	<div class="box-body">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
