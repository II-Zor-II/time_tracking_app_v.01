<?php
include_once dirname(__FILE__)."/".'header.php';
include_once dirname(__FILE__)."/".'db/db.php';
include_once dirname(__FILE__)."/".'objects/member.php';

$database = new Database();
$db = $database->getConnection();

$members = new Member($db);

echo "<input style='display:none' value='{$_GET['user_id']}' id='chartUserId'/>"
?>
<div><h3 id="chart-member-name"></h3></div>
<canvas id="memberChart" width="400" height="400"></canvas>


<?php 
include_once 'footer.php';	
echo "<script src='js/chart-bundle.js'></script>
<script src='js/chart.js'></script>";
?>