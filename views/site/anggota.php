<?php

use yii\helpers\Html;
use app\models\Buku;    
use app\models\Kategori;
use app\models\Penerbit;
use app\models\Penulis;
use app\models\User;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = 'Perpustakaan';
?>
<div class="row">
        <?php foreach (Buku::find()->all() as $buku) {?> 
            <!-- Kolom box mulai -->
            <div class="col-md-4">

                <!-- Box mulai -->
                <div class="box box-widget">

                    <div class="box-header with-border">
                        <div class="user-block">
                            <span class="username"><?= Html::a($buku->nama, ['buku/view', 'id' => $buku->id]); ?></span>
                            <span class="description"> Di Terbitkan : Tahun <?= $buku->tahun_terbit; ?></span>
                        </div>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        <center>
                            <?php if ($buku->sampul != '') { ?>
                                <img style="height: 300px" class="img-responsive pad" src="<?= Yii::$app->request->baseUrl.'/upload/sampul/'.$buku['sampul']; ?>" alt="Photo">
                            <?php } else { ?>
                                <img style="height: 300px" class="img-responsive pad" src="<?= Yii::$app->request->baseUrl.'/upload/no-images.png' ?>" alt="Photo">
                            <?php } ?>
                            
                        </center>
                        <p>Sinopsis : <?= substr($buku->sinopsis,0,120);?> ...</p>
                        <?= Html::a("<i class='fa fa-eye'> Detail Buku</i>",["buku/view","id"=>$buku->id],['class' => 'btn btn-default']) ?>
                        <?= Html::a('<i class="fa fa-file"> Pinjam Buku</i>', ['peminjaman/create', 'id_buku' => $buku->id], ['class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Apa anda yakin ingin meminjam buku ini?',
                            ],
                        ]) ?>
                        <!-- <span class="pull-right text-muted">127 Peminjam - 3 Komentar</span> -->
                    </div>

                </div>
                <!-- Box selesai -->

            </div>
            <!-- Kolom box selesai -->  
        <?php
            }
        ?>
    </div>