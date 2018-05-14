<h2 style="text-align: center; margin: 40px 0 50px">Корзина</h2>
<?php if ($data['products']): ?>
<?php if (!Session::get('login')): ?>
    <p style="font-style: italic; line-height: 25px; width: 80%; text-align: center; margin: 0 auto 40px">Если Вы еще не зарегистрированы на нашем сайте, Вы можете сделать это перейдя по ссылке <a href="/users/register/">регистрация</a>. Если Вы зарегистрированы на сайте, то Вы можете <a href="/users/login/">авторизоваться.</a></p>
<?php endif; ?>
<table id="cart-table" class="table table-striped" style="margin-bottom: 20px">
    <thead>
        <tr>
            <th style="width: 50%">Название товара</th>
            <th style="width: 15%">Цена, грн</th>
            <th style="width: 15%">Количество, шт</th>
            <th style="width: 10%">Удалить</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['products'] as $product): ?>
            <tr>
                <td>
                    <?php if ($product[0]['is_analitic'] == 1): ?>
                        <span style="color: red">Акция! </span>
                    <?php endif; ?>
                    <?= $product[0]['title_news'] ?>
                </td>

                <?php if ($product[0]['is_analitic'] == 1): ?>
                    <td><?= $product[0]['new_price'] ?></td>
                <?php else: ?>
                    <td><?= $product[0]['price'] ?></td>
                <?php endif; ?>

                <td><?= $product[0]['count'] ?></td>

                <td><a href="/cart/delete/<?= $product[0]['id_news'] ?>" title="Удалить" class="nav-menu-buttons" onclick="return confirmDelete();" style="color: #d93a2b; font-size: 25px">&#10008;</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p style="text-align: right"><span style="font-weight: 600">Общая сумма</span>:&ensp;<?= $data['products']['total_price'] ?> грн</p>
<a href="/cart/checkout/" class="btn btn-md btn-primary">Оформить заказ</a>
<?php else: ?>
<p style="text-align: center; font-size: 20px; font-style: italic">Вы не выбрали ни одного товара</p>
<?php endif; ?>
<script>
    (function () {
        var parent = document.querySelector('#cart-table tbody');
        var rows = document.querySelectorAll('#cart-table tbody tr');
        var lastRow = rows[rows.length - 1];
        parent.removeChild(lastRow);
    })();
</script>