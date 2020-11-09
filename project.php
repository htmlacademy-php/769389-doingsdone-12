<?php
require('connect.php');
require_once('helpers.php');

if (!isset($_SESSION['user'])) {
    header('Location: /guest.php');
    exit();
}

$errors = [];
require('request_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;


    $required_fields = ['name'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }

    if (empty($errors)) {
        $project = mysqli_real_escape_string($con, $form['name']);
        $sql = "SELECT id FROM project WHERE title = '$project'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            $errors['doubleProject'] = 'Такой проект уже существует';
        }
        else {

            $user_id = $_SESSION['id'];
            $sql = 'INSERT INTO project (title, user_id) VALUES (?, ?)';
            $stmt = db_get_prepare_stmt($con, $sql, [$form['name'], $user_id]);
            $res = mysqli_stmt_execute($stmt);
        }

        if ($res && empty($errors)) {
             header('Location: /index.php');
             exit();
         }
    }

}

require('task-completed.php');

$main_block = include_template('form-project.php', ['task_array' => $task_array, 'project_arr' => $project_arr, 'errors' => $errors]);
$layout_block = include_template('layout.php', ['content' => $main_block, 'user_name' => $_SESSION['name'], 'title' => 'Добавление проекта']);
print($layout_block);
?>
