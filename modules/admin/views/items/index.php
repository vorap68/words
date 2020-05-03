<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Слова';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- скрипт отслеживает 2 события. 1-е выбор слова (checkbox) заполняет массив keys из id выбранных слов
     2-событие "создать тест" сохраняет название теста (name_test) и отправдяет в скрипт admin/items/create_test
   POST переменную с именем теста и массивом из id выбранных слов-->
<script type="text/javascript">
    $(document).ready(function(){
        var datakeys;
        $("input[type=checkbox]").click(function(){
            var keys = $('#usergrid').yiiGridView('getSelectedRows');
             datakeys =keys.join(',');
             //console.log(keys);
          });   

    $("form").on('submit', function(event){
        var name_test = $("#test").val();
        var comment_test =$("#comment").val();
          data = {"name":name_test,"id":datakeys,"comment":comment_test};
            event.preventDefault();
            console.log(comment_test);
            $.ajax({
                url:'admin/items/create_test',
                type:'post',
                //datatype:'json',
                data:"name_test="+JSON.stringify(data) ,
                success:function(result){
                   alert(result);
                    location.reload();
                }
            })
       // alert('submitYes');
    })
    
    });
</script>
<div class="items-index">

       

    <p>
        <?= Html::a('Добавить слово', ['create'], ['class' => 'btn btn-success']) ?>
        <h3>Для создания нового теста введите название теста и комментарии к тесту<h3> 
               <form>
  <div class="form-group">
                <label for="test">Название</label>
                <input id="test" type="text" class="form-control" required> 
            <label for="comment">Комментарии</label>
           <textarea id="comment" class="form-control" > </textarea>
             <hr>
<!--             <h3>выберите слова и нажмите <a href="create_test" class="btn btn-success" id="create_test">Создать</a></h3>-->
                <label for="submit">выберите слова и нажмите</label>
             <button type="submit" class="btn btn-primary mb-2">Создать</button>
    <hr>
           </div>
               </form>
    </p>

<!--эта часть кода выводит таблицу со всеми словами с возможностью выбора отдельных слов
с помощью checkbox колонки-->
    <?= GridView::widget([
        'id'=>'usergrid',
        'dataProvider' => $dataProvider,
         'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'word',
             ['attribute'=>'patch_of_speech',
              'value'=>function($data){
                  switch ($data->patch_of_speech){
                      case 'a': return 'Артикль';
                      case 'v': return 'Глагол';
                      case 'c': return 'Союз';
                      case 'n': return 'Существительное';
                      case 'a': return 'Артикль';
                      case 'p': return 'Местоимение';
                      case 'i': return 'Предлог';
                      case 'm': return 'Числительные';
                  }
              }  
                ],
            'frequency',
                         [
            'class' => 'yii\grid\CheckboxColumn',
            // вы можете настроить дополнительные свойства здесь.
        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
