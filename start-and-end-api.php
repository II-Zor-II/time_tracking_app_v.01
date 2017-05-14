<?php
include_once 'db/db.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$task->saveStartTime($_POST['task_id'],$_POST['start_date'],$_POST['start_time']);
?>