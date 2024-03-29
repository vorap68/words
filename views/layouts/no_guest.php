<!--Этот шаблон для зарегистрированых учеников-->
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
	      <script>
                $(document).ready(function () {
                    var nameuser = "<?= Yii::$app->user->identity->username; ?>";
                    console.log(nameuser);
                    if (nameuser == 'admin')
                        location = "/admin";
                })
            </script>
            <?php
            //сложный код )) нужно получить все имена файлов-тестов
            // создать массив полученных имен и сформировать  и вернуть $items 
            // в том виде в каком она должна быть в виджете Nav

	    function tests_names() {
		$arr = scandir("tests/"); //массив с именами файлов
		$arr_temp = []; //2-х мерный массив где каждый влож массив это 2 элемента
		for ($i = 2; $i < count($arr); $i++) {
		    $arr_temp[$i - 2] = substr($arr[$i], 0, -4);  //название теста
		}
		//print_r($arr_temp); die();
		if(empty($arr_temp)) return null;
		for ($j = 0;$j < count($arr_temp); $j++) {
		    $items[] = array('label' => $arr_temp[$j],
                            'url' => '/test/teacher?name=' . $arr_temp[$j],
		);
		}
		return $items;
	    }
	    function count_words(){
		$arr = array(20,50,100,300,500,1000);
		for($i=0;$i<count($arr);$i++){
		    $items[] = array('label'=>$arr[$i],'url'=>'#',);
		}
		return $items;
	    }
	    function limit_time(){
		$arr = array(1,3,5,10,20,30);
		for($i=0;$i<count($arr);$i++){
		    $items[] = array('label'=>$arr[$i],'url'=>'#',);
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
                    ['label' => 'Стандартные тесты',
                        'items' => [
                            ['label' => 'имена существительные',
                                'url' => ['test/index', 'id' => 'n'],],
                            '<li class="divider"></li>',
                            ['label' => 'глаголы',
                                'url' => ['test/index', 'id' => 'v'],],
                            '<li class="divider"></li>',
                            ['label' => 'местоимения',
                                'url' => ['test/index', 'id' => 'p'],],
                            '<li class="divider"></li>',
                            ['label' => 'союзы',
                                'url' => ['test/index', 'id' => 'c'],],
                            '<li class="divider"></li>',
                            ['label' => 'случайный порядок',
                                'url' => ['test/index', 'id' => '1'],],
                            '<li class="divider"></li>',
                            ['label' => 'по популярности',
                                'url' => ['test/index', 'id' => '0'],],
                            '<li class="divider"></li>', ''
                        ]],
                    ['label' => 'Тесты от преподателя',
                        'items' => tests_names(),
                    ],
		    ['label' => 'Ограничить время теста',
                        'items' => limit_time(),
			
                    ],
		    ['label' => 'Ограничить количество слов в тесте',
                        'items' => count_words(),
			
                    ],
                      ['label' => 'Просмотреть свои тесты',
                     'url' => ['/test/view_result', 'email' => Yii::$app->user->identity->email],
			
                    ],
                    [
                        'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
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
