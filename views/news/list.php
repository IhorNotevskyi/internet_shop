<?php if (!isset($data['news']['count'])): ?>
    <?= $data['crumbs'] ?>
    <div style="min-height: 300px">
        <h2 style="text-align: center; margin-top: 40px">
            <?php if ($data['is_analitic'] == 1): ?>
                <span style="color: red">Акция! </span>
            <?php endif; ?>
            <?= $data['title_news']; ?>
        </h2>
        <?php if ($data['image_news']): ?>
            <div style="margin: 30px 0">
                <img src="/webroot/image/<?= $data['image_news']; ?>" style="max-width: 600px; max-height: 400px">
            </div>
        <?php endif; ?>
        <p style="text-align: center; margin-top: 40px; font-size: 20px">
            <?php if ($data['is_analitic'] == 1): ?>
                <span style="font-weight: 600">Старая цена:</span> <?= $data['price'] ?> грн
                <span style="font-weight: 600; padding-left: 50px">Новая цена:</span> <?= $data['new_price'] ?> грн
            <?php else: ?>
                <span style="font-weight: 600">Цена:</span> <?= $data['price'] ?> грн
            <?php endif; ?>
            <a href="/cart/add/<?= $data['id_news'] ?>" class="btn btn-lg btn-success" style="margin-left: 50px">Добавить в корзину&ensp;<span class="fa fa-shopping-cart"></span></a>
        </p>
        <div style="line-height: 20px; text-align: justify; margin: 35px 0 50px; white-space: pre-wrap"><?= $data['content_news']; ?></div>
<!--        --><?php //if (!Session::get('login') && $data['is_analitic'] == 1) echo ' <p class="must-reg" style="margin-bottom: 50px"><a href="/users/login/">Войдите в свой аккаунт</a> или <a href="/users/register/">зарегистрируйтесь</a>, чтобы получить доступ к полному описанию новости</p>'; ?>
    </div>
    <?php if (isset($data['tags'])): ?>
        <p style="font-size: 22px">Теги:</p>
        <?php foreach ($data['tags'] as $key => $value): ?>
            <a href="/news/tag/<?= $key; ?>">
                <input type="button" class="btn btn-primary btn-sm" style="margin-right: 2px; letter-spacing: 1px" value="<?= $value; ?>">
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
    <div style="text-align: right; line-height: 22px; margin: 30px 0 40px">Количество просмотров (без учета «читающих сейчас»): <span id="total-read"><?= $data['cnt_visit']; ?></span><br> Читают сейчас: <span id="read"></span><br>Количество просмотров (с учетом «читающих сейчас»): <span id="random-read"></span>
    </div>
    <h3>Комментариев: <span class="badge" style="font-size: 20px"><?= $data['comments']['count']; ?></span></h3>
    <?php if (Session::get('login')) : ?>
        <form method="post" id="comment_form" action="">
            <input type='hidden' id='id_news' value='<?= $data['id_news'] ?>'>
            <div class="form-group">
                <textarea class="form-control" name="comment"  placeholder="Написать комментарий..." style="min-height: 80px"></textarea>
            </div>
<!--            <div class="form-group">-->
<!--                <input type="radio" id="recommend" name="announce" value="1">-->
<!--                <label for="recommend">&ensp;Рекомендую</label>-->
<!--                <input type="radio" id="discommend" name="announce" style="margin-left: 30px">-->
<!--                <label for="discommend">&ensp;Не рекомендую</label>-->
<!--            </div>-->
            <div class="comment-buttons">
                <button type="submit" name="submit" class="btn btn-success" onclick="location.reload()">Добавить комментарий</button>
                <button type="reset" class="btn btn-danger">Отмена</button>
                <hr>
            </div>
        </form>
    <?php else : ?>
        <div style="margin-bottom: 50px;"><a href="/users/login/">Войдите в свой аккаунт</a> или <a href="/users/register/">зарегистрируйтесь</a>, чтобы оставить комментарий</div>
    <?php endif; ?>
<div id="parent-for-comments">
    <?php if ($data['comments']['count']) {
        unset($data['comments']['count']);
        function array_rec($comment, $level = 0)
        {
            static $result;

            foreach ($comment as $item => $value) {

                if ($level == 1) {
                    $result .= "<div class='panel panel-info' id='panel-info-{$value['id_comment']}' style='margin-left: 80px'>";
                } else {
                    $result .= "<div class='panel panel-info' id='panel-info-{$value['id_comment']}'>";
                }

                $result .= "<div class='panel-heading' id='panel-heading-{$value['id_comment']}'>";
                $result .= "<h3 class='panel-title'>";
                $result .= "Написал: <a href='/comments/show/{$value['id_user']}'><span class='comment-write'>{$value['login']}</span></a>";
                $result .= "<span class='comment-date' data-numeric='" . strtotime($value['date_time']) . "' id='comment-date-{$value['id_comment']}'>" . date( 'd/m/Y H:i:s', strtotime($value['date_time'])) . "</span></h3> </div>";
                $result .= "<div class='panel-body'  id='panel-body-{$value['id_comment']}'>{$value['comment']}</div>";
                $result .= "<div class='panel-footer'  id='panel-footer-{$value['id_comment']}' style='padding: 4px 15px; overflow: hidden'>";

                if (Session::get('login') && $level == 0) {
                    $result .= "<div style='float: left'>";
                    $result .= "<a id='answer' class='btn btn-sm btn-primary'>Ответить</a>";
                    if (Session::get('login') == $value['login']) {
                        if (time() < strtotime($value['date_time']) + 60) {
                            $result .= "<a onclick='correctComment(this)' data-number='{$value['id_comment']}' data-digit='{$value['id_news']}'  id='correct-comment-{$value['id_comment']}' class='btn btn-sm btn-warning' style='margin-left: 5px'>Редактировать</a>";
                        }
                        $result .= "<a href='/news/list/{$value['id_news']}?delete={$value['id_comment']}' id='remove-comment1' onclick='return confirmDelete();' class='btn btn-sm btn-danger' style='margin-left: 5px'>Удалить</a></div>";
                    } else {
                        $result .= "</div>";
                    }
                } elseif (Session::get('login') && Session::get('login') == $value['login'] && $level != 0) {
                    $result .= "<div style='float: left'>";
                    if (time() < strtotime($value['date_time']) + 60) {
                        $result .= "<a onclick='correctComment(this)' data-number='{$value['id_comment']}' data-digit='{$value['id_news']}' id='correct-comment-{$value['id_comment']}' class='btn btn-sm btn-warning' style='margin-right: 5px'>Редактировать</a>";
                    }
                    $result .= "<a href='/news/list/{$value['id_news']}?delete={$value['id_comment']}' id='remove-comment2' onclick='return confirmDelete();' class='btn btn-sm btn-danger'>Удалить</a></div>";
                }

                $result .= "<div style='float: right'>";
                $result .= "<input type='hidden' id='id_comment' value='{$value['id_comment']}'>";
                $result .= "<input type='hidden' id='id_user' value='{$value['id_user']}'>";
                $result .= "<button type='button' id='like' class='btn btn-default'>
                        Like:<span class='fa fa-thumbs-up'
                             aria-hidden='true'> {$value['cnt_like']}</span>
                     </button> ";
                $result .= " <button type='button' id='dislike' class='btn btn-default'>
                      Dislike:<span class='fa fa-thumbs-down'
                             aria-hidden='true'> {$value['cnt_dislike']}</span>
                     </button>";
                if ($value['cnt_total'] > 0) {
                    $result .= " <button type='button' id='total' class='btn btn-default'>
                          Total:<span class='fa fa-star'
                                 aria-hidden='true'> +{$value['cnt_total']}</span>
                         </button>";
                } else {
                    $result .= " <button type='button' id='total' class='btn btn-default'>
                          Total:<span class='fa fa-star'
                                 aria-hidden='true'> {$value['cnt_total']}</span>
                         </button>";
                }
                $result .= "</div></div></div>";

                if (isset($value['childs'])) {
                    $level++;
                    array_rec($value['childs'], $level);
                    $level = 0;
                }
            }

            return $result;
        }

        $comment = array_rec($data['comments']);
        echo $comment;
    }
    ?>
</div>
<script src="/webroot/js/comment.js" async></script>
<?php else: ?>
    <?= $data['crumbs'] ?>
    <div style="margin-top: 40px">
        <h2 style="text-align: center; margin-bottom: 30px">Список товаров</h2>
        <ul class="list-unstyled news-parent" style="font-size: 20px">
            <?php foreach ($data['news'] as $value):
                if ($value['title_news'] == '') continue; ?>
                <li style="line-height: 30px; padding: 20px 0">
                    <a href="/news/list/<?= $value['id_news']; ?>" class="news-list">&middot;&ensp;<?= $value['title_news']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php if (!isset($_GET['pages'])) $_GET['pages'] = 1; ?>
    <div class="text-center">
        <ul class="pagination pagination-lg news-pagination pagination-parent">

            <?php if ($_GET['pages'] > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="/news/list/?pages=<?= $_GET['pages'] - 1; ?>">Предыдущая</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">Предыдущая</span>
                </li>
            <?php endif; ?>

            <?php for ($j = 1; $j <= $data['news']['count']; $j++): ?>
                <?php if ($j == 2): ?>
                    <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>

                <li <?= ($j == $_GET['pages']) ? "class='active'" : ''; ?>>
                    <a href="/news/list/?pages=<?= $j; ?>"><?= $j; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($_GET['pages'] < $j - 1): ?>
                <li class="page-item">
                    <a class="page-link" href="/news/list/?pages=<?= $_GET['pages'] + 1; ?>">Следующая</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">Следующая</span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>
<script src="/webroot/js/pagination.js" async></script>