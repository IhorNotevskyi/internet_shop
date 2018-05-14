<?= $data['crumbs'] ?>
<div class="starter-template">
    <h2 style="margin-bottom: 50px"><?= $data['data_analytics'][0]['category_name'] ?></h2>
    <ul class="list-unstyled" style="font-size: 20px; text-align: center">
    <hr>
    <?php foreach ($data['category_analytics'] as $value): ?>
        <?php if ($value['title_news'] == '') continue; ?>
            <li>
                <a href="/news/list/<?= $value['id_news'] ?>"><span style="color: red">Акция! </span><?= $value['title_news']; ?></a>
                <img src="/webroot/image/<?= $value['image_news'] ?>" style="margin: 40px auto; max-width: 400px">
                <p style="color: #111111"><span style="font-weight: 600">Старая цена:</span> <?= $value['price'] ?> грн <span style="font-weight: 600; padding-left: 50px">Новая цена:</span> <?= $value['new_price'] ?> грн</p>
                <hr>
            </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php if (!isset($_GET['pages'])) $_GET['pages'] = 1; ?>
<div class="text-center" style="margin: -10px 0 20px">
    <ul class="pagination pagination-lg news-pagination pagination-parent">
        <?php if ($_GET['pages'] > 1): ?>
            <li class="page-item">
                <a class="page-link" href="/category/analytics/?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Предыдущая</span>
            </li>
        <?php endif; ?>

        <?php for ($j = 1; $j <= $data['category_analytics']['count']; $j++): ?>
            <?php if ($j == 2): ?>
                <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            <li <?= ($j == $_GET['pages']) ? 'class=active' : ''; ?>>
                <a href="/category/analytics/?pages=<?= $j; ?>"><?= $j; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($_GET['pages'] < $j - 1): ?>
            <li class="page-item">
                <a class="page-link" href="/category/analytics/?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Следующая</span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<script src="/webroot/js/pagination.js" async></script>