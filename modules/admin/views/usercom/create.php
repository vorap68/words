<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Usercom */

$this->title = 'Create Usercom';
$this->params['breadcrumbs'][] = ['label' => 'Usercoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usercom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
