<?php

require 'mailer/PHPMailer.php';
require 'mailer/Exception.php';
require 'mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// -------------------------------------------------------

$token = "7305763009:AAGcOqpWRnmVfa2SVmXLKA5_aVKQjnxuyjM";
$chat_id = "-4623006214";

$name = isset($_POST['name']) ? $_POST['name'] : '';  
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';   

if (empty($name) && empty($tel)) {
  exit('Поля не могут быть пустыми.'); 
}

$arr = [
    'Имя' => $name,
    'Телефон' => $tel
];

$txt = '';
foreach ($arr as $key => $value) {
    $txt .= "<b>{$key}:</b> {$value}%0A"; 
}

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

if ($sendToTelegram) {
  header('Location: ' . $_SERVER['HTTP_REFERER'] . '#form-success');
} else {
  header('Location: ' . $_SERVER['HTTP_REFERER'] . '#form-error');
}

// -------------------------------------------------------

$mail = new PHPMailer(true);

$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

$mail->isSMTP();
$mail->Host       = '--------------';
$mail->SMTPAuth   = true;
$mail->Username   = '--------------';
$mail->Password   = '--------------';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;

$mail->setFrom('--------------', 'Orders');
$mail->addAddress('--------------');

$mail->isHTML(true);
$mail->Subject = 'New order';
$mail->Body    = '<b>Имя:</b> '. $arr['Имя'] . '<br><b>Email:</b> '. $arr['Телефон'] .'<br>';

try {
  $mail->send();
  echo "mail success";
} catch (Exception $e) {
  echo "Ошибка при отправке письма: {$mail->ErrorInfo}";
}