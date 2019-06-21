<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Penulis;
use app\models\Penerbit;
use app\models\Kategori;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\Buku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buku-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?php /*<?= $form->field($model, 'tahun_terbit')->textInput(['maxlength' => true]) ?>*/ ?>
    <?= $form->field($model, 'tahun_terbit')->widget(DatePicker::className(), [
            'removeButton' => false,
            'options' => ['placeholder' => 'Tahun Terbit'],
            'pluginOptions' => [
                'minViewMode'=>2,
                'autoclose'=>true,
                'format' => 'yyyy'
            ]
    ]) ?>
    
    <?= $form->field($model, 'id_penulis')->widget(Select2::classname(), [
        'data' =>  Penulis::getList(),
        'options' => [
          'placeholder' => '- Pilih Penulis -',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'id_penerbit')->widget(Select2::classname(), [
        'data' =>  Penerbit::getList(),
        'options' => [
          'placeholder' => '- Pilih Penerbit -',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'id_kategori')->widget(Select2::classname(), [
        'data' =>  Kategori::getList(),
        'options' => [
          'placeholder' => '- Pilih Kategori -',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'sinopsis')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'es',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <?= $form->field($model, 'sampul')->widget(FileInput::classname(), [
        'data' => $model->sampul,
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select Photo'
        ] 
    ]); ?>
    
    <?= $form->field($model, 'berkas')->widget(FileInput::classname(), [
        'data' => $model->berkas,
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>