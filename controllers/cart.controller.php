<?php

class CartController extends Controller
{
    private $productsInCart = array();

    public static $getId;

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Newss();
    }

    public function user()
    {
        $params = App::getRoutes()->getParams();

        if (isset($params)) {
            $id = $params[0];

            $this->model = new User();
            $this->data['personal'] = $this->model->getPersonalData($id);

            $this->model = new Newss();
            $this->data['custom'] = $this->model->getOrdersByLoginId($id);

            foreach ($this->data['custom'] as $key => $value) {
                $dec = json_decode($this->data['custom'][$key]['orders'], true);
                $this->data['custom'][$key]['orders'] = $dec;
            }

            if (isset($_POST['personal_new_email']) && isset($_POST['personal_email_pass']) && isset($_POST['submit'])) {
                $personalNewEmail = strip_tags(trim($_POST['personal_new_email']));
                $personalEmailPass = $_POST['personal_email_pass'];

                $this->data['errors'] = $this->checkEmail($personalNewEmail, $errors = array());

                if (!$this->data['errors']) {
                    $this->model = new User();
                    $password = $this->model->getPasswordForCheck($id);
                    $hash = md5(Config::get('salt') . $personalEmailPass);

                    if ($hash === $password[0]['password']) {
                        $this->model->saveNewPersonalEmail($id, $personalNewEmail);
                        Router::redirect($_SERVER['REQUEST_URI']);
                    } else {
                        $errors = array();
                        $errors[] = 'Вы ввели неправильный пароль';
                        $this->data['errors'] = $errors;
                    }
                }
            } elseif (isset($_POST['personal_email']) && isset($_POST['personal_old_pass']) && isset($_POST['personal_new_pass']) && isset($_POST['change_pwd'])) {
                $personalEmail = strip_tags(trim($_POST['personal_email']));
                $personalOldPass = md5(Config::get('salt') . $_POST['personal_old_pass']);
                $personalNewPass = $_POST['personal_new_pass'];

                $this->data['errors'] = $this->checkPersonalEmail($id, $personalEmail, $errors = array());

                if (!$this->data['errors']) {
                    $this->model = new User();
                    $personalPassword = $this->model->getPasswordForCheck($id);

                    if ($personalOldPass != $personalPassword[0]['password']) {
                        $errors = array();
                        $errors[] = 'Вы ввели неправильный пароль';
                        $this->data['errors'] = $errors;

                        return false;
                    }

                    $this->data['errors'] = $this->checkNewPassword($personalNewPass, $errors = array());

                    if (!$this->data['errors']) {
                        $personalNewPassword = md5(Config::get('salt') . $personalNewPass);
                        $this->model->changePersonalPassword($id, $personalNewPassword);
                        Router::redirect($_SERVER['REQUEST_URI']);
                    }
                }
            }
        } else {
            echo 'Error';
            exit;
        }
    }

    public function checkNewPassword($password, array $errors)
    {
        if (!preg_match('/^(?=[-_a-zA-Z0-9]*?[A-Z])(?=[-_a-zA-Z0-9]*?[a-z])(?=[-_a-zA-Z0-9]*?[0-9])[-_a-zA-Z0-9]{6,32}$/', $password)) {
            $errors[] = 'Вы ввели некорректный пароль. Пароль должен быть не менее 6 и не более 32 символов, содержать только латинские буквы, цифры, символы: !?#_- и обязан иметь как минимум один символ верхнего регистра, один символ нижнего регистра и одну цифру';
        }

        return $errors;
    }

    public function checkPersonalEmail($id, $email, array $errors)
    {
        $this->model = new User();
        $personalEmail = $this->model->getEmailById($id);

        if (!$personalEmail[0]['email'] || $personalEmail[0]['email'] != $email) {
            $errors[] = 'Вы ввели неправильный email';
        }

        return $errors;
    }

    public function checkEmail($email, array $errors)
    {
        if (!preg_match('/^(?:[a-z0-9!#$%&\'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/', $email)) {
            $errors[] = 'Вы ввели некорректный email';
        }

        $this->model = new User();
        $allEmails = $this->model->getAllEmailsForCheck();
        foreach ($allEmails as $items) {
            if ($email == $items['email']) {
                $errors[] = 'Данный email уже используется другим пользователем';
                break;
            }
        }

        return $errors;
    }

    public function add()
    {
        $url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $urlParts = explode('/', $url);
        $id = array_pop($urlParts);

        $this->addProduct($id);
    }

    public function order()
    {
        $this->productsInCart = $this->getProducts();

        if ($this->productsInCart) {
            $i = 0;
            $total = 0;

            foreach ($this->productsInCart as $product => $count) {
                $this->data['products'][$i] = $this->model->getNewsById($product);
                $this->data['products'][$i][0]['count'] = $count;
                $this->data['count'] += $count;

                if ($this->data['products'][$i][0]['is_analitic'] == 1) {
                    $total += $this->data['products'][$i][0]['new_price'] * $count;
                } else {
                    $total += $this->data['products'][$i][0]['price'] * $count;
                }

                ++$i;
            }

            $this->data['products']['total_price'] = $total;
        }
    }

    public function checkout()
    {
        $this->order();

        $orderArray = array();
        foreach ($this->productsInCart as $orderNumber => $cntOrder) {
            $orderArray[$orderNumber] = $this->model->getPriceByLogin($orderNumber);
            $orderArray[$orderNumber][0]['total'] = $cntOrder;
        }

        $ordersArr = array();
        foreach ($orderArray as $key => $value) {
            $ordersArr[$key] = $value[0];
        }

        if ($this->data['count'] == false || $this->data['products']['total_price'] == false) {
            $errors = array();
            $errors[] = 'Вы не выбрали ни одного товара';
            $this->data['errors'] = $errors;

            return false;
        }

        if (isset($_POST['user_name']) && isset($_POST['user_phone']) && isset($_POST['user_email'])) {
            $userName = strip_tags(trim($_POST['user_name']));
            $userPhone = strip_tags(trim($_POST['user_phone']));
            $userEmail = strip_tags(trim($_POST['user_email']));

            $this->data['errors'] = $this->checkOrderData($userName, $userPhone, $userEmail, $errors = array());

            if (!$this->data['errors']) {
                $userId = 0;

                if (Session::get('login')) {
                    $this->model = new User();
                    $login = $this->model->getUserIdByLogin(Session::get('login'));
                    $userId = $login[0]['id'];
                }

                $this->model = new Newss();

                $result = $this->model->saveNews(
                    $userName,
                    $userPhone,
                    $userEmail,
                    $userId,
                    $this->data['products']['total_price'],
                    $this->data['count'],
                    $ordersArr
                );

                if ($result) {
                    $this->clearProducts();
                    $this->data['count'] = 0;
                    $this->data['products']['total_price'] = 0;

                    Router::redirect('/cart/checkout_ok/');
                } else {
                    $errors = array();
                    $errors[] = 'Форма не отправлена';
                    $this->data['errors'] = $errors;

                    return false;
                }
            }
        }
    }

    public static function getPersonalId($login)
    {
        $result = new Newss();
        $id = $result->getPersonalIdByLogin($login);

        return $id[0]['id'];
    }

    public function checkout_ok()
    {
    }

    public function delete()
    {
        $id = $this->params[0];
        $this->deleteProduct($id);
        Router::redirect('/cart/order/');
    }

    public function deleteProduct($id)
    {
        $this->productsInCart = $this->getProducts();
        unset($this->productsInCart[$id]);
        $_SESSION['products'] = $this->productsInCart;
    }

    public function addProduct($id)
    {
        $id = intval($id);
        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        Router::redirect($_SERVER['HTTP_REFERER']);
    }

    public function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }

        return false;
    }

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }

            return  $count;
        } else {
            return 0;
        }
    }

    public function checkOrderData($userName, $userPhone, $userEmail, array $errors)
    {
        if (!preg_match('/^.{1,100}$/', $userName)) {
            $errors[] = 'Вы ввели некорректное имя';
        }

        if (!preg_match('/^\d{10}$/', $userPhone)) {
            $errors[] = 'Вы ввели некорректный номер телефона';
        }

        if (!preg_match('/^(?:[a-z0-9!#$%&\'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/', $userEmail)) {
            $errors[] = 'Вы ввели некорректный email';
        }

        return $errors;
    }

    public function clearProducts()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

//    public function admin_orders_list()
//    {
//        $page = 0;
//        if (isset($_GET['pages'])) {
//            $page = $_GET['pages'] - 1;
//        }
//
//        $this->model = new Cart();
//        $this->data['orders'] = $this->model->admin_get_orders($page);
//
//        $url = urldecode($_SERVER['REQUEST_URI']);
//        $this->data['crumbs'] = $this->getBreadCrumbs(
//            $this->panel,
//            array($url, 'Список заказов')
//        );
//    }
}