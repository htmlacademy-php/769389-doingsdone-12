<?php
require('connect.php');
require_once('helpers.php');

$tpl_data = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$form = $_POST;
    $errors = [];

    $required = ['email', 'password'];

	foreach ($required as $field) {
	    if (empty($form[$field])) {
	        $errors[$field] = 'Это поле надо заполнить';
        }
    }

    if (!isset($errors['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['emailError'] = 'E-mail введён некорректно';
        }
    }


	$email = mysqli_real_escape_string($con, $form['email']);
	$sql = "SELECT * FROM user WHERE email = '$email'";
    $res = mysqli_query($con, $sql);
    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];


	if (!count($errors) and $user) {
		if (password_verify($form['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		else {
			$errors['passwordError'] = 'Неверный пароль';
		}
	}
	else {
		$errors['emailEmpty'] = 'Такой пользователь не найден';
	}

	if (count($errors)) {
		$page_content = include_template('form-authorization.php', ['form' => $form, 'errors' => $errors]);
	}
	else {
		header('Location: /index.php');
		exit();
    }
    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;
}
else {
    $page_content = include_template('authorization.php', []);

    if (isset($_SESSION['user'])) {
        header('Location: /index.php');
        exit();
    }

}

$_SESSION['id'] = $user['id'];
$_SESSION['name'] = $user['name'];

$add_block = include_template('form-authorization.php', $tpl_data, ['content' => $page_content ]);
$layout_block = include_template('layout.php',['user_name' => 'Константин', 'content' => $add_block, 'title' => 'Дела в Порядке | Вход']);

print($layout_block);
?>
