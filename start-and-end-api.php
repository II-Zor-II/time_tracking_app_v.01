<?php
include_once 'db/db.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$formatted_startDateAndTime = $_GET['start_date']." ".$_GET['start_time'];
$response = $task->saveStartTime($_GET['task_id'],$formatted_startDateAndTime);
echo "Done ||".$_GET['task_id']." ".$_GET['start_date']." || ".$_GET['start_time']."||".$response;

?>