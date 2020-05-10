<?php
require('connect.php');
require('request_db.php');
require_once('helpers.php');

$errors = [];
$rules = [
    'name' => function() {
        return validateFilled('name');
    },
    'date' => function() {
        return is_date_valid('date');
    }
];

function add_task($title, $id_project, $date, $filename, $con) {
    $u_id = 1;
    $sql = "INSERT INTO `task` (`title`, `link`, `deadline`, `user_id`, `project_id`)
    VALUES  ('$title','$filename', '$date', '$u_id', '$id_project');";
    $result = mysqli_query($con, $sql);
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
        $title = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $id_project = $_POST['project'];
        $date = $_POST['date'];
        $filename = null;
            if (isset($_FILES['file'])) {
            $filename = $_FILES['file']['name'];
            $file_path = __DIR__ . '/uploads/';
            move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $filename);
            }
        add_task($title, $id_project, $date, $filename, $con);
        header("Location: /index.php?id=$id_project&&s=2&&d=desc");
    }
}

$add_block = include_template ('add-task.php',
[
    'task_array' => $task_array,
    'task_arr' => $task_arr,
    'project_arr' => $project_arr,
    'show_complete_tasks' => $show_complete_tasks = rand(0, 1),
    'errors' => $errors
]);

$layout_block = include_template('layout.php',
[
    'content' => $add_block,
    'title' => 'Добавление задачи'
]);

print($layout_block);
?>
