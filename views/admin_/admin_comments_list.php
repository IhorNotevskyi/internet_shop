<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Список всех комментариев</h2>
<p style="font-size: 12px; font-style: italic; text-align: center">Комментарии в категории "Политика" нужно одобрить, чтобы они были опубликованы</p>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="vertical-align: middle">Комментарий</th>
            <th>Имя пользователя</th>
            <th>Заголовок новости</th>
            <th>Категория</th>
            <th>Дата добавления</th>
            <th>Опубликован</th>
            <th>Лайки</th>
            <th>Дизлайки</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['comments'] as $key => $value) : ?>
            <?php if ($key === 'count') break; ?>
            <tr>
                <td style="min-width: 250px"><?= $value['comment'] ?></td>
                <td><?= $value['login'] ?></td>
                <td style="min-width: 200px"><?= $value['title_news'] ?></td>
                <td><?= $value['category_name'] ?></td>
                <td><?= $value['date_time']?></td>
                <td><?= ($value['is_active']) ? 'да' : 'нет'; ?></td>
                <td><?= $value['cnt_like'] ?></td>
                <td><?= $value['cnt_dislike'] ?></td>
                <td style="min-width: 200px">
                    <a href="/admin/comments/edit_comment/<?= $value['id_comment'] ?>" style="display: inline-block">
                        <button class="btn btn-sm btn-block btn-warning">Редактировать</button>
                    </a>
                    <a href="/admin/comments/delete_comment/<?= $value['id_comment'] ?>" onclick="return confirmDelete();" style="display: inline-block">
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
                <a class="page-link" href="/admin/comments/comments_list/?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Предыдущая</span>
            </li>
        <?php endif; ?>

        <?php for ($j = 1; $j <= ($data['comments']['count']); $j++) : ?>
            <?php if ($j == 2): ?>
                <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            <li <?= ($j == $_GET['pages']) ? 'class=active' : ''; ?>>
                <a href="/admin/comments/comments_list/?pages=<?= $j; ?>"><?= $j; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($_GET['pages'] < $j - 1): ?>
            <li class="page-item">
                <a class="page-link" href="/admin/comments/comments_list/?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Следующая</span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<script src="/webroot/js/pagination.js" async></script>