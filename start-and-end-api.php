<?php
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$formatted_startDateAndTime = $_GET['start_date']." ".$_GET['start_time'];
$task->startTimerTask($_GET['task_id'],$formatted_startDateAndTime);

?>