<?php 
include_once 'db/db.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$stmt = $task->getTaskUnfinishedOfCategory($_GET['category_id']); //getTaskUnfinishedOfCategory
$outputArr = array();
$outputArr = $stmt->fetchall(PDO::FETCH_ASSOC);
echo  json_encode($outputArr);
?> 