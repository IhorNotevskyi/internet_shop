<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Мой интернет магазин</title>
    <link rel="icon" type="image/x-icon" href="/webroot/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- arcticModal -->
    <script src="/webroot/js/articmodal_v0.3/jquery.arcticmodal-0.3.min.js"></script>
    <link rel="stylesheet" href="/webroot/js/articmodal_v0.3/jquery.arcticmodal-0.3.css">
    <!-- arcticModal theme -->
    <link rel="stylesheet" href="/webroot/js/articmodal_v0.3/themes/dark.css">
    <script src="/webroot/js/articmodal_v0.3/jquery.cookie.js"></script>
    <link rel="stylesheet" href="/webroot/css/style.css">
<!--    <script>
        window.onbeforeunload = function(e) {
            var text = "Вы действительно хотите покинуть сайт?";
            e.returnValue = text;
            e.cancelable = true;
            return text;
        }
    </script>-->
<!--    <script type="text/javascript">
        $(document).ready(function () {
            $(window).on('beforeunload', function() {
                document.write('<div>.....................</div>');  // HTML код в одну строчку!!!
                return "Вы точно решили покинуть наш сайт?";
            });

            $('a').click(function() {
                $(window).off('beforeunload');
            });
        });
    </script>-->
</head>
<body style="background-color:<?= $data['config'][1]['value']; ?>">
<div class="content">
<div style="display: none">
    <div class="box-modal" id="boxUserFirstInfo">
        <div class="box-modal_close arcticmodal-close fa fa-close"></div>
        <div class="subscription">Подписаться на акционную рассылку?</div>
        <form>
            <div class="form-group">
                <label for="name">Введите Ваши имя и фамилию</label>
                <input type="text" class="form-control" id="name" placeholder="Имя и фамилия">
            </div>
            <div class="form-group">
                <label for="email">Введите Ваш email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <button class="arcticmodal-close btn btn-success" style="margin-top: 10px">Подписаться</button>
        </form>
    </div>
</div>

<nav class="navbar navbar-inverse" style="background-color:<?= $data['config'][0]['value'] ?>; border: none">
    <div class="navbar-header" style="display: inline-block">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand fa fa-angellist" href="/" style="color: #fff"> Мой интернет магазин</a>
    </div>
    <ul id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="menu-items"><a class="active" href="/category/list" style="color: #fff">Категории товаров</a></li>
<!--            <li class="menu-items"><a href="/news/list/"  style="color: #fff">Список товаров</a></li>-->
            <li class="menu-items"><a href="/find/"  style="color: #fff">Поиск товаров</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle menu-items" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #fff">Меню<span class="caret" style="margin-left: 5px"></span></a>
                <?php
                function tplMenu($value)
                {
                    $menu = "";

                    if (isset($value['children'])) {
                        $menu .= '<li class="dropdown-submenu"><a href="' . $value['path'] . '">' . $value['value'] . '<span class="caret" style="margin-left: 5px"></span></a><ul class="dropdown-menu">' . showCat($value['children']) . '</ul></li>';
                    } else {
                        $menu .= '<li><a href="' . $value['path'] . '">' . $value['value'] . '</a>';
                    }

                    $menu .= '</li>';

                    return $menu;
                }

                function showCat($data)
                {
                    $string = '';

                    foreach ($data as $item) {
                        $string .= tplMenu($item);
                    }

                    return $string;
                }

                echo '<ul class="dropdown-menu">' . showCat($data['menu']) . '</ul>';
                ?>
            </li>
        <?php if (Session::get('login') == $data['admin_role'][0]['login']): ?>
            <li class="menu-items admin-items"><a href="/admin/settings/menu/" style="color: #ff463c"><span class="fa fa-address-card" style="margin-right: 7px"></span>Админ-панель</a></li>
        <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="menu-items">
                <?php if (Session::get('login')): ?>
                    <a href="/cart/order/<?= CartController::getPersonalId(Session::get('login')) ?>" style="color: #fff">
                <?php else: ?>
                    <a href="/cart/order/" style="color: #fff">
                <?php endif; ?>
                    <span class="fa fa-shopping-cart" style="padding-right: 5px"></span>
                    Корзина (товаров: <span><?= CartController::countItems() ?></span>)
                </a>
            </li>
            <?php if (Session::get('login')): ?>
                <li class="menu-items"><a href="/cart/user/<?= CartController::getPersonalId(Session::get('login')) ?>" style="color: #fff">Личный кабинет</a></li>
                <li><a style="color: #fff">Добро пожаловать, <span style="font-weight: 700"><?= Session::get('login') ?></span></a></li>
                <li class="menu-items"><a href="/users/logout/" style="color: #fff">Выйти</a></li>
            <?php else : ?>
                <li class="menu-items"><a href="/users/login/" style="color: #fff">Вход</a></li>
                <li class="menu-items"><a href="/users/register/" style="color: #fff">Регистрация</a></li>
            <?php endif; ?>
        </ul>
        <form action="search.php" method="post" name="form" onsubmit="return false;"
              class="navbar-form navbar-right" role="search" style="margin-right: 10px">
            <div class="form-group">
                <div class="btn-group">
                    <input type="text" autocomplete="off" id="search" data-toggle="dropdown" class="form-control"
                           placeholder="Поиск по тегам"> </input>
                    <ul id="resSearch" class="dropdown-menu">
                    </ul>
                </div>
            </div>
        </form>
    </ul>
</nav>
<br>
<?php if (App::getRoutes()->getMethodPrefix() == null): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <?php for ($prom = $data['promotion'], $cnt = count($data['promotion']), $i = 0;
                $i < $cnt;
                $i++): ?>
                <?php if ($i == ceil($cnt / 2)) : ?>
            </div>
            <div class="col-sm-2 col-sm-push-8">
                <?php endif; ?>
                <div class="banner" data-placement="right" data-toggle="tooltip" data-html="true" title="<p style='font-size: 14px; padding: 10px 10px 0; width: 100px'>Купон на скидку - <strong style='color: red'>Fgf67Hui</strong> - примените и получите скидку <strong style='color: red'>10%</strong></p>">
                    <p>Товар: <?= $prom[$i]['product_name'] ?></p>
                    <hr class="hr-promotion">
                    <p class="product-price">Цена: <span data-price="<?= $prom[$i]['price'] ?>"><?= $prom[$i]['price'] ?></span> грн</p>
                    <hr class="hr-promotion">
                    <p>Переходов: <?= $prom[$i]['cnt'] ?></p>
                    <hr class="hr-promotion">
                    <p id="<?= $prom[$i]['id'] ?>">Фирма: <a href="<?= $prom[$i]['site'] ?>" target="_blank">"<?= $prom[$i]['firm'] ?>"</a></p>
                </div>
                <?php endfor; ?>
            </div>
            <div class="col-sm-8 col-sm-pull-2 main-container">
                <?php if (Session::hasFlash()) { ?>
                    <div class="starter-template">
                        <div class="alert alert-info" role="alert">
                            <?php Session::flash(); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php include $this->path; ?>
            </div>
        </div>
    </div>
<?php elseif (Session::get('login') == 'admin'): ?>
    <?php include VIEW_PATH . DS . App::getRoutes()->getMethodPrefix() . DS . 'admin_menu.php'; ?>
<?php else : ?>
    <div class="container">
    <?php include $this->path; ?>
    </div>
<?php endif; ?>
</div>
<?php include VIEW_PATH . DS . 'footer.php'; ?>
</body>
<script src="/webroot/js/main.js"></script>
</html>