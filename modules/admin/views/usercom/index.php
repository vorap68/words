<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use Yii;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usercoms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usercom-index">

    <h2> Результаты учащегося <u><?=$name ?></u></h2>

    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'WORD',
            [
		'attribute'=>'ANSWER',
		'format' => 'raw',
		'value'=>function($data){
		if($data->ANSWER == 1){
		    return '<span class="text-success">Положительно</span>';}
		    else  return '<span class="text-danger">Отрицательно</span>';
		}
	    ],
            'TIME',
            'DATE',
	    ],
    ]); ?>


</div>
