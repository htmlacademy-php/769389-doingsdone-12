<?php
require('connect.php');
require_once('helpers.php');
require_once('function.php');

if (!isset($_SESSION['user'])) {
    header('Location: /guest.php');
    exit();
}
require('request_db.php');

$u_id = $_SESSION['id'];
$errors = [];
$rules = [
    'title' => function () {
        return validateFilled('title');
    },
    'deadline' => function () {
        return is_date_valid('deadline');
    }
];

$form = $_POST;

if (!empty($form['deadline']) && ($form['deadline'] < date('Y-m-d'))) {
    $errors['lastDate'] = 'Дата уже прошла';
}

if (isset($_POST['task-btn'])) {
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }
    $errors = array_filter($errors);
    if (!count($errors)) {
        $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        $id_project = $_POST['project_id'];
        $date = NULL;
        if ($_POST['deadline']) {
            $date = $_POST['deadline'];
        }
        $filename = NULL;
        if (isset($_FILES['link']) && !empty($_FILES['link']['name'])) {
            $filename = $_FILES['link']['name'] . '_' . time();
            $file_path = __DIR__ . '/uploads/';
            move_uploaded_file($_FILES['link']['tmp_name'], $file_path . $filename);
        }
        $sql = "INSERT INTO `task` (`title`, `link`, `deadline`, `user_id`, `project_id`)
        VALUES  (?, ?, ?, ?, ?)";
        $stmt = db_get_prepare_stmt($con, $sql, [$title, $filename, $date, $u_id, $id_project]);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            header("Location: /index.php?id=$id_project");
        }
    }
}

$add_block = include_template('add-task.php', ['task_array' => $task_array, 'project_arr' => $project_arr, 'errors' => $errors]);
$layout_block = include_template('layout.php', ['user_name' => $_SESSION['name'], 'content' => $add_block, 'title' => 'Добавление задачи']);

print($layout_block);
?>
