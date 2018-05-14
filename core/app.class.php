<?php

class App
{
    protected static $routes;

    protected static $data;

    protected static $model;

    public static $db;

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function run($uri)
    {
        self::$db = new DB(
            Config::get('db.host'),
            Config::get('db.user'),
            Config::get('db.password'),
            Config::get('db.db_name')
        );

        self::$routes = new Router($uri);
        $class_name = ucfirst(self::$routes->getController()) . 'Controller';
        $method_name = strtolower(self::$routes->getMethodPrefix() . self::$routes->getAction());

        $layout = self::$routes->getMethodPrefix();
        self::$model = new User();
        self::$data['admin_role'] = self::$model->getUsersByRole();
        
        if ($layout == 'admin_' && Session::get('login') != self::$data['admin_role'][0]['login']) {
            if ($method_name !== 'admin_login') {
                Router::redirect('/admin/users/login'); // чтобы не бесконечный редирект
            }
        }

        $controller_object = new $class_name();

        if (method_exists($controller_object, $method_name)) {
            $view_path = $controller_object->$method_name();  // запись данных в обьект класса + если метод ничего не возвращает, то пустота
            $view_object = new View($controller_object->getData(), $view_path);

            // иклуд файла и передача в него инфы
            $content = $view_object->render();
            echo $content;
        } else {
            echo 'Error'; exit;
            /*throw new Exception('There is no method : ' . $method_name . ' in controller :' . $class_name);*/
        }
    }
}