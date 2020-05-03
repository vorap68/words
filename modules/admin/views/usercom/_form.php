<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Usercom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usercom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'WORD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANSWER')->textInput() ?>

    <?= $form->field($model, 'TIME')->textInput() ?>

    <?= $form->field($model, 'DATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
