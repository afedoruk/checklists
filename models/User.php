<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\Security;

class User  extends ActiveRecord implements \yii\web\IdentityInterface
{
	public $password;
	
  	public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
	
	public static function findIdentityByAccessToken($token)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->hash);
    }
	
	public function beforeSave($insert)
    {
    if (parent::beforeSave($insert)) {
        if ($this->isNewRecord) {
            $this->auth_key = Security::generateRandomKey();
            $this->phash=Security::generatePasswordHash($this->password);
	    }
        return true;
    }
    return false;
}
}
