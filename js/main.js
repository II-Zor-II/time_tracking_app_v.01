
$(document).ready(function(){
	//hides certain selection boxes
	$('#mem-options').hide();
	//--------------------------
	$('#logout-btn').click(function(){
		window.location.href="/tmq/index.php";
	});
	//
	$("#add-member-btn").click(function(){
		window.location.href="/tmq/add-member.php";
	});
	$("#add-team-btn").click(function(){
		window.location.href="/tmq/add-team.php";
	});
	$("#add-category-btn").click(function(){
		window.location.href="/tmq/add-category.php";
	});
	$("#add-task-btn").click(function(){
		window.location.href="/tmq/add-task.php";
	});
	$("#add-timeframe-btn").click(function(){
		window.location.href="/tmq/add-timeframe.php";
	});
	//
	$("#Cancel").click(function(){
		event.preventDefault();
		window.location.href="/tmq/admin-dashboard.php";
	});
	
	// Create a new password on page load
	$("#memPwG-btn").click(function(){
		event.preventDefault();
		var generatedPw = randString();
		$("#password-input").attr("placeholder",generatedPw);
		$("#password-input").val(generatedPw);
	});
	
	$("#password-input").ready(function(){
		var generatedPw = randString();
		$("#password-input").attr("placeholder",generatedPw);
		$("#password-input").val(generatedPw);
	});
	
	//
	$("#timeFrame-selector").change(function(){
		console.log("something changed");
		$('#mem-options').show();
	});
	
	
	//add-timeframe functions with AJAX
	$("#tf-task-categ").change(function(){
		console.log("AJAX response");
		$.ajax({
			url: "category_task_list.php?category_id="+event.target.value, 	
			success: function(result){
        		console.log(result);
				//$("#tf-task-selection")
				
    		}
		});
		
	});
});


function randString(){

  var possible = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  var dataSet = possible.split(','); 
  var text = '';
  for(var i=0; i < 6; i++) {
	text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}


/*
<button class="btn btn-primary" id="add-member-btn">Add Member</button>
		<button class="btn btn-primary" id="add-team-btn">Add Team</button>
		<button class="btn btn-primary" id="add-category-btn">Add Category</button>
		<button class="btn btn-primary" id="add-task-btn">Add Task</button>
		<button class="btn btn-success" id="add-timeframe-btn">Timeframe</button>
*/