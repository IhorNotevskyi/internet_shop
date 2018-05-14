<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators carousel-indicators-numbers">
        <li data-target="#myCarousel" data-slide-to="0" class="active">1</li>
        <li data-target="#myCarousel" data-slide-to="1">2</li>
        <li data-target="#myCarousel" data-slide-to="2">3</li>
        <li data-target="#myCarousel" data-slide-to="3">4</li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        $cnt = 0;
        foreach ($data['carousel_slider'] as $slide) {
            if (($slide['image_news'])) {
                $cnt++;
                if ($cnt == 5) break; ?>
                <div class="item">
                    <a href="/news/list/<?= $slide['id_news'] ?>">
                        <h3><span style="color: red">Акция! </span><?= $slide['title_news'] ?></h3>
                        <p style="max-height: 50px; padding: 0 100px; overflow: hidden; margin-bottom: 20px; text-align: justify"><?= $slide['content_news'] ?></p>
                        <img src="/webroot/image/<?= $slide['image_news'] ?>">
                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<script>
    (function () {
        var sliderItem = document.querySelector('.carousel-inner .item');
        sliderItem.classList.add('active');
    })();
</script>
<hr>
<hr>
<div style="text-align: center">
<?php foreach ($data as $category => $item) {
        if (isset($item['id_category'])) {
            $b[$item['category_name']] = $item['id_category'];
        }
    } ?>
    <?php foreach ($b as $key => $item): ?>
        <h2 style="text-align: center; margin-bottom: 40px"><a href="/category/list/<?= $item ?>" class="category-title"><?= $key ?></a></h2>
        <hr>
        <hr>
        <ul class="list-unstyled" style="font-size: 20px">
        <?php foreach ($data['by_analytics'] as $analytics): ?>
            <?php if (isset($analytics['id_category']) && $analytics['id_category'] == $item): ?>
                <li style="padding-top: 10px"><a href="/news/list/<?= $analytics['id_news'] ?>"><span style="color: red">Акция! </span><?= $analytics['title_news']; ?></a></li>
                <li style="padding-top: 10px; max-width: 400px; margin: 20px auto"><img src="/webroot/image/<?= $analytics['image_news'] ?>"></li>
                <li style="padding-top: 10px; text-align: justify; max-height: 100px; overflow: hidden">&emsp;<?= $analytics['content_news'] ?></li>
                <li style="margin-top: 40px"><span style="font-weight: 600">Старая цена:</span> <?= $analytics['price'] ?> грн <span style="font-weight: 600; padding-left: 50px">Новая цена:</span> <?= $analytics['new_price'] ?> грн</li>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php foreach ($data as $category): ?>
            <?php if (isset($category['id_category']) && $category['id_category'] == $item): ?>
                <li style="padding-top: 10px"><a href="/news/list/<?= $category['id_news'] ?>"><?= $category['title_news']; ?></a></li>
                <li style="padding-top: 10px; max-width: 400px; margin: 20px auto"><img src="/webroot/image/<?= $category['image_news'] ?>"></li>
                <li style="padding-top: 10px; text-align: justify; max-height: 100px; overflow: hidden">&emsp;<?= $category['content_news'] ?></li>
                <li style="margin-top: 40px"><span style="font-weight: 600">Цена:</span> <?= $category['price'] ?> грн</li>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
        <hr>
    <?php endforeach; ?>
<?php if (!empty($data['category_analytics']) && !empty($data['data_analytics'])): ?>
<h2 style="text-align: center; margin-bottom: 50px"><a href="/category/analytics" class="category-title"><?= $data['data_analytics'][0]['category_name'] ?></a></h2>
<hr>
<?php foreach ($data['category_analytics'] as $value): ?>
    <hr>
    <ul class="list-unstyled" style="font-size: 20px">
        <li><a href="/news/list/<?= $value['id_news'] ?>"><span style="color: red">Акция! </span><?= $value['title_news']; ?></a></li>
        <li style="padding-top: 10px; max-width: 400px; margin: 20px auto"><img src="/webroot/image/<?= $value['image_news'] ?>"></li>
        <li style="padding-top: 10px; text-align: justify; max-height: 100px; overflow: hidden">&emsp;<?= $value['content_news'] ?></li>
        <li style="margin-top: 40px"><span style="font-weight: 600">Старая цена:</span> <?= $value['price'] ?> грн <span style="font-weight: 600; padding-left: 50px">Новая цена:</span> <?= $value['new_price'] ?> грн</li>
    </ul>
<?php endforeach; ?>
</div>
<hr>
<hr>
<?php endif; ?>
<h2 class="title-table" style="margin-top: 50px">Топ-5 комментаторов</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th style="width: 15%">№</th>
        <th style="width: 50%">Имя пользователя</th>
        <th style="width: 35%">Количество комментариев</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach ($data['commentator'] as $commentator): ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><a href="/comments/show/<?= $commentator['id_user'] ?>"><?= $commentator['login'] ?></a></td>
            <td><?= $commentator['cnt'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<hr>
<h2 class="title-table" style="margin-top: 50px">Топ-5 популярных товаров</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th style="width: 10%">№</th>
        <th style="width: 40%">Название темы</th>
        <th style="width: 60%">Фото темы</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach ($data['themes'] as $theme): ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><a href="/news/list/<?= $theme['id_news'] ?>"><?= $theme['title_news'] ?></a></td>
            <td><img src="/webroot/image/<?= $theme['image_news'] ?>" alt="" style="width: 350px; height: 200px"></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>