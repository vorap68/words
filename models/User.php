<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class User extends ActiveRecord implements \yii\web\IdentityInterface
{
   
    public static function tableName() {
	return 'users';
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
       return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
	return static::findOne(['username'=>$username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
    public function regist() {
	//print_r($_POST);
	//echo $_POST['RegistForm']['username'];
	$user->username = $_POST['RegistForm']['username'];
	$user->password = $_POST['RegistForm']['password'];
	$user->email = $_POST['RegistForm']['email'];
	if($user->save()) return true;
	//var_dump($user);
    }
}
