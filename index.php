<?php
require('connect.php');
require_once('helpers.php');

/* Получение списка проектов у текущего пользователя */
$u_id = 1;

$project = "SELECT * FROM `project` WHERE `user_id` = $u_id";
$result_project = mysqli_query($con, $project);
$project_arr = mysqli_fetch_all($result_project, MYSQLI_ASSOC);

/* вывод общего количества задач */
$tasks = "SELECT * FROM `task` WHERE `user_id` = $u_id";
$result_tasks = mysqli_query($con, $tasks);
$task_array = mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);

/* выгрузка задач по проектам (после получения запроса от пользователя идет дальнейшая выгрузка по столбцу project_id равному запросу */
if (isset($_GET['id']) && $_GET['id']) {
    $id_project = mysqli_real_escape_string($con, intval($_GET['id']));
    $tasks .= " AND `project_id` = '$id_project' ";
}
$result_task = mysqli_query($con, $tasks);

if (!mysqli_num_rows($result_task)) {
    http_response_code(404);
    exit();
}
$task_arr = mysqli_fetch_all($result_task, MYSQLI_ASSOC);

$main_block = include_template ('main.php', ['task_array' => $task_array, 'task_arr' => $task_arr, 'project_arr' => $project_arr, 'show_complete_tasks' => $show_complete_tasks = rand(0, 1)]);
$layout_block = include_template ('layout.php', ['content' => $main_block, 'user_name' => 'Константин', 'title' => 'Дела в порядке']);
print($layout_block);
?>
