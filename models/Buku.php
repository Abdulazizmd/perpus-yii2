<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "buku".
 *
 * @property int $id
 * @property string $nama
 * @property string $tahun_terbit
 * @property int $id_penulis
 * @property int $id_penerbit
 * @property int $id_kategori
 * @property string $sinopsis
 * @property string $sampul
 * @property string $berkas
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['tahun_terbit'], 'safe'],
            [['id_penulis', 'id_penerbit', 'id_kategori'], 'integer'],
            [['sinopsis'], 'string'],
            [['nama', 'sampul', 'berkas'], 'string', 'max' => 255],
            [['sampul'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['berkas'], 'file', 'extensions' => 'doc, docx, xls, xlsx, pdf, ppt'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tahun_terbit' => 'Tahun Terbit',
            'id_penulis' => 'Penulis',
            'id_penerbit' => 'Penerbit',
            'id_kategori' => 'Kategori',
            'sinopsis' => 'Sinopsis',
            'sampul' => 'Sampul',
            'berkas' => 'Berkas',
            'status_pinjam' => 'Status Pinjam'
        ];
    }

    public static function getList() {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id','nama');
    }

    public function listPeminjaman()
    {
        return Peminjaman::find()
            ->andWhere(['id' => $this->id_anggota])
            ->all();
    }

    public function getPenulis()
    {
        return $this->hasOne(Penulis::class, ['id' => 'id_penulis']);
    }

    public function getPenerbit()
    {
        return $this->hasOne(Penerbit::class, ['id' => 'id_penerbit']);
    }

    public function getKategori()
    {
        return $this->hasOne(Kategori::class, ['id' => 'id_kategori']);
    }
    public static function getCount()
    {
        return static::find()->count();
    }

    public function getImageKecilSampul()
    {
        if ($this->sampul != '') {
            return Html::img('@web/upload/sampul/' . $this->sampul, [
                'class' => 'img-responsive', 
                'style' => 'height:100px'
            ]);
        } 
        
        return Html::img('@web/upload/no-images.png', [
            'class' => 'img-responsive', 
            'style' => 'height:100px'
        ]);
        
    }

    public function getLinkIconBerkas()
    {
        if ($this->berkas != '') {
            $url = Yii::getAlias('@web') . '/upload/berkas/' . $this->berkas;
            return Html::a('<i class="glyphicon glyphicon-download-alt"></i>',$url,[
                'data-toggle'=>'tooltip',
                'title'=>'Unduh Berkas'
            ]);
        } 
        
        return '<i class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Berkas Tidak Tersedia"></i>';
        
    }
}
