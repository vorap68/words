<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Items;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\ItemsSearch;
use app\modules\admin\models\Usercomua;
use app\models\User;

class ItemsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }
// Получает с БД массив со всеми пользователями и отправляет его в вид user_tests.php
    public function actionUser_tests() {
       $list = User::find()->asArray()->select(['username', 'id', 'email'])->where(['role' => 'user'])->all();
        $listuser = [];
        foreach ($list as $key => $value) {
            $listuser[$value['email']] = $value['username'];
        }
        return $this->render('user_tests', compact('listuser'));
    }

  // Вывод (просмотр) всех созданных тестов
    public function actionView_tests_name(){
        $this->layout = 'empty';
        $name_test = Yii::$app->request->get('name');
        $path = "tests/" . $name_test . ".txt";
        $file = file($path);
        $arr_id = explode(',', $file[0]);
        $comment = $file[1];
        $words = []; //ассоциат 3-х мерный!!!! массив выборки с БД 
        for ($i = 0; $i < count($arr_id); $i++) {
            $words[] = Items::find()->asArray()->select(['word'])->where(['id' => $arr_id[$i]])->all();
        }
        $arr_words = []; //индексный 1 массив слов 
        for ($i = 0; $i < count($words); $i++) {
            $arr_words[] = $words[$i][0]['word'];
        }
        //$arr_words = \yii\helpers\ArrayHelper::getColumn($words, 'word');
        // }
        return $this->render('view_names', compact('arr_words', 'comment', 'name_test'));
        //print_r($arr_words);exit();
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Items();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

//Создание нового теста    
// Действие получает POST массив в котором id-ид номера выбраных слов 
// name- название теста comment- коментарии к тесту.
// И записывает в txt файл с именем name и содержанием id+comment
    public function actionCreate_test() {
        $obj = [];
        $obj = json_decode($_POST['name_test']);
        // echo $obj->name;
        $path = "tests/" . $obj->name . ".txt";
        $content = $obj->id . PHP_EOL . $obj->comment;
        if (file_exists($path)) {
            echo "Тест с таким названием существует";
            exit();
        } else {
            if ($file = fopen($path, 'x+')) {
                fwrite($file, $content);
                fclose($file);
                echo "Тест $obj->name создан";
                exit();
            }
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
