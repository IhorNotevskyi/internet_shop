<?php

/*try {*/
    define('ROOT', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);
    define('VIEW_PATH', ROOT . DS . 'views');
    define('IMAGE_PATH', 'webroot' . DS . 'image');
    define('ALLOW_TYPES', array(
        'image/jpeg',
        'image/gif',
        'image/png'
    ));

    include ROOT . DS . 'core' . DS . 'load.class.php';
    spl_autoload_register([(new Load()), 'autoloader']);

    session_start();

    App::run($_SERVER['REQUEST_URI']);
/*
} catch (Exception $e) {
    Router::redirect('/error/message');
}*/
