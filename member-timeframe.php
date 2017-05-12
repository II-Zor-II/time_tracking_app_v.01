<?php
include_once 'header.php';
include_once 'objects/task.php';
include_once 'db/db.php';

if(isset($_GET['user_id'])){
	$database = new Database();
	$db = $database->getConnection();	
//	echo $_GET['user_id'];
//	echo $_GET['username'];
	$task = new Task($db);
}
?>


<div class="container">

 <?php echo "<h2>{$_GET['username']} Timeframe</h2>";?>
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Task</th>
        <th>Estimated Date</th>
        <th>Estimated Time</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
<?php
	$stmt = $task->getTasksOfMember($_GET['user_id']); //$from_record_num,$records_per_page
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		$statusString = '';
		switch($status){
			case 0:
				$statusString = "unfinished";
				break;
			case 1:
				$statusString = "on-going";
				break;
			case 2:
				$statusString = "done";
				break;
		}
		
		echo "<tr>";
			echo "<td>{$task_name}</td>";
			echo "<td>{$estimated_date}</td>";
			echo "<td>{$estimated_time}</td>";
			echo "<td>{$statusString}</td>";
		echo "</tr>";
	}
?>
    </tbody>
  </table>
<div>
	<button class="btn btn-danger" id="Cancel">Close</button>
</div>
</div>

 <?php 
	
	
include_once 'footer.php';	
?>