<?php 
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);
$stmt = $task->getTaskOfCategory($_GET['category_id']); //getTaskUnfinishedOfCategory
$outputArr = array();
$outputArr = $stmt->fetchall(PDO::FETCH_ASSOC);

echo  json_encode($outputArr);
?> 