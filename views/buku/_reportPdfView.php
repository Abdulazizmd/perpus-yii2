<?php
    
use yii\helpers\Html;
use app\models\Buku;
?>

<div class="kategori-index">
        <h3 align="center" class="box-title">Daftar Buku</h3>
        <table border="1" class="table">
            <tr>
                <th>No</th>
                <th>Nama Buku</th>
                <th>Tahun Terbit</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Kategori</th>
            </tr>
            <?php $no=1; foreach (Buku::find()->all() as $buku): ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $buku->nama;  ?></td>
                <td><?= $buku->tahun_terbit; ?></td>
                <td><?= $buku->penulis->nama; ?></td>
                <td><?= $buku->penerbit->nama; ?></td>
                <td><?= $buku->kategori->nama; ?></td>
            </tr>
            <?php $no++; endforeach ?>
        </table>
    </div>