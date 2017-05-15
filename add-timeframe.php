<?php
include_once 'header.php';
include_once 'db/db.php';
include_once 'objects/member.php';
include_once 'objects/team.php';
include_once 'objects/category.php';
include_once 'objects/task.php';
$database = new Database();
$db = $database->getConnection();

?>

	<h2>New TimeFrame</h2>
	<hr>
	<form class="form-horizontal" action="add-timeframe.php" method="post">
		<div class="row">
			<div class="col-xs-6">
				<label for="task-category">Category</label>
				<select name="task-category" id="tf-task-categ">
					<option value="" disabled selected>Select a Category</option>
					<?php 
					$category = new Category($db);					
					$stmt = $category->readCategory();
					$total_category = $category->countAll();
					if($total_category>0){
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						echo "<option value='{$category_id}'>{$category_name}</option>";
						}		
					}
					?>
				</select>
			</div>		
			<div class="col-xs-6">
				<label for="task">Task</label>
				<select name="tf-task" id="tf-task-selection">
				</select>
				<!--to be php-->
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="est-date">Estimated Date: </label>
			<div class="col-xs-8">
			<input type="date" name="est-date">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="est-time">Estimated Time: </label>
			<div class="col-xs-8">
			<input type="time" step="1" name="est-time">
			</div>
		</div>
		<div class="form-group col-xs-12">
				<label for="task">Teams</label>
				<select name="tf-teams" id="timeFrame-team-selector">
				<option value="" disabled selected>Select a Team</option>
					<?php 
					$team = new Team($db);					
					$stmt = $team->readTeams();
					$total_teams = $team->countAll();
					if($total_teams>0){
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						echo "<option value='{$team_name}'>{$team_name}</option>";
						}		
					}
					?>
				</select>
		</div>	
		<div class="form-group col-xs-12" id="mem-options">
			<label for="task">Member</label>
			<select name="tf-task-member" id="tf-teamMembers">
			</select>
		</div>	
		<div>
			<button class="btn btn-danger" id="Cancel">Cancel</button>
			<input type="submit" class="btn btn-primary" name="submit" value="Add" />
		</div>
	</form>
<?php 

if(isset($_POST['submit'])){
	if(
		!empty($_POST['task-category'])&&
		!empty($_POST['tf-task'])&&
		!empty($_POST['est-date'])&&
		!empty($_POST['est-time'])&&
		!empty($_POST['tf-task-member'])){
		$task = new Task($db);

		$task->updateTask($_POST['tf-task'],$_POST['est-date'],$_POST['est-time'],$_POST['tf-task-member']);
			
	}else{
		echo '<script language="javascript">';
		echo 'alert("Please Fill out the Form")';
		echo '</script>';
	}
}

include_once 'footer.php';	
?>