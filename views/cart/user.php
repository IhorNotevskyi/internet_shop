<h2 style="text-align: center; margin: 40px 0 60px">Личный кабинет</h2>
<div class="container lead">
    <p class="">Имя пользователя: <span class="text-primary"><?= $data['personal'][0]['login'] ?></span></p>
    <p>Email: <span class="text-primary"><?= $data['personal'][0]['email'] ?></span></p>
    <?php if (Session::get('login') === $data['personal'][0]['login']): ?>
        <p>Пароль: <span class="text-primary fa fa-lock" style="margin-right: 4px"></span><span class="text-primary fa fa-lock" style="margin-right: 4px"></span><span class="text-primary fa fa-lock"></span></p><span><?= $data['success_message'] ?></span>

        <?php if ($data['errors']): ?>
            <ul style="list-style: none; color: red; font-style: italic; margin-top: 20px; width: 80%">
                <?php foreach ($data['errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="" method="post" id="email_cart_user" style="border-bottom: 2px solid #4d4d4d; border-top: 2px solid #4d4d4d; width: 35%; margin: 30px 0 30px; padding: 10px 0; display: none">
            <div class="form-group" style="margin-top: 15px">
                <label for="personal_new_email">Введите Ваш новый email:</label>
                <input type="text" class="form-control" name="personal_new_email" id="personal_new_email" placeholder="Новый email">
            </div>
            <div class="form-group">
                <label for="personal_email_pass">Введите Ваш пароль:</label>
                <input type="password" class="form-control" name="personal_email_pass" id="personal_email_pass" placeholder="Пароль">
            </div>
            <input type="submit" name="submit" value="Сохранить" id="new_email_save" class="btn btn-md btn-success" style="margin: 10px 0 20px">
            <input type="reset" name="reset" value="Отмена" id="new_email_reset" class="btn btn-md btn-danger"  style="margin: 10px 0 20px">
        </form>

        <form action="" method="post" id="password_cart_user" style="border-bottom: 2px solid #4d4d4d; border-top: 2px solid #4d4d4d; width: 35%; margin: 30px 0 30px; padding: 10px 0; display: none">
            <div class="form-group" style="margin-top: 15px">
                <label for="personal_email">Введите Ваш email:</label>
                <input type="text" class="form-control" name="personal_email" id="personal_pass_email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="personal_old_pass">Введите Ваш старый пароль:</label>
                <input type="password" class="form-control" name="personal_old_pass" id="personal_old_pass" placeholder="Старый пароль">
            </div>
            <div class="form-group">
                <label for="personal_new_pass">Введите Ваш новый пароль:</label>
                <input type="password" class="form-control" name="personal_new_pass" id="personal_new_pass" placeholder="Новый пароль">
            </div>
            <input type="submit" name="change_pwd" value="Сохранить" id="new_password_save" class="btn btn-md btn-success" style="margin: 10px 0 20px">
            <input type="reset" name="reset" value="Отмена" id="new_password_reset" class="btn btn-md btn-danger"  style="margin: 10px 0 20px">
        </form>

    <div style="margin-top: 25px">
        <button class="btn btn-md btn-primary" id="change_personal_email" style="display: inline">Изменить email</button>
        <button class="btn btn-md btn-primary" id="change_personal_pass" style="display: inline; margin-left: 10px">Изменить пароль</button>
    </div>
    <?php endif; ?>
</div>
<?php if (Session::get('login') === $data['personal'][0]['login']): ?>
<div class="container lead" style="margin-top: 45px">
    <a href="/comments/show/<?= $data['personal'][0]['id'] ?>" class="">Перейти к моим комментариям на сайте</a>
</div>
<hr>
<h3 style="text-align: center; margin: 40px 0 30px">История заказов</h3>
<div style="width: 100%">
    <?php $i = count($data['custom']); ?>
    <?php foreach ($data['custom'] as $key => $value): ?>
        <details class="details-orders" style="border-radius: 5px; cursor: pointer; margin: -1%; padding: 8px 10px">
            <summary class="details-summary" style="background: -webkit-linear-gradient(top, #f3f3f3 50%, #e6e6e6 50%); border: 2px solid #89a9e3; border-radius: 5px; margin: 0 0 .4em; padding: 1.04%; cursor: pointer">Заказ №<span style="padding-left: 2px"><?= $i ?></span><span style="float: right"><span style="font-weight: 600">Дата:</span> <?= $value['date_time'] ?></span></summary>
            <table class="table table-striped" style="margin-top: 40px">
                <thead>
                <tr>
                    <th style="width: 50%">Название товара</th>
                    <th style="width: 15%">Цена, грн</th>
                    <th style="width: 15%">Количество, шт</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($value['orders'] as $product): ?>
                    <tr>
                        <td><?= $product['title_news'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['total'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p style="text-align: right; margin-right: 20px"><span style="font-weight: 600">Общая сумма:</span> <?= $value['total_price'] ?> грн</p>
        </details>
        <?php --$i ?>
    <?php endforeach; ?>
</div>
<script src="/webroot/js/personal.js" async></script>
<?php endif; ?>