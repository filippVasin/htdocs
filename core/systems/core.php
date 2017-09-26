<?php
/**
    Объявляем константы;
 */
// Путь к скрипту на сервере;
define('ROOT_PATH', isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT'] !='' ? $_SERVER['DOCUMENT_ROOT'] : '/../..');
// Маршрут который нам передал пользователь;
define('ROUTE', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
// Адрес ресурса;
define('URL', isset($_SERVER['SERVER_NAME']) ? (isset($_SERVER["HTTPS"]) ? 'https://'.$_SERVER['SERVER_NAME'] : 'http://'.$_SERVER['SERVER_NAME']) : '');

/**
Подключаем конфиг;
 */
include(ROOT_PATH . '/config.php');


/**
    Включаем сессию;
 */
if (session_id() == '') {
    session_start();
}


/**
    Подключаем классы;
 */


require_once(ROOT_PATH . '/core/systems/classes/class_controller.php');
require_once(ROOT_PATH . '/core/systems/classes/class_elements.php');
require_once(ROOT_PATH . '/core/systems/classes/class_labro.php');
require_once(ROOT_PATH . '/core/systems/classes/class_mysql.php');
require_once(ROOT_PATH . '/core/systems/classes/class_node.php');
require_once(ROOT_PATH . '/core/systems/classes/class_phpexcel.php');
require_once(ROOT_PATH . '/core/systems/classes/class_phpmailer.php');
require_once(ROOT_PATH . '/core/systems/classes/class_router.php');
require_once(ROOT_PATH . '/core/systems/classes/class_smtp.php');
require_once(ROOT_PATH . '/core/systems/classes/class_systems.php');
require_once(ROOT_PATH . '/templates/simple_template/template_mails/temp_mail.php');



/**
    Включаем БД;
 */
// Если база не подключена - подключаем;
if(!isset($db)){
    // Создаем объект;
    $db = new MySQL;
    // ПОдключаемся к базе;
    $db->connect($db_host, $db_name, $db_user, $db_password);
    // Устанавливаем кодировку;
    $db->query("SET NAMES `UTF8`");
}


/**
    Включаем елементы которые будем выводить через методы и классы;
 */
// Если елементы не подключен - подключаем;
if(!isset($elements)){
    // Создаем объект;
    $elements = new elements;
}



// Если елементы не подключен - подключаем;
if(!isset($labro)){
    // Создаем объект;
    $labro = new labro;
}

/**
    Включаем системные функции;
 */
// Если функции не подключен - подключаем;
if(!isset($systems)){
    // Создаем объект;
    $systems = new systems;
}


/**
    Включаем маршрутизатор;
 */
// Если маршрутизатор не подключен - подключаем;
if(!isset($router) && ROUTE!="") {
    // Создаем объект
    $router = new router;
}
