<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\RegistForm;

$this->title = 'Registration';
if(!isset($regist)) $regist = new RegistForm;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to registration:</p>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($regist, 'username'); ?>
    <?= $form->field($regist, 'password')->passwordInput(); ?>
      <?= $form->field($regist, 'password_repeat')->passwordInput(); ?>
    <?= $form->field($regist, 'email'); ?>

   
     <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Registration', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

<?php ActiveForm::end(); ?>