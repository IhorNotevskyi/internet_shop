<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Добавить рекламный блок</h2>
<form method="post" action="" >
    <input type="hidden" name="id" value=""/>
    <div class="form-group">
        <label for="product_name">Товар</label>
            <textarea rows="3" id="product_name" name="product_name"
                      class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="price">Цена в грн</label>
        <input type="text" id="price" name="price" value=""
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="firm">Фирма</label>
        <input type="text" id="firm" name="firm" value=""
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="cnt">Переходы</label>
        <input type="text" id="cnt" name="cnt" value=""
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="site">Сайт</label>
        <input type="text" id="site" name="site" value=""
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="is_active" style="margin-right: 5px">Публиковать?</label>
        <input type="checkbox" id="is_active" name="is_active" checked="checked"/>
    </div>
    <input type="submit" class="btn btn-lg btn-success" style="margin-top: 10px" value="Добавить блок">
</form>
