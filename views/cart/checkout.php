<h2 style="text-align: center; margin: 40px 0 50px">Оформление заказа</h2>

<?php if ($result): ?>

    <p style="text-align: center; font-size: 20px; font-style: italic">Ваш заказ оформлен. Мы Вам перезвоним.</p>

<?php else: ?>

    <p>Выбрано товаров: <?= isset($data['count']) ? $data['count'] : 0 ?></p>
    <p style="margin-top: 20px">Общая сумма: <?= isset($data['products']['total_price']) ? $data['products']['total_price'] : 0 ?> грн</p>
    <p style="margin-top: 20px">Для оформления заказа заполните форму, чтобы наш менеджер смог связаться с Вами</p>

    <?php if (!$result): ?>

        <?php if ($data['errors']): ?>
            <ul style="list-style: none; color: red; font-style: italic; margin-top: 40px">
                <?php foreach ($data['errors'] as $error): ?>
                    <li style="margin-top: 10px"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="#" method="post" style="margin-top: 40px">
            <div class="form-group">
                <label for="user_name">Введите Ваше имя:</label>
                <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Имя" style="width: 35%">
            </div>
            <div class="form-group">
                <label for="user_phone">Введите Ваш номер телефона:</label>
                <input type="text" class="form-control" name="user_phone" id="user_phone" placeholder="Пример: 0979998877"  style="width: 35%">
            </div>
            <div class="form-group">
                <label for="user_email">Введите Ваш email:</label>
                <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Email"  style="width: 35%">
            </div>
            <input type="submit" name="submit" value="Оформить заказ" class="btn btn-md btn-primary" style="margin-top: 20px">
        </form>

    <?php endif; ?>
<?php endif; ?>