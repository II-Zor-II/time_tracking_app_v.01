<?php 
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/member.php';

$database = new Database();
$db = $database->getConnection();

$members = new Member($db);
$stmt = $members->getMembersOfTeam($_GET['team_name']);
$outputArr = array();
$outputArr = $stmt->fetchall(PDO::FETCH_ASSOC);

echo  json_encode($outputArr);
?>