
<?php
use yii\helpers\Html;
use yii\helpers\Url;

$json = json_encode($arr);
?>
<script>
    // var ansv = [];
    $(document).ready(function () {
        var date0 = new Date();
         console.log(date0);
        var timer1 = date0.getTime();
       //alert(timer0);
	var i = 0;
	var keys = [];
	var slovo = <?php echo $json;?>;
	//alert(JSON.stringify(slovo));
	keys= Object.keys(slovo);
	//alert(keys);
	$('#slovo').text(slovo[keys[i]]);
//        if(slovo[keys[i]==""){
//           $("#exit").css(['display'=>'block']); }
	
        //скрипт отслеживает нажатие кнопки "дальше".При срабатывании этого события
        // результаты выбора записываются в массив data и отсылаются в действие save_result
        $('button').on("click",function (event) {
            var date1 = new Date();
            timer1 = (date1.getTime()- timer1)/1000;
           
             if(typeof(slovo[keys[i]])=== 'undefined'){
             $("#exit").css('display','block');
             $("#test").css('display','none');
         }
           $('#slovo').text(slovo[keys[i]]);
           console.log(typeof(slovo[keys[i]]));
         // event.preventDefault();  // Полная остановка происходящего
            var result = $(event.target).attr('name');
          //var data = {"key1":slovo[keys[i]],"key2":result,"key3":timer1};
          var data = {"word":slovo[keys[i]],"ans":result,"time":timer1};
           console.log(data);
           timer1 = date1.getTime();
         
           $.ajax({
		    url:'save_result',
		    type:"POST",
		    data:"param2="+JSON.stringify(data),
		   //dataType:'json',
		    cache: false,
		   success:function(response){
                   console.log(response);
                            }
           });
             i++;
        });
	
        });
</script>
<div id="test">
<div id="slovo" class="btn btn-lg  btn-primary" >
</div>
<div>
<button type="submit" class="btn btn-success" name="1">Я знаю это слово</button>
</div>
<div>
 <button type="submit" class="btn btn-warning" name="2">Я не знаю этого слова</button>
</div>
</div>
<div id="exit" class="btn btn-lg btn-success" style="display:none">
    Вы закончили тест
</div>
    <hr>
<?= Html::a('Выйти',[Url::home()],['class'=>'btn btn-secondary mb-2']);?>
