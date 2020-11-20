<?php
/**
 * функция, возвращающая массив задач из строки поиска
 *
 * @param resource $con ресурс соединения
 * @param string $search текст строки поиска
 * @param integer $id идентификатор пользователя
 *
 * @return array массив задач из строки поиска
 */
function getSearchTasks($con, $search)
{
    $u_id = $_SESSION['id'];
    $sql = 'SELECT * FROM task WHERE user_id = "' . $u_id . '" AND MATCH(title) AGAINST (? IN BOOLEAN MODE)';

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $search);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    $task_arr = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $task_arr;
}

/**
 * функция подсчета количества задач в проекте
 *
 * @param array $array_tasks массив задач
 * @param array $project массив проектов
 *
 * @return integer общее количество задач в конкретном проекте
 */
function calc($array_tasks, $project)
{
    $i = 0;
    foreach ($array_tasks as $value) {
        if ($value['project_id'] == $project['id']) {
            $i++;
        }
    }
    return $i;
}

/**
 * функция для расчета "горящих дат" (истекающих менее чем через 24 часа)
 *
 * @param string $date дата окончания задачи
 *
 * @return bool true при истечении срока выполнения задачи менее чем через 24 часа, иначе false
 */
function task_important($date)
{
    if (isset($date)) {
        $today = date('d.m.y.');
        $dif = (strtotime($date) - strtotime($today)) / 3600;
        if ($dif <= 24) {
            return true;
        }
    }
    return false;
}

/**
 * Функция получения значений из POST запроса
 *
 * @param string $name input[name] из которого необходимо получить значение
 *
 * @return string Возвращает строку введенную пользователем, если форма отправленна с ошибкой.
 */
function getPostVal($name)
{
    return $_POST[$name] ?? '';
}

/**
 * функция для проверки заполненности поля формы
 *
 * @param string $name имя поля формы
 *
 * @return string текст ошибки
 */
function validateFilled($name)
{
    if (empty($_POST[$name])) {
        return 'Это поле должно быть заполнено';
    }
}

/**
 *  функция для выгрузки задач по фильтрам дат окончания
 *
 * @param integer $user_id Id текущего пользователя
 * @param string $tab Строка с привязкой к дате (today, tomorrow, expired)
 *
 * @return "sql" запрос на получение всех тасков с привязкой к дате (today, tomorrow, expired)
 */
function show_tasks_by_date($user_id, $tab)
{

    if ($tab == 'today') {
        $sql = 'SELECT id, pubdate, status, title, link, deadline, user_id, project_id FROM task ' . 'WHERE user_id = "' . $user_id . '" AND deadline = CURDATE()';
    } elseif ($tab == 'tomorrow') {
        $sql = 'SELECT id, pubdate, status, title, link, deadline, user_id, project_id FROM task ' . 'WHERE user_id = "' . $user_id . '" AND deadline = ADDDATE(CURDATE(),INTERVAL 1 DAY)';
    } elseif ($tab == 'expired') {
        $sql = 'SELECT id, pubdate, status, title, link, deadline, user_id, project_id FROM task ' . 'WHERE user_id = "' . $user_id . '" AND deadline < CURDATE()';
    }

    return $sql;
}
