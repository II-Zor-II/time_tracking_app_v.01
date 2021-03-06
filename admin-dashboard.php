 <?php 

include_once (dirname(__FILE__)."/".'header.php');
include_once (dirname(__FILE__)."/".'objects/member.php');
include_once (dirname(__FILE__)."/".'db/db.php');
$database = new Database();
$db = $database->getConnection();
?>

<div class="container-fluid">
	<div class="row">
		<input type="button" value="logout" class="logoutbtn" id="logout-btn"/>
	</div>
	<div class="row">
		<button class="btn btn-primary" id="add-member-btn">Add Member</button>
		<button class="btn btn-primary" id="add-team-btn">Add Team</button>
		<button class="btn btn-primary" id="add-category-btn">Add Category</button>
		<button class="btn btn-primary" id="add-task-btn">Add Task</button>
		<button class="btn btn-success" id="add-timeframe-btn">Timeframe</button>
	</div>
	<div class="row">
		<div class="col-xs-4">
			Show   <select name="num-of-entries">
				<?php 
				for($i=10;$i>0;$i--){
					echo "<option value='".$i."'>".$i."</option>";
				}
				?>
  			</select> entries
		</div>
		<div class="col-xs-4 col-offset-xs-4">
			<input type="text" class="form-control" placeholder="Search">
		</div>
	</div>
	<div>
	<table class="table table-bordered">
    <thead>
      <tr>
        <th>Team</th>
        <th>Member</th>
        <th>Position</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
		
<?php
	$members = new Member($db);
	$stmt = $members->readAllMembers(); //$from_record_num,$records_per_page
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		echo "<tr>";
		echo "<td>{$team}</td>";
		echo "<td>{$username}</td>";
		echo "<td>{$position}</td>";
		$stmt2 = $members->getPrivilegeOfUser($row['user_id']);
		$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
		extract($row2);
		if($row2['privilege']==1){
			echo "<td></td>";
		}else{
			echo "<td>			
				<button class='btn btn-success admin-mem-tfBtn' value='{$user_id}' name='{$username}'>Timeframe</button>
				<button class='btn btn-primary admin-mem-worklog' value='{$user_id}' name='{$username}'>Worklog</button>
				<button class='btn btn-warning admin-mem-addTask' value='{$user_id}'>Add Task</button>
			  	  </td>";
			echo "</tr>";	
		}
	}
			
?>
<!--
			<td></td>
			<td></td>
			<td></td>
			<td>
				<button class="btn btn-success">Timeframe</button>
				<button class="btn btn-primary">Working</button>
				<button class="btn btn-warning">Add Task</button>
			</td>
-->
		
    </tbody>
  </table>		
  </div>
</div>




<?php 

include_once 'footer.php';

?>