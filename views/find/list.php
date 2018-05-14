<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin: 40px 0 25px">Поиск товаров</h2>
<div class="starter-template searched" style="text-align: left">
    <form method="post" action="" class="form-horizontal">
        <h3 style="margin: 0 0 15px">Дата:</h3>
        <div class="form-inline">
            <label for="date">с: </label>
            <input type="date" data-date-format="DD MMMM YY" class="form-control" name="date_ot" id="date"
                   placeholder="date" style="margin-right: 10px">
            <label for="date">по: </label>
            <input type="date" class="form-control" name="date_do" id="date" placeholder="Date">
        </div>
        <h3 style="margin: 25px 0 5px">Теги товаров:</h3>
        <?php foreach ($data['tags'] as $key => $tag) : ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="tags[<?= $key ?>]" value="<?= $tag ?>"> <?= $tag ?>
                </label>
            </div>
        <?php endforeach; ?>
        <h3 style="margin: 25px 0 5px">Категории товаров:</h3>
        <?php foreach ($data['category'] as $key => $category) : ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="category[<?= $key ?>]" value="<?= $category ?>"><?= $category ?>
                </label>
            </div>
        <?php endforeach; ?>
        <div class="buttons">
            <button type="submit" class="btn btn-success">Найти</button>
            <button type="reset" class="btn btn-danger">Отмена<button>
        </div>
    </form>
    <?php
    if (isset($data['filter'])): ?>
        <hr>
        <h2 style="text-align: center; margin: -10px 0 40px">Результаты поиска</h2>
        <ul class="list-unstyled">
            <?php foreach ($data['filter'] as $value): ?>
                <li style="line-height: 34px; margin-bottom: 30px">
                    <a href="/news/list/<?= $value['id_news'] ?>">&middot;&ensp;<?= $value['title_news'] ?></a>
                </li>
            <?php endforeach; ?>

            <?php if (count($data['filter'][0]) === 0): ?>
                <p style="font-size: 20px; font-style: italic">Ничего не найдено</p>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>