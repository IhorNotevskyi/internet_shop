<?= $data['crumbs'] ?>
<div style="text-align: center">
    <h2 style="margin-bottom: 20px">Изменить фон шапки сайта</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="color_bg" style="font-weight: 400; font-style: italic">Кликните на прямоугольную область, чтобы выбрать цвет</label>
            <input type="color" id="color_bg" name="<?= $data['bg_site'][0]['id'];?>" value="<?= $data['bg_site'][0]['value'];?>" class="form-control" style="max-width: 300px; min-height: 100px; cursor: pointer; margin: 10px auto 0">
        </div>
        <input type="submit" class="btn btn-lg btn-success"  value="Сохранить изменения">
    </form>
    <hr style="max-width: 600px; margin: 50px auto 40px">
    <h2 style="text-align: center; margin: 20px 0">Изменить фон сайта</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="color_header" style="font-weight: 400; font-style: italic">Кликните на прямоугольную область, чтобы выбрать цвет</label>
            <input type="color" id="color_header" name="<?= $data['bg_site'][1]['id'];?>" value="<?= $data['bg_site'][1]['value'];?>" class="form-control"  style="max-width: 300px; min-height: 100px; cursor: pointer; margin: 10px auto 0">
        </div>
        <input type="submit" class="btn btn-lg btn-success" value="Сохранить изменения">
    </form>
</div>