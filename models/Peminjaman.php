<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peminjaman".
 *
 * @property int $id
 * @property int $id_buku
 * @property int $id_anggota
 * @property string $tanggal_pinjam
 * @property string $tanggal_kembali
 */
class peminjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peminjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_anggota', 'tanggal_pinjam', 'tanggal_kembali'], 'required'],
            [['id_buku', 'id_anggota'], 'integer'],
            [['tanggal_pinjam', 'tanggal_kembali'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_buku' => 'Buku',
            'id_anggota' => 'Anggota',
            'tanggal_pinjam' => 'Tanggal Pinjam',
            'tanggal_kembali' => 'Tanggal Kembali',
        ];
    }

    public static function getList() {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id','nama');
    }

    public static function getListBuku()
    {
        $query = Peminjaman::find()
            ->andWhere(['id_anggota' => User::getIdAnggota()])
            ->groupBy('id_buku')
            ->all();
        
        $list = [];

        foreach ($query as $peminjaman) {
            $list[$peminjaman->id_buku] = @$peminjaman->buku->nama;
        }
        return $list;
    }

    public function getBuku()
    {
        return $this->hasOne(Buku::class, ['id' => 'id_buku']);
    }

    public function getAnggota()
    {
        return $this->hasOne(Anggota::class, ['id' => 'id_anggota']);
    }
}