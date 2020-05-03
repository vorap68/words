<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistForm;
use app\models\User;
use yii\helpers\Url;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'no_guest';
        }
        return $this->render('index');
    }

// Запускается из шаблона main.php запускает страницу логирования
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // echo Yii::$app->user->identity->username;
            if (Yii::$app->user->identity->username == 'admin')
                return $this->redirect(Url::to(['/admin']));
            //if(Yii::$app->user->identity->username == 'admin') echo Yii::$app->user->identity->username;
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    // Запускается из вида login.php запускает страницу регистрации
    public function actionRegist() {
        $regist = new RegistForm();
        if ($regist->load(Yii::$app->request->post())) {
            $user = new User();
            $user->username = $_POST['RegistForm']['username'];
            $user->password = $_POST['RegistForm']['password'];
            $user->email = $_POST['RegistForm']['email'];
            if ($user->save()) {
                $table_name = str_replace("@", "__", $user->email);
                $table_name = str_replace(".", "_", $table_name);
              Yii::$app->db->createCommand()->createTable($table_name, [
    'ID' => 'pk',
    'WORD' => 'string',
    'ANSWER' => 'integer',
     'TIME'   =>'decimal',
     'DATE'  => 'date'         
])->execute();
               
            }
        }
        return $this->render('regist', [
                    'model' => $regist,
        ]);
    }

    // Запускается из вида login.php запускает страницу регистрации
    // этот код для создания файла для нового пользователя
//    public function actionRegist() {
//	$regist = new RegistForm();
//	if ($regist->load(Yii::$app->request->post())){
//	    $user = new User();
//	    $user->username = $_POST['RegistForm']['username'];
//	$user->password = $_POST['RegistForm']['password'];
//	$user->email = $_POST['RegistForm']['email'];
//	if($user->save()){
//	    $path = 'users/'.$user->email.'.txt';
//            echo $path;
//	    if(!file_exists($path)) {
//		$file = fopen($path, 'w+');
//		fwrite($file,'');
//		fclose($file);
//		}
//	    echo 'Вы успешно зарегистрировались<hr>';
//	    echo \yii\helpers\Html::a('Главная','index');
//	    exit();
//	}
//	}
//		 return $this->render('regist', [
//            'model' => $regist,
//        ]);
//    }
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
}
