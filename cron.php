<?php
include('core/systems/core.php');

$sql="Select *
                  FROM employees
                  WHERE employees.id = 2";
$email_temp = $db->row($sql);

$email = $email_temp['email'];

//// отправка письма:
//$mail = new PHPMailer;
////будем отравлять письмо через СМТП сервер
//$mail->isSMTP();
////хост
//$mail->Host = 'smtp.yandex.ru';
////требует ли СМТП сервер авторизацию/идентификацию
//$mail->SMTPAuth = true;
//// логин от вашей почты
//$mail->Username = 'noreply';
//// пароль от почтового ящика
//$mail->Password = 'asd8#fIw2)l45Ab@!4Sa3';
////указываем способ шифромания сервера
//$mail->SMTPSecure = 'ssl';
////указываем порт СМТП сервера
//$mail->Port = '465';

////указываем кодировку для письма
//$mail->CharSet = 'UTF-8';
//информация от кого отправлено письмо

$mailer->From = 'noreply@laborpro.ru';
$mailer->FromName = 'Охрана Труда';
$mailer->addAddress($email);

$mailer->isHTML(true);

$mailer->Subject = "Тест крона";
$mailer->Body = "Привет это крон";

//$mailer->send();

//$handle = fopen("cronLog.txt", "a");
//$str = "Last timestamp: ".date("H:i:s")."\n";
//fwrite($handle, $str);
//fclose($handle);
?>