<?php


namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class RegistForm extends Model { 
    public $username;
    public $password;
    public $email;
    public $password_repeat;
    
     public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','email','password_repeat'], 'required'],
            // rememberMe must be a boolean value
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
          
        ];
    }
    //put your code here
}
