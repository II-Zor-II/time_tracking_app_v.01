<?php
include_once 'header.php';
include_once 'db/db.php';
include_once 'objects/member.php';

$database = new Database();
$db = $database->getConnection();

$members = new Member($db);

echo "<input style='display:none' value='{$_GET['user_id']}' id='chartUserId'/>"
?>
<div><h3 id="chart-member-name"></h3></div>
<canvas id="memberChart" width="400" height="400"></canvas>


<?php 
include_once 'footer.php';	
?>