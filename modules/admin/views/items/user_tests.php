<!--Этот скрипт  получает выбор пользователя из вида admin/items/index 
и отправляет email выбраного пользователя в admin/items/file_get-->
<script>
//    $(document).ready(function () {
//        $('div#choise').on('click', function (event) {
//             event.preventDefault();
////            $('#result').css('display', 'inline-block');
////	     $('#list').css('display', 'none');
//            var idd = $(event.target).attr('name');
////            $('#first_row').text('Результаты ' + idd);
//            $.ajax({
//                url: "/admin/usercom/",
//                type: "post",
//		//datatype:"json",
//                data: "param=" + idd,
//               
//                success: function (result) {
//                  alert(result);
//                  var mass = JSON.parse(result);
//                   console.log(mass);
//                   //alert(mass);
//                   for(var key of mass){
//                      console.log(key);
//                     var mass = key.substring(0, key.length - 3);
//                     console.log (mass);
//                    var mas = JSON.parse(mass);
//                      //alert(mas.key1);
//                    if(mas.key2 == 1) { $("#body").append('<tr style="background-color:#90EE90;"><td>'+mas.key1+"</td><td>да</td><td>"+mas.key3+" секунд</td></tr>");}
//		else { $("#body").append('<tr style="background-color:#008B8B;"><td>'+mas.key1+"</td><td>нет</td><td>"+mas.key3+" секунд</td></tr>");}
//	    }
//                }
//                })
//        });
//    });
</script>

<h2> <span class="badge badge-secondary">Выберите ученика из списка для просмотра результатов теста</span></h2>

<div class="btn-group-vertical" id="list">
    <?php print_r($listuser);?>
    <?php foreach ($listuser as $key => $value): ?>

        <div  class="btn btn-primary" id="choise" name="<?= $key;?>"><?php echo $value; ?></div>
    <?php endforeach; ?>
</div>


 <?php foreach ($listuser as $key => $value): ?>
<div class="list-group">
 
  <a href="/admin/usercom/?name=<?php echo $key;?>" class="list-group-item list-group-item-action"><?php echo $value; ?></a>

</div>
   <?php endforeach; ?>
<!--<div class="btn-group-vertical" style="margin-left:40px ; display:none" id="result" >
    <h2 id="first_row"> </h2>
    <table class="table table-striped">
	<thead>
	    <tr>
		<th>Слово</th>
		<th>ответ</th>
                <th>потраченное время</th>
	    </tr>
	</thead>
	<tbody id="body">
	  
	</tbody>
    </table>
</div>-->