<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usercoms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usercom-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Usercom', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'WORD',
            'ANSWER',
            'TIME',
            'DATE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
