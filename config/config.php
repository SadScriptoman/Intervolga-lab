<?
    $_PROTOCOL = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

    $_ROOT = $_SERVER['DOCUMENT_ROOT'];
    $_CORE = $_ROOT . '/core';
    $_MAGIC = $_CORE . '/magic';
    $_TEMPLATES = $_CORE . '/templates';
    $_SRC = $_CORE . '/src';
    $_FUNCTIONS = $_CORE . '/functions';

    $_MAIN_PAGE = $_PROTOCOL . $_SERVER['HTTP_HOST'];
    $_core = $_MAIN_PAGE .'/core';
    $_magic = $_core . '/magic';
    $_src = $_core . '/src';

    $_CONFIG = [
        'DATABASE' => [
            'HOST' => 'localhost',
            'NAME' => 'lab3',
            'USERNAME' => 'root',
            'PASS' => '',
            'CHARSET' => 'utf8',
            'CONNECT' => $_CORE . '/database/db-connect.php'
        ],
        'TEMPLATES' => [
            'HEADER' => $_TEMPLATES . '/header.php',
            'FOOTER_ALL_SCRIPTS' => $_TEMPLATES . '/footer-all-scripts.php',
            'FOOTER_BOOTSTRAP' => $_TEMPLATES . '/footer-bootstrap-scripts.php',
            'FOOTER_CRUD' => $_TEMPLATES . '/footer-crud.php',
            'FOOTER_REG' => $_TEMPLATES . '/footer-registration.php',
        ],
        'AUTHORIZATION' => [
            'IS_LOGGED' => $_MAGIC . '/authorization/is-logged.php',
            'LOGOUT' => $_magic . '/authorization/logout',
            'LOGIN' => $_MAGIC . '/authorization/login.php',
            'REGISTRATION' => $_MAGIC . '/authorization/registration.php',
        ],
        'ANALITYCS' => [
            'MODULE_FOLDER' => $_MAGIC . '/analitycs',
            'FULL_PATH_TO_MODULE' => $_MAGIC . '/analitycs/analytics.php',
            'DEL' => $_magic . '/analitycs/delete-page',
        ],
        'RESERVATIONS' => [
            'MODULE_FOLDER' => $_MAGIC . '/reservations',
            'INIT' => $_MAGIC . '/reservations/initialize/init.php',
            'HANDLE' => $_magic .'/reservations/handle-reservation',
            'CPY' => $_magic . '/reservations/copy-reservation',
            'DEL' => $_magic . '/reservations/delete-reservation',
            'OLD' => $_magic . '/reservations/delete-old-reservations',
        ],
        'EMPLOYEES' => [
            'MODULE_FOLDER' => $_MAGIC . '/employees',
            'INIT' => $_MAGIC . '/employees/initialize/init.php',
            'HANDLE' => $_magic . '/employees/handle-employee',
            'CPY' => $_magic . '/employees/copy-employee',
            'DEL' => $_magic . '/employees/delete-employee',
            'PATH_TO_PHOTOS' => 'uploads/employees/',
            'FULL_PATH_TO_PHOTOS' => $_ROOT . '/uploads/employees/',
            'IMAGE_W' => 100,
            'IMAGE_H' => 100
        ],
    ];

    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']); 