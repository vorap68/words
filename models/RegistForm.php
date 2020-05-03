<?php


namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class RegistForm extends Model { 
    public $username;
    public $password;
    public $email;
    
     public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','email'], 'required'],
            // rememberMe must be a boolean value
          
        ];
    }
    //put your code here
}
