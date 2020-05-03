<ul class="list-group">
    <h1 class=" font-italic text-center">Тест <?=$name_test;?></h1>
    <h2 class=" font-italic text-left"><?=$comment;?><h2>
  <?php
 for($i=0;$i<count($arr_words);$i++){
    echo '<li class="list-group-item  list-group-item-dark text-center" style="font-size: 2rem;">'.$arr_words[$i].'</li>';
 }
    ?>
</ul>

