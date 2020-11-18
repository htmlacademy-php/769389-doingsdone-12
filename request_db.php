<?php
require('connect.php');
require_once('helpers.php');
require_once('function.php');

/* Получение списка проектов у текущего пользователя */
$u_id = $_SESSION['id'];

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
$task_arr = mysqli_fetch_all($result_task, MYSQLI_ASSOC);
?>
