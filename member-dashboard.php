
<?php
include_once 'header.php';
include_once 'objects/task.php';
include_once 'db/db.php';
include_once 'objects/member.php';

if(isset($_GET['user_id'])){
	$database = new Database();
	$db = $database->getConnection();	
//	echo $_GET['user_id'];
//	echo $_GET['username'];
	$task = new Task($db);
}
?>
	<div>
 	<?php echo "<h2>{$_GET['username']}</h2>";?>
  	<hr>
  	<div class="col-xs-offset-1">
		<input type="button" value="logout" class="logoutbtn btn btn-danger" id="logout-btn"/>
	</div>
	<hr>
  	<div class="row col-xs-offset-1">
		<button class="btn btn-primary" id="mem-myWorklog" value="<?php echo $_GET['user_id']?>" name="<?php echo $_GET['username']?> ">My Worklog</button>
		<button class="btn btn-warning" id="mem-myWorklog-ChR">Worklog Chart Report</button>
		<button class="btn btn-success" id="mem-myTimeframe" value='<?php echo $_GET['user_id']?>' name='<?php echo $_GET['username']?>'>My Timeframes</button>
	</div>
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
			echo "<td>{$Location}</td>"; //2location
			echo "<td>{$Collab}</td>"; //3collab
			echo "<td><div style='max-height:125px;overflow:auto;width:130px;'>{$task_desc}</div></td>"; //4description
			echo "<td>{$start_date}</td>"; //5start
			echo "<td>{$end_date}</td>"; //6end
			echo "<td>{$time_spent}</td>"; //total
			echo "<td>{$type}</td>"; //type - timer - clock
			echo "<td>{$statusString}</td>";
			echo "<td>{$breaks}</td>";//break log
		echo "</tr>";
	}
?>
    <tr>
    	<td><strong>Total hours:</strong></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td><strong><?php $member = new Member($db); $member->calculateTotalHours($user_id,$task);?></strong></td>
    </tr>
    </tbody>
    </table>	
    </div>
<?php 
	
	
include_once 'footer.php';	
?>