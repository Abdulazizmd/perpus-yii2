<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\UserRole;
use app\models\Anggota;
use app\models\Petugas;
use app\models\Penerbit;
use app\models\Penulis;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_user_role')->dropDownList(UserRole::getList(), [
            'option' => 'value',
            'prompt'=>'- Pilih Jenis -',
        ]); ?>

    <div id="anggota">
        <?= $form->field($model, 'id_anggota')->widget(Select2::classname(), [
            'data' =>  Anggota::getList(),
            'options' => [
              'placeholder' => '- Pilih Anggota -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div> 


    <div id="petugas">
        <?= $form->field($model, 'id_petugas')->widget(Select2::classname(), [
            'data' =>  Petugas::getList(),
            'options' => [
              'placeholder' => '- Pilih Petugas -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div> 

    <div id="penerbit">
        <?= $form->field($model, 'id_penerbit')->widget(Select2::classname(), [
            'data' =>  Penerbit::getList(),
            'options' => [
              'placeholder' => '- Pilih Penerbit -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>

    <div id="penulis">
        <?= $form->field($model, 'id_penulis')->widget(Select2::classname(), [
            'data' =>  Penulis::getList(),
            'options' => [
              'placeholder' => '- Pilih Penulis -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>

    <?php //echo $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    function showHideDiv(){
        if($('#user-id_user_role').val()==2){                   
            $('#petugas').hide();
            $('#anggota').show();
            $('#penerbit').hide();
            $('#penulis').hide();
        }else if($('#user-id_user_role').val()==3){
            $('#anggota').hide();
            $('#petugas').show();
            $('#penerbit').hide();
            $('#penulis').hide();
        }else if($('#user-id_user_role').val()==4){
            $('#anggota').hide();
            $('#petugas').hide();
            $('#penerbit').show();
            $('#penulis').hide();
        }else if($('#user-id_user_role').val()==5){
            $('#anggota').hide();
            $('#petugas').hide();
            $('#penerbit').hide();
            $('#penulis').show();
        }
        else{
            $('#anggota').hide();
            $('#petugas').hide(); 
            $('#penerbit').hide();
            $('#penulis').hide();
        }   
    }

    $(document).ready(function() {
        showHideDiv();
    });
        
    $('#user-id_user_role').change(function() {
        showHideDiv();
    });
</script>