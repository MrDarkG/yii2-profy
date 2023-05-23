<?php

namespace app\models;

use Faker\Provider\Uuid;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $access_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_PROFY = 'profy';
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'role'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'This email address has already been taken.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }

    /**
     * @throws Exception
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }



    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // Implement this method if you need to support "remember me" functionality
        return null;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function validateAuthKey($authKey)
    {
        // Implement this method if you need to support "remember me" functionality
        return null;
    }

    public function isProfy(): bool
    {
        return $this->role === self::ROLE_PROFY;
    }


    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function getServices()
    {
        return $this->hasMany(Services::class, ['id' => 'service_id'])
            ->viaTable('profy_services', ['profy_id' => 'id']);
    }
    //getprofy users
    public function getProfyUsers()
    {
        return $this->where(['role' => 'profy'])->all();
    }
}
