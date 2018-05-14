<h2 style="text-align: center; margin: 40px 0 10px">Результаты поиска</h2>
<div class="starter-template" style="min-height: 300px; text-align: left">
<!--    --><?php //var_dump($data['tags'][0]); ?>
    <?php if (!isset($data['tags'][0]['id_news'])): ?>
        <ul class="list-unstyled tag-list search-by-tags">
            <?php foreach ($data['tags'] as $key => $value): ?>
                <li style="margin-bottom: 35px; line-height: 34px">
                    <a href="/news/tag/<?= $key; ?>">&middot;&ensp;<?= $value ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <ul class="list-unstyled tag-list" style="margin-top: -20px; text-align: center">
            <hr>
            <?php foreach ($data['tags'] as $category => $item) {
                if (isset($item['id_category'])) {
                    $b[$item['category_name']] = $item['id_category'];
                }
            } ?>
            <?php foreach ($b as $key => $item): ?>
                <h3 style="text-align: center; margin-bottom: 40px"><a href="/category/list/<?= $item ?>" class="category-title"><?= $key ?></a></h3>
                <?php foreach ($data['tags'] as $category): ?>
                    <?php if (isset($category['id_category']) && $category['id_category'] == $item): ?>
                        <li style="padding-top: 10px">
                            <span style="padding-right: 5px; color: #00bb00">&#10004;</span>
                            <a href="/news/list/<?= $category['id_news'] ?>"><?= $value['category_name'] ?>
                                <?php if ($category['is_analitic'] == 1): ?>
                                    <span style="color: red">Акция! </span>
                                <?php endif; ?>
                                <?= $category['title_news']; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <hr>
            <?php endforeach; ?>

<!--            --><?php //foreach ($data['tags'] as $value): ?>
<!--                <li style="margin-bottom: 35px; line-height: 34px">-->
<!--                    <a href="/news/list/--><?//= $value['id_news']; ?><!--">--><?//= $value['category_name'] ?><!-- &middot;&ensp;-->
<!--                        --><?php //if ($value['is_analitic'] == 1): ?>
<!--                            <span style="color: red">Акция! </span>-->
<!--                        --><?php //endif; ?>
<!--                        --><?//= $value['title_news'] ?>
<!--                    </a>-->
<!--                </li>-->
<!--            --><?php //endforeach; ?>
        </ul>
    <?php endif; ?>
</div>