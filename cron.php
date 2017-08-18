<?php
include('core/systems/core.php');
global $systems;
$sql="Select *
                  FROM employees
                  WHERE employees.id = 2";
$email_temp = $db->row($sql);

$send_mailer = $systems->create_mailer_object();

$email = $email_temp['email'];
$send_mailer->From = 'noreply@laborpro.ru';
$send_mailer->FromName = 'Охрана Труда';
$send_mailer->addAddress($email);
$send_mailer->isHTML(true);
$send_mailer->Subject = "Тест крона";
$send_mailer->Body = "Привет это крон";

$send_mailer->send();

//$handle = fopen("cronLog.txt", "a");
//$str = "Last timestamp: ".date("H:i:s")."\n";
//fwrite($handle, $str);
//fclose($handle);

?>