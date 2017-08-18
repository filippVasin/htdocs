
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.03.2017
 * Time: 12:37
 */
class systems{
    // Получаем дату россиского формата;
    public function get_local_date_time($date, $show_time = ''){
        if($date != ''){
            return date('d.m.Y '.($show_time != '' ? 'H:i:s' : ''), strtotime($date));
        }   else{
            return '';
        }
    }

    // Подключения объекта почты с подгрузкой параметров;
    public function create_mailer_object($options_array = array()){
        $send_mailer = new PHPMailer(true);

        // Массив передаваемых параметров должен быть следующей формы
//        $options_array = array(
//            'host' => 'smtp.yandex.ru',
//            'username' => 'noreply',
//            'password' => 'asd8#fIw2)l45Ab@!4Sa3'
//        );
//будем отравлять письмо через СМТП сервер

        $send_mailer->isSMTP();

        // Если нам не передавали массив значений - наполняем его по умолчанию;
        if(count($options_array) == 0){
            //хост
            $send_mailer->Host = 'smtp.yandex.ru';
            //требует ли СМТП сервер авторизацию/идентификацию
            $send_mailer->SMTPAuth = true;
            // логин от вашей почты
            $send_mailer->Username = 'noreply@laborpro.ru';
            // пароль от почтового ящика
            $send_mailer->Password = 'asd8#fIw2)l45Ab@!4Sa3';
            //указываем способ шифромания сервера
            $send_mailer->SMTPSecure = 'ssl';
            //указываем порт СМТП сервера
            $send_mailer->Port = '465';
            //указываем кодировку для письма
            $send_mailer->CharSet = 'UTF-8';
        }   else{
            // Если же нам передали массив параметров - наполняем им объвленный обект;
            foreach($options_array as $option => $value){
                $send_mailer->$option = $value;
            }
        }

        return $send_mailer;
    }
}