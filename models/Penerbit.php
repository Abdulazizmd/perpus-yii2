<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penerbit".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 */
class penerbit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penerbit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['nama', 'telepon'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 2555],
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
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'email' => 'Email',
            'jml_penerbit'=>'Jumlah Buku',
        ];
    }

    // down

    public static function getList() {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id','nama');
    }

    public function getJumlahPenerbit()
    {
        return Buku::find()
            ->andWhere(['id_penerbit' => $this->id])
            ->count();
    }

    public function listBuku()
    {
        return Buku::find()
            ->andWhere(['id_penerbit' => $this->id])
            ->all();
    }

    public static function getCount()
    {
        return static::find()->count();
    }

    public function getManyPenerbit()
    {
        return $this->hasMany(Buku::class, ['id_penerbit' => 'id']);
    }

    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $penerbit) {
            $data[] = [($penerbit->nama), (int) $penerbit->getManyPenerbit()->count()];
        }
        return $data;
    }

    public static function getNama()
    {
        $data = [];
        foreach (static::find()->all() as $penerbit) {
            $data[] = [$penerbit->nama];
        }
        return $data;
    }
}
