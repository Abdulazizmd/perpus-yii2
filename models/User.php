<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $id_anggota
 * @property int $id_petugas
 * @property int $id_user_role
 * @property int $status
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['id_anggota', 'id_petugas', 'id_user_role', 'status'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'id_anggota' => 'Anggota',
            'id_petugas' => 'Petugas',
            'id_user_role' => 'User Role',
            'status' => 'Status',
        ];
    }
    // Cunstom sendiri interface.
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return null;
    }
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    // Bagian Login, sudah terkoneksi sama databases.
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    public function validatePassword($password)
    {
        //return $this->password == $password;
         return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    public function getUserRole()
    {
        return $this->hasOne(UserRole::class, ['id' => 'id_user_role']);
    }

    // Buat Access Contol User.
    public static function isAdmin()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 1))) {
            return $user;
        } else {
            return false;
        }
    }

    // Buat Access Contol User.
    public static function isAnggota()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 2))) {
            return $user;
        } else {
            return false;
        }
    }

    // Buat Access Contol User.
    public static function isPetugas()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 3))) {
            return $user;
        } else {
            return false;
        }
    }

    public static function isPenerbit()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 4))) {
            return $user;
        } else {
            return false;
        }
    }

    public static function isPenulis()
    {
        // Jika bila user login trs keluar dan user terus masuk lewat url itu tidak bisa maka balik ke login.
        if (Yii::$app->user->isGuest) {
           return false;
        }

        // Buat id akses login user
        if (($user = User::findOne(Yii::$app->user->identity->id_user_role == 5))) {
            return $user;
        } else {
            return false;
        }
    }

    public function getIdAnggota()
    {
        return Yii::$app->user->identity->id_anggota;
    }
}
