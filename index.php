<?php
/*
$categories = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];

$tasks = [
    [
    'title' => 'Собеседование в IT компании',
    'date' => '01.12.2019',
    'category' => 'Работа',
    'completed' => false
    ],
    [
    'title' => 'Выполнить тестовое задание',
    'date' => '25.12.2019',
    'category' => 'Работа',
    'completed' => false
    ],
    [
    'title' => 'Сделать задание первого раздела',
    'date' => '21.12.2019',
    'category' => 'Учеба',
    'completed' => true
    ],
    [
    'title' => 'Встреча с другом',
    'date' => '22.12.2019',
    'category' => 'Входящие',
    'completed' => false
    ],
    [
    'title' => 'Купить корм для кота',
    'date' => null,
    'category' => 'Домашние дела',
    'completed' => false
    ],
    [
    'title' => 'Заказать пиццу',
    'date' => null,
    'category' => 'Домашние дела',
    'completed' => false
    ]
];
*/

//функция подсчета задач
function calc($array_tasks, $project) {
    $i = 0;
    foreach ($array_tasks as $value) {
        if ($value['project_id'] == $project['id']) {
            $i++;
        }
    }
    return $i;
}

// функция для расчета "горящих дат" (менее 24 часов)
function task_important($date) {
    if(isset($date)) {
        $today = date('d.m.y.');
        $dif = (strtotime($date) - strtotime($today))/3600;
        if ($dif <= 24) {
            return true;
        }
    }
    return false;
}

/* Установка соединения, проверка подключения */
$con = mysqli_connect('localhost', 'root', '', 'doingsdone_db');
if ($con == false) {
   print("Ошибка подключения: " . mysqli_connect_error());
}
else {
   print("Соединение установлено");
}
mysqli_set_charset($con, "utf8");

/* Получение списка проектов у текущего пользователя */
$project = "SELECT * FROM `project` WHERE `user_id` = 1";
$result_project = mysqli_query($con, $project);
$project_arr = mysqli_fetch_all($result_project, MYSQLI_ASSOC);

/* Получение списка из всех задач у текущего пользователя. */
$task = "SELECT * FROM `task` WHERE `user_id` = 1";
$result_task = mysqli_query($con, $task);
$task_arr = mysqli_fetch_all($result_task, MYSQLI_ASSOC);

require_once('helpers.php');

$main_block = include_template ('main.php', ['task_arr' => $task_arr, 'project_arr' => $project_arr, 'show_complete_tasks' => $show_complete_tasks = rand(0, 1)]);
$layout_block = include_template ('layout.php', ['content' => $main_block, 'user_name' => 'Константин', 'title' => 'Дела в порядке']);
print($layout_block);
?>
