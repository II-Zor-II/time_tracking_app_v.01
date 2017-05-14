<?php
include_once 'db/db.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$stmt = $task->getTaskTimeFrame($_GET['task_id']);
$outputArr = array();
$outputArr = $stmt->fetch(PDO::FETCH_ASSOC);

echo  json_encode($outputArr);

?>