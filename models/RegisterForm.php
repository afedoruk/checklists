<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
	public $id;
    public $username;
	public $email;
    public $password;
	public $password_repeat;
    
	public function attributeLabels()
    {
        return [
            'username' => 'Your name',
            'password' => 'Your password',
            'password_repeat' => 'Confirm password',
        ];
    }

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'email'], 'required'],
            [['password', 'password_repeat'], 'required', 'except'=>'update'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass'=>'\app\models\User', 'except'=>'update'],
  //          ['email', 'unique', 'targetClass'=>'\app\models\User', 'targetAttribute' => ['id'=>, 'email'], 'on'=>'update'],
            // password is validated by validatePassword()
            ['password', 'compare'],
            ['id', 'integer']
        ];
    }



    public function register()
    {
        if ($this->validate()) {
        	$user = new User();
			$user->username=$this->username;
			$user->email=$this->email;
			$user->password=$this->password;
			$user->save(); 
            return $user->save();
        } else {
            return false;
        }
    }
	
	public function updateInfo()
	{
		 if ($this->validate()) {
        	$user = User::findOne(Yii::$app->user->identity->id);
			$user->username=$this->username;
			$user->email=$this->email;
			//$user->password=$this->password;
			$user->save(); 
            return $user->save();
        } else {
            return false;
        }
	}

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     *
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }*/
}
