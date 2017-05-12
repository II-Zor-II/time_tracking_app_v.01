<?php
include_once 'header.php';
include_once 'db/db.php';
include_once 'objects/member.php';
include_once 'objects/team.php';
$database = new Database();
$db = $database->getConnection();
session_start();
if (isset($_POST['mem-username'])) { 
 $_SESSION['mem-username'] = $_POST['mem-username'];
 } 
if (isset($_POST['position'])) { 
 $_SESSION['position'] = $_POST['position'];
 } 
?>
	<h3>Add Member</h3>
	<hr>
	<form class="form-horizontal" action="add-member.php" method="post">
		<div class="form-group">
			<label class="control-label col-sm-2" for="team">Team</label>
			<div class="col-sm-10">
				<select name="team">
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
				<!--to be php-->
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="position">Position:</label>
			<div class="col-xs-8">
				<input type="text" class="form-control" id="position" placeholder="ex. Web Designer" name="position" value="<?php if(!empty($_SESSION['position'])){echo $_SESSION['mem-username']; }?>"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="settings">Settings:</label>
			<div class="col-xs-8">
				<label class="radio-inline">
					<input type="radio" name="settings" value="clock">Clock Only</label>
				<label class="radio-inline">
					<input type="radio" name="settings" value="timer">Timer Only</label>
				<label class="radio-inline">
					<input type="radio" name="settings" value="both">Both</label>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-xs-2" for="mem-username">Username: </label>
			<div class="col-xs-8">
				<input type="text" class="form-control" id="mem-username" placeholder="username" name="mem-username"
				value="<?php if(!empty($_SESSION['mem-username'])){echo $_SESSION['mem-username']; }?>"> </div>
		</div>
		<div class="form-group col-xs-12">
			<label class="control-label col-xs-2">Password: </label>
			<div class="input-group col-xs-3">			
				<input id="password-input" rel="gp" type="text" class="form-control" rel="gp" data-size="8" name="mem-password"/>
				<button id="memPwG-btn" type="button" class="btn btn-default btn-lg">again</button>    
			</div>
		</div>
		<div>
			<button class="btn btn-danger" id="Cancel">Cancel</button>
			<input type="submit" class="btn btn-primary" name="submit" /> </div>
	</form>
	<?php 
///public function addMember($userinput_username, $userinput_team, $userinput_position, $userinput_settings){

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

include_once 'footer.php';	
?>