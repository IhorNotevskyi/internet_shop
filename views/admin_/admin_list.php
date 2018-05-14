<?= $data['crumbs'] ?>
<h2 style="text-align: center">Список товаров</h2>
<a href="/admin/news/add/" style="display: block; text-align: right; margin-right: 20px">
    <button class="btn btn-lg btn-success" style="padding-left: 50px; padding-right: 50px">Добавить товар</button>
</a>
<div class="table-responsive" style="margin-top: 20px">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Категория</th>
            <th>Дата добавления</th>
            <th>Опубликован</th>
            <th>Акционный</th>
            <th>Посещения</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody style="vertical-align: center">
        <?php foreach ($data as $key => $value) : ?>
            <?php if ($key === 'count') break; ?>
            <tr>
                <td><?= $value['title_news'] ?></td>
                <td><?= $value['category_name'] ?></td>
                <td style="min-width: 180px"><?= $value['date_news'] ?></td>
                <td><?= ($value['is_published']) ? 'да' : 'нет'; ?></td>
                <td><?= ($value['is_analitic']) ? 'да' : 'нет'; ?></td>
                <td><?= $value['cnt_visit'] ?></td>
                <td style="min-width: 200px">
                    <a href="/admin/news/edit/<?= $value['id_news'] ?>" style="display: inline-block">
                        <button class="btn btn-sm btn-block btn-warning">Редактировать</button>
                    </a>
                    <a href="/admin/news/delete/<?= $value['id_news'] ?>" onclick="return confirmDelete();" style="display: inline-block">
                        <button class="btn btn-sm btn-block btn-danger">Удалить</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tbody>
    </table>
</div>
<br/>
<?php if (!isset($_GET['pages'])) $_GET['pages'] = 1; ?>
<div class="text-center" style="margin: -10px 0 20px">
    <ul class="pagination pagination-lg news-pagination pagination-parent">
        <?php if ($_GET['pages'] > 1): ?>
            <li class="page-item">
                <a class="page-link" href="/admin/index/list/?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Предыдущая</span>
            </li>
        <?php endif; ?>

        <?php for ($j = 1; $j <= ($data['count']); $j++) : ?>
            <?php if ($j == 2): ?>
                <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            <li <?= ($j == $_GET['pages']) ? 'class=active' : ''; ?>>
                <a href="/admin/index/list/?pages=<?= $j; ?>"><?= $j; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($_GET['pages'] < $j - 1): ?>
            <li class="page-item">
                <a class="page-link" href="/admin/index/list/?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Следующая</span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<script src="/webroot/js/pagination.js" async></script>