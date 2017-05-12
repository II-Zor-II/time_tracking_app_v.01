 <?php 

include_once 'header.php';


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
			Show   <select name="cars">
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
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>
				<button class="btn btn-success">Timeframe</button>
				<button class="btn btn-primary">Working</button>
				<button class="btn btn-warning">Add Task</button>
			</td>
		</tr>
    </tbody>
  </table>		
  </div>
</div>




<?php 

include_once 'footer.php';

?>