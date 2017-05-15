<?php
include_once 'db/db.php';
include_once 'objects/member.php';
include_once 'objects/task.php';
// total number of hours, time spent for a task, number of tasks
$database = new Database();
$db = $database->getConnection();

$members = new Member($db);
$stmt = $members->getmemberByUID($_GET['user_id']);
$outputArr = array();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);
array_push($outputArr,$row['username']);
$task = new Task($db);
$stmt = $task->getTasksOfMember($_GET['user_id']);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	extract($row);
	array_push($outputArr,$row['task_name'],$row['time_spent']);
}
echo  json_encode($outputArr);
?>