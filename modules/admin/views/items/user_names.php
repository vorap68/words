<!--Этот скрипт  совершает выбор пользователя из вида admin/items/index -->


<div class="row"><h2 align="center" class="page-header"> <span class="badge badge-secondary" style="font-size:18px;">Выберите ученика из списка для просмотра результатов теста</span></h2>
</div>

<?php foreach ($listuser as $key => $value): ?>
    <div class="list-group">
        <a href="/admin/usercom/?email=<?= $key; ?>&name=<?= $value; ?>" class="list-group-item list-group-item-action list-group-item-success"><span class="glyphicon glyphicon-user"></span><?php echo " " . $value; ?></a>
    </div>
<?php endforeach; ?>
