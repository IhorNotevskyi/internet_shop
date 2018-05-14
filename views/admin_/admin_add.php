<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Добавить товар</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title_news">Заголовок</label>
        <input type="text" id="title_news" name="title_news" value="" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="content">Описание</label>
        <textarea rows="8" id="content_news" name="content_news" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="id_category">Категория</label>
        <select class="form-control" name="id_category" id="id_category">
            <?php foreach ($data['category'] as $key => $value): ?>
                <?php if ($value == 'Акция') continue; ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="checkbox">
        <p style="font-weight:600">Теги</p>
        <?php foreach ($data['tags'] as $key => $value): ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="tags[]" value="<?= $key; ?>"><?= $value; ?>
            </label>
     <?php endforeach; ?>
    </div>
    <div class="form-group" style="margin-top: 20px">
        <label for="is_published" style="margin-right: 5px">Публиковать?</label>
        <input type="checkbox" id="is_published" name="is_published" checked="checked"/>
    </div>
    <div class="form-group">
        <label for="is_analitic" style="margin-right: 5px">Акционный?</label>
        <input type="checkbox" id="is_analitic" name="is_analitic"
    </div><br/>
    <div class="form-group" style="margin-top: 18px">
        <label for="photo" style="margin-right: 5px">Добавить фото</label>
        <input type="file" name="photo" id="photo" style="display: inline-block">
        <p class="help-block" style="font-size: 12px; margin: 20px 0 40px">Пожалуйста, загрузите Ваш файл (jpg, png, gif). Максимальный размер файла - 3Мб. При несоответствии требованиям фото не будет загружено.</p>
    </div>
    <input type="submit" class="btn btn-lg btn-success" value="Добавить товар" style="margin-bottom: 40px">
</form>