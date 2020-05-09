<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Usercom;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsercomController implements the CRUD actions for Usercom model.
 */
class UsercomController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
    public function actionIndex()
    {
           $name_user = str_replace(".", "_", $_GET['email']);
         $table_name = str_replace("@", "__", $name_user);
       
         $session = Yii::$app->session;
         $session->set('tablename',$table_name);
        $dataProvider = new ActiveDataProvider([
            'query' => Usercom::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
	    'name'=>$_GET['name'],
        ]);
    }

    //Все функции которые следуют дальше- это встроенные от виджета Gridview
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   
    public function actionCreate()
    {
        $model = new Usercom();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Usercom::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
