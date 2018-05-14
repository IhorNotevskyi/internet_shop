<h2 style="text-align: center; margin: 40px 0 20px">Комментарии</h2>
<div class="starter-template">
    <?php foreach ($data['comment'] as $key => $value): ?>
        <div class="panel panel-info text-left">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Написал: <a href="/comments/show/<?= $value['id_user'] ?>" class="comment-write"><?= $value['login'] ?></a>
                    <span style="float: right"><?= $value['date_time'] ?></span>
                </h3>
            </div>
            <div class="panel-body"><?= $value['comment'] ?></div>
            <div class="panel-footer" style="padding: 4px 15px; overflow: hidden"><span style="font-weight: 600">Название товара: </span><?= $value['title_news'] ?></div>
        </div>
    <?php endforeach; ?>
</div>
<?php if (!isset($_GET['pages'])) $_GET['pages'] = 1; ?>
    <div class="text-center">
        <ul class="pagination pagination-lg news-pagination pagination-parent">

            <?php if ($_GET['pages'] > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="/comments/show/<?= $data['comment'][0]['id_user'] ?>/?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">Предыдущая</span>
                </li>
            <?php endif; ?>

            <?php for ($j = 1; $j <= ($data['count_page']); $j++) : ?>
                <?php if ($j == 2): ?>
                    <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>

                <li <?= ($j == $_GET['pages']) ? 'class=active' : ''; ?>>
                    <a href="/comments/show/<?= $data['comment'][0]['id_user'] ?>/?pages=<?= $j; ?>"><?= $j; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($_GET['pages'] < $j - 1): ?>
                <li class="page-item">
                    <a class="page-link" href="/comments/show/<?= $data['comment'][0]['id_user'] ?>/?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">Следующая</span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<script src="/webroot/js/pagination.js" async></script>