<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
    </head>
    <body>
	<?php $this->beginBody() ?>

        <div class="wrap">
	    <?php

	    //сложный код )) нужно получить все имена файлов-тестов

	    function menu() {
		$arr = scandir("tests/"); //массив с именами файлов
		$arr_temp = []; //2-х мерный массив где каждый влож массив это 2 элемента
		for ($i = 2; $i < count($arr); $i++) {
		    $arr_temp[$i - 2] = substr($arr[$i], 0, -4); //название теста
		}
		//print_r($arr_temp); die();
		for ($j = 0; $j < count($arr_temp); $j++) {
		    $items[] = array('label' => $arr_temp[$j],
			'url' => 'view_tests_name?name=' . $arr_temp[$j],
			'options' => ['id' => 'id_comment',
		    ]);
		}
		return $items;
	    }

	    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
		'options' => [
		    'class' => 'navbar-inverse navbar-fixed-top',
		],
	    ]);
	    echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => [
		    ['label' => 'Результаты тестов', 'url' => ['/admin/items/user_tests']],
		    ['label' => 'Настроить тесты', 'url' => ['/admin']],
		    ['label' => 'Все тесты',
			'items' => menu(),
		    ],
		    [
			'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
			'url' => ['/site/logout'],
			'linkOptions' => ['data-method' => 'post']
		    ],
		],
	    ]);
	    NavBar::end();
	    ?>

            <div class="container">
		<?=
		Breadcrumbs::widget([
		    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		])
		?>
		<?= Alert::widget() ?>
		<?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

	<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
