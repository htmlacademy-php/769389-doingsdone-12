<?php
require('connect.php');
require('request_db.php');
require_once('helpers.php');

if (!isset($_SESSION['user'])) {
    header("Location: /reg.php");
    exit();
}

$main_block = include_template ('main.php', ['task_array' => $task_array, 'task_arr' => $task_arr, 'project_arr' => $project_arr, 'show_complete_tasks' => $show_complete_tasks = rand(0, 1)]);
$layout_block = include_template ('layout.php', ['content' => $main_block, 'user_name' => 'Константин', 'title' => 'Дела в порядке']);
print($layout_block);
?>
