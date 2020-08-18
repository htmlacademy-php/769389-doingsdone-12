<?php
require('connect.php');

require_once('helpers.php');

require('request_db.php');

$main_block = include_template ('main.php', ['project_arr' => $project_arr]);
$layout_block = include_template ('layout.php', ['content' => $main_block, 'user_name' => $_SESSION['name'], 'title' => 'Дела в порядке']);
print($layout_block);
?>
