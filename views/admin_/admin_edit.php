<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Редактировать товар</h2>
<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_news" value="<?= $data['id_news'] ?>"/>
    <div class="form-group">
        <label for="title_news">Заголовок</label>
        <input type="text" id="title_news" name="title_news" value="<?= $data['title_news'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="content_news">Описание</label>
            <textarea rows="8" id="content_news" name="content_news"
                      class="form-control"><?= $data['content_news'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="id_category">Категория</label>
        <select class="form-control" name="id_category" id="id_category">
            <?php foreach ($data['category'] as $key => $value): ?>
                <?php if ($value == 'Акция') continue; ?>
                <option value="<?= $key; ?>"
                    <?= ($data['id_category'] == $key) ? 'selected' : ''; ?> >
                    <?= $value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="checkbox">
        <p style="font-weight:600;">Теги</p>
        <?php foreach ($data['tags_list'] as $key => $value): ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="tags[]" <?= isset($data['tags'][$key]) ? 'checked' : ''; ?>
                       value="<?= $key; ?>"><?= $value; ?>
            </label>
            <!--                <input class="checkbox" type="checkbox" name="tag[]" value="--><? //= $data['tags'][$i]['id_tag']; ?><!--">--><? //= $data['tags'][$i]['tag_name']; ?><!--<br/>-->
        <?php endforeach; ?>
    </div>
    <div class="form-group">
        <label for="is_published" style="margin: 20px 5px 5px 0">Публиковать?</label>
        <input type="checkbox" id="is_published" name="is_published"
               <?php if ($data['is_published']) { ?>checked="checked" <?php } ?> />
    </div>
    <div class="form-group">
        <label for="is_analitic" style="margin-right: 5px">Акционный?</label>
        <input type="checkbox" id="is_analitic" name="is_analitic"
               <?php if ($data['is_analitic']) { ?>checked="checked" <?php } ?> />
    </div>
    <div class="form-group" style="margin-top: 18px">
        <label for="photo" style="margin-right: 5px">Редактировать фото</label>
        <input type="file" name="photo" id="photo" style="display: inline-block; margin-bottom: 10px">
        <img style="width: 200px; height: 150px; display: inline-block" src="/webroot/image/<?= $data['image_news']; ?>">
        <p class="help-block" style="font-size: 12px; margin: 20px 0 40px">Пожалуйста, загрузите Ваш файл (jpg, png, gif). Максимальный размер файла - 3Мб. При несоответствии требованиям фото не будет загружено.</p>
    </div>
    <input type="submit" class="btn btn-lg btn-success" value="Сохранить изменения" style="margin-bottom: 60px">
</form>