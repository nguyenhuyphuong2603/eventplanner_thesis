<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Description of RegisterForm
 *
 */
class RegisterForm extends Model {

    public $username;
    public $password;
    public $confirm_password;
    public $firstname;
    public $lastname;
    public $email;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password', 'confirm_password', 'email', 'firstname', 'lastname'], 'required'],
            [['username', 'password', 'confirm_password', 'email', 'firstname', 'lastname'], 'string', 'min' => 2],
            ['email', 'email'],
            ['email', 'validateEmail'],
            ['username', 'validateUsername'],
            ['password', 'compare', 'compareAttribute' => 'confirm_password']
        ];
    }

    public function validateEmail($attribute, $params) {
        $profile = Profile::findByEmail($this->email);
        if ($profile != null) {
            $this->addError($attribute, 'Email exists.');
        }
    }

    public function validateUsername($attribute, $params) {
        $user = User::findByUsername($this->username);

        if ($user != null) {
            $this->addError($attribute, 'Username exists.');
        }
    }

    public function register() {

        if ($this->validate() == false) {
            return false;
        }
        $user = new User();
        $user->username = $this->username;
        $user->password = $this->password;
        $user->save();

        $profile = new Profile();
        $profile->email = $this->email;
        $profile->id = $user->id;
        $profile->save();

        return Yii::$app->user->login($this->getUser(), 0);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}
