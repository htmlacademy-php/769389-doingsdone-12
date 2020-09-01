<?php
require('connect.php');

require_once('helpers.php');

if (!isset($_SESSION['user'])) {
    header('Location: /guest.php');
    exit();
}
require('request_db.php');

function getSearchTasks ($con, $search)
{
    $sql = 'SELECT * FROM task WHERE MATCH(title) AGAINST (? IN BOOLEAN MODE)';

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $search);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    $task_arr = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $task_arr;
}

if (isset($_GET['search'])) {
    $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

    if (!empty($search)) {
        $task_arr = getSearchTasks($con, $search);
    }
}

$main_block = include_template('main.php', ['task_array' => $task_array, 'task_arr' => $task_arr, 'project_arr' => $project_arr, 'show_complete_tasks' => $show_complete_tasks = rand(0, 1)]);
$layout_block = include_template('layout.php', ['content' => $main_block, 'user_name' => $_SESSION['name'], 'title' => 'Дела в порядке']);
print($layout_block);
?>
