<?php
require('connect.php');
require_once('helpers.php');
require_once('function.php');

if (!isset($_SESSION['user'])) {
    header('Location: /guest.php');
    exit();
}
require('request_db.php');
require('task-completed.php');

if (isset($_GET['search'])) {
    $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

    if (!empty($search)) {
        $task_arr = getSearchTasks($con, $search);
    }
}

if (isset($_GET['date_list'])) {
    $active_tab = $_GET['date_list'];
    $sql = show_tasks_by_date($u_id, $active_tab);
    $task_arr = mysqli_query($con, $sql);
}

if (isset($_GET['show_completed'])) {
    $show_complete_tasks = 0 + $_GET['show_completed'];
} else {
    $show_complete_tasks = 0;
}

$main_block = include_template('main.php', ['task_array' => $task_array, 'task_arr' => $task_arr, 'project_arr' => $project_arr, 'show_complete_tasks' => $show_complete_tasks]);
$layout_block = include_template('layout.php', ['content' => $main_block, 'user_name' => $_SESSION['name'], 'title' => 'Дела в порядке | Главная']);
print($layout_block);
?>
