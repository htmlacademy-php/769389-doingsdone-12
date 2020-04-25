<?php
$con = mysqli_connect('localhost', 'root', '', 'doingsdone_db');
if (!$con) {
   die("Ошибка подключения: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");
?>
