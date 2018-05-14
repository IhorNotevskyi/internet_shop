<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Список пользователей (без администраторов)</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Логин</th>
            <th>Email</th>
            <th>Права</th>
            <th>Пароль (md5)</th>
            <th>Активный</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['users'] as $key => $value) : ?>
            <?php if ($key === 'count') break; ?>
            <tr>
                <td><?= $value['login'] ?></td>
                <td><?= $value['email'] ?></td>
                <td><?= $value['role'] ? 'admin' : '-'?></td>
                <td><?= $value['password']?></td>
                <td><?= ($value['is_active']) ? 'да' : 'нет'; ?></td>
                <td align="right">
                    <a href="/admin/users/delete/<?= $value['id'] ?>" onclick="return confirmDelete();">
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
                <a class="page-link" href="/admin/users/user_list/?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Предыдущая</span>
            </li>
        <?php endif; ?>

        <?php for ($j = 1; $j <= ($data['users']['count']); $j++) : ?>
            <?php if ($j == 2): ?>
                <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            <li <?= ($j == $_GET['pages']) ? 'class=active' : ''; ?>>
                <a href="/admin/users/user_list/?pages=<?= $j; ?>"><?= $j; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($_GET['pages'] < $j - 1): ?>
            <li class="page-item">
                <a class="page-link" href="/admin/users/user_list/?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Следующая</span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<script src="/webroot/js/pagination.js" async></script>