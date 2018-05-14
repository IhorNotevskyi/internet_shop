<div class="starter-template">
    <?php if (isset($data['category_list'])): ?>
        <div style="text-align: left; margin: -40px 0 40px"><?= $data['crumbs'] ?></div>
        <h2 style="margin-bottom: 30px">Категории товаров</h2>
        <ul class="list-unstyled" style="font-size: 20px">
            <?php foreach ($data['category_list'] as $key => $value): ?>
                <li style="font-size: 25px; line-height: 30px; padding: 20px 0">
                    <a href="/category/<?= $key == 6 ? 'analytics' : 'list/' . $key ?>"><?= $value; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div style="text-align: left; margin: -40px 0 40px"><?= $data['crumbs'] ?></div>
        <h2 style="margin-bottom: 30px"><?= $data['category'][0]['category_name']; ?></h2>
        <ul class="list-unstyled category-news" style="text-align: left; color: #587dff">
        <hr>
        <?php for ($i = 0; $i < $counter = count($data['category']); $i++): ?>
            <li style="display: none; text-align: center">
                <a href="/news/list/<?= $data['category'][$i]['id_news']; ?>">
                    <?php if ($data['category'][$i]['is_analitic'] == 1): ?>
                        <span style="color: red">Акция! </span>
                    <?php endif; ?>
                    <?= $data['category'][$i]['title_news']; ?>
                </a>
                <img src="/webroot/image/<?= $data['category'][$i]['image_news'] ?>" style="margin: 40px auto; max-width: 400px">
                <p style="color: #111111">
                    <?php if ($data['category'][$i]['is_analitic'] == 1): ?>
                        <span style="font-weight: 600">Старая цена:</span> <?= $data['category'][$i]['price'] ?> грн
                        <span style="font-weight: 600; padding-left: 50px">Новая цена:</span> <?= $data['category'][$i]['new_price'] ?> грн
                    <?php else: ?>
                        <span style="font-weight: 600">Цена:</span> <?= $data['category'][$i]['price'] ?> грн
                    <?php endif; ?>
                </p>
                <hr>
            </li>
        <?php endfor; ?>
        </ul>
        <script src="/webroot/js/news.js" async></script>
        <?php if (!isset($_GET['pages'])) $_GET['pages'] = 1; ?>
        <div class="text-center">
            <ul class="pagination pagination-lg news-pagination">
                <?php if (isset($data['category']) && count($data['category']) > 5):

                    if ($_GET['pages'] > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="/category/list/<?= $data['category'][0]['id_category']; ?>?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Предыдущая</span>
                        </li>
                    <?php endif; ?>

                    <?php for ($j = 1; $j <= $numerator = count($data['category']) % 5 != 0 ? count($data['category']) / 5 + 1 : count($data['category']) / 5; $j++): ?>
                        <?php if ($j == 2): ?>
                        <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                            <span class="page-link">...</span>
                        </li>
                        <?php endif; ?>
                        <li <?= ($j == $_GET['pages']) ? "class='active'" : ''; ?>>
                            <a href="/category/list/<?= $data['category'][0]['id_category']; ?>?pages=<?= $j; ?>"><?= $j; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($_GET['pages'] < $j - 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="/category/list/<?= $data['category'][0]['id_category']; ?>?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Следующая</span>
                        </li>
                    <?php endif; ?>

                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
<script src="/webroot/js/pagination.js" async></script>