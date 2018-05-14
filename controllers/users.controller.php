<?php

class UsersController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new User();
    }

    public function admin_user_list()
    {
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'] - 1;
        }
        $page = !isset($page) ? 0 : $page;

        $this->data['users'] = $this->model->users($page, 10);

        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->panel,
            array($url, 'Список пользователей')
        );
    }

    public function admin_delete()
    {
        if (isset($this->params[0])) {
            $result = $this->model->admin_delete($this->params[0]);

            if ($result) {
                Session::setFlash('Категория удалена');
            } else {
                Session::setFlash('Ошибка');
            }
        }

        Router::redirect('/admin/users/user_list');
    }

    public function admin_login()
    {
        if ($_POST && isset($_POST['login']) && isset($_POST['password'])) {
            $user = $this->model->getByLogin($_POST['login']);
            $hash = md5(Config::get('salt') . $_POST['password']);

            if ($user && $user['is_active'] && $hash == $user['password']) {
                Session::set('login', $user['login']);
                Session::set('role', $user['role']);
            }

            Router::redirect('/admin/settings/menu');
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->home,
            array('/admin/users/login', 'Авторизация для администратора')
        );
    }

    public function admin_logout()
    {
        Session::destroy();
        Router::redirect('/admin/');
    }

    public function login()
    {
        if ($_POST && isset($_POST['login']) && isset($_POST['password'])) {
            $user = $this->model->getByLogin($_POST['login']);
            $hash = md5(Config::get('salt') . $_POST['password']);

            if ($user && $user['is_active'] && $hash == $user['password'] && ($_POST['login'] !== 'admin')) {
                Session::set('login', $user['login']);
                Router::redirect('/');
            } else {
                Session::setFlash('Попробуйте еще раз');
            }
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->home,
            array('/users/login', 'Авторизация')
        );
    }

    public function register()
    {
        if ($_POST) {
            $login = trim(strip_tags($_POST['login']));
            $email = trim(strip_tags($_POST['email']));
            $password = $_POST['password'];

            if (!preg_match('/^.{1,45}$/', $login)) {
                Session::setFlash('Логин некорректный (минимум 1 символ, максимум 45 символов)');
                return false;
            }

            if ($this->model->checkUniqueField('login', $login) > 0) {
                Session::setFlash('Пользователь с таким логином уже существует');
                return false;
            }

            if (!preg_match('/^(?:[a-z0-9!#$%&\'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/', $email)) {
                Session::setFlash('Email некорректный');
                return false;
            }

            if ($this->model->checkUniqueField('email', $email) > 0) {
                Session::setFlash('Пользователь с таким email уже существует');
                return false;
            }

            if (!preg_match('/^(?=[-_a-zA-Z0-9]*?[A-Z])(?=[-_a-zA-Z0-9]*?[a-z])(?=[-_a-zA-Z0-9]*?[0-9])[-_a-zA-Z0-9]{6,32}$/', $password)) {
                Session::setFlash('Пароль некорректный. Пароль должен быть не менее 6 и не более 32 символов, содержать только латинские буквы, цифры, символы: !?#_- и обязан иметь как минимум один символ верхнего регистра, один символ нижнего регистра и одну цифру');
                return false;
            }

            $new_user = $this->model->addUser($_POST);
            if ($new_user) {
                Session::set('login', $new_user['login']);
                Session::setFlash('Поздравляем, Вы успешно зарегистрировались!');
            }

            Router::redirect('/');
        }

        $this->data['crumbs'] = $this->getBreadCrumbs(
            $this->home,
            array('/users/register', 'Регистрация')
        );
    }

    public function logout()
    {
        Session::destroy();
        Router::redirect('/');
    }
}