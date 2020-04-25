<?php
require('connect.php');
require_once('helpers.php');

/* Получение списка проектов у текущего пользователя */
$u_id = 1;
$project = "SELECT * FROM `project` WHERE `user_id` = $u_id";
$result_project = mysqli_query($con, $project);
$project_arr = mysqli_fetch_all($result_project, MYSQLI_ASSOC);

/* Получение списка из всех задач у текущего пользователя. */
$task = "SELECT * FROM `task` WHERE `user_id` = $u_id";
$result_task = mysqli_query($con, $task);
$task_arr = mysqli_fetch_all($result_task, MYSQLI_ASSOC);



$main_block = include_template ('main.php', ['task_arr' => $task_arr, 'project_arr' => $project_arr, 'show_complete_tasks' => $show_complete_tasks = rand(0, 1)]);
$layout_block = include_template ('layout.php', ['content' => $main_block, 'user_name' => 'Константин', 'title' => 'Дела в порядке']);
print($layout_block);
?>
