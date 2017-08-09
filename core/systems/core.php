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
if(!isset($router)) {
    // Создаем объект
    $router = new router;
}


// подключаем обьект класса mail-рассылка
if(!isset($mail)) {
    // Создаем объект
    // отправка письма:
    $mail = new PHPMailer;
//будем отравлять письмо через СМТП сервер
    $mail->isSMTP();
//хост
    $mail->Host = 'smtp.yandex.ru';
//требует ли СМТП сервер авторизацию/идентификацию
    $mail->SMTPAuth = true;
// логин от вашей почты
    $mail->Username = 'noreply';
// пароль от почтового ящика
    $mail->Password = 'asd8#fIw2)l45Ab@!4Sa3';
//указываем способ шифромания сервера
    $mail->SMTPSecure = 'ssl';
//указываем порт СМТП сервера
    $mail->Port = '465';
//указываем кодировку для письма
    $mail->CharSet = 'UTF-8';

}