<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penulis".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 */
class penulis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penulis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['alamat'], 'string'],
            [['nama', 'telepon', 'email'], 'string', 'max' => 255],
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
            'jml_penulis'=>'Jumlah Buku',
        ];
    }

    // down

    public static function getList() {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id','nama');
    }

    public function getJumlahPenulis()
    {
        return Buku::find()
            ->andWhere(['id_penulis' => $this->id])
            ->count();
    }

    public function listBuku()
    {
        return Buku::find()
            ->andWhere(['id_penulis' => $this->id])
            ->all();
    }

    public static function getCount()
    {
        return static::find()->count();
    }

    public function getManyPenulis()
    {
        return $this->hasMany(Buku::class, ['id_penulis' => 'id']);
    }
    
    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $penulis) {
            $data[] = [($penulis->nama), (int) $penulis->getManyPenulis()->count()];
        }
        return $data;
    }
    
    public static function getNama()
    {
        $data = [];
        foreach (static::find()->all() as $penulis) {
            $data[] = [$penulis->nama];
        }
        return $data;
    }

}
