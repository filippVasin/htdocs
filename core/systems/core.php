<?php
/**
    Объявляем константы;
 */
// Путь к скрипту на сервере;
define('ROOT_PATH', isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT']!=''? $_SERVER['DOCUMENT_ROOT']:'/../..');
// Маршрут который нам передал пользователь;
define('ROUTE', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']:'');
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
function __autoLoad($class){
    require_once(ROOT_PATH.'/core/systems/classes/class_'.mb_strtolower($class).'.php');

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


// подключаем обьект класса mail-рассылка
if(!isset($mailer)) {
    // Создаем объект
    // отправка письма:
    $mailer = new phpmailer;
//будем отравлять письмо через СМТП сервер
    $mailer->isSMTP();
//хост
    $mailer->Host = 'smtp.yandex.ru';
//требует ли СМТП сервер авторизацию/идентификацию
    $mailer->SMTPAuth = true;
// логин от вашей почты
    $mailer->Username = 'noreply';
// пароль от почтового ящика
    $mailer->Password = 'asd8#fIw2)l45Ab@!4Sa3';
//указываем способ шифромания сервера
    $mailer->SMTPSecure = 'ssl';
//указываем порт СМТП сервера
    $mailer->Port = '465';
//указываем кодировку для письма
    $mailer->CharSet = 'UTF-8';
}