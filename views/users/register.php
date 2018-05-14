<?= $data['crumbs'] ?>
<div class="registr">
    <h2>Регистрация</h2>
    <p><?= Session::hasFlash() ?></p>
    <form class="form-horizontal" method="post" action="">
        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Логин:</label>
            <div class="col-sm-6">
                <input type="text" name="login" class="form-control" id="login" placeholder="Login" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Пароль:</label>
            <div class="col-sm-6">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-success btn-md">Зарегистрироваться</button>
            </div>
        </div>
    </form>
</div>
<!--<script>
    var msgReg = document.querySelector('.message-reg');
    var registr = document.querySelector('.registr');
    registr.appendChild(msgReg);
</script>-->