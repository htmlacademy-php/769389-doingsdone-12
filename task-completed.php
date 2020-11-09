<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && (isset($_GET['done_task_id']))) {

    $input_task = $_GET['done_task_id'];

    if ($input_task > 0) {
        $sql = 'SELECT id, pubdate, status, title, link, deadline, user_id, project_id FROM task WHERE user_id = "' . $_SESSION['id'] . '" AND id = "' . $input_task . '"';
        $result = mysqli_query($con, $sql);
        $task = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $task_status = array_column($task, 'status');

        if ($task_status[0] == 0) {
            $task_complete = 1;
        } else {
            $task_complete = 0;
        }

        $sql = 'UPDATE task SET status = "' . $task_complete . '" WHERE user_id = "' . $_SESSION['id'] . '" AND id = "' . $input_task . '"';
        $result = mysqli_query($con, $sql);

        if ($result) {
            header("Location: /index.php");
        }
    }
}
?>
