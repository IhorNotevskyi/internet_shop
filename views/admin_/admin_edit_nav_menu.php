<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 40px">Редактировать пункт меню</h2>
<form method="post" action="">
    <input type="hidden" name="id_menu_item" value="<?= $data[0]['id'] ?>"/>
    <div class="form-group">
        <label for="value_menu_item">Название</label>
        <input type="text" id="value_menu_item" name="value_menu_item" value="<?= $data[0]['value'] ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="path_menu_item">Ссылка</label><span> (если ссылка никуда не ведет, то указывать #)</span>
        <input type="text" id="path_menu_item" name="path_menu_item" value="<?= $data[0]['path'] ?>" class="form-control"/>
    </div>
    <input type="submit" class="btn btn-lg btn-success" value="Сохранить изменения" style="margin-top: 20px">
</form>