<?= $data['crumbs'] ?>
<h2 style="margin-bottom: 50px; text-align: center">Редактировать меню</h2>
<a href="/admin/settings/add_nav_menu">
    <button class="btn btn-lg btn-success">Добавить пункт меню</button>
</a>
<ul class="list-select" style="list-style-type: none; font-size: 23px; margin: 30px 0 50px">
<?php

function templateMenu($value)
{
    $menu = '<li style="padding: 10px 0"><a href="' . $value['path'] . '"><span style="color: #000">&#10148;&ensp;</span>' . $value['value'] . ' (ID: ' . $value['id'] . ')</a>';
    $menu .= "<a href='/admin/settings/edit_nav_menu/{$value['id']}' title='Редактировать' class='nav-menu-buttons' style='margin-left: 20px; color: #f4a007'>&#9998;</a>";
    $menu .= "<a href='/admin/settings/delete_nav_menu/{$value['id']}' title='Удалить' class='nav-menu-buttons' onclick='return confirmDelete();' style='margin-left: 10px; color: #d93a2b'>&#10008;</a>";

    if (isset($value['children'])) {
        $menu .= '<ul style="margin-left: 100px; list-style-type: none; padding-top: 20px">' . show($value['children']) . '</ul>';
    }

    $menu .= '</li>';

    return $menu;
}

function show($data)
{
    $string = '';

    foreach ($data as $item) {
        $string .= templateMenu($item);
    }

    return $string;
}

echo show($data['menu']);
?>
</ul>