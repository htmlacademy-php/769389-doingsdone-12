<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



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


    $sql_id = "SELECT id FROM user WHERE email = '$email'";
    $res_id = mysqli_query($con, $sql_id);
    $id_arr = mysqli_fetch_assoc($res_id);
    $_SESSION['id'] = $id_arr['id'];



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
		$page_content = include_template('authorization.php', ['form' => $form, 'errors' => $errors]);
	}
	else {
		header("Location: /index.php");
		exit();
    }
    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;
}
else {
    $page_content = include_template('authorization.php', []);

    if (isset($_SESSION['user'])) {
        header("Location: /index.php");
        exit();
    }

}


$add_block = include_template ('form-authorization.php', $tpl_data, ['content' => $page_content, 'title' => 'Дела в Порядке | Вход']);

print($add_block );
?>
