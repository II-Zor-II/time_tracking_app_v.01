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
	<div>
 	<?php echo "<h2>{$_GET['username']} Worklog</h2>";?>
   	<table class="table table-bordered">
    <thead>
      <tr>
        <th>task name</th>
        <th>location</th>
        <th>collab</th>
        <th>description</th>
        <th>start</th>
        <th>end</th>
        <th>total</th>
		<th>type</th>
      	<th>status</th>
      	<th>break log</th>
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
			echo "<td></td>"; //2location
			echo "<td></td>"; //3collab
			echo "<td></td>"; //4description
			echo "<td></td>"; //5start
			echo "<td></td>"; //6end
			echo "<td></td>"; //total
			echo "<td></td>"; //type - timer - clock
			echo "<td>{$statusString}</td>";
			echo "<td></td>";//break log
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