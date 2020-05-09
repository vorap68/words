<?php

namespace app\controllers;

use app\modules\admin\models\Usercom;
use yii\web\Controller;
use app\models\Test;
use app\models\User;
use yii\helpers\Url;
use Yii;
use yii\data\ActiveDataProvider;

class TestController extends Controller {

    public $layout = 'no_guest';
    public $id;

    // действие вызывается с главного меню после авторизации пользователя
    //запускает страницу с  выбранным СТАНДАРТНЫМ тестом для конкретного пользователя
    public function actionIndex() {
        // echo 'yes';
        $this->layout = 'no_guest';
        //$model = new Test();
        $request = Yii::$app->request;
        $id = $request->get('id');
        $arr = [];
        if ($id == '1') {
            $words = Test::find()->select(['id', 'word'])->asArray()->all();
            foreach ($words as $key => $word) {
                $arr[$word['id']] = $word['word']; //получаем одном массив с ключами id и word
            }
            shuffle($arr);
        } elseif ($id == '0') {
            $words = Test::find()->select(['id', 'word'])->asArray()->all();
            foreach ($words as $key => $word) {
                $arr[$word['id']] = $word['word']; //получаем одном массив с ключами id и word
            }
        } else {
            $words = Test::find()->select(['id', 'word'])->where(['patch_of_speech' => $id])->asArray()->all();
            foreach ($words as $key => $word) {
                $arr[$word['id']] = $word['word']; //получаем одном массив с ключами id и word
            }
        }
       
        // print_r($arr);
        return $this->render('index', compact('arr'));
    }
  

// действие вызывается с главного меню после авторизации пользователя
    //запускает страницу с  выбранным тестом от ПРЕПОДАВАТЕЛЯ для конкретного пользователя  
    public function actionTeacher(){
        $path  = "tests/".Yii::$app->request->get('name').".txt";
        $temp = file($path);
        $id_words = explode(',',$temp[0]);
        $words = Test::find()->select(['id','word'])->where(['id'=>$id_words])->asArray()->all();
         foreach ($words as $key => $word) {
                $arr[$word['id']] = $word['word']; //получаем одном массив с ключами id и word
            }
        // print_r($arr);
        return $this->render('index', compact('arr'));
        //print_r($words); exit();
    }

//сохранение результатов теста в БД в таблице под именем пользователя
    public function actionSave_result() {
 // этот кусок кода для записи результатов теста в файл       
//        if ($_POST['param2']) {
//            $path = 'users/' . Yii::$app->user->identity->email . '.txt';
//            $file = fopen($path, "a+");
//            fwrite($file, $_POST['param2'] .';'.PHP_EOL);
//            fclose($file);
//        }
        
        if ($_POST['param2']){
            $table_name = str_replace("@","__", Yii::$app->user->identity->email);
           $table_name = str_replace(".", "_", $table_name);
           //$count = Usercom::findOne()->
            $obj = json_decode($_POST['param2']);
             $obj->date = date("Y-m-d");
           $result =  Yii::$app->db->createCommand()->insert($table_name, [
    'word' => $obj->word,
    'answer' => $obj->ans,
    'time'=>  $obj->time,
     'date'=>  $obj->date,        
            ])->execute();
           echo $result;exit();
           //  echo $table_name;  exit();
        }
    }
    
    
    public function actionView_result() {
        
        $name_user = str_replace(".", "_", $_GET['email']);
         $table_name = str_replace("@", "__", $name_user);
       
         $session = Yii::$app->session;
         $session->set('tablename',$table_name);
        $dataProvider = new ActiveDataProvider([
            'query' => Usercom::find(),
        ]);

        return $this->render('view_result', [
            'dataProvider' => $dataProvider,
	    'name'=>$_GET['name'],
        ]);
        
    }

}
