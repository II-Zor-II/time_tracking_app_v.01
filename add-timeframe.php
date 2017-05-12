<?php
include_once 'header.php';
include_once 'db/db.php';
include_once 'objects/member.php';
include_once 'objects/team.php';
include_once 'objects/category.php';
$database = new Database();
$db = $database->getConnection();

session_start();
?>

	<h3>new TimeFrame</h3>
	<hr>
	<form class="form-horizontal" action="add-timeframe.php" method="post">
		<div class="row">
			<div class="col-xs-6">
				<label for="task-category">Category</label>
				<select name="task-category" id="tf-task-categ">
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
				<select name="task" id="tf-task-selection">
				</select>
				<!--to be php-->
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="position">Estimated Date: </label>
			<div class="col-xs-8">
			<input type="date" name="est-date">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="mem-username">Estimated Time: </label>
			<div class="col-xs-8">
			<input type="text" name="est-time">
			</div>
		</div>
		<div class="form-group col-xs-12">
				<label for="task">Teams</label>
				<select name="task" id="timeFrame-selector">
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
			<label for="task">Members</label>
			<select name="task">
				<option>mem 1</option>
				<option>mem 1</option>
				<option>mem 1</option>
				<option>mem 1</option>
			</select>
		</div>	
		<div>
			<button class="btn btn-danger" id="Cancel">Cancel</button>
			<input type="submit" class="btn btn-primary" name="submit" />
		</div>
	</form>
	<?php 

if(isset($_POST['submit'])){
	$member = new Member($db);
	if(!empty($_POST['mem-username'])&&!empty($_POST['position'])&&!empty($_POST['team'])&&!empty($_POST['settings'])&&!empty($_POST['mem-password'])){
		session_unset(); 
		$member->addMember($_POST['mem-username'],$_POST['team'],$_POST['position'],$_POST['settings'],$_POST['mem-password']);
	}else{
		echo '<script language="javascript">';
		echo 'alert("Please Fill out the Form")';
		echo '</script>';
	}
}
session_unset();
include_once 'footer.php';	
?>