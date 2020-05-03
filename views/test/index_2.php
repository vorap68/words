
<?php
use yii\helpers\Html;
use yii\helpers\Url;

$json = json_encode($arr);
?>
<script>
    // var ansv = [];
    $(document).ready(function () {
        var date0 = new Date();
        var timer0 = date0.getTime();
       //alert(timer0);
	var i = 0;
	var keys = [];
	var slovo = <?php echo $json;?>;
	//alert(JSON.stringify(slovo));
        data = "";
	keys= Object.keys(slovo);
	//alert(keys);
	$('#slovo').text(slovo[keys[i]]);
	
        //скрипт отслеживает нажатие кнопки "дальше".При срабатывании этого события
        // результаты выбора записываются в массив data и отсылаются в действие save_result
       $("input[name='exampleRadios']").change(function(){
            var date1 = new Date();
            var timer1 = date1.getTime()- timer0;
            //alert(timer1);
	    i++;
           $('#slovo').text(slovo[keys[i]]);
          
            var result = $('input:checked').val();
	    data = data + {"key1":result,"key2":slovo[keys[i]],"key3":timer1};
           console.log(data);
       });
         
	 $('form').submit(function (event) { 
             event.preventDefault();  // Полная остановка происходящего
	  $.ajax({
		    url:'save_result',
		    type:"POST",
		    data:"param2="+JSON.stringify(data),
		   //dataType:'json',
		    cache: false,
		   // processData: false, // Не обрабатываем файлы (Don't process the files)
		   // contentType:false,
		  success:function(response){
                  // console.log(response);
                            }
           });
        });
	
        });
</script>
<div id="slovo" class="btn btn-lg btn-success" >
</div>
<div id="exit" class="btn btn-lg btn-success" style="display:none">
    Вы закончили тест
</div>
<form action="save_result" method="POST" id="myform" >
    <div class="form-check  ">
        <input class="form-check-input form-control form-control-lg " type="radio" name="exampleRadios" id="yes" value="1">
	<label class="form-check-label" for="exampleRadios1">
	    <h3>Я знаю это слово</h3>
	</label>
    </div>
    <div class="form-check">
	<input class="form-check-input form-control form-control-lg" type="radio" name="exampleRadios" id="no" value="2">
	<label class="form-check-label " for="exampleRadios2">
	   <h3>Я не знаю это слово</h3> 
	</label>
    </div>
    <button type="submit" class="btn btn-primary mb-2" id="go">Дальше</button>
</form>
<hr>
<?= Html::a('Выйти',[Url::home()],['class'=>'btn btn-success mb-2']);?>
