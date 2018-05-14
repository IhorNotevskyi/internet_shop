<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Редактировать рекламный блок</h2>
<form method="post" action="" >
    <input type="hidden" name="id" value="<?= $data['admin_promotion'][0]['id'] ?>"/>
    <div class="form-group">
        <label for="product_name">Товар</label>
            <textarea rows="3" id="product_name" name="product_name"
                      class="form-control"><?= $data['admin_promotion'][0]['product_name'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="price">Цена в грн</label>
        <input type="text" id="price" name="price" value="<?= $data['admin_promotion'][0]['price'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="firm">Фирма</label>
        <input type="text" id="firm" name="firm" value="<?= $data['admin_promotion'][0]['firm'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="cnt">Переходы</label>
        <input type="text" id="cnt" name="cnt" value="<?= $data['admin_promotion'][0]['cnt'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="site">Сайт</label>
        <input type="text" id="site" name="site" value="<?= $data['admin_promotion'][0]['site'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="is_active" style="margin-right: 5px">Активный</label>
        <input type="checkbox" id="is_active" name="is_active"
               <?php if ($data['admin_promotion'][0]['is_active']) { ?>checked="checked" <?php } ?> />
    </div>
    <input type="submit" class="btn btn-lg btn-success" value="Сохранить изменения" style="margin-top: 20px">
</form>
