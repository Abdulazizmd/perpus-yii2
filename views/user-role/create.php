<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserRole */

$this->title = 'Create User Role';
$this->params['breadcrumbs'][] = ['label' => 'User Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
	<div class="box-header">
    	<h1 class="box-title">Form Tambah User Role</h1>
	</div>

	<div class ="box-body">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
