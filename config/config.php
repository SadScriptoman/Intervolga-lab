<?
    $_CONFIG = [
        'DATABASE' => [
            'HOST' => 'localhost',
            'NAME' => 'lab2',
            'USERNAME' => 'root',
            'PASS' => '',
            'CHARSET' => 'utf8',
            'CONNECT' => $_SERVER['DOCUMENT_ROOT'] . '/core/database/db-connect.php'
        ],
        'SRC_PATH' => $_SERVER['DOCUMENT_ROOT'] . '/core/src/',
        'FUNCTIONS_PATH' => $_SERVER['DOCUMENT_ROOT'] . '/core/functions/',
        'TEMPLATES' => [
            'HEADER' => $_SERVER['DOCUMENT_ROOT'] . '/core/templates/header.php',
            'FOOTER_ALL_SCRIPTS' => $_SERVER['DOCUMENT_ROOT'] . '/core/templates/footer-all-scripts.php',
            'FOOTER_BOOTSTRAP' => $_SERVER['DOCUMENT_ROOT'] . '/core/templates/footer-bootstrap-scripts.php',
            'FOOTER_CRUD' => $_SERVER['DOCUMENT_ROOT'] . '/core/templates/footer-crud.php',
            'FOOTER_REG' => $_SERVER['DOCUMENT_ROOT'] . '/core/templates/footer-registration.php',
        ],
        'ANALITYCS' => [
            'MODULE_FOLDER' => $_SERVER['DOCUMENT_ROOT'] . '/core/magic/analitycs',
            'FULL_PATH_TO_MODULE' => $_SERVER['DOCUMENT_ROOT'] . '/core/magic/analitycs/analytics.php',
            'DEL' => 'core/magic/analitycs/delete-page',
        ],
        'RESERVATIONS' => [
            'MODULE_FOLDER' => $_SERVER['DOCUMENT_ROOT'] . '/core/magic/reservations',
            'HANDLE' => 'core/magic/reservations/handle-reservation',
            'CPY' => 'core/magic/reservations/copy-reservation',
            'DEL' => 'core/magic/reservations/delete-reservation',
            'OLD' => 'core/magic/reservations/delete-old-reservations',
        ],
        'EMPLOYEES' =>[
            'MODULE_FOLDER' => $_SERVER['DOCUMENT_ROOT'] . '/core/magic/employees',
            'HANDLE' => 'core/magic/employees/handle-employee',
            'CPY' => 'core/magic/employees/copy-employee',
            'DEL' => 'core/magic/employees/delete-employee',
            'PATH_TO_PHOTOS' => 'uploads/employees/',
            'FULL_PATH_TO_PHOTOS' => $_SERVER['DOCUMENT_ROOT'] . '/uploads/employees/',
            'IMAGE_W' => 100,
            'IMAGE_H' => 100
        ],
    ];