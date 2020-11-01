<?php
require_once 'vendor/autoload.php';
require('connect.php');

$transport = new Swift_SmtpTransport("phpdemo.ru", 25);
$transport->setUsername("keks@phpdemo.ru");
$transport->setPassword("htmlacademy");

$mailer = new Swift_Mailer($transport);

$sql = 'SELECT id, email, name FROM user';
$res = mysqli_query($con, $sql);
$all_users = mysqli_fetch_all($res, MYSQLI_ASSOC);

    foreach ($all_users as $key => $value) {
        $sql = "SELECT * FROM `task` WHERE `status` = 0 `deadline` = CURDATE() AND task.user_id = " . $value['id'];
        $res = mysqli_query($con, $sql);
        $todayListUser = mysqli_fetch_all($res, MYSQLI_ASSOC);

        $recipients[$value['email']] = $value['name'];

        if (!empty($todayListUser)) {

            $message = new Swift_Message();
            $message->setSubject("Уведомление от сервиса «Дела в порядке»");
            $message->setFrom(['keks@phpdemo.ru' => 'Дела в порядке']);
            $message->setBcc($recipients);

            $msg_content = include_template('message.php', [
                'todayListUser' => $todayListUser,
                'user_name' => $value['name']
            ]);
            $message->setBody($msg_content, 'text/html');

            $result = $mailer->send($message);
        }
    }

?>
