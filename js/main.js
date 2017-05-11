


$(document).ready(function(){
	$("#add-member-btn").click(function(){
		window.location.href="/tmq/add-member.php";
	});
	$("#add-team-btn").click(function(){
		window.location.href="/tmq/add-team.php";
	});
	$("#add-category-btn").click(function(){
		window.location.href="/tmq/add-team.php";
	});
	$("#add-task-btn").click(function(){
		window.location.href="/tmq/add-team.php";
	});
	
	$("#Cancel").click(function(){
		event.preventDefault();
		window.location.href="/tmq/admin-dashboard.php";
	});
});



/*
<button class="btn btn-primary" id="add-member-btn">Add Member</button>
		<button class="btn btn-primary" id="add-team-btn">Add Team</button>
		<button class="btn btn-primary" id="add-category-btn">Add Category</button>
		<button class="btn btn-primary" id="add-task-btn">Add Task</button>
		<button class="btn btn-success" id="add-timeframe-btn">Timeframe</button>
*/