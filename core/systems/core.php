<?php
/**
    Объявляем константы;
 */
// Путь к скрипту на сервере;
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
// Маршрут который нам передал пользователь;
define('ROUTE', $_SERVER['REQUEST_URI']);
// Адрес ресурса;
define('URL', isset($_SERVER["HTTPS"]) ? 'https://'.$_SERVER['SERVER_NAME'] : 'http://'.$_SERVER['SERVER_NAME']);

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
function __autoLoad($class){
    require(ROOT_PATH.'/core/systems/classes/class_'.mb_strtolower($class).'.php');
}


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
if(!isset($router)) {
    // Создаем объект
    $router = new router;
}