<?php

class SettingsController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Setting();
    }

    public function admin_menu()
    {
    }

    public function admin_bg_site()
    {
        if ($_POST) {
            $id = key($_POST);
            $color = $_POST[$id];
            $this->model->save($id, $color);

            Router::redirect('/admin/settings/bg_site');
        } else {
            $this->data['bg_site'] = $this->model->admin_color();
        }

        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array($url, 'Изменить фон сайта или шапки')
        );
    }

   public function admin_nav_menu()
   {
       $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
       $this->data['crumbs'] = $this->getBreadCrumbs(
           $this->panel,
           array($url, 'Редактировать меню')
       );
   }

    public function admin_add_nav_menu()
    {
        if (isset($_POST['value_menu_item']) && isset($_POST['path_menu_item']) && $_POST['id_parent_menu_item'] !== '') {
            $this->model->add_nav_menu(
                $_POST['value_menu_item'],
                $_POST['path_menu_item'],
                $_POST['id_parent_menu_item']
            );

            Router::redirect('/admin/settings/nav_menu');
        }

        if (isset($_POST['value_menu_item']) && isset($_POST['path_menu_item']) && $_POST['id_parent_menu_item'] === '') {
            $this->model->add_nav_menu_without_parent(
                $_POST['value_menu_item'],
                $_POST['path_menu_item']
            );

            Router::redirect('/admin/settings/nav_menu');
        }

        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/settings/nav_menu', 'Редактировать меню'),
            array($url, 'Добавить пункт меню')
        );
    }

    public function admin_edit_nav_menu()
    {
        if (isset($_POST['id_menu_item']) && !empty($_POST['id_menu_item']) && !empty($_POST['value_menu_item']) && !empty($_POST['path_menu_item'])) {
            $this->model->change_nav_menu(
                $_POST['id_menu_item'],
                $_POST['value_menu_item'],
                $_POST['path_menu_item']
            );

            Router::redirect('/admin/settings/nav_menu');
        } else {
            $id = $this->params[0];
            $this->data = $this->model->admin_edit_nav_menu($id);
        }

        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array('/admin/settings/nav_menu', 'Редактировать меню'),
            array($url, 'Редактировать пункт меню')
        );
    }

    public function admin_delete_nav_menu()
    {
        $id = (int)$this->params[0];
        $this->model->admin_delete_nav_menu($id);
        Router::redirect('/admin/settings/nav_menu');
    }
}