<?php
include_once 'header.php';
include_once 'db/db.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();
$task = new Task($db);
?>

<!--Display Worklog member here-->
<div class="container">
	<h1>NEW WORKLOG</h1>
	<hr>
 <form action="member-personalWorkLog.php" method="post">
	<div class="row">
		<div class="col-xs-6">
			<label>Task</label>
			<select name="task_id" id="mem-prsnlWorkLog-selection">
			<option value="" disabled selected>Select a task</option> <!-- prompt option -->
			<?php
			$stmt = $task->getTaskUnfinished($_GET['user_id']); //$from_record_num,$records_per_page
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				echo "<option value='{$task_id}'>{$task_name}</option>";
			}			
				
				?>			
			</select>
		</div>
		<div class="col-xs-6" id="timeframe-div">
			<label>Timeframe</label>
			<input disabled value="" id="mem-task-timeframe"/>
		</div>	
	</div>
	<div class="row">
			<label>Clock in</label>
			<input type="time" name="mem-task-clockIn"/>	
	</div>

	<div class="row time-timer-container">
			<h3><strong>Log</strong></h3>
			<button id="selct-time-btn" class="btn btn-primary">Select by Time</button>
			<button id="selct-timr-btn" class="btn btn-primary">Select by Timer</button>
		<hr>
			<table id="time-form" class="table table-bordered">
				<tr>
					<td><input type="time" name="task-endTime"/></td>		 		
				</tr>

				 <tr>
					<td>Location</td>
					<td><input type="text" class="form-control" name="cloudFile-url"/></td>
				</tr> 
				<tr>
					<td>Collaborated with</td>
					<td><input type="text" class="form-control" name="task-collab-wth"/></td>
				</tr> 
				<tr>
					<td>Description</td>
					<td><textarea class="form-control" rows="5" name="task-description"></textarea></td>
				</tr> 
			</table>
			
			<table id="timer-form" style="display:none">
				<tr>
					<td>
						<input value="" id="elapsed-timer" type="text" placeholder="hours:minutes:seconds" class="text-center" name="wl-elapsed-time" readonly/>
					</td>
					<td>
						<button id="start-pause-btn" class="btn btn-primary">Start</button>
					</td>
					<td>
						<button id="reset-btn" class="btn btn-danger">Reset</button>
					</td>

				</tr>

			</table>
			<input style="display:none" value="1" id="LogIdentifier" name="logIdentifier"/>
			<input style="display:none" value="0" id="tot-breaks" name="tot-breaks"/>
			<input style="display:none" value="" id="time-ended" name="time-ended"/>
			<input style="display:none" value="<?php echo $_GET['user_id']; ?>" name="user_id"/>
			<input style="display:none" value="<?php echo $_GET['username']; ?>" name="username"/>
	</div>
		<hr>
		<div>
			<button class="btn btn-danger" id="memWorkLog-Cancel" uid="<?php echo $_GET['user_id']?>" un="<?php echo $_GET['username']?>">Cancel</button>
			<input type="submit" class="btn btn-primary" name="submit" value="Save" id="save-worklog"/>
		</div>
 </form>
</div>
<?php 


 if(isset($_POST['submit'])){
	if(
		!empty($_POST['task_id'])&&
		!empty($_POST['mem-task-clockIn'])&&
		!empty($_POST['task-endTime'])&&
		!empty($_POST['cloudFile-url'])&&
		!empty($_POST['task-collab-wth'])&&
		!empty($_POST['task-description'])||
		(
		!empty($_POST['task_id']))&&
		!empty($_POST['time-ended'])&&
		!empty($_POST['wl-elapsed-time'])){
		//Do something here --> $_POST['LogIdentifier];
		if($_POST['logIdentifier']=="1"){
		//saveTaskTime($task_id, $clock_in, $task_endTime, $cloud_file_url, $collab_with, $task_descrption)
			
			
		if(strtotime($_POST['mem-task-clockIn'])>=strtotime($_POST['task-endTime'])){
			$member_page = "member-personalWorkLog.php?user_id=".$_POST['user_id']."&username=".$_POST['username']."&FAILED&reason=clockInAndEndTimeIncorrect";
			header('Location: '.$member_page);	
		}else{
		$stmt = $task->saveTaskTime($_POST['task_id'],$_POST['mem-task-clockIn'],$_POST['task-endTime'],$_POST['cloudFile-url'],$_POST['task-collab-wth'],$_POST['task-description']);	
			
		$member_page = "member-dashboard.php?user_id=".$_POST['user_id']."&username=".$_POST['username']."&TIME_SUBMITTED_SUCCESS";
			header('Location: '.$member_page);
		}
			
		}else if($_POST['logIdentifier']=="2"){

		$stmt = $task->saveTaskTimer($_POST['task_id'],$_POST['wl-elapsed-time'],$_POST['tot-breaks'],$_POST['time-ended']);
		$member_page = "member-dashboard.php?user_id=".$_POST['user_id']."&username=".$_POST['username']."&TIMER_SUBMITTED_SUCCESS";
			header('Location: '.$member_page);
		}
	}else{
		//window.location.href="/tmq/member-work-log.php?user_id="+$(this).attr("value")+"&username="+$(this).attr("name");
		$member_page = "member-personalWorkLog.php?user_id=".$_POST['user_id']."&username=".$_POST['username']."&FAILED";
		header('Location: '.$member_page);	
	}
 }

include_once 'footer.php';	
?>