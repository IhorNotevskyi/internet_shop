<?= $data['crumbs'] ?>
<h2 style="text-align: center">Список рекламных блоков</h2>
<a href="/admin/promotions/promotion_add/" style="display: block; text-align: right; margin: 0 20px 15px 0">
    <button class="btn btn-lg btn-success" style="padding-left: 50px; padding-right: 50px">Добавить блок</button>
</a>
<p style="font-size: 12px; font-style: italic; text-align: center">Верхние блоки слева и справа размещены по количеству переходов, остальные рандомно по 3 блока по бокам, неактивные блоки не отображаются</p>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Фирма</th>
            <th>Переходы</th>
            <th>Сайт</th>
            <th>Активный</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['admin_promotion'] as $key => $value): ?>
            <?php if ($key==='count') break; ?>
            <tr>
                <td><?= $value['product_name'] ?></td>
                <td><?= $value['price'] ?> грн</td>
                <td><?= $value['firm'] ?></td>
                <td><?= $value['cnt'] ?></td>
                <td><?= ($value['site']) ?></td>
                <td><?=  ($value['is_active']) ? 'да' : 'нет'; ?></td>
                <td  style="min-width: 200px">
                    <a href="/admin/promotions/edit_promotion/<?= $value['id'] ?>" style="display: inline-block">
                        <button class="btn btn-sm btn-block btn-warning">Редактировать</button>
                    </a>
                    <a href="/admin/promotions/delete/<?= $value['id'] ?>" onclick="return confirmDelete();" style="display: inline-block">
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

        <?php for ($j = 1; $j <= ($data['admin_promotion']['count']); $j++) : ?>
            <?php if ($j == 2): ?>
                <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            <li <?= ($j == $_GET['pages']) ? 'class=active' : ''; ?>>
                <a href="/admin/promotions/promotion_list/?pages=<?= $j; ?>"><?= $j; ?></a>
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