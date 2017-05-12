<?php 
include_once 'db/db.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$stmt = $task->getTaskOfCategory($_GET['category_id']);
$outputArr = array();
$outputArr = $stmt->fetch(PDO::FETCH_ASSOC);
echo  json_encode($outputArr);
?>