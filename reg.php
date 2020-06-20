<?php
require('connect.php');
require_once('helpers.php');

$tpl_data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $errors = [];

    $required_fields = ['email', 'password', 'name'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
  }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['emailError'] = 'E-mail введён некорректно';
    }

    if (empty($errors)) {
        $email = mysqli_real_escape_string($con, $form['email']);
        $sql = "SELECT id FROM user WHERE email = '$email'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            $errors['doubleEmail'] = 'Пользователь с этим email уже зарегистрирован';
        }
        else {
            $password = password_hash($form['password'], PASSWORD_DEFAULT);

            $sql = 'INSERT INTO user (reg_date, email, name, password) VALUES (NOW(), ?, ?, ?)';
            $stmt = db_get_prepare_stmt($con, $sql, [$form['email'], $form['name'], $password]);
            $res = mysqli_stmt_execute($stmt);
        }

        if ($res && empty($errors)) {
            header("Location: /index.php");
            exit();
        }
    }
    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;

}

$add_block = include_template ('register-user.php', $tpl_data, ['title' => 'Дела в Порядке | Регистрация']);
print($add_block );
?>
