<?php 
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/member.php';

$database = new Database();
$db = $database->getConnection();

$members = new Member($db);
$stmt = $members->getmemberByUID($_GET['user_id']);
$outputArr = array();
$outputArr = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($outputArr);
?>