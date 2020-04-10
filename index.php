<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

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

//функция подсчета задач
function calc($array_tasks, $project) {
    $i = 0;
    foreach ($array_tasks as $value) {
        if ($value['category'] == $project) {
            $i++;
        }
    }
    return $i;
}

require_once('helpers.php');

$main_block = include_template ('main.php', ['tasks' => $tasks, 'categories' => $categories, 'show_complete_tasks' => $show_complete_tasks = rand(0, 1)]);
$layout_block = include_template ('layout.php', ['content' => $main_block, 'user_name' => 'Константин', 'title' => 'Дела в порядке']);

print($layout_block);
?>
