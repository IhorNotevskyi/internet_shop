<?= $data['crumbs'] ?>
<div class="admin-auth" style="max-width: 560px; margin: 0 auto">
    <h2 style="text-align: center">Авторизация для администратора</h2>
    <form class="form-horizontal" method="post" action="">
        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Логин:</label>
            <div class="col-sm-10">
                <input type="text" name="login" class="form-control" id="login" placeholder="Login">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Пароль:</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-success">Войти</button>
            </div>
        </div>
    </form>
</div>