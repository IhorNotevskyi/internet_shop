<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 40px">Добавить пункт меню</h2>
<form method="post" action="">
    <div class="form-group">
        <label for="value_menu_item">Название</label>
        <input type="text" id="value_menu_item" name="value_menu_item" value="" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="path_menu_item">Ссылка</label><span> (если ссылка никуда не ведет, то указывать #)</span>
        <input type="text" id="path_menu_item" name="path_menu_item" value="" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="id_parent_menu_item">ID родителя</label><span> (если первый уровень вложенности, то ничего не указывать)</span>
        <input type="text" id="id_parent_menu_item" name="id_parent_menu_item" value="" class="form-control"/>
    </div>
    <input type="submit" class="btn btn-lg btn-success" value="Добавить" style="margin-top: 20px">
</form>